@extends('layouts.admin')
@section('content')
<div class="container">
    @if ($mataPelajaran->isEmpty())
        <p>Tidak ada kategori yang diampu.</p>
    @else
        <h1 class="fw-bold">
            {{ $mataPelajaran->pluck('name')->implode(', ') }}
            @if ($mataPelajaran->first()->kelas)
                Kelas {{ $mataPelajaran->first()->kelas->nama_kelas }}
            @endif
        </h1>
        <p>Ujian kompetensi siswa</p>
        <div class="row">
            <div class="col-auto">
                <button class="btn btn-primary">Buat Soal</button>
                <button class="btn btn-primary">Nilai</button>
            </div>
        </div>
    @endif
</div>


@endsection