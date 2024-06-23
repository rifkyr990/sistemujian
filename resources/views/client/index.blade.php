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
                                    <a href="#" class="text-decoration-none text-dark open-modal" data-category-id="{{ $data->id }}" data-category-name="{{ $data->name }}" style="pointer-events: none">{{ $data->name }}</a>
                                </p>
                                    <p class="float-end mb-0">{{ $result->score }} / 100</p>
                                @else
                                    <p class="mb-0 float-start">
                                        <a href="#" class="text-decoration-none text-dark open-modal" data-category-id="{{ $data->id }}" data-category-name="{{ $data->name }}" data-toggle="modal" data-target="#examCodeModal">{{ $data->name }}</a>
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

<!-- Modal -->
<div class="modal fade" id="examCodeModal" tabindex="-1" role="dialog" aria-labelledby="examCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examCodeModalLabel">Masukkan Kode Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="examCodeForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="examCode">Kode Ujian</label>
                        <input type="text" class="form-control" id="examCode" name="exam_code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
