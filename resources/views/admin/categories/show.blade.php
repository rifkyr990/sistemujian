@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>{{ $category->name }}</h2>
                    <div>
                        @can('question_create')
                        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
                            Buat Soal
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-header border-top-0">
                    <hr>
                    <p>Kelas: {{ $category->mapel?->kelas }}</p>
                    <p>Tanggal Ujian: {{ $category->tanggal_ujian }}</p>
                    <p>Waktu: {{ $category->jam_mulai }} - {{ $category->jam_selesai }}</p>
                </div>
                <div class="card-body">
                    @if($questions->isNotEmpty())
                    @foreach($questions as $index => $question)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <p><strong>{{ $index + 1 }}. Pertanyaan:</strong> {{ $question->question_text }}</p>
                            <div>
                                @can('question_delete')
                                <form onclick="return confirm('Are you sure?')"
                                    action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </form>
                                @endcan
                            </div>
                        </div>
                        <ul class="list-unstyled">
                            @foreach ($question->options as $option)
                            <li class="mx-auto px-3">
                                <input type="radio" id="option{{ $loop->parent->index }}{{ $loop->index }}"
                                    name="question{{ $question->id }}" value="{{ $option->id }}">
                                <label
                                    for="option{{ $loop->parent->index }}{{ $loop->index }}">{{ $option->option_text }}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                    @else
                    <p>Tidak ada pertanyaan yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection