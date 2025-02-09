<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('teachingContents')->get();
        // return $teachers;
        return view('dashboard.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject_1' => 'nullable|string',
            'subject_2' => 'nullable|string',
            'subject_3' => 'nullable|string',
            'url_1' => 'nullable|url',
            'url_2' => 'nullable|url',
            'url_3' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        // return $request->all();
        
        $teacher = Teacher::create([
            'name' => $data['name'],
            'main_techer' => 'known',
            'description' => $data['description'] ?? null,
        ]);

        $teacher->teachingContents()->create([
            'subject_1' => $data['subject_1'],
            'subject_2' => $data['subject_2'],
            'subject_3' => $data['subject_3'],
        ]);
        return redirect()->route('teacher.index')->with('success', 'Teacher information saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
