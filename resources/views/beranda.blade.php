@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-header bg-transparent">
                <h1 class="fw-header"> {{ __('Profile') }} @foreach($user->roles as $key => $role)
                    <span>{{ $role->title }}</span>
                    @endforeach
                </h1>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <p>{{ $user->tanggal_lahir }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <p>{{ $user->jenis_kelamin }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Alamat</label>
                    <p></p>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <p>{{ $user->kelas }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">NISN</label>
                    <div class="col-sm-9">
                        <p>{{ $user->nomer_induk }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <p>{{$user->password}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <section class="ftco-section shadow-sm">
                <div class="calendar calendar-first rounded" id="calendar_first">
                    <div class="calendar_header">
                        <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
                        <h2></h2>
                        <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="calendar_weekdays"></div>
                    <div class="calendar_content"></div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection