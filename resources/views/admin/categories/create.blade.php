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
                <h1 class="h3 mb-0 text-gray-800">{{ __('Ujian') }}</h1>
                <a href="{{ route('admin.categories.index') }}"
                    class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Nama ujian') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{ __('nama mata pelajaran') }}"
                        name="name" value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                    <label for="mapel_id">{{ __('mapel') }}</label>
                    <select class="form-control" name="mapel_id" id="mapel_id">
                        @foreach($mapels as $id => $mapel)
                        <option value="{{ $id }}">{{ $mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_ujian">{{ __('Tanggal mulai')}}</label>
                    <input type="date" class="form-control" name="tanggal_ujian" id="tanggal_ujian">
                </div>
                <div class="form-group">
                    <label for="jam_mulai">{{ __('Jam mulai')}}</label>
                    <input type="time" class="form-control" name="jam_mulai" id="jam_mulai">
                </div>
                <div class="form-group">
                    <label for="jam_selesai">{{ __('Jam selesai')}}</label>
                    <input type="time" class="form-control" name="jam_selesai" id="jam_selesai">
                </div>
                <div class="form-group">
                    <label for="user_id">{{ __('Guru Pengampu') }}</label>
                    <select class="form-control" name="user_id" id="user_id">
                        @foreach($users as $id => $user)
                        <option value="{{ $id }}">{{ $user }}</option>
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
