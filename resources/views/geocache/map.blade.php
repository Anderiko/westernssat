@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/geocache.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        .background {
            display: none !important;
        }

        header:not(.geo) {
            display: none !important;
        }

        body {
            background-color: #fff !important;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <header class="geo">
        <div class="contentsZone headerZone">
            <p id="proximityLabel"></p>
            <div class="headerLinks">
                <a class="headerLink" href="{{ route('geocache.validate') }}"><img src="{{ asset('images/geocache/validate.png') }}"/></a>
            </div>
        </div>
    </header>

    <div id="basemap"></div>

    <script src="{{ asset('js/geocache.js') }}"></script>
@endsection
