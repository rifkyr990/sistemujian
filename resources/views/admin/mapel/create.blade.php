@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('Mata pelajaran') }}</h1>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_mapel">{{ __('Nama mata pelajaran') }}</label>
                    <input type="text" class="form-control" id="nama_mapel"
                        placeholder="{{ __('Nama mata pelajaran') }}" name="nama_mapel"
                        value="{{ old('nama_mapel') }}" />
                </div>
                <div class="form-group">
                    <label for="kelas">{{ __('mapel') }}</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="7">{{ __('7') }}</option>
                        <option value="8">{{ __('8') }}</option>
                        <option value="9">{{ __('9') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kode_mapel">{{ __('Kode Kelas') }}</label>
                    <input type="text" class="form-control" id="kode_mapel" placeholder="{{ __('Kode mapel') }}"
                        name="kode_mapel" value="{{ old('kode_mapel') }}" />
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

</div>
@endsection
