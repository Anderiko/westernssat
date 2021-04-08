@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/geocache.css') }}">

    <style>
        .background {
            display: none !important;
        }

        header:not(.geo) {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <header class="geo">
        <div class="contentsZone headerZone">
            <div class="headerLinks">
                <a class="headerLink" href="{{ route('geocache.map') }}"><img src="{{ asset('images/geocache/backarrow.png') }}"/></a>
            </div>
            <div class="headerLinks">
                <a class="headerLink" href="{{ route('geocache.validate') }}"><img src="{{ asset('images/geocache/validate.png') }}"/></a>
            </div>
        </div>
    </header>

    <div id="main">
        <div class="contentsZone">
            @if($cache->type !== 'final')

                <section>
                    <section>
                        <h1>Fragment {{ $cache->num }}</h1>
                        <h4 style="color: var(--emph2)" class="i">{{ $cache->enigme }}</h4>

                        <div class="collapsible" id="errorNoGPSbox">
                            <input type="checkbox" id="errorNoGPS">
                            <label for="errorNoGPS"><p class="collapsibleTitle spaced">Révéler l'image indice</p></label>
                            <div class="collapsibleItem illustration">
                                <img src="{{ asset('images/geocache/capsules/' . $cache->src) }}">
                            </div>
                        </div>

                    </section>
                    <section>
                        <h2>À propos de ce fragment</h2>
                        <p>Trouver ce fragment vous rapportera <b>{{ $cache->points }} points</b>.</p>
                        <p><b>{{ count($cache->users) }}</b> personnes l'ont déjà trouvé.</p>
                        <p>Difficulté estimée : <b>{{ $cache->difficulty }}/5</b></p>
                    </section>
                </section>
                <section>
                    <p>Si vous pensez que la capsule a disparu, ou si vous constatez qu'elle a été détériorée ou que le code est inutilisable, contactez nous <a href="https://discord.gg/mkCaa4S9Uc" style="color: var(--emph2)">sur discord</a> !</p>
                </section>

            @else

                <section>
                    <section>
                        <p class="text-center">
                            Aucune information n'est disponible pour cet emplacement...<br/>
                            Le secret semble avoir été très bien gardé !
                        </p>
                        <div class="illustration">
                            <img src="{{ asset('images/geocache/position-final.png') }}">
                        </div>
                    </section>
                </section>

            @endif
        </div>
    </div>


    <footer>
        <div class="contentsZone footerZone">
            <div class="footerLinks">
                <a class="footerLink" href="{{ route('geocache.rules') }}">Règlement du jeu</a>
                <a class="footerLink" href="https://discord.gg/mkCaa4S9Uc">Serveur Discord</a>
                <a class="footerLink" href="{{ route('mentions') }}">Mentions légales</a>
            </div>
            <a href="/"><img class="footerLogo" src="{{ asset('images/geocache/logo.png') }}"></a>
            <div class="footerCopyright">&#169; Western'ssat, 2021</div>
        </div>
    </footer>
@endsection
