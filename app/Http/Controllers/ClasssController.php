<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $teachers = Teacher::all();
        return view('dashboard.classes.make', compact('students', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->merge([
            'from_time' => substr($request->from_time, 0 , 5),
            'to' => substr($request->to, 0 , 5)
        ]);

        $validator = Validator::make($request->all(),[
            'Check' => 'array',
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

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        // Time Transformation and i do not need it i was need them //
        // return date('H:i:s',strtotime('10:00PM'));
        // $from_time = date('H:i:s', strtotime($request->from_time));
        // $to_time = date('H:i:s', strtotime($request->to));

        $class = Classs::create([
            'class_content_name' => $request->class_content_name,
            'class_number' => $request->class_number,
            'from_age' => $request->from_age,
            'to_age' => $request->to_age,
            'total_seats' => $request->total_seats,
            'tution_fee' => $request->tution_fee,
            'from_time' => $request->from_time,
            'to' => $request->to,
            'description' => $request->description,
        ]);

        if (!empty($request->Check)) {
            $studentsIds = $request->Check;
            $pivotData = [];

            foreach ($studentsIds as $id) {
                $pivotData[$id] = ['joined_at' => now()];
            }

            $class->students()->attach($pivotData);

            $seatsToRemove = count($studentsIds);

            if ($class->total_seats >= $seatsToRemove) {
                $class->total_seats -= $seatsToRemove;
                $class->save();
            }
            //  else {
            // //    return response()->json([
            // //        'error' => true,
            // //        'message' => 'No seats available'
            // //    ]);
            //  }
        }

        if (!empty($request->teacher_id)) {
            $class->teachers()->attach($request->teacher_id);
            // $teacher = Teacher::findOrFail($request->teacher_id);
            // $teacher->classses()->attach($class->id);

        }

        return response()->json([
        'success' => true,
        'message' => 'Class information saved successfully.'
    ]);

        // return redirect()->route('class.index')->with('success', 'Class information saved successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Classs $classs, Request $request)
    {
        if (!$request->class) {
            return redirect()->back()->with('error', 'Class Not Found');
        }
        $class = Classs::find($request->class);
        return view('dashboard.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classs $classs, Request $request)
    {
        $class = Classs::find($request->class_id);
        $students = Student::all();
        $teachers = Teacher::all();
        $classStudents = $class->students->pluck('id')->toArray();
        $selectedTeacher = $class->teachers->pluck('id')->toArray();
        return view('dashboard.classes.edit', compact('class', 'students', 'classStudents', 'teachers', 'selectedTeacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classs $classs)
    {
        $request->merge([
            'from_time' => substr($request->from_time, 0, 5),
            'to' => substr($request->to, 0, 5),
        ]);

        $classId = $request->classId;

        $class = Classs::find($classId);

        $validateData = Validator::make($request->all(), [
            'Check' => 'array',
            'class_content_name' => 'string|max:255',
            'class_number' => 'integer',
            'from_age' => 'integer|min:1',
            'to_age' => 'integer|min:1|gte:from_age',
            // 'total_seats' => 'integer|min:1',
            'tution_fee' => 'numeric|min:0',
            'from_time' => 'date_format:H:i:s,H:i|before:to',
            'to' => 'date_format:H:i:s,H:i|after:from_time',
            'description' => 'string'
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ], 422); // Status code 422 for validation errors
        }
        
        
        $class->update([
            'class_content_name' => $request->class_content_name,
            'class_number' => $request->class_number,
            'from_age' => $request->from_age,
            'to_age' => $request->to_age,
            // 'total_seats' => $request->total_seats,
            'tution_fee' => $request->tution_fee,
            'from_time' => $request->from_time,
            'to' => $request->to,
            'description' => $request->description
        ]);


        $currentStudentsIds = $class->students->pluck('id')->toArray();

        $newStudentsIds = $request->Check ?? [];

        $addedStudents = array_diff($newStudentsIds, $currentStudentsIds);

        $removedStudents = array_diff($currentStudentsIds, $newStudentsIds);

        $class->students()->sync($newStudentsIds);

        $seatsToDecrease = count($addedStudents);
        $seatsToIncrease = count($removedStudents);

        $class->total_seats = $class->total_seats - $seatsToDecrease + $seatsToIncrease;
        if ($class->total_seats < 0) {
            $class->total_seats = 0;
        }

        $class->save();

        // $class->students()->sync($request->Check ?? []);

        // Secound Way -------
        // if (count($request->Check) <= 1) {
        //     $class->students()->sync($request->Check);
        // }else {
        //     $class->students()->detach();
        // }
        
        if ($request->filled('teacher_id')) {
            $class->teachers()->sync($request->teacher_id);
        }

        return response()->json([
            'success' => true,
            "message" => 'Class Updated Successfully'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classs $classs, Request $request)
    {
        $classId = $request->input('class_id');

        $class = Classs::find($classId);

        if (!$class) {
            return redirect()->back()->with('error', 'Class Not Found');
        }

        $class->delete();

        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }
}
