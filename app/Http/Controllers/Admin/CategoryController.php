<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('class_access'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $categories = Category::all();
        $users = User::all();

        return view('admin.categories.index', compact('categories', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('class_create'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $users = User::all()->pluck('name', 'id');
        $mapels = Mapel::all()->pluck('nama_mapel', 'id');

        return view('admin.categories.create', compact('users', 'mapels'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('class_create'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Request $request, $categoryId, $questionIndex = 0)
    {
        $category = Category::with('questions.options')->findOrFail($categoryId);
        $questions = $category->questions;
    
        if ($request->isMethod('post')) {
            $answers = $request->session()->get('answers', []);
            $answers[$request->question_id] = $request->answer;
            $request->session()->put('answers', $answers);

            if ($request->has('finish')) {
                return $this->finishExam($request, $category, $questions);
            }
            return redirect()->route('admin.categories.show', ['category' => $categoryId, 'question' => $questionIndex + 1]);
        }
        
        return view('admin.categories.show', compact('category', 'questions'));
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('class_edit'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $users = User::all()->pluck('name', 'id');
        $mapels = Mapel::all()->pluck('nama_mapel', 'id');

        return view('admin.categories.edit', compact('category', 'users', 'mapels'));
    }

    public function update(Request $request, Category $category)
    {
        abort_if(Gate::denies('class_edit'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'kode_kelas' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('class_delete'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        $category->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Category::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }


    public function finishExam(Request $request, $category, $questions)
    {
        $totalQuestions = $questions->count();
        $pointsPerQuestion = 100 / $totalQuestions;

        $answers = $request->session()->get('answers', []);
        $score = 0;

        foreach ($questions as $question) {
            if (isset($answers[$question->id])) {
            $selectedOptionId = $answers[$question->id];
            $selectedOption = $question->options->firstWhere('id', $selectedOptionId);

            if ($selectedOption && $selectedOption->is_correct) {
                $score += $pointsPerQuestion;
                }
            }
        }
        try {
            Result::create([
            'user_id' => Auth::id(),
            'category_id' => $category->id,
            'score' => $score,
        ]);
        $request->session()->forget('answers');
            return redirect()->route('admin.result.index')->with('status', 'Ujian selesai. Skor: ' . $score);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan hasil ujian: ' . $e->getMessage());
        }
    }


public function verifyExamCode(Request $request, $id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['valid' => false, 'message' => 'Kategori tidak ditemukan']);
    }

    if ($request->exam_code === $category->kode_ujian) {
        return response()->json(['valid' => true, 'category_id' => $category->id]);
    } else {
        return response()->json(['valid' => false, 'message' => 'Kode ujian tidak valid']);
    }
}



}