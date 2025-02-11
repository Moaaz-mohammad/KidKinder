<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index() {
        $clsses = Classs::all();
        $teachers = Teacher::all();
        return view('theme.index', compact('clsses', 'teachers'));
    }

    public function aboutPage() {
        return view('theme.about');
    }

    public function classesPage() {
        $clsses = Classs::all();
        return view('theme.classes', compact('clsses'));
    }

    public function blogPage() {
        return view('theme.blog');
    }

    public function teamPage() {
        $teachers = Teacher::all();
        return view('theme.team', compact('teachers'));
    }

    public function galleryPage() {
        return view('theme.gallery');
    }

    public function contactPage() {
        return view('theme.contact');
    }

    //---Onther Way To Use The Route For Pages ----//

    // public function show($page)
    // {
    //     $validPages = ['index', 'about', 'classes', 'blog', 'team', 'gallery', 'contact'];

    //     if (!in_array($page, $validPages)) {
    //         abort(404);
    //     }

    //     return view("theme.$page");
    // }
}
