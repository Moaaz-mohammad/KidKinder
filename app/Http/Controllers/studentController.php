<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('dashboard.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->file('image')) ;
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_forign_id' => 'required|string|max:255',
            'age' => 'required',
            'description' => 'nullable|string|',
            // 'image' => 'required|image|max:2048',
        ]);

        //------------ First Way
        // $student = Student::create(
        //     $request->all()
        // );

        //----------- Secound Way
        $student = Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'student_forign_id' => $request->student_forign_id,
            'age' => $request->age,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $studentImage = $request->file('image');

            $imageName = time() . '.' . $studentImage->extension();

            $studentImage->storeAs('public/images', $imageName);

            $student->images()->create([
                'file_path' => 'storage/images/' . $imageName, 
                'file_name' => $imageName,
            ]);
        }

        return redirect()->route('student.index')->with('primary','Student information saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
