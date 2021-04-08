@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg-login.png') }}');
        }
    </style>
@endsection

@section('content')

    <section class="container login">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <div class="login-card p-md-4">
                    <h3 class="text-center mb-4">Vérifiez votre adresse mail pour continuer</h3>
                    <p class="text-center">
                        Avant de continuer, veuillez cliquer sur le lien de vérification envoyé par mail.
                    </p>
                    <hr>

                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ route('verification.notice') }}" class="link">Renvoyer un email</a>
                        <a href="{{ route('profile.edit') }}" class="link ms-4">Modifier mes informations</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
