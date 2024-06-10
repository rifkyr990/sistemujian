<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index($kelas)
    {
        $users = User::whereHas('roles', function ($query) {
        $query->where('title', 'Siswa');})->where('kelas', $kelas)->get();// Mengirim data pengguna ke view
        return view('admin.siswa.index', compact('users'));
    }
}
