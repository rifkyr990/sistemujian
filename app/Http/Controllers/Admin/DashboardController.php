<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $studentMaleCount = User::whereHas('roles', function($query) {
            $query->where('title', 'siswa');
        })->where('jenis_kelamin', 'Laki-laki')->count();

        $studentWomenCount = User::whereHas('roles', function($query) {
            $query->where('title', 'siswa');
        })->where('jenis_kelamin', 'Perempuan')->count();

        $teacherCount = User::whereHas('roles', function($query) {
            $query->where('title', 'guru');
        })->count();

        $allStudentCount = User::whereHas('roles', function($query) {
            $query->where('title', 'siswa');
        })->count();
        return view('admin.dashboard', compact('studentMaleCount', 'studentWomenCount', 'teacherCount', 'allStudentCount'));
    }
}
