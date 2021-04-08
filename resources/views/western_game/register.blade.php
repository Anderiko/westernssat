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

                <h3 class="text-center mb-4 mb-lg-5 western">Rejoindre une équipe</h3>

                <div class="login-card p-md-4">
                    <p class="text-center">Écrivez le code de l'équipe pour continuer</p>

                    <form method="post" action="{{ route('party.join') }}">
                        @csrf
                        @if (session('error'))

                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>

                        @endif
                        <div class="mb-3">
                            <label for="code" class="form-label">Code :</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="XXXXXX" value="{{ old('code') }}" required autofocus>

                            @error('code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('party.create') }}" class="me-4 link">Créér une équipe</a>
                            <button type="submit" class="btn btn-orange text-white">Rejoindre</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection
