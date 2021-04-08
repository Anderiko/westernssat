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

                <h3 class="text-center mb-3 mb-lg-5 western">Mot de passe oublié</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Indiquez votre adresse email pour réinitialiser votre mot de passe</p>

                    <form method="post" action="{{ route('password.forgot') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="jdupont" id="email" name="email" value="{{ old('email') }}" required>
                                <span class="input-group-text">@enssat.fr</span>
                            </div>

                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('profile') }}" class="me-4 link">Retour</a>
                            <button type="submit" class="btn btn-orange text-white">Valider</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

    @error('status')
        {{ $message }}
    @enderror

@endsection
