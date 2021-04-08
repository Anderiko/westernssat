@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg_welcome.jpeg') }}');
        }

        header:not(.geo) {
            display: none !important;
        }
    </style>
@endsection

@section('content')

    <header class="geo text-white">CEIzcbeiuzova</header>

    <section class="container game timer">
        <h3 class="text-white text-center" id="game-launch">L'escape game arrive dans : <br><span id="timer" data-time="{{ $time }}"></span></h3>
    </section>

@endsection


@section('scripts')
    <script>
        let clock = document.getElementById('timer')

        if (clock)
        {
            let time = new Date(clock.getAttribute('data-time')).getTime()

            let timer = setInterval(countdown, 1000)
            countdown()


            function countdown ()
            {
                let now = new Date().getTime()

                let distance = time - now

                let days = Math.floor(distance / (1000 * 60 * 60 * 24))
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
                let seconds = Math.floor((distance % (1000 * 60)) / 1000)

                clock.innerHTML = days + "j " + hours + "h " + minutes + "m " + seconds + "s "

                if (distance < 0)
                {
                    document.getElementById('game-launch').innerHTML = "C'est parti l'escape game est lancé ! Rafraichis la page pour y accéder !"
                    clearInterval(timer)
                }
            }
        }

    </script>
@endsection
