<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clsses = Classs ::all();
        $teachers = Teacher::all();
        return view('theme.index', compact('clsses', 'teachers'));
    }
}
