<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\ReturnTypePass;

class DashboardController extends Controller
{
    public function index() {
        $students = Student::all();
        $studentsCount = $students->count();
        return view('dashboard.index', compact('students', 'studentsCount'));
    }
    public function user_profile() {
        $user = Auth::user();
        // return $user;
        return view('dashboard.user_profile', compact('user'));
    }
}
