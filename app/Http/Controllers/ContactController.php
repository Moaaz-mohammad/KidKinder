<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request) {
        
        // return $request;
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        Contact::create($validated);

        Mail::to(config('mail.contact_receiver'))->send(new ContactMessage($validated));

        return redirect()->route('store')->with('success', 'Your message has been sent successfully');
    }
}
