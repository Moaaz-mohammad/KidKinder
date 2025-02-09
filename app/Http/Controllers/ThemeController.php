<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index() {
        $clsses = Classs::all();
        return view('theme.index', compact('clsses'));
    }

    public function aboutPage() {
        return view('theme.about');
    }

    public function classesPage() {
        return view('theme.classes');
    }

    public function blogPage() {
        return view('theme.blog');
    }

    public function teamPage() {
        return view('theme.team');
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
