@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="header">{{ __('Detail Siswa') }}</div>

            <div class="body">
                <h4>{{ $siswa->name }}</h4>
                <p>Email: {{ $siswa->email }}</p>

                <h5>{{ __('Mata Pelajaran') }}</h5>
                @if($siswa->mapels->isEmpty())
                <p>{{ __('Siswa ini belum mengambil mata pelajaran.') }}</p>
                @else
                @foreach($siswa->mapels as $mapel)
                <div class="col-md-4 col-xl-3 my-2">
                    <div class="card bg-success order-card p-2">
                        <div class="card-block">
                            <h6 class="m-b-20 text-light"><a href="">{{ $mapel->nama_mapel }}</a></h6>
                            <h2 class="text-right"><i class="fa fa-rocket f-left"></i></span>
                            </h2>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                <a href="{{ route('admin.siswa.addSubject', $siswa) }}" class="btn btn-primary">
                    {{ __('Tambah Mata Pelajaran') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection