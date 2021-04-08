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

                <h3 class="text-center mb-3 mb-lg-5 western">Profil</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Modifier mes informations</p>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf

                        @if (session('error'))
                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" placeholder="Jean" value="{{ auth()->user()->firstname }}" required>

                                @error('firstname')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dupont" value="{{ auth()->user()->name }}" required>

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="jdupont" id="email" name="email" value="{{ explode('@', auth()->user()->email)[0] }}" {{ auth()->user()->hasVerifiedEmail() ? 'disabled' : "" }} required>
                                    <span class="input-group-text">@enssat.fr</span>
                                </div>

                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="faculty_id" class="form-label">Filière</label>
                                <select id="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" name="faculty_id" required>
                                    <option value="" disabled selected>Sélectionnez une filière...</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ auth()->user()->faculty_id == $faculty->id ? "selected" : "" }}>{{ $faculty->name }}</option>
                                    @endforeach
                                </select>

                                @error('faculty_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="{{ route('profile') }}" class="link me-4">Retour</a>
                            <button type="submit" class="btn btn-orange text-white">Valider</button>
                        </div>
                    </form>
                    <hr>

                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ route('password.change') }}" class="link">Changer mon mot de passe</a>
                        @if(!auth()->user()->hasVerifiedEmail())
                            <form class="d-inline ms-4" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link link p-0 m-0 align-baseline" style="box-shadow: none;">Vérifier mon email</button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
