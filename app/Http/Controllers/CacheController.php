<?php

namespace App\Http\Controllers;

use App\Models\Cache;
use App\Models\Enigme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CacheController extends Controller
{
    public function index()
    {
        return view('geocache.index');
    }

    public function map()
    {
        return view('geocache.map');
    }

    public function rules()
    {
        return view('geocache.rules');
    }

    public function credits()
    {
        $cache = Cache::where('type', 'final')->firstOrFail();

        if (!auth()->user()->caches->contains($cache))
        {
            abort(404);
        }

        return view('geocache.credits');
    }

    public function submitEnigme(Request $request)
    {
        $valid = [
            'x',
            'un x',
            'le x',
            'lettre x',
            'la lettre x'
        ];

        $enigme = auth()->user()->enigme;

        if (auth()->user()->enigme)
        {
            if (Carbon::parse(auth()->user()->enigme->throttle)->addMinutes(10) > now())
            {
                return redirect()->back()->withErrors([
                    'anwser' => 'Veuillez patienter avant de retenter.'
                ])->with([
                    'message' => [
                        'title' => 'Enigme',
                        'message' => 'Veuillez patienter avant de retenter.'
                    ]
                ]);
            }
        }
        else
        {
            $enigme = Enigme::create([
                'user_id' => auth()->user()->id,
                'throttle' => Carbon::now()->addMinutes(-10),
                'found_at' => null,
                'propositions' => '',
                'detail' => ''
            ]);
        }

        $data = $request->validate([
            'answer' => 'required',
            'answerDetail' => 'nullable'
        ]);

        $enigme->throttle = now();
        $enigme->propositions .= $data['answer'] . ', ';
        $enigme->detail .= $data['answerDetail'] . ' [next], ';

        $enigme->found_at = in_array(trim(strtolower($data['answer'])), $valid) ? now() : null;

        $enigme->save();

        if ($enigme->found_at)
        {

            return redirect()->back()->with([
                'message' => [
                    'title' => 'Enigme',
                    'message' => 'Félicitations !!! Vous avez correctement répondu à l\'énigme !'
                ]
            ]);
        }
        else
        {
            return redirect()->back()->with([
                'message' => [
                    'title' => 'Enigme',
                    'message' => 'Réponse incorrecte, vous pourrez à nouveau soumettre une proposition dans 10 minutes.'
                ]
            ]);
        }
    }

    public function showCache($cache)
    {
        if ($cache === 'final')
        {
            $cache = Cache::where('type', 'final')->firstOrFail();
        }
        else
        {
            $cache = Cache::where('num', $cache)->firstOrFail();

            if ($cache->show_at > now())
            {
                abort(404);
            }
        }

        return view('geocache.show', [
            'cache' => $cache
        ]);
    }

    public function getGeopoints()
    {
        $pts = Cache::where('type', 'fragment')->get();

        if (auth()->user()->enigme && auth()->user()->enigme->found_at)
        {
            $pts->push(Cache::where('type', 'final')->first());
        }

        $geopoints = [];

        foreach ($pts as $pt)
        {
            if (!$pt->show_at || !$pt->show_at > now())
            {
                $geopoints[] = [
                    'id' => $pt->num,
                    'type' => $pt->type,
                    'found' => auth()->user()->caches->contains($pt),
                    'coord' => $pt->coord,
                    'desc' => $pt->enigme
                ];
            }
        }

        return response()->json([
            'geopoints' => $geopoints
        ]);
    }

    public function validateCacheForm(Request $request)
    {
        $rules = [
            'code' => 'nullable|regex:/([a-z0-9]{8})/i'
        ];
        $passed = Validator::make($request->all(), $rules);
        $code = !$passed->fails() ? $request->input('code') : null;


        $score = 0;
        foreach (auth()->user()->caches as $cache)
        {
            $score += $cache->pivot->points_given;
        }


        $throttle = false;
        if (auth()->user()->enigme) $throttle = Carbon::parse(auth()->user()->enigme->throttle)->addMinutes(10) > now();


        $showEnigme = true;
        foreach (Cache::all() as $cache)
        {
            if (!in_array($cache->num, [6, 8, 9, 12, 16, 17]))
            {
                if (!auth()->user()->caches->contains($cache) && $cache->type === 'fragment') $showEnigme = false;
            }
        }


        $showValidation = count(auth()->user()->caches) !== count(Cache::all());

        return view('geocache.validate', [
            'code' => $code,
            'score' => $score,
            'throttle' => $throttle,
            'enigme' => $showEnigme,
            'showValidation' => $showValidation
        ]);
    }

    public function getEnigmeParts()
    {
        $spriteSources = [];

        // foreach (Cache::all() as $cache)
        foreach (auth()->user()->caches as $cache)
        {
            $puzzle = $cache->puzzle;
            if ($puzzle) $spriteSources[] = [
                'id' => 'fragment' . $puzzle->id,
                'mobileCoord' => $puzzle->mobile_coord,
                'src' => asset('images/geocache/enigme/' . $puzzle->src)
            ];
        }

        return response()->json([
            'spriteSources' => $spriteSources
        ]);
    }

    public function validateCache(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|size:8',
            'coordLat' => 'required|numeric',
            'coordLon' => 'required|numeric'
        ]);

        if (preg_match('/.*mobile.*/i', $request->server('HTTP_USER_AGENT'))) // if mobile user agent -> if on mobile
        {
            $gp = Cache::where('code', $data['code'])->first();

            if ($gp)
            {
                if (!auth()->user()->caches->contains($gp))
                {
                    $latDist = ((double) $data['coordLat'] - $gp->lat) * 1.1119 / 1e-5;
                    $lonDist = ((double) $data['coordLon'] - $gp->lon) * 0.7339 / 1e-5;
                    $gpDistance = sqrt(($latDist * $latDist) + ($lonDist * $lonDist));

                    if ($gpDistance < 30)
                    {
                        $points_given = $gp->points;

                        if ($gp->nb_found === 0)
                        {
                            $points_given += $gp->bonus;
                        }

                            /* BONUS DE PTS JOURNALIERS
                            if ($gp->found_at)
                            {
                                //carbon found at -> +1 day diff day now
                            //  $days = Carbon::make($gp->found_at)->diff(now())->days;
                                $days *= $gp->tile_bonus;
                            } */

                        if (auth()->user()->party)
                        {
                            if (count(auth()->user()->party->members) === 2)
                            {
                                $points_given += 50;
                            }

                            foreach (auth()->user()->party->members as $user)
                            {
                                $this->attachCache($user, $gp, $points_given);
                            }
                        }
                        else
                        {
                            $points_given += 150;
                            $this->attachCache(auth()->user(), $gp, $points_given);
                        }
                    }
                    else
                    {
                        return redirect()->back()->withErrors([
                            'code' => 'Vous devez être à moins de 30m d\'une cache pour la valider.'
                        ])->with([
                            'message' => [
                                'title' => 'Validation de code',
                                'message' => 'Vous devez être à moins de 30m d\'une cache pour la valider.'
                            ]
                        ])->withInput();
                    }
                }
                else
                {
                    return redirect()->back()->withErrors([
                        'code' => 'Vous avez déjà enregistré cette cache.'
                    ])->with([
                        'message' => [
                            'title' => 'Validation de code',
                            'message' => 'Vous avez déjà enregistré cette cache.'
                        ]
                    ]);
                }
            }
            else
            {
                return redirect()->back()->withErrors([
                    'code' => 'Le code saisi est invalide.'
                ])->with([
                    'message' => [
                        'title' => 'Validation de code',
                        'message' => 'Le code saisi est invalide.'
                    ]
                ])->withInput();
            }
        }
        else
        {
            return redirect()->back()->withErrors([
                'code' => 'Vous devez être sur mobile pour valider le code.'
            ])->with([
                'message' => [
                    'title' => 'Validation de code',
                    'message' => 'Vous devez être sur mobile pour valider le code.'
                ]
            ]);
        }

        if ($gp->type === 'final')
        {
            return redirect()->route('geocache.credits')->with([
                'message' => [
                    'title' => 'Cache finale',
                    'message' => 'Félicitations, vous avez trouvé la cache finale, merci d\'avoir participé !'
                ]
            ]);
        }
        else
        {
            return redirect()->route('geocache.map')->with([
                'message' => [
                    'title' => 'Validation de code',
                    'message' => 'Cette cache a bien été enregistrée, pensez à la remettre comme elle était avant ;)'
                ]
            ]);
        }
    }

    private function attachCache($user, Cache $cache, int $points)
    {
        $user->caches()->attach($cache, [
            'found_at' => now(),
            'points_given' => $points
        ]);
    }
}
