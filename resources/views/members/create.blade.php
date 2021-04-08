@extends('layouts.app')

@section('head')
    <style>
        .background {
            background-image: url('{{ asset('images/backgrounds/bg_welcome.jpeg') }}');
        }
    </style>
@endsection

@section('content')

    <section class="container login">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h3 class="text-center mb-3 mb-lg-5 western">Ajouter un membre</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Remplissez le formulaire pour continuer</p>

                    <form method="post" action="{{ route('members.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if (session('error'))
                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="name" class="form-label">Prénom <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ex: Hugo" value="{{ old('name') }}" required>

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="alias" class="form-label">Alias <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('alias') is-invalid @enderror" id="alias" name="alias" placeholder="Ex: Unlucky Luke" value="{{ old('alias') }}" required>

                                @error('alias')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="show_order" class="form-label">Ordre <sup class="text-danger">*</sup></label>
                                <input type="number" class="form-control @error('show_order') is-invalid @enderror" id="show_order" name="show_order" placeholder="Ex: 0" value="{{ old('show_order') }}" required>

                                @error('show_order')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="photo" class="form-label">Photo <sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg" required>
                                <small><em>Formats acceptés : png, jpg, jpeg | Taille max : 2Mo</em></small>

                                @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="bg" class="form-label">Fond <sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control @error('bg') is-invalid @enderror" id="bg" name="bg" accept="image/png, image/jpeg, image/jpg" required>
                                <small><em>Formats acceptés : png, jpg, jpeg | Taille max : 2Mo</em></small>

                                @error('bg')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="description" class="form-label">Description <sup class="text-danger">*</sup></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Résumer en quelques mots..." required>{{ old('description') }}</textarea>

                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <button type="submit" class="btn btn-orange text-white">Ajouter</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection
