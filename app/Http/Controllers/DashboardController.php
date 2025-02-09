<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $students = Student::all();
        $studentsCount = $students->count();
        return view('dashboard.index', compact('students', 'studentsCount'));
    }
}
