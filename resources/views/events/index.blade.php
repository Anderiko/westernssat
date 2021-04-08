@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg_nathan.png') }}');
        }
    </style>
@endsection

@section('content')

    <section class="container event-list mb-0">
        <h3 class="western text-center mb-4 mb-lg-5">événements</h3>
        @can('create_event')
            <div class="d-flex justify-content-center mb-4 mb-lg-5">
                <a href="{{ route('events.create') }}" class="btn text-center text-white" style="border-radius: 0; border: 1px solid #fff;">
                    <i class="fas fa-plus"></i> Ajouter
                </a>
            </div>
        @endcan
        <div class="row justify-content-center">
            @forelse($events as $event)
                <div class="col-12 col-lg-4 mb-5 event">
                    <div class="card">
                        <div class="card-img-top d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('uploads/'.$event->photo_path) }}')">
                            @if($event->label->slug == 'ended')
                                <img src="{{ asset('images/event_ended.png') }}" alt="" style="max-width: 100%; max-height: 100%; opacity: .5;">
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <hr class="m-0 mb-2">
                                <p class="card-text"><i class="fas fa-calendar-day me-3"></i>{{ (new DateTime($event->start))->format( 'd/m/Y') }}</p>
                                @if((new DateTime($event->inscription_start)) > new DateTime('now'))
                                    <p class="card-text text-orange"><i class="fas fa-calendar-exclamation me-3"></i>Sera affiché le {{ (new DateTime($event->inscription_start))->format( 'd/m/Y') }}</p>
                                @endif
                                <p class="card-text">{{ $event->overview }}</p>
                            </div>
                            <div class="actions">
                                <p><span class="badge text-uppercase bg-{{ $event->label->color }}" style="border-radius: 0;">{{ $event->label->name }}</span></p>

                                <div class="buttons">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                        Détails
                                    </a>

                                    @can('edit_event')
                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            Modifier
                                        </a>
                                    @endcan

                                    @can('delete_event')
                                        <a href="{{ route('events.delete', $event->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Supprimer
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty

                <h4 class="text-center mt-5 text-white">Le prochain événement arrive !</h4>

            @endforelse
        </div>
    </section>

    @can('delete_event')
        @include('layouts.delete-modal')
    @endcan

@endsection
