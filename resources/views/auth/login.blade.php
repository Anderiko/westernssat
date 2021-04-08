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

            <div class="col-lg-6 offset-lg-3">

                <h3 class="text-center mb-4 mb-lg-5 western">Connexion</h3>

                <div class="login-card p-md-4">
                    <p class="text-center">Connectez-vous pour continuer</p>

                    <form method="post">
                        @csrf
                        @if (session('error'))

                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>

                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label">Identifiant</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="jdupont" id="email" name="email" value="{{ session('email') }}" required>
                                <span class="input-group-text">@enssat.fr</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="****" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" value="true" checked>
                                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                </div>

                            </div>
                            <div class="col-6">

                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('password.forgot') }}" class="link">Mot de passe oublié ?</a>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('register') }}" class="me-4 link">Inscription</a>
                            <button type="submit" class="btn btn-orange text-white">Connexion</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection
