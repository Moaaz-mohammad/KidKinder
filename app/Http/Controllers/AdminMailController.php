<?php

namespace App\Http\Controllers;

use App\Mail\AdminMassEmail;
use App\Mail\AdmninMassEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMailController extends Controller
{
    

    public function send(Request $request) {
        
        // dd($request->attachment);
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240'
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachment', 'public');
        }

        // dd($attachmentPath);
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new AdmninMassEmail($validated['subject'], $validated['message'], $attachmentPath));
        }

        return back()->with('success', 'Email is being sent to all users!');
    }

}
