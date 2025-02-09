<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use Illuminate\Http\Request;

class ClasssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classs::all();
        return view('dashboard.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('dashboard.classes.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $vaeldateData = $request->validate ([
            'Check' => 'required|array',
            'class_content_name' => 'required|string|max:255',
            'class_number' => 'required|integer',
            'from_age' => 'nullable|integer|min:1',
            'to_age' => 'nullable|integer|min:1|gte:from_age',
            'total_seats' => 'nullable|integer|min:1',
            'tution_fee' => 'nullable|numeric|min:0',
            'from_time' => 'nullable|date_format:H:i',
            'to' => 'nullable|date_format:H:i|after:from_time',
            'description' => 'required|string',
        ]);

        // return date('H:i:s',strtotime('10:00PM'));

        $from_time = date('H:i:s', strtotime($vaeldateData['from_time']));
        $to_time = date('H:i:s', strtotime($vaeldateData['to']));

        $class = Classs::create([
            'class_content_name' => $vaeldateData['class_content_name'],
            'class_number' => $vaeldateData['class_number'],
            'from_age' => $vaeldateData['from_age'],
            'to_age' => $vaeldateData['to_age'],
            'total_seats' => $vaeldateData['total_seats'],
            'tution_fee' => $vaeldateData['tution_fee'],
            'from_time' => $from_time,
            'to' => $to_time,
            'description' => $vaeldateData['description'],
        ]);

        $class->students()->attach($request->Check, ['joined_at' => now()]);

        return response()->json(['message' => "Done" . $request]);

        // return redirect()->route('class.index')->with('success', 'Class information saved successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Classs $classs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classs $classs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classs $classs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classs $classs)
    {
        //
    }
}
