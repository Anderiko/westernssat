<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function token()
    {
        auth()->user()->api_token = Str::random(60);
        auth()->user()->save();
        return response()->json(['token' => auth()->user()->api_token]);
    }

    public function user()
    {
        return response()->json([
            'user' => User::with(['party', 'party.groupSave', 'soloSave'])->find(auth()->user()->id)->toArray()
        ]);
    }

    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $remember = $request->input('remember') !== null;

        if (Auth::attempt($request->except(['_token', 'remember']), $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with([
                'message' => [
                    'title' => 'Connexion réussie',
                    'message' => 'Bon retour parmi nous !'
                ]
            ]);
        }

        return back()->with([
            'error' => 'Identifiants incorrects, veuillez réessayer.',
            'email' => $request->input('email')
        ]);
    }

    public function registerForm()
    {
        return view('auth.register', [
            'faculties' => Faculty::all()
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'firstname' => 'required|string',
            'name' => 'required|string',
            'faculty_id' => 'required',
            'email' => 'required|unique:users',
            'email_valid' => 'required|email',
            'password' => 'required|confirmed|string'
        ];

        $data = $request->all();

        if (isset($data['email']))
        {
            $data['email_valid'] = $data['email'] . '@enssat.fr';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $request->all();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        return redirect()->route('login')->with([
            'message' => [
                'title' => 'Inscription réussie',
                'message' => 'Bienvenue, un lien pour vérifier votre adresse email a été envoyé !'
            ]
        ]);
    }

    public function requestPassword()
    {
        return view('auth.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required']);

        $status = Password::sendResetLink(
            ['email' => $request->email]
        );

        return $status === Password::RESET_LINK_SENT
        ? redirect()->route('login')->with([
                'message' => [
                    'title' => 'Réinitialisation du mot de passe',
                    'message' => 'Lien envoyé, vérifiez votre boite mail !'
                ]
            ])
        : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'email_verified_at' => Carbon::now()
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with([
                'message' => [
                    'title' => 'Réinitialisation du mot de passe',
                    'message' => 'Mot de passe réinitialisé, vous pouvez vous connecter'
                ]
            ])
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => 'required|confirmed',
        ]);

        auth()->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Changement du mot de passe',
                'message' => 'Votre mot de passe a bien été modifié !'
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with([
            'message' => [
                'title' => 'Déconnecté',
                'message' => 'Déconnexion réussie'
            ]
        ]);
    }

    public function profile()
    {
        return view('profile');
    }

    public function editProfile()
    {
        return view('auth.profile-change', [
            'faculties' => Faculty::all()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'firstname' => 'required',
            'name' => 'required',
            'faculty_id' => 'required',
            'email' => 'nullable'
        ];

        if (!auth()->user()->HasVerifiedEmail())
        {
            $rules['email'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        auth()->user()->update($request->except('_token'));

        return redirect()->route('profile')->with([
            'message' => [
                'title' => 'Profil',
                'message' => 'Vos modifications ont bien été enregistrées'
            ]
        ]);
    }

    public function showPassword()
    {
        return view('auth.change-password');
    }
}
