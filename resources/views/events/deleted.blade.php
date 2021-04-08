@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg_nathan.png') }}');
        }
    </style>
@endsection

@section('content')

    <section class="container event-list">
        <h3 class="western text-center mb-4 mb-lg-5">événements supprimés
        </h3>

        <div class="row justify-content-center">
            @foreach($events as $event)
                <div class="col-12 col-lg-4 mb-5 event">
                    <div class="card">
                        <div class="card-img-top">
                            <img src="{{ asset('uploads/'.$event->photo_path) }}" class="img-top" alt="">
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
                                        <a href="{{ route('events.delete', $event->id) }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Supprimer
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @can('delete_event')
        @include('layouts.delete-modal')
    @endcan

@endsection
