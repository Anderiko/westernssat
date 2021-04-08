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

                <div class="login-card p-md-4">
                    <p class="text-center">Changer de mot de passe</p>

                    <form method="post" action="{{ route('password.change') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Ancien mot de passe</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="****" required>

                            @error('old_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="****" required>

                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Répéter le nouveau mot de passe</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="****" required>

                            @error('password_confirmation')
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

@endsection
