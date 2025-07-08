<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    
    public function index() {
        
        $user = Auth::user();
        $unreadNotifications = $user->unreadnotifications;
        $readNotifications = $user->readnotifications;

        return view('theme.notifications', compact('unreadNotifications', 'readNotifications'));
    }

    public function markAsRead(DatabaseNotification $notification) {
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read');
    }

    public function markAllRead() {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read');
    }

    public function destroy($id) {
        
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notification deleted successfully.');
        }

        return back()->with('error', "Notification not found.");
    }

    public function destroyAll() {
        $notifications = auth()->user()->notifications();
        $notifications->delete();
        return back()->with('success', 'Notifications deleted successfully.');
    }

}
