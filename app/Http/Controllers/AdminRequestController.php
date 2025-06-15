<?php

namespace App\Http\Controllers;

use App\Models\ClassRequest;
use App\Models\Student;
use App\Models\User;
use App\Notifications\ClassRequestStatusNotification;
use Illuminate\Http\Request;

class AdminRequestController extends Controller
{
    
    public function index() {
        $requests = ClassRequest::paginate(5);
        return view('dashboard.requests.index', compact('requests'));
    }

    public function approve(Request $request, $id) {
        $ClassRequest = ClassRequest::FindOrFail($id);

        if ($ClassRequest->status === "approved") {
            return back()->with('error', 'This request has already been approved.');
        }

        if ($ClassRequest->class->total_seats <= 0) {
            return back()->with('error', 'No seats are currently available for this class.');
        }

        $student = Student::where('student_forign_id', $ClassRequest->user->forign_id)->first();

        // return $student;
        if (!$student) {
            $student = Student::Create(
                [
                    'first_name' => $ClassRequest->user->name,
                    'last_name' => $ClassRequest->user->last_name,
                    'student_forign_id' => $ClassRequest->user->forign_id,
                    'age' => $ClassRequest->user->age,
                    'description' => ' '
                ]
            );
        }

        $ClassRequest->class->students()->syncWithoutDetaching([
            $student->id =>  ['joined_at' => now()]
        ]);

        $ClassRequest->class->decrement('total_seats');

        $ClassRequest->update(['status' => 'Approved']);

        $ClassRequest->user->notify(new ClassRequestStatusNotification('approved', $ClassRequest->class->class_content_name));

        return redirect()->back()->with('success', 'Request Approved');
    }

    public function show($id) {
        $classRequest = ClassRequest::findOrFail($id);
        $requestClass = $classRequest->class;
        return view('dashboard.requests.show', compact('classRequest', 'requestClass'));
    }

    public function pending($id) {
        $classRequest = ClassRequest::findOrFail($id);

        if ($classRequest->status === 'pending') {
            return back()->with('error', 'Request already pengding');
        }

        $student = Student::where('student_forign_id', $classRequest->user->forign_id)->first();

        if ($student && $classRequest->class->students()->where('student_id', $student->id)->exists()) {

            $classRequest->class->students()->detach($student->id);

            $classRequest->class->increment('total_seats');

        }

        $classRequest->update(['status' => 'pending']);

        return back()->with('success', 'Request Pending');
    }

    public function reject($id) { 

        $ClassRequest = ClassRequest::FindOrFail($id);

        if ($ClassRequest->status === 'rejected') {
            return back()->with('error', 'Request already rejected');
        }

        $student = Student::where('student_forign_id', $ClassRequest->user->forign_id)->first();

        if ($student && $ClassRequest->class->students()->where('student_id', $student->id)->exists()) {

            $ClassRequest->class->students()->detach($student->id);

            $ClassRequest->class->increment('total_seats');
        }

        $ClassRequest->update(['status' => 'rejected']);
        
        $ClassRequest->user->notify(new ClassRequestStatusNotification('rejected', $ClassRequest->class->class_content_name));

        return redirect()->back()->with('success', 'Done, The request rejected');

    }
}
