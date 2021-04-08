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
            <a href="{{ route('home') }}">
                <img class="headerLogo" src="{{ asset('images/geocache/headerlogo.png') }}">
            </a>
            <div class="headerLinks">
                <a class="headerLink" href="{{ route('geocache.validate') }}"><img src="{{ asset('images/geocache/validate.png') }}"/></a>
                <a class="headerLink" href="{{ route('geocache.map') }}"><img src="{{ asset('images/geocache/map.png') }}"/></a>
            </div>
        </div>
    </header>

    <div id="main">
        <div class="contentsZone">
            <section>
                <h1>Règlement du jeu</h1>
                <section>
                    <h2>1. Organisation</h2>
                    <p>La liste Western'ssat organise dans le cadre des campagnes en vue des élections de l'Association des Eleves de l'ENSSAT (AEE), du 4 avril au 8 avril 2021 un jeu de chasse au trésor "Geocaching".</p>
                </section>
                <section>
                    <h2>2. Conditions de participation</h2>
                    <p>
                        Ce jeu est ouvert à toute personne physique, sans limite d'âge, possédant un compte utilisateur vérifié sur le site westernssat.fr, désirant participer au jeu de géocaching, à l'exception des membres de la liste organisatrice et de toute personne ayant participé à l'élaboration du jeu.<br/>
                        La participation est totalement gratuite.<br/>
                        Le participant devra indiquer des coordonnées permettant de le contacter en cas de gain au jeu.<br/>

                    </p>
                </section>
                <section>
                    <h2>3. Utilisation des données</h2>
                    <p>Les données collectées ne seront communiquées qu'aux seuls destinataires suivants : le webmestre du site westernssat.fr et les organisateurs du jeu de géocaching.<br/>
                        Les données personnelles relatives à votre inscription sont conservées jusqu'à la suppression de votre compte utilisateur westernssat.fr.<br/>
                        Les données de géolocalisation obtenues lors de l'utilisation de l'application ne sont pas conservées après leur traitement.<br/><br/>
                        Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou exercer votre droit à la limitation du traitement de vos données.<br/>
                        En fonction de la base légale du traitement, vous pouvez retirer à tout moment votre consentement au traitement de vos données.<br/>
                        Vous pouvez également vous opposer au traitement de vos données ; vous pouvez également exercer votre droit à la portabilité de vos données.<br/>
                        Consultez le site cnil.fr pour plus d’informations sur vos droits.<br/>
                        Pour exercer ces droits ou pour toute question sur le traitement de vos données dans ce dispositif, vous pouvez vous adresser aux administrateurs du <a href="https://discord.gg/mkCaa4S9Uc" style="color: var(--emph2)">serveur discord</a> de la liste Western'ssat.<br/>
                        Si vous estimez, après nous avoir contactés, que vos droits "Informatique et Libertés" ne sont pas respectés, vous pouvez adresser une réclamation à la CNIL.
                    </p>
                </section>
                <section>
                    <h2>4. Gagnants et prix</h2>
                    <p>Chaque participant pourra gagner au plus un prix.<br/>
                        Trois gagnants différents seront déterminés à l'issue du jeu selon les critères suivant :<br/>
                        • le plus grand nombre de points amassés au cours du jeu<br/>
                        • le plus grand nombre de "fragments" collectés en un temps le plus court<br/>
                        • le temps le plus court pour atteindre la géocache finale<br/><br/>
                        Si un participant gagnant est une équipe, alors le prix obtenu sera équitablement réparti entre les membres constituant l'équipe.</p>
                </section>
                <section>
                    <h2>5. Responsabilité</h2>
                    <p>Les participants sont seuls responsables de leurs actes dans le cadre du jeu et la responsabilité des organisateurs ne saurait être mise en cause si des règles civiles venaient à être enfreintes par les participants lors de leur prospection.<br/>
                        Les géocaches à récupérer ne sont placées que dans des espaces publics accessibles de tous et sans difficulté particulière ou nécessitant un effort physique important.<br/>
                        Les restrictions sanitaires actuelles imposent une distance maximale de 10km du domicile des participants pour la recherche des caches. En considération de cette contrainte, le jeu a été élaboré de manière à garantir que la distance de chaque capsule à l'hotel de ville de Lannion n'excède pas 7km, et de manière à ce que les participants dans l'incapacité de rassembler toutes les capsules ne soient pas pénalisés par ce manque dans leur avancée du jeu.<br/>
                        Les organisateurs se réservent dans tous les cas la possibilité de prolonger la période de participation et de modifier le déroulement du jeu, ainsi que de révoquer la participation des utilisateurs selons des critères laissés à leur appréciation.
                    </p>
                </section>
                <section>
                    <h2>6. Acceptation du règlement</h2>
                    <p>Le simple fait de participer au présent jeu implique l’acception entière et sans réserve du présent règlement et de ses résultats.</p>
                </section>
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
