<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Category;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $questions = Question::with('category', 'options')->get(); // Pastikan untuk memuat relasi
        return view('admin.questions.index', compact('questions'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.questions.create', compact('categories'));
    }

    public function store(QuestionRequest $request): RedirectResponse
{
    abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');

    $request->validate([
        'question_text' => 'required|string',
        'options' => 'required|array|min:2', // Minimal dua jawaban
        'options.*' => 'required|string', // Pastikan setiap opsi adalah string yang valid
        'correct_option' => 'required|integer', // Validasi untuk memastikan nilai yang dikirimkan adalah integer (indeks opsi)
    ]);

    // Simpan pertanyaan
    $question = Question::create([
        'question_text' => $request->input('question_text'),
        'category_id' => $request->input('category_id'), // Menyertakan category_id
    ]);

    // Simpan jawaban
    foreach ($request->input('options') as $key => $option) {
        $isCorrect = $key == $request->input('correct_option'); // Memeriksa apakah indeks opsi saat ini adalah jawaban yang benar
        Option::create([
            'question_id' => $question->id,
            'option_text' => $option, // Menyertakan option_text
            'is_correct' => $isCorrect,
        ]);
    }

    return redirect()->route('admin.questions.index')->with([
        'message' => 'Successfully created!',
        'alert-type' => 'success'
    ]);
}



    public function show(Question $question): View
    {
        return view('admin.questions.show', compact('question'));
    }

    public function edit(Question $question): View
    {
        abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.questions.edit', compact('question', 'categories'));
    }

    public function update(Request $request, $id)
{
    abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');

    $request->validate([
        'question_text' => 'required|string',
        'options' => 'required|array|min:2',
        'options.*' => 'required|string',
        'correct_option' => 'required|integer', // Rubah validasi menjadi integer
    ]);

    $question = Question::findOrFail($id);

    $question->update([
        'question_text' => $request->input('question_text'),
        'category_id' => $request->input('category_id'),
    ]);

    // Hapus opsi yang sudah ada
    $question->options()->delete();

    foreach ($request->input('options') as $index => $optionText) {
        $isCorrect = $request->input('correct_option') == $index;

        Option::create([
            'question_id' => $question->id,
            'option_text' => $optionText,
            'is_correct' => $isCorrect,
        ]);
    }

    return redirect()->route('admin.questions.index')->with([
        'message' => 'Successfully updated!',
        'alert-type' => 'success',
    ]);
}

    public function destroy(Question $question): RedirectResponse
    {
        abort_if(Gate::denies('question_delete'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $question->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Question::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function answer(Request $request, Question $question)
    {
        $answer = $request->input('answer');
        session(['answer.' . $question->id => $answer]);

        return redirect()->route('admin.categories.show', ['category' => $question->category_id, 'question' => request()->get('question', 0)]);
    }

    public function endTest(Request $request)
{
    // Validasi form jika diperlukan
    $request->validate([
        // Aturan validasi di sini jika ada
    ]);

    // Proses menghitung skor dan menyimpan hasil ke database
    $questions = session('questions');
    $answers = session('answers', []);
    $totalQuestions = count($questions);
    $correctAnswers = 0;

    foreach ($questions as $question) {
        if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_option_id) {
            $correctAnswers++;
        }
    }

    $score = ($correctAnswers / $totalQuestions) * 100;

    // Simpan hasil ujian ke dalam tabel results
    Result::create([
        'user_id' => Auth::id(),
        'category_id' => $request->category_id,
        'score' => $score,
    ]);

    // Reset session
    session()->forget('answers');
    session()->forget('questions');

    // Redirect ke halaman hasil ujian atau ke halaman yang sesuai
    return redirect()->route('admin.result.index')->with('status', 'Ujian selesai. Skor Anda: ' . $score);
}


    public function showResults()
    {
        $results = Result::with('category')->where('user_id', Auth::id())->get();
        return view('admin.results.index', compact('results'));
    }
}
