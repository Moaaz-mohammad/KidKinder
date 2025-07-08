<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    public function index() {
        $clsses = Classs::where('total_seats', '>', '0')->get();
        $teachers = Teacher::all();
        return view('theme.index', compact('clsses', 'teachers'));
    }

    public function showProfile() {
        $user = auth()->user();
        
        $requests = $user->classRequests;

        $totalRequests = $user->classRequests->count();
        $approvedRequests = $user->classRequests->where('status', 'approved')->count();
        $rejectedRequests = $user->classRequests->where('status', 'rejected')->count();

        $notifications = $user->notifications;
        return view('theme.user-profile', compact('user', 'requests', 'totalRequests', 'approvedRequests', 'rejectedRequests', 'notifications'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'email' => 'string|max:255|email|unique:users,email,'. $id,
            'password' => 'nullable|string|min:8|'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors());
        }

        if ($request->filled('password')) {
            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }else {
            $user->update([
                'email' => $request->email
            ]);
        }

        return redirect()->back()->with('success', 'Your account information has been updated successfully.');
    }
    public function aboutPage() {
        return view('theme.about');
    }

    public function classesPage() {
        $clsses = Classs::where('total_seats', '>', 0)->get();
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

    public function joinClass($id) {
        $class = Classs::findOrFail($id);
        return view('theme.join-class', compact('class'));
    }
}
