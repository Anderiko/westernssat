<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\User;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartyController extends Controller
{
    public function leave(Request $request)
    {
        auth()->user()->party()->dissociate();
        auth()->user()->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Confirmation',
                'message' => 'Vous avez bien quitté votre équipe'
            ]
        ]);
    }

    public function register(Request $request, Party $party)
    {
        if (auth()->user()->id !== auth()->user()->party->leader->id || auth()->user()->party->id !== $party->id)
        {
            abort(404);
        }

        $party->registered = (Carbon::now(new DateTimeZone('Europe/Paris')))->toDateTimeLocalString();
        $party->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Inscription équipe',
                'message' => 'Votre équipe a bien été inscrite pour la compétition du Western Game'
            ]
        ]);
    }

    public function unregister(Request $request, Party $party)
    {
        if (auth()->user()->id !== auth()->user()->party->leader->id || auth()->user()->party->id !== $party->id)
        {
            abort(404);
        }

        $party->registered = null;
        $party->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Inscription équipe',
                'message' => 'Votre équipe a bien été désinscrite'
            ]
        ]);
    }

    public function create()
    {
        if (!auth()->user()->party == null)
        {
            return back()->with([
                'message' => [
                    'title' => 'Création équipe',
                    'message' => 'Vous êtes déjà dans une équipe'
                ]
            ]);
        }

        $code = $this->generateCode();

        $party = Party::create([
            'code' => $code,
            'user_id' => auth()->user()->id
        ]);

        auth()->user()->party_id = $party->id;

        auth()->user()->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Création équipe',
                'message' => 'Votre équipe a bien été créée'
            ]
        ]);
    }

    public function joinForm()
    {
        return view('western_game.register');
    }

    public function join(Request $request)
    {
        $data = $request->validate([
            'code' => 'required'
        ]);

        $party = Party::where('code', strtoupper($data['code']));

        if ($party->count() == 0)
        {
            return back()->with([
                'message' => [
                    'title' => 'Rejoindre une équipe',
                    'message' => 'Aucune équipe ne correspond, veuillez réessayer'
                ]
            ])->withInput();
        }

        $party = $party->get()[0];

        if (count($party->members) >= 3)
        {
            return back()->with([
                'message' => [
                    'title' => 'Rejoindre une équipe',
                    'message' => 'Cette équipe est au complet, veuillez en rejoindre une autre'
                ]
            ])->withInput();
        }

        auth()->user()->party_id = $party->id;

        auth()->user()->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Rejoindre une équipe',
                'message' => 'Vous avez bien rejoint une équipe'
            ]
        ]);
    }

    public function removeMember(Request $request, Party $party, User $user)
    {
        if (auth()->user()->id !== auth()->user()->party->leader->id || auth()->user()->party->id !== $party->id)
        {
            abort(404);
        }

        $user->party()->dissociate();
        $user->save();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Retirer de l\'équipe',
                'message' => 'Ce membre a bien été retiré de votre équipe'
            ]
        ]);
    }

    public function dissovleParty(Request $request, Party $party)
    {
        if (auth()->user()->id !== auth()->user()->party->leader->id || auth()->user()->party->id !== $party->id)
        {
            abort(404);
        }

        foreach ($party->members as $member)
        {
            $member->party()->dissociate();
            $member->save();
        }

        if ($party->groupSave) $party->groupSave->delete();
        $party->delete();

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Dissolution équipe',
                'message' => 'Votre équipe a bien été dissoute'
            ]
        ]);
    }

    private function generateCode()
    {
        $code = strtoupper(Str::random(6));

        if (Party::where('code', $code)->count() > 0)
        {
            return $this->generateCode();
        }
        else
        {
            return $code;
        }
    }
}
