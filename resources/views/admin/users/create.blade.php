@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('create user') }}</h1>
                <a href="{{ route('admin.users.index') }}"
                    class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name"
                        value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" class="form-control" id="email" placeholder="{{ __('Email') }}" name="email"
                        value="{{ old('email') }}" />
                </div>
                <div class="form-group">
                    <label for="nomer_induk">{{ __('Nomer induk') }}</label>
                    <input type="number" class="form-control" id="nomer_induk" placeholder="{{ __('nomer_induk') }}"
                        name="nomer_induk" value="{{ old('nomer_induk') }}" />
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">{{ __('Tanggal lahir') }}</label>
                    <input type="date" class="form-control" id="tanggal_lahir" placeholder="{{ __('tanggal_lahir') }}"
                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" />
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih jenis kelamin --</option>
                        <option value="Laki-laki">{{ __('Laki-laki') }}</option>
                        <option value="Perempuan">{{ __('Perempuan') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">{{ __('Kelas') }}</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value="">-- Pilih kelas --</option>
                        <option value="7">{{ __('7') }}</option>
                        <option value="8">{{ __('8') }}</option>
                        <option value="9">{{ __('9') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="text" class="form-control" id="password" placeholder="{{ __('Password') }}"
                        name="password" value="{{ old('password') }}" required />
                </div>
                <div class="form-group">
                    <label for="roles">{{ __('Role') }}</label>
                    <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                        @foreach($roles as $id => $roles)
                        <option value="{{ $id }}"
                            {{ (in_array($id, old('roles', [])) || isset($role) && $role->roles->contains($id)) ? 'selected' : '' }}>
                            {{ $roles }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
            </form>
        </div>
    </div>


    <!-- Content Row -->

</div>
@endsection
