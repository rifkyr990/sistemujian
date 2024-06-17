@extends('layouts.admin')

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>Daftar Pertanyaan</h4>
                    <ul class="list-group">
                        @foreach($questions as $index => $q)
                        <li class="list-group-item {{ session('answers.' . $q->id) ? 'bg-success' : 'bg-danger' }}">
                            <a href="{{ route('admin.categories.show', ['category' => $category->id, 'question' => $index]) }}" class="text-white">
                                Pertanyaan {{ $index + 1 }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center shadow-md">
                    <h2 style="font-weight: 500;">{{ $category->name }}</h2>
                    @can('question_create')
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
                        Buat Soal
                    </a>
                    @endcan
                </div>
                <div class="card-body shadow-md rounded-bottom">
                    <p>Kelas: {{ $category->mapel?->kelas }}</p>
                    <p>Tanggal Ujian: {{ $category->tanggal_ujian }}</p>
                    <p>Waktu: {{ $category->jam_mulai }} - {{ $category->jam_selesai }}</p>
                </div>
                <div class="card-body">
                    @if($questions->isNotEmpty())
                    @php
                    $currentQuestionIndex = request()->get('question', 0);
                    if (isset($questions[$currentQuestionIndex])) {
                        $question = $questions[$currentQuestionIndex];
                    }
                    @endphp
                    @if(isset($question))
                    <form id="answer-form"
                        action="{{ route('admin.categories.answer', ['category' => $category->id, 'question' => $currentQuestionIndex]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <p><strong>{{ $currentQuestionIndex + 1 }}.) </strong>{{ $question->question_text }}</p>
                                <div>
                                    @can('question_delete')
                                    <form onclick="return confirm('Are you sure?')" action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                @foreach ($question->options as $option)
                                <li class="mx-auto px-3">
                                    <input type="radio" id="option{{ $currentQuestionIndex }}{{ $loop->index }}" name="answer" value="{{ $option->id }}" @if(session('answers.' . $question->id) == $option->id) checked @endif>
                                    <label for="option{{ $currentQuestionIndex }}{{ $loop->index }}">{{ $option->option_text }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between">
                            @if($currentQuestionIndex > 0)
                            <a href="{{ route('admin.categories.show', ['category' => $category->id, 'question' => $currentQuestionIndex - 1]) }}" class="btn btn-secondary">
                                Pertanyaan Sebelumnya
                            </a>
                            @endif

                            <button type="submit" name="save" class="btn btn-primary">Simpan</button>

                            @if($currentQuestionIndex < $questions->count() - 1)
                            <a href="{{ route('admin.categories.show', ['category' => $category->id, 'question' => $currentQuestionIndex + 1]) }}" class="btn btn-primary">
                                Pertanyaan Selanjutnya
                            </a>
                            @else
                            <button type="submit" name="finish" class="btn btn-success">Selesai</button>
                            @endif
                        </div>
                    </form>
                    @else
                    <p>Indeks pertanyaan tidak valid.</p>
                    @endif
                    @else
                    <p>Tidak ada pertanyaan yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection