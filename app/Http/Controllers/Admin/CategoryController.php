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

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('class_edit'), Response::HTTP_FORBIDDEN, 'Akses tidak diizinkan');
        return view('admin.categories.edit', compact('category'));
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
}
