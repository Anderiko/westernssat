<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function emailNotice()
    {
        return view('auth.verify-email');
    }

    public function emailVerify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home')->with([
            'message' => [
                'title' => 'Vérification email',
                'message' => 'Votre email est vérifié !'
            ]
        ]);
    }

    public function emailResend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with([
            'message' => [
                'title' => 'Vérification email',
                'message' => 'Un email contenant le lien de vérification vient d\'être envoyé'
            ]
        ]);
    }
}
