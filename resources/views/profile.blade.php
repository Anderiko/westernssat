@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg-login.png') }}');
        }
    </style>
@endsection

@section('content')

    <section class="container login profile">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h3 class="text-center mb-3 mb-lg-5 western">Profil</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Mes informations</p>

                    <p>
                        <strong>Nom :</strong><br>
                        {{ auth()->user()->firstname }} {{ auth()->user()->name }}
                    </p>

                    <p>
                        <strong>Filière :</strong><br>
                        {{ auth()->user()->faculty->name }}
                    </p>

                    <p>
                        <strong>Email :</strong><br>
                        {{ auth()->user()->email }}<br>

                        @if(auth()->user()->HasVerifiedEmail())
                            <small><em>Votre email est vérifié.</em></small>
                        @else
                            <small><em>Votre email n'est pas vérifié.</em></small>
                        @endif
                    </p>
                    <hr>

                    <div class="teams">
                        <p class="m-0"><strong>Mon équipe :</strong></p>

                        @if(auth()->user()->party)


                            <ul class="team-members">
                                <li>
                                    <i class="fas fa-crown text-orange"></i>
                                    {{ auth()->user()->party->leader->firstname }}
                                    {{ auth()->user()->party->leader->name }}

                                    @if(auth()->user()->party->leader->id == auth()->user()->id && count(auth()->user()->caches) === 0)
                                        - <a href="{{ route('party.dissolve', auth()->user()->party->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="link">
                                            Dissoudre l'équipe
                                        </a>
                                    @endif
                                </li>
                                @foreach(auth()->user()->party->members as $member)
                                    @if($member->id !== auth()->user()->party->leader->id)
                                        <li>{{ $member->firstname }}
                                            {{ $member->name }}

                                            @if(auth()->user()->party->leader->id == auth()->user()->id && count(auth()->user()->caches) === 0)
                                                - <a href="{{ route('party.removeMember', [auth()->user()->party->id, $member->id]) }}" data-bs-toggle="modal" data-bs-target="#kickModal" class="link">
                                                    Exclure de l'équipe
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                            @if(auth()->user()->party->leader->id != auth()->user()->id && count(auth()->user()->caches) === 0)
                                <a href="{{ route('party.leave') }}" data-bs-toggle="modal" data-bs-target="#quitModal" class="link">
                                    Quitter l'équipe
                                </a>

                            @else

                                {{-- @if(auth()->user()->party->registered !== null)
                                    <a href="{{ route('party.unregister', auth()->user()->party->id) }}" class="link">
                                        Désinscrire l'équipe
                                    </a>
                                @else
                                    <a href="{{ route('party.register', auth()->user()->party->id) }}" class="link">
                                        Inscrire l'équipe
                                    </a>
                                @endif --}}

                            @endif

                            <p>
                                <strong>Code équipe :</strong><br>
                                {{ auth()->user()->party->code }}
                            </p>

                        {{--
                            @if(auth()->user()->party->registered !== null)
                                <p>
                                    <small><em>Votre équipe est inscrite pour la compétition Western Game</em></small>
                                </p>

                            @else
                                <p>
                                    <small><em>Votre équipe n'est pas inscrite pour la compétition Western Game</em></small>
                                </p>
                            @endif
                            --}}
                        @else
                            <div class="d-flex flex-column">
                                <small class="mb-2">Vous n'êtes pas dans une équipe.</small>

                                @if(count(auth()->user()->caches) === 0)
                                    <a href="{{ route('party.create') }}" class="link mb-2">Créer une équipe</a>
                                    <a href="{{ route('party.join') }}" class="link">Rejoindre une équipe</a>
                                @else
                                    <p>Vous avez commencé le géocaching vous ne pouvez plus créer ou rejoindre une équipe</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <hr>

                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ route('password.change') }}" class="link">Changer mon mot de passe</a>
                        <a href="{{ route('profile.edit') }}" class="link ms-4">Modifier mes informations</a>
                        @if(!auth()->user()->HasVerifiedEmail())
                            <form class="d-inline ms-4" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link link p-0 m-0 align-baseline" style="box-shadow: none;">Vérifier mon email</button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>

    @if(auth()->user()->party)


        @if(auth()->user()->party->leader->id == auth()->user()->id)


            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 0;">
                        <div class="modal-header" style="border-radius: 0;">
                            <h5 class="modal-title" id="deleteModalTitle">Confirmation de dissolution</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment dissoudre votre équipe ?</p>
                        </div>
                        <div class="modal-footer" style="border-radius: 0;">
                            <button type="button" class="btn btn-secondary text-white" style="border-radius: 0;" data-bs-dismiss="modal">Annuler</button>
                            <form class="d-inline" method="post" action="#" id="deleteLink">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white align-baseline" style="box-shadow: none;border-radius: 0;">
                                    <i class="fas fa-trash"></i>
                                    Dissoudre
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="kickModal" tabindex="-1" aria-labelledby="kickModalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 0;">
                        <div class="modal-header" style="border-radius: 0;">
                            <h5 class="modal-title" id="kickModalTitle">Confirmation d'exclusion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment exclure cette personne de votre équipe ?</p>
                        </div>
                        <div class="modal-footer" style="border-radius: 0;">
                            <button type="button" class="btn btn-secondary text-white" style="border-radius: 0;" data-bs-dismiss="modal">Annuler</button>
                            <form class="d-inline" method="post" action="#" id="kickLink">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white align-baseline" style="box-shadow: none;border-radius: 0;">
                                    <i class="fas fa-user-minus"></i>
                                    Exclure
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let deleteModal = document.getElementById('deleteModal')

                deleteModal.addEventListener('show.bs.modal', function (event) {
                    let button = event.relatedTarget
                    let link = document.getElementById('deleteLink')
                    link.setAttribute('action', button.getAttribute('href'))
                })

                let kickModal = document.getElementById('kickModal')

                kickModal.addEventListener('show.bs.modal', function (event) {
                    let button = event.relatedTarget
                    let link = document.getElementById('kickLink')
                    link.setAttribute('action', button.getAttribute('href'))
                })
            </script>

        @else

            <div class="modal fade" id="quitModal" tabindex="-1" aria-labelledby="quitModalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 0;">
                        <div class="modal-header" style="border-radius: 0;">
                            <h5 class="modal-title" id="quitModalTitle">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment quitter votre équipe ?</p>
                        </div>
                        <div class="modal-footer" style="border-radius: 0;">
                            <button type="button" class="btn btn-secondary text-white" style="border-radius: 0;" data-bs-dismiss="modal">Annuler</button>
                            <form class="d-inline" method="post" action="#" id="quitLink">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white align-baseline" style="box-shadow: none;border-radius: 0;">
                                    <i class="fas fa-sign-out"></i>
                                    Quitter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let quitModal = document.getElementById('quitModal')

                quitModal.addEventListener('show.bs.modal', function (event) {
                    let button = event.relatedTarget
                    let link = document.getElementById('quitLink')
                    link.setAttribute('action', button.getAttribute('href'))
                })
            </script>

        @endif


    @endif

@endsection
