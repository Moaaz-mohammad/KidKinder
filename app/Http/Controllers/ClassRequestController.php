<?php

namespace App\Http\Controllers;

use App\Models\ClassRequest;
use App\Models\Classs;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassRequestController extends Controller
{
    
    public function index () {

        return view('theme.requests-table');
    }

    public function store(Request $request) {

        $exists = ClassRequest::where('user_id', $request->student_id)->where('class_id', $request->class_id)->whereIn('status', ['pending', 'approved'])->exists();

        $class = Classs::findOrFail($request->class_id);

        if ($exists) {
            return back()->with('error', 'You already have an active request for this class');
        }

        
        if ($class->total_seats <= 0) {
            return back()->with('error', 'No seats are currently available for this class.');
        }

        $valedator = Validator::make($request->all(), [
            'classId' => 'required|exists:classes,id',
            'age' => 'required',
            'additional_info' => 'nullable|string'
        ]);

        ClassRequest::create([
            'user_id' => $request->student_id,
            'class_id' => $request->class_id,
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'additional_info' => $request->additional_info,
            'status' => 'pending'
        ]);


        //  I have to make an if condition for make a user cannot request tow request in the same time and for the same class.
        // if () {
        //     # code...
        // }

        return redirect()->route('requests.index')->with('warning', 'This request is pending review');
    }

    public function show($id) {
        $TheRequest = ClassRequest::findOrFail($id);
        $class = Classs::findOrFail($TheRequest->class_id);
        return view('theme.request-tracker', compact('TheRequest', 'class'));
    }
}
