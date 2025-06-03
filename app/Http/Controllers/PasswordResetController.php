<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm() {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
    
        $user = User::where('email', $request->email)->first();
    
        if (is_null($user->email_verified_at)) {
            return back()->withErrors(['email' => 'Please verify your email address before resetting your password.']);
        }
    
        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
    
        Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Your Password');
        });

        return back()->with('status', 'Reset link sent!');
    }

    public function showResetForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $tokenData = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

                   if (!$tokenData) {
                       return back()->withErrors(['email' => 'Invalid token.']);
                   }

                   $user = User::where('email', $request->email)->first();

                   if (is_null($user->email_verified_at)) {
                       return back()->withErrors(['email' => 'Please verify your email address before resetting your password.']);
                   }

                   // Update password
                   User::where('email', $request->email)->update([
                       'password' => Hash::make($request->password)
                   ]);

                   DB::table('password_reset_tokens')->where('email', $request->email)->delete();

                   return redirect('/login')->with('status', 'Password has been reset!');

    }
}
