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

                <h3 class="text-center mb-3 mb-lg-5 western">Modifier un événement</h3>

                <div class="login-card p-md-4">
                    <p class="text-center mb-3">Remplissez le formulaire pour continuer</p>

                    <form method="post" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                        @csrf

                        @if (session('error'))
                            <div class="error-pan text-white text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="name" class="form-label">Nom <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Escape Game" value="{{ $event->name }}" required>

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="start" class="form-label">Date <sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control @error('start') is-invalid @enderror" id="start" name="start" value="{{ explode(' ', $event->start)[0] }}" required>

                                @error('start')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ $event->photo_path }}" accept="image/png, image/jpeg, image/jpg">
                                <small><em>Formats acceptés : png, jpg, jpeg | Taille max : 2Mo</em></small>

                                @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="inscription_start" class="form-label">Début des inscriptions</label>
                                <input type="date" class="form-control @error('inscription_start') is-invalid @enderror" id="inscription_start" name="inscription_start" value="{{ explode(' ', $event->inscription_start)[0] }}">

                                @error('inscription_start')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="max_participants" class="form-label">Nombre max de participants</label>
                                <input type="number" min="0" step="1" class="form-control @error('max_participants') is-invalid @enderror" id="max_participants" name="max_participants" placeholder="150" value="{{ $event->max_participants }}">

                                @error('max_participants')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="price" class="form-label">Prix</label>
                                <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $event->price }}" placeholder="15">

                                @error('price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="label_id" class="form-label">Étiquette</label>
                                <select id="label_id" class="form-select @error('label_id') is-invalid @enderror" name="label_id" required>
                                    <option value="" disabled selected>Sélectionnez une étiquette...</option>
                                    @foreach($labels as $label)
                                        <option value="{{ $label->id }}" {{ $event->label_id == $label->id ? "selected" : "" }}>{{ $label->name }}</option>
                                    @endforeach
                                </select>

                                @error('label_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="overview" class="form-label">Résumé <sup class="text-danger">*</sup></label>
                                <textarea name="overview" class="form-control @error('overview') is-invalid @enderror" id="overview" placeholder="Résumé en quelques mots..." required>{{ $event->overview }}</textarea>

                                @error('overview')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="description" class="form-label">Description <sup class="text-danger">*</sup></label>
                                <textarea name="description" class="@error('description') is-invalid @enderror" id="description">{{ $event->description }}</textarea>

                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <button type="submit" class="btn btn-orange text-white">Modifier</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection


@section('scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: {
                    items: [
                        'heading',
                        'alignment',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'horizontalLine',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                language: 'fr',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                }
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                console.warn('Build id: xlrt5s33lfu6-i2y0ok75ywzz');
                console.error(error);
            })
    </script>
@endsection
