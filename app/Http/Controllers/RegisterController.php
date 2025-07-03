<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

 /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // ✅ Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // ✅ Log the user in
    Auth::login($user);

    // ✅ Total users now
    $totalUsers = User::count();

    // ✅ Last month's end (last day of previous month)
    $lastMonthEnd = Carbon::now()->startOfMonth()->subDay()->endOfDay();

    // ✅ Users created up to end of last month
    $totalUsersLastMonth = User::where('created_at', '<=', $lastMonthEnd)->count();

    // ✅ Calculate growth percentage
    if ($totalUsersLastMonth > 0) {
        $percentageChange = (($totalUsers - $totalUsersLastMonth) / $totalUsersLastMonth) * 100;
    } else {
        $percentageChange = $totalUsers > 0 ? 100 : 0;
    }

    // ✅ Save to session
    $request->session()->put('total_users', $totalUsers);
    $request->session()->put('total_users_percentage_change', round($percentageChange, 2));

    return redirect('/standard');
}
}
