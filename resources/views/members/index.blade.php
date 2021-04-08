@extends('layouts.app')

@section('head')
    <style>
        .background {
            display: none;
        }
    </style>
@endsection

@section('content')

    <section class="members">
        <h3 class="text-center western pb-4 pb-lg-5">Membres
            @can('create_member')
                <div class="d-flex justify-content-center mb-4 mb-lg-5">
                    <a href="{{ route('members.create') }}" class="btn text-center text-white" style="border-radius: 0; border: 1px solid #fff; font-family: 'Nunito', sans-serif">
                        <i class="fas fa-plus"></i> Ajouter
                    </a>
                </div>
            @endcan</h3>


        <div class="members-content">
            @foreach($members as $member)
                <div class="parallax" style="background-image: url('{{ asset('images/backgrounds/'.$member->bg_path) }}')"></div>

                <div class="parallax-content py-3 p-lg-5 {{ $loop->index % 2 === 0 ? '' : 'alternate' }}">
                    <div class="container">
                        <div class="cust-wrapper">
                            <div class="photo-cropper">
                                <img src="{{ asset('images/members/'.$member->photo_path) }}" alt="" class="photo rounded">
                            </div>
                            <div class="member-presentation">
                                <h3 class="mb-lg-4">{{ $member->name }} <small style="font-weight: lighter; font-size: .75em;"><em>alias</em></small>
                                    <span style="font-family: 'Western', 'Nunito', sans-serif;">{{ $member->alias }}</span></h3>
                                <p>{{ $member->description }}</p>
                                @can('edit_member')
                                    <div>
                                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary text-white" style="border-radius: 0;">
                                                <i class="fas fa-edit"></i>
                                                Modifier
                                            </a>

                                        @can('delete_member')
                                            <a href="{{ route('members.delete', $member->id) }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger text-white" style="border-radius: 0;">
                                                <i class="fas fa-trash"></i>
                                                Supprimer
                                            </a>
                                        @endcan
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @can('delete_member')
        @include('layouts.delete-modal')
    @endcan

@endsection
