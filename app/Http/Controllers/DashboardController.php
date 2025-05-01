<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\ReturnTypePass;

use function PHPUnit\Framework\returnSelf;

class DashboardController extends Controller
{
    public function index() {
        $students = Student::all();
        $studentsCount = $students->count();
        return view('dashboard.index', compact('students', 'studentsCount'));
    }
    public function user_profile() {
        $user = Auth::user();
        // return $user;
        return view('dashboard.user_profile', compact('user'));
    }
    public function Update(Request $request, $id) {
        
        $validator = Validator::make($request->all(), [
            'userName' => 'string|max:225',
            'userEmail' => 'email|max:255'
        ]
        ,
        [
            'userName.max' => 'The name is too long. Please keep it under 255 characters',
            'userEmail.max' => 'The email address is too long. Please keep it under 255 characters',
        ]
    );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        if (Auth::id() != $user->id) {
            abort(403);
        }

        if ($request->hasFile('image')) {

            $userPhoto = $request->file('image');

            $imageName = time() . '.'. $userPhoto->extension();

            $userPhoto->storeAs('public/images/', $imageName);

            if ($user->images()->exists()) {
                $oldImage = $user->images()->first();
                Storage::delete('public/images/' . $oldImage->file_name);
                $oldImage->delete();
            }
            
            $user->images()->create([
                'file_path' => 'storage/images/' . $imageName,
                'file_name' => $imageName
            ]);

        }
        $user->name = $request->userName;
        $user->email =$request->userEmail;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }

    public function updatePassword(Request $request, $id) {

        // return $request->all();

        $validate = $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'min:8', 'confirmed', 'different:current_password']
        ],
            [
                'new_password.confirmed' => 'Please make sure both password fields match exactly.',
            ]
    
    );

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current Password is incorrect']);
        }

        $user = User::find($id);
        // First Way To  update the information
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

    
        // Secound Way To update the information
        // $user->fill([
        //     'password' => Hash::make($request->new_password)
        // ])->save();

        return back()->with('succcess', 'Passwrod updated');
    }

    public function removePhoto(Request $request, $id) {
        $user = User::findOrFail($id);

        if ($user->images()->exists()) {
            foreach ($user->images as $image) {
                Storage::delete('public/images/'. $image->file_path);
                $image->delete();
            }
        }


        return response()->json([
            'message' => 'Photo removed successfully'
        ]);
    }
}
