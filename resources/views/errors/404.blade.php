@extends('layouts.app')

@section('head')
    <style>
        .background {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="error_404">
        <span class="err-code">
            404
        </span>

        <div class="err-text">
            <h3>Page non trouvée</h3>
            <p>
                <small>
                    La page que vous recherchez n'existe pas. <a href="{{ route('home') }}" class="link">Retour à l'accueil</a>
                </small>
            </p>
        </div>
    </div>

@endsection
