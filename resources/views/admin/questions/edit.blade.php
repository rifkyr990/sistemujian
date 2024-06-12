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
    <div class="card">
        <div class="card-header">Edit Question and Answers</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.questions.update', $question->id) }}">
                @csrf
                @method('PUT') <!-- Gunakan method PUT untuk update -->

                <div class="form-group">
                    <label for="category">{{ __('Judul Ujian') }}</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach($categories as $id => $category)
                        <option value="{{ $id }}" @if($question->category_id == $id) selected @endif>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question_text">{{ __('Pertanyaan') }}</label>
                    <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}"
                        name="question_text" value="{{ $question->question_text }}" />
                </div>

                <div class="form-group">
                    <label for="options">Options</label>
                    <div id="options">
                        @foreach($question->options as $index => $option)
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="options[]" placeholder="option {{ $index + 1 }}" value="{{ $option->option_text }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option" value="{{ $index }}" @if($option->is_correct) checked @endif> <!-- Beri tanda checked jika opsi benar -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="btn btn-secondary" id="addoption">Add Another Option</button>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('addoption').addEventListener('click', function() {
    var optionIndex = document.querySelectorAll('#options .input-group').length + 1;
    var newoption = `
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="options[]" placeholder="option ` + optionIndex + `">
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="radio" name="correct_option" value="` + optionIndex + `"> <!-- Value disesuaikan dengan indeks opsi -->
                </div>
            </div>
        </div>
    `;
    document.getElementById('options').insertAdjacentHTML('beforeend', newoption);
});
</script>
@endsection
