@extends('layouts.app')

@section('head')
    <style>
        .background {
            display: none;
        }
    </style>
@endsection

@section('content')

    <section class="container">
        <h3 class="text-center mb-lg-5 mb-4">Admin</h3>

        <div class="wrapper mb-4 p-3">
            <h4 class="text-center pb-3">Liste des utilisateurs :</h4>
            <table class="table table-hover text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Filière</th>
                    <th scope="col">Email</th>
                    <th scope="col">Email vérifié</th>
                    <th scope="col">Rôles</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->firstname }} {{ $user->name }}</td>
                        <td>{{ $user->faculty->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at == null ? "Non" : "Oui" }}</td>
                        @if (count($user->roles) > 0)
                            <td>
                                @foreach($user->roles as $role)
                                    {{ $role->name }},<br>
                                @endforeach
                            </td>
                        @else
                            <td>Pas de rôles</td>
                        @endif
                        <td>
                            <a href="{{ route('admin.user.permissions', $user->id) }}" class="text-primary d-inline-block me-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ route('admin.user.delete', $user->id) }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-danger d-inline-block">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <hr>

        <div class="wrapper mt-4 p-3">
            <h4 class="text-center pb-3">Liste des rôles :</h4>
            <table class="table table-hover text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">slug</th>
                    <th scope="col">Name</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $role)
                    <tr>
                        <th>{{ $role->id }}</th>
                        <td>{{ $role->slug }}</td>
                        <td>{{ $role->name }}</td>
                        @if (count($role->permissions) > 0)
                            <td>
                                @foreach($role->permissions as $perm)
                                    {{ $perm->name }},<br>
                                @endforeach
                            </td>
                        @else
                            <td>Pas de permissions</td>
                        @endif
                        <td>
                            <a href="{{ route('admin.roles', $role->id) }}" class="text-primary d-inline-block me-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ route('admin.roles.delete', $role->id) }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-danger d-inline-block">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <hr>

        <div class="wrapper mt-4 p-3 login">
            <h4 class="text-center pb-3">Ajouter un rôle :</h4>

            <form action="{{ route('admin.roles.create') }}" method="post">
                @csrf

                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="slug" class="form-label">Slug <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Ex: dev" value="{{ old('slug') }}" required>

                        @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ex: Développeur" value="{{ old('name') }}" required>

                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button type="submit" class="btn btn-orange text-white">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </section>

    @include('layouts.delete-modal')

@endsection
