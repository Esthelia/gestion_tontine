<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Notifications\MyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getShow() {

        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        $notificationCount = $notifications->count();

        return view('layout.header', compact('notifications', 'notificationCount'));
    }


    public function sendNotification()
    {
        $user = Auth::user(); // Utilisateur authentifié
        Notification::send($user, new MyNotification('Vous avez un nouveau message !'));

        return redirect()->back()->with('status', 'Notification envoyée avec succès !');
    }
}
