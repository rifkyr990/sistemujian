@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header bg-transparent">
                <h2>{{ __('Ujian') }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($ujian as $data)
                    <div class="col-sm-3 mb-3">
                        <div class="card border-primary bg-transparent">
                            <div class="card-body">
                                <button class="btn btn-danger btn-sm mb-2 w-100" style="cursor: none;">{{ $data->formatted_tanggal_ujian }}</button>
                                <p class="mb-0 fw-bold">{{ $data->mapel?->nama_mapel }}</p>
                                @php
                                    $result = $results->firstWhere('category_id', $data->id);
                                @endphp
                                @if ($result)
                                <p class="mb-0 float-start">
                                    <a href="{{ route('admin.categories.show', $data->id) }}" class="text-decoration-none text-dark" style="pointer-events: none">{{ $data->name }}</a>
                                </p>
                                    <p class="float-end mb-0">{{ $result->score }} / 100</p>
                                @else
                                    <p class="mb-0 float-start">
                                        <a href="{{ route('admin.categories.show', $data->id) }}" class="text-decoration-none text-dark">{{ $data->name }}</a>
                                    </p>
                                    <p class="float-end mb-0">0/100</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <p>{{ __('Jadwal Ujian Belum Tersedia.') }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
