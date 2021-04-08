@extends('layouts.app')

@section('head')
    <style>
        .background {
            display: none;
        }
    </style>
@endsection

@section('content')

    <section class="container login">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h3 class="text-center mb-3 mb-lg-5">Modifier permissions</h3>

                <div class="login-card p-md-4">
                    <p class="mb-4"><a href="{{ route('admin') }}" class="link text-orange">Retour</a> - Informations :</p>

                    <p class="mb-2">Role : {{ $role->name }}</p>


                    <div class="mt-3 row">
                        <p>Permissions :</p>

                        <form action="{{ route('admin.roles', $role->id) }}" method="post">
                            @csrf

                            @foreach($permissions as $perm)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="perms[]" value="{{ $perm->slug }}" id="{{ $perm->slug }}" {{ $role->hasPermission($perm->slug) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $perm->slug }}">
                                        {{ $perm->name }}
                                    </label>
                                </div>
                            @endforeach

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="removeAllPerms" value="removeAllPerms" id="removeAllPerms">
                                <label class="form-check-label" for="removeAllPerms">
                                    Retirer toutes les permissions
                                </label>
                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <button type="submit" class="btn btn-orange text-white">
                                    <i class="fas fa-edit"></i>
                                    Modifier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
