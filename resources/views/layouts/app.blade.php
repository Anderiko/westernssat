<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="google-site-verification" content="NAnZt5G-tj6kB_3zxT1xPJHS69a7LixJBh1nseKSn0g" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Campagne AEE ENSSAT 2021 - WESTERN'SSAT - Votre liste préférée est là">

    <link rel="icon" href="{{ asset('logo.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ env('APP_URL') }}">

    <title>Western'ssat</title>

    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @yield('head')
</head>
<body>

<!-- <img src="{{ asset('images/westernssat.svg') }}" alt="" class="d-block farwest"> -->
<div class="background">
    <div class="dark-opacity"></div>
</div>

@include('layouts.header')

@yield('content')

@if(session('message'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 999999;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('images/westernssat.png') }}" class="rounded me-2" width="20" height="20" alt="">
                <strong class="me-auto">{{ session('message')['title'] }}</strong>
                <small class="text-muted">WESTERN'SSAT</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('message')['message'] }}
            </div>
        </div>
    </div>
@endisset

<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')
</body>
</html>
