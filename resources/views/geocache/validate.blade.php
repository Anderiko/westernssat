@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/geocache.css') }}"/>

    <style>
        .background {
            display: none !important;
        }

        header:not(.geo) {
            display: none !important;
        }

        .codePromptSubmitBtn:disabled {
            border: solid var(--lightgray) 2px;
            background-color: var(--lightgray);
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <header class="geo">
        <div class="contentsZone headerZone">
            <a href="{{ route('home') }}">
                <img class="headerLogo" src="{{ asset('images/geocache/headerlogo.png') }}">
            </a>
            <div class="headerLinks">
                <a class="headerLink" href="{{ route('geocache.map') }}"><img src="{{ asset('images/geocache/map.png') }}"/></a>
            </div>
        </div>
    </header>


    <div id="main">
        <div class="contentsZone">

            @if($showValidation)
                <section>
                    <h1>Validation de code</h1>

                    <form class="codePromptForm" id="codePromptForm" action="{{ route('geocache.validate') }}" method="post">
                        @csrf
                        <input disabled class="codePromptTextbox @error('code') is-invalid @enderror" id="codePromptTextbox" type="text" placeholder="Géolocalisation nécessaire" @if($code || old('code')) value="{{ old('code') ? old('code') : $code }}" @endif required><br><br>
                        <button disabled type="submit" class="codePromptSubmitBtn" id="codePromptSubmitBtn"><i class="fas fa-sync-alt fa-spin me-1" id="validateLoader"></i> Valider</button>
                    </form>

                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="collapsible" id="errorNoGPSbox">
                        <input type="checkbox" id="errorNoGPS">
                        <label for="errorNoGPS"><h5 class="collapsibleTitle spaced">Veuillez activer et autoriser la géolocalisation de votre appareil</h5></label>
                        <p class="collapsibleItem">
                            Afin de limiter la triche, le système requiert de vérifier votre présence à proximité de la capsule dont vous souhaitez valider le code.<br/>
                            Votre position GPS est donc requise pour effectuer cette analyse. Les coordonnées GPS obtenues sont celles fournies par le GPS de votre appareil.
                        </p>
                    </div>

                </section>
            @endif


            <section>
                <h1>Fragments trouvés</h1>
                <h3>Votre score : {{ $score }} pts</h3>
                <div class="illustration">
                    <canvas id="elementsZoneCanvas" width="1280" height="720"></canvas>
                </div>

                @if($enigme)

                    @if(!auth()->user()->enigme || !auth()->user()->enigme->found_at)

                        <div class="collapsible">
                            <input type="checkbox" id="riddleAnswer">
                            <label for="riddleAnswer"><h4 class="collapsibleTitle spaced">Répondre à l'énigme</h4></label>
                            <div class="collapsibleItem">
                                <p>
                                    Entrez votre réponse à l'énigme dans le premier champ de texte ci-dessous.<br/><br/>
                                    L'énigme contient 9 références à sa réponse. Indiquez celles que vous avez repérées pour tenter de remporter des points !<br/>
                                    Le gagnant de l'énigme sera déterminé par son score obtenu en repérant les différentes références de l'énigme !<br/><br/>
                                    Ce second champ est toutefois facultatif et l'omettre ne gênera pas la validation de l'énigme pour trouver les lingots salés.
                                </p>
                            </div>
                        </div>

                        <form class="codePromptForm verticalForm" id="riddleValidation" action="{{ route('geocache.enigme') }}" method="post">
                            @csrf
                            <input class="codePromptTextbox" type="text" name="answer" placeholder="Votre réponse à l'énigme" @if($throttle) disabled @endif required>
                            <textarea class="codePromptTextbox" name="answerDetail" form="riddleValidation" style="resize:none" @if($throttle) disabled @endif rows="10" placeholder="Explication détaillée de votre réponse (champ facultatif)"></textarea>
                            <input class="codePromptSubmitBtn" type="submit" value="Valider" @if($throttle) disabled @endif>
                        </form>

                        @if($throttle)
                            <h3 style="color:var(--emph2)">Réponse incorrecte, vous pourrez à nouveau soumettre une proposition dans 10 minutes.</h3>
                        @endif

                    @else

                        <h3 style="color:#4DAB33">Félicitations !</h3>

                        <p>
                            Vous avez correctement répondu à l'énigme !<br/>
                            Allez voir du côté de la carte, on dirait qu'il y a du nouveau ...
                        </p>

                        @if(!$showValidation)

                            <div class="vflex mt-5">
                                <a class="credits homepage-linkbtn" href="{{ route('geocache.credits') }}">Crédits</a>
                            </div>

                        @endif

                    @endif

                @else

                    <p>Reconstituez l'énigme pour pouvoir la résoudre<br/></p>

                @endif
            </section>

        </div>
    </div>
    <footer>
        <div class="contentsZone footerZone">
            <div class="footerLinks">
                <a class="footerLink" href="{{ route('geocache.rules') }}">Règlement du jeu</a>
                <a class="footerLink" href="https://discord.gg/mkCaa4S9Uc">Serveur Discord</a>
                <a class="footerLink" href="https://westernssat.fr/mentions">Mentions légales</a>
            </div>
            <a href="/"><img class="footerLogo" src="{{ asset('images/geocache/logo.png') }}"></a>
            <div class="footerCopyright">&#169; Western'ssat, 2021</div>
        </div>
    </footer>

    @if($showValidation)
        <script src="{{ asset('js/gpsValidate.js') }}"></script>
    @endif

    <script src="{{ asset('js/imgcanvas.js') }}"></script>
@endsection
