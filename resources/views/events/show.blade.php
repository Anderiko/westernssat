@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg_hugo.png') }}');
        }

        .output p {
            margin: 0;
        }
    </style>
@endsection

@section('content')

    <section class="container event-list show-event">
        <h3 class="western text-center mb-4 mb-lg-5">événements</h3>

        <div class="col-12 mb-5 event">
            <div class="card">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('uploads/'.$event->photo_path) }}')">
                    @if($event->label->slug == 'ended')
                        <img src="{{ asset('images/event_ended.png') }}" alt="" class="d-block" style="max-width: 100%; max-height: 100%; opacity: .5;">
                    @endif
                </div>
                <div class="card-body">
                    <div class="content">
                        <div class="card-title d-flex justify-content-between">
                            <h3>{{ $event->name }}</h3>
                            <a href="{{ route('events.index') }}">Retour</a>
                        </div>
                        <hr class="m-0 mb-2">
                        <p><span class="badge text-uppercase bg-{{ $event->label->color }}" style="border-radius: 0;">{{ $event->label->name }}</span></p>

                        <p class="card-text m-0"><i class="fas fa-calendar-day"></i>{{ (new DateTime($event->start))->format( 'd/m/Y') }}</p>

                        @if((new DateTime($event->inscription_start)) > new DateTime('now'))
                            <p class="card-text text-orange"><i class="fas fa-calendar-exclamation me-3"></i>Sera affiché le {{ (new DateTime($event->inscription_start))->format( 'd/m/Y') }}</p>
                        @endif

                        @if($event->max_participants != NULL)
                            <p class="card-text m-0"><i class="fas fa-users"></i>{{ $event->max_participants }}</p>
                        @endif

                        @if($event->price != NULL)
                            <p class="card-text"><i class="fas fa-euro-sign"></i>{{ $event->price }}</p>
                        @endif

                        {!! $event->description !!}
                    </div>

                    @can('edit_event')
                        <div class="buttons">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </a>

                            @can('delete_event')
                                <a href="{{ route('events.delete', $event->id) }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </a>
                            @endcan
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </section>

    @can('delete_event')
        @include('layouts.delete-modal')
    @endcan

@endsection
