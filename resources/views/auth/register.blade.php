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

                <h3 class="text-center mb-3 mb-lg-5 western">Inscription</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Inscrivez-vous pour continuer</p>

                    <form method="post">
                        @csrf

                        @if (session('error'))
                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" placeholder="Jean" value="{{ old('firstname') }}" required>

                                @error('firstname')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dupont" value="{{ old('name') }}" required>

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="email" class="form-label">Email Enssat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror @error('email_valid') is-invalid @enderror" placeholder="jdupont" id="email" name="email" value="{{ old('email') }}" required>
                                    <span class="input-group-text animate__tada animate__animated">@enssat.fr</span>
                                </div>

                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('email_valid')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="faculty_id" class="form-label">Filière</label>
                                <select id="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" name="faculty_id" required>
                                    <option value="" disabled selected>Sélectionnez une filière...</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? "selected" : "" }}>{{ $faculty->name }}</option>
                                    @endforeach
                                </select>

                                @error('faculty_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="****" required>

                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="password_confirmation" class="form-label">Répéter le mot de passe</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="****" required>

                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="{{ route('login') }}" class="me-4 link">Connexion</a>
                            <button type="submit" class="btn btn-orange text-white">Inscription</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection
