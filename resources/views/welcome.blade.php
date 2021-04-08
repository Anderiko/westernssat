@extends('layouts.app')

@section('head')
    <style>
        .background {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="western-cover" style="background-image: url('{{ asset('images/backgrounds/bg_welcome.jpeg') }}');">
        <div class="cover">

            <div class="centered">
                <h3 class="text-center western" style="">WESTERN'SSAT</h3>

                <div class="buttons">
                    <a target="_blank" href="https://www.youtube.com/watch?v=K3bG6bkrvAs">Trailer</a>
                    <a href="https://mystere.westernssat.fr/" target="_blank" class="animate__animated animate__tada">Mystère ?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container countdown">
        @if($time !== false)
            <p id="game-launch">Lancement du prochain événement dans : <span id="timer" data-time="{{ $time }}"></span></p>
            <a href="{{ route('events.index') }}">Voir plus</a>
        @else
            <p>Le prochain événement arrive !</p>
            <a href="{{ route('events.index') }}">Voir plus</a>
        @endif
    </div>

    <section class="container presentation">
        <div class="row mb-5 socials">
            <div class="col-12 col-lg-3 offset-lg-3 text-center fb">
                <a target="_blank" href="https://www.facebook.com/westernssat" class="d-flex justify-content-center">
                    <span class="me-2">Facebook</span>
                    <img src="{{ asset('images/fb.png') }}" width="50" height="50" alt="FB Logo">
                </a>
            </div>
            <div class="col-12 col-lg-3 text-center insta">
                <a target="_blank" href="https://www.instagram.com/westernssat/" class="d-flex justify-content-center">
                    <span class="me-2">Instagram</span>
                    <img src="{{ asset('images/insta.png') }}" width="50" height="50" alt="Insta Logo">
                </a>
            </div>
        </div>

        <div>
            <h3 class="western text-center text-dark mt-lg-5 mb-3">Événements</h3>
            <p class="text-center">Une liste des
                <del>rodéos</del>
                événements à venir - <a href="{{ route('events.index') }}" class="btn text-orange">Voir plus</a></p>

            <div class="event-list row justify-content-center">
                @forelse($events as $event)
                    <div class="col-12 col-lg-4 mb-5 event">
                        <div class="card" style="box-shadow: 0 0 .5em 0 rgba(100, 100, 100, .3);">
                            <div class="card-body">
                                <div class="content">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="card-title m-0" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                            {{ $event->name }}
                                        </h4>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn text-orange" style="border-radius: 0; width: 100px;">
                                            <i class="fas fa-search"></i>
                                            Détails
                                        </a>
                                    </div>
                                    <hr class="m-0 mb-2">
                                    <p><span class="badge bg-{{ $event->label->color }}" style="border-radius: 0;">{{ $event->label->name }}</span></p>
                                    <p class="card-text"><i class="fas fa-calendar-day me-3"></i>{{ (new DateTime($event->start))->format( 'd/m/Y') }}</p>
                                    @if((new DateTime($event->inscription_start)) > new DateTime('now'))
                                        <p class="card-text text-orange"><i class="fas fa-calendar-exclamation me-3"></i>Sera affiché le {{ (new DateTime($event->inscription_start))->format( 'd/m/Y') }}</p>
                                    @endif
                                    <p class="card-text">{{ $event->overview }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-center">Le prochain événement arrive !</p>
                @endforelse
            </div>
        </div>

        <div class="organigramme">
            <h3 class="western text-center text-dark mt-5 mb-5">LA liste</h3>
            <figure>
                <img src="{{ asset('images/organigramme_corrige.jpg') }}" alt="" style="max-width: 100%;">
                <figcaption class="text-center py-2">LA Liste - <a target="_blank" href="{{ asset('images/organigramme_corrige.jpg') }}" class="btn text-orange px-0">Télécharger</a></figcaption>
            </figure>
        </div>

        @can('create_event')
            <hr>


            <div class="vade-retro">
                <p class="text-center">VADE RETRO (y'a que nous qui pouvons voir) - <a href="https://www.youtube.com/watch?v=RkZkekS8NQU" target="_blank" class="btn text-orange px-0">Voir plus</a></p>
            </div>
        @endcan
    </section>

    <footer>
        <a href="{{ route('mentions') }}" class="btn text-orange p-0 d-inline">Mentions légales</a> - WESTERN'SSAT &copy; 2021
    </footer>

@endsection

@section('scripts')
    <script>
        let clock = document.getElementById('timer')

        if (clock) {
            let time = new Date(clock.getAttribute('data-time')).getTime()

            let timer = setInterval(countdown, 1000)
            countdown()


            function countdown() {
                let now = new Date().getTime()

                let distance = time - now

                let days = Math.floor(distance / (1000 * 60 * 60 * 24))
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
                let seconds = Math.floor((distance % (1000 * 60)) / 1000)

                clock.innerHTML = days + "j " + hours + "h " + minutes + "m " + seconds + "s "

                if (distance < 0) {
                    document.getElementById('game-launch').innerHTML = "Le prochain événement arrive !"
                    clearInterval(timer)
                }
            }
        }

    </script>
@endsection
