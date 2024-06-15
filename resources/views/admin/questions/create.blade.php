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
        <div class="card-header">Create Question and Answers</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.questions.store') }}">
                @csrf

                <div class="form-group">
                    <label for="category">{{ __('Judul Ujian') }}</label>
                    <select class="form-control" name="category_id" id="category">
                        <option value="">{{ __('-- Pilih Kategori Ujian --')}}</option>
                        @foreach($categories as $id => $category)
                        <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question_text">{{ __('Pertanyaan') }}</label>
                    <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}"
                        name="question_text" value="{{ old('question_text') }}" />
                </div>

                <div class="form-group">
                    <label for="options">Options</label>
                    <div id="options">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="options[]" placeholder="option 1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option" value="0"> <!-- Value disesuaikan dengan indeks opsi -->
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="options[]" placeholder="option 2">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option" value="1"> <!-- Value disesuaikan dengan indeks opsi -->
                                </div>
                            </div>
                        </div>
                        <!-- Add more option options as needed -->
                    </div>
                </div>

                <button type="button" class="btn btn-secondary" id="addoption">Add Another Option</button>

                <button type="submit" class="btn btn-primary">Submit</button>
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
