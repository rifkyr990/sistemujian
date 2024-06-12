@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $mapel->nama_mapel }}</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Kelas:</strong> {{ $mapel->kelas }}</p>
                        <p><strong>Kode Mapel:</strong> {{ $mapel->kode_mapel }}</p>
                        <hr>
                        <ul>
                            @foreach ($mapel->category as $ujian)
                                <li><a href="{{ route('admin.categories.show', $ujian->id) }}">{{$ujian->name}}</a></li>
                            @endforeach
                        </ul>
                        <hr>
                        <div class="text-right">
                            <a href="{{ route('admin.mapel.index') }}" class="btn btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
