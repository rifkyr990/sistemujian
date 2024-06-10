<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas)
    {
        $users = User::whereHas('roles', function ($query) {
        $query->where('title', 'Guru');})->where('kelas', $kelas)->get();// Mengirim data pengguna ke view
        return view('admin.guru.index', compact('users'));
    }

    // GuruController.php
    public function show()
    {
        $user = auth()->user();
        $mataPelajaran = Category::where('user_id', $user->id)->get();

        return view('admin.guru.kelas', compact('mataPelajaran'));
}

}
