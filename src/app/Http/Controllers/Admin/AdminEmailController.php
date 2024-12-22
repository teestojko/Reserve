<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use App\Models\User;
use App\Http\Requests\AdminEmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminEmailController extends Controller
{
    public function showForm()
    {
        $users = User::all();
        return view('admin.send_email', compact('users'));
    }

    public function sendEmail(AdminEmailRequest $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserNotification($request->subject, $request->message));
        }
        return redirect()->back()->with('success', 'メールが送信されました');
    }
}
