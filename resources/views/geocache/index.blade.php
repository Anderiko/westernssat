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
    </style>
@endsection

@section('content')
    <div id="homepage-welcome" style="background-image: url('{{ asset('images/geocache/ploumanach.JPG') }}');"><svg class="orange" version="1.1" fill="#c9690a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path class="wavePath-haxJK1" d="M826.337463,25.5396311 C670.970254,58.655965 603.696181,68.7870267 447.802481,35.1443383 C293.342778,1.81111414 137.33377,1.81111414 0,1.81111414 L0,150 L1920,150 L1920,1.81111414 C1739.53523,-16.6853983 1679.86404,73.1607868 1389.7826,37.4859505 C1099.70117,1.81111414 981.704672,-7.57670281 826.337463,25.5396311 Z" fill="currentColor"></path></svg></div>
    <div class="homepage-section orange">
        <div class="contentsZone">
            <div class="homepage-texttitle">Il manque des lingots !</div>
            <p class="homepage-textcontents">L'enquête menée au cours du Western Game a aidé à retrouver une petite partie du butin volé, mais les trésoriers ont vite remarqué que le budget n'était pas complet !</p>
            <p class="homepage-textcontents">Il semble en effet que Woody avait anticipé que l'enquête avancerait vite.<br/>La rumeur d'une autre planque secrète où se trouve le butin s'est alors rapidement propagée dans Lannion Town.</p>
            <p class="homepage-textcontents">À moitié ivre mort lors d'une soirée dans le saloon, un certain G. O'Kashin aurait révélé avoir trouvé un morceau de papier avec une énigme, mais incapable de la résoudre il se serait amusé à la déchirer et à en disperser les morceaux dans la ville.<br/>
                Convaincu que cette énigme mène aux lingots, il a alors indiqué grossièrement l'emplacement des fragments déchirés avant de perdre connaissance.</p>
            <p class="homepage-textcontents">Dépassée par cette affaire, la marshall a promis une récompense grandiose au citoyen qui l'aiderait à retrouver le précieux beurre salé !</p>
        </div>
    </div>
    <svg class="orange vflip" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path class="wavePath-haxJK1" d="M826.337463,25.5396311 C670.970254,58.655965 603.696181,68.7870267 447.802481,35.1443383 C293.342778,1.81111414 137.33377,1.81111414 0,1.81111414 L0,150 L1920,150 L1920,1.81111414 C1739.53523,-16.6853983 1679.86404,73.1607868 1389.7826,37.4859505 C1099.70117,1.81111414 981.704672,-7.57670281 826.337463,25.5396311 Z" fill="currentColor"></path></svg>
    <div class="homepage-section">
        <div class="contentsZone limited">
            <div class="vflex">
                <div class="hflex homepage-item">
                    <img src="{{ asset('images/geocache/mapIllustration.png') }}">
                    <div class="homepage-textitem">
                        <span class="homepage-textitemtitle">Traquez</span>
                        <span class="homepage-textitembody">les géocaches dans Lannion Town et ses environs</span>
                    </div>
                </div>
                <div class="hflex homepage-item">
                    <div class="homepage-textitem">
                        <span class="homepage-textitemtitle">Validez</span>
                        <span class="homepage-textitembody">les codes des capsules et débloquez les fragments d’énigme</span>
                    </div>
                    <img src="{{ asset('images/geocache/validateIllustration.png') }}">
                </div>
                <div class="hflex homepage-item">
                    <img src="{{ asset('images/geocache/enigmeIllustration.png') }}">
                    <div class="homepage-textitem">
                        <span class="homepage-textitemtitle">Résolvez</span>
                        <span class="homepage-textitembody">l’énigme reconstituée avec tous les fragments trouvés</span>
                    </div>
                </div>
                <div class="hflex homepage-item">
                    <div class="homepage-textitem">
                        <span class="homepage-textitemtitle">Retrouvez</span>
                        <span class="homepage-textitembody">la cache des lingots de beurre salé disparus</span>
                    </div>
                    <img src="{{ asset('images/geocache/lingotsIllustration.png') }}">
                </div>
            </div>
        </div>
    </div>
    <svg class="orange hflip" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path class="wavePath-haxJK1" d="M826.337463,25.5396311 C670.970254,58.655965 603.696181,68.7870267 447.802481,35.1443383 C293.342778,1.81111414 137.33377,1.81111414 0,1.81111414 L0,150 L1920,150 L1920,1.81111414 C1739.53523,-16.6853983 1679.86404,73.1607868 1389.7826,37.4859505 C1099.70117,1.81111414 981.704672,-7.57670281 826.337463,25.5396311 Z" fill="currentColor"></path></svg>
    <div class="homepage-section orange">
        <div class="vflex">
            <div class="homepage-texttitle">Commencez dès maintenant !</div>

            <a class="homepage-linkbtn" href="{{ route('geocache.map') }}">Accédez à la carte interactive</a>
        </div>
    </div>
    <svg class="orange hflip vflip" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path class="wavePath-haxJK1" d="M826.337463,25.5396311 C670.970254,58.655965 603.696181,68.7870267 447.802481,35.1443383 C293.342778,1.81111414 137.33377,1.81111414 0,1.81111414 L0,150 L1920,150 L1920,1.81111414 C1739.53523,-16.6853983 1679.86404,73.1607868 1389.7826,37.4859505 C1099.70117,1.81111414 981.704672,-7.57670281 826.337463,25.5396311 Z" fill="currentColor"></path></svg>

    <div id="main">
        <div class="contentsZone">
            <section>
                <h1>Informations supplémentaires</h1>

                <div class="collapsible">
                    <input type="checkbox" id="q1">
                    <label for="q1"><h4 class="collapsibleTitle spaced">Peut-on participer en équipe ?</h4></label>
                    <p class="collapsibleItem">
                        Oui !<br/>
                        Vous pouvez participer seul ou constituer des équipes de 2 ou 3 personnes.<br/>
                        Les trois configurations ont leurs propres avantages et sont équivalentes en termes de chances de gagner le jeu : les fragments débloqués par chaque membre d'une même équipe sont mis en commun avec les autres membres de l'équipe, et les participants en solitaire gagnent plus de points à chaque géocache trouvée !<br/>
                        Attention toutefois, les équipes ne peuvent plus être changées après avoir été constituées.
                    </p>
                </div>

                <div class="collapsible">
                    <input type="checkbox" id="q2">
                    <label for="q2"><h4 class="collapsibleTitle spaced">Comment sont déterminés les gagnants ?</h4></label>
                    <p class="collapsibleItem">
                        À l'issue du jeu, 3 gagnants différents seront déterminés :<br/>
                        • le participant ayant accumulé le plus de points au cours du jeu<br/>
                        • le participant ayant rassemblé le plus de fragments d'énigme et le plus rapidement<br/>
                        • le participant ayant retrouvé la cache finale des lingots<br/><br/>
                        Si l'énigme n'est pas intégralement reconstituée ou si les lingots ne sont jamais trouvés, d'autres gagnants seront déterminés, il n'y a pas de perdants !
                    </p>
                </div>

                <div class="collapsible">
                    <input type="checkbox" id="q3">
                    <label for="q3"><h4 class="collapsibleTitle spaced">Combien y a-t-il de géocaches à trouver ?</h4></label>
                    <p class="collapsibleItem">
                        Le jeu prévoit 20 géocaches permettant de débloquer un fragment d'énigme.<br/>
                        Elles sont numérotées arbitrairement et sont dispersées partout dans Lannion Town.<br/>
                        L'emplacement des géocaches est dévoilé progressivement sur la carte, avec chaque jour de nouveaux emplacements.<br/><br/>
                        Nous sommes conscients que les conditions sanitaires actuelles imposent des contraintes de distance et que certaines géocaches sont difficilement accessibles à pied, aussi seules 14 de ces 20 géocaches contiennent des fragments strictement nécessaires pour répondre à l'énigme !<br/>
                        Ce sont naturellement les géocaches les plus accessibles qui sont concernées par ces fragments.
                    </p>
                </div>

                <div class="collapsible">
                    <input type="checkbox" id="q4">
                    <label for="q4"><h4 class="collapsibleTitle spaced">Que faire si une géocache est détériorée ou manquante ?</h4></label>
                    <p class="collapsibleItem">
                        Les géocaches sont constituées d'une petite capsule en plastique opaque noir contenant un code inscrit sur un morceau de papier, et sont malheureusement exposées à divers dangers.<br/>
                        Rien ne garantit donc qu'elles seront intègres lorsque vous les trouverez.<br/><br/>
                        Si vous constatez qu'une capsule a été détériorée, ou que le code qu'elle contient est illisible et inutilisable, ou si vous pensez qu'elle a disparu, contactez nous <a href="https://discord.gg/mkCaa4S9Uc" style="color: var(--emph2)">sur discord</a> !<br/>
                        Nous comptons sur votre civisme pour prendre soin des géocaches et pour nous prévenir en cas de problème :)
                    </p>
                </div>

                <div class="collapsible">
                    <input type="checkbox" id="q5">
                    <label for="q5"><h4 class="collapsibleTitle spaced">De quoi a-t-on besoin pour participer ?</h4></label>
                    <p class="collapsibleItem">
                        Le jeu nécessite l'utilisation d'un smartphone et d'un compte vérifié sur westernssat.fr.<br/>
                        Les positions des géocaches sont données sur la carte interactive, et la validation des codes s'effectue sur la page dédiée.<br/>
                        L'utilisation des fonctionnalités de géolocalisation du smartphone est nécessaire pour la validation des codes des capsules, et facultative pour le repérage sur la carte interactive.<br/><br/>
                        Certaines géocaches plus distantes peuvent également nécessiter l'utilisation d'une voiture ou d'un autre moyen de transport, mais cette nécessité peut être contournée par la contitution d'équipes.
                    </p>
                </div>
            </section>
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
