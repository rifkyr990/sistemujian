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

class QuestionController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $questions = Question::all();

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
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        Question::create($request->validated());

        return redirect()->route('admin.questions.index')->with([
            'message' => 'successfully created !',
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

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN,'Akses tidak diizinkan');
        $question->update($request->validated());

        return redirect()->route('admin.questions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
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
}
