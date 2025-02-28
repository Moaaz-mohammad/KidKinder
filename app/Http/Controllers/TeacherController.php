<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'TeacherPhoto' => 'required|image|max:2048',
        ]);

        $teacher = Teacher::create([
            'name' => $data['name'],
            'url_1' => $request->url_1,
            'url_2' => $request->url_2,
            'url_3' => $request->url_3,
            'main_techer' => 'known',
            'description' => $data['description'] ?? null,
        ]);

        $teacher->teachingContents()->create([
            'subject_1' => $data['subject_1'],
            'subject_2' => $data['subject_2'],
            'subject_3' => $data['subject_3'],
        ]);

        if ($request->hasFile('TeacherPhoto')) {

            $TeacherPhoto = $request->file('TeacherPhoto');
        
            $PhotoName = time() . '.' . $TeacherPhoto->extension();
        
            $TeacherPhoto->storeAs('public/images/', $PhotoName);

            $teacher->images()->create([
                'file_path' => 'storage/images/'. $PhotoName,
                'file_name' => $PhotoName,
            ]);
        }
        return redirect()->route('teacher.index')->with('success', 'Teacher information saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('dashboard.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('dashboard.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //dd( $request->all());
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject_1' => 'required|string',
            'subject_2' => 'nullable|string',
            'subject_3' => 'nullable|string',
            'url_1' => 'nullable|url',
            'url_2' => 'nullable|url',
            'url_3' => 'nullable|url',
            'description' => 'nullable|string',
            'TeacherPhoto' => 'image|max:2048',
        ]);

        // $tescher = Teacher::findOrFail($request->id);

        $teacher->update([
            'name' => $request->name,
            'url_1' => $request->url_1,
            'url_2' => $request->url_2,
            'url_3' => $request->url_3,
            'main_techer' => "known",
            'description' => $request->description,
        ]);

        $teacher->teachingContents()->update([
            'subject_1' => $data['subject_1'],
            'subject_2' => $data['subject_2'],
            'subject_3' => $data['subject_3'],
        ]);

        if ($request->hasFile('TeacherPhoto')) {

            $TeacherPhoto = $request->file('TeacherPhoto');

            $PhotoName = time() . '.' . $TeacherPhoto->extension();

            $TeacherPhoto->storeAs('public/images/' . $PhotoName);

            if ($teacher->images()->exists()) {
                $oldPhoto = $teacher->images()->first();
                Storage::delete('public/images/' . $oldPhoto->file_name);

                $oldPhoto->delete();
            }

            $teacher->images()->create([
                'file_path' => 'storage/images/' . $PhotoName,
                'file_name' => $PhotoName,
            ]);
        }


        return redirect()->route('teacher.index')->with('success', 'Teacher Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
    
        if (!$teacher) {
            return back()->with('error', 'Teacher Not Found');
        }

        if ($teacher->images()->exists()) {
            foreach ($teacher->images as $image) {
                Storage::delete('public/images/'. $image->file_name);
                $image->delete();
            }
        }

        $teacher->delete();

        return back()->with('success', 'Teacher Deleted Sucessfully');
    }
}
