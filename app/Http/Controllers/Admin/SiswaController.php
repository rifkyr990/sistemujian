<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index($kelas)
    {
        $users = User::whereHas('roles', function ($query) {
        $query->where('title', 'Siswa');})->where('kelas', $kelas)->get();// Mengirim data pengguna ke view
        return view('admin.siswa.index', compact('users', 'kelas'));
    }

    public function create() {
        $roles = Role::pluck('title', 'id');

        return view('admin.siswa.create', compact('roles'));
    }

    public function show(User $siswa)
    {
        $siswa->load('mapels'); // Memuat relasi subjects
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Pastikan ini mendapatkan data guru
        $roles = Role::all()->pluck('name', 'id'); // Pastikan ini mendapatkan data role
        return view('admin.siswa.edit', compact('user', 'roles'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated() + ['password' => bcrypt($request->password)]);
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.siswa.index')->with([
            'message' => 'User successfully updated!',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index')->with([
            'message' => 'User successfully created!',
            'alert-type' => 'success'
        ]);
    }

    public function kelas()
    {
        $siswa = Auth::user();
        return view('admin.siswa.show', compact('siswa'));
    }

    public function addSubject(User $siswa)
    {
        $mapels = Mapel::all()->groupBy('kelas');;
        return view('admin.siswa.addSubject', compact('siswa', 'mapels'));
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
}
