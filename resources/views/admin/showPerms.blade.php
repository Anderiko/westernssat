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

                    <div class="row">
                        <p class="col-lg-6">
                            <strong>Nom :</strong><br>
                            {{ $user->firstname }} {{ $user->name }}
                        </p>

                        <p class="col-lg-6">
                            <strong>Filière :</strong><br>
                            {{ $user->faculty->name }}
                        </p>
                    </div>

                    <p>
                        <strong>Email :</strong><br>
                        {{ $user->email }}<br>

                        @if($user->HasVerifiedEmail())
                            <small><em>Email vérifié.</em></small>
                        @else
                            <small><em>Email non vérifié.</em></small>
                        @endif
                    </p>
                    <hr>

                    <div class="mt-3 row">

                        <div class="col-lg-6">
                            <p>Permissions utilisateurs :</p>

                            <form action="{{ route('admin.user.permissions.update', $user->id) }}" method="post">
                                @csrf

                                @foreach($permissions as $perm)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="perms[]" value="{{ $perm->slug }}" id="{{ $perm->slug }}" {{ $user->hasPermission($perm->slug) ? 'checked' : '' }}>
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

                        <div class="col-lg-6">
                            <p>Roles utilisateurs :</p>

                            <form action="{{ route('admin.user.roles.update', $user->id) }}" method="post">
                                @csrf

                                @foreach($roles as $role)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->slug }}" id="{{ $role->slug }}" {{ $user->hasRole($role->slug) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $role->slug }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="removeAllRoles" value="removeAllRoles" id="removeAllRoles">
                                    <label class="form-check-label" for="removeAllRoles">
                                        Retirer tous les roles
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

        </div>
    </section>

@endsection
