<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
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

    public function addSubject(User $siswa)
    {
        $mapels = Mapel::all()->groupBy('kelas');;
        return view('admin.siswa.create', compact('siswa', 'mapels'));
    }

    public function storeSubject(Request $request, User $siswa)
    {
        $request->validate([
            'mapels' => 'required|array',
            'mapels.*' => 'exists:mapels,id',
        ]);

        $siswa->mapels()->attach($request->mapels);

        return redirect()->route('admin.siswa.show', $siswa)->with('success', 'Subjects added successfully');
    }

    public function show(User $siswa)
    {
        $siswa->load('mapels'); // Memuat relasi subjects
        return view('admin.siswa.show', compact('siswa'));
    }
}
