<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function showLoginForm() {
        return view('auth.login');
    }

    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();

    //         // ✅ Store total users count in session
    //         $totalUsers = User::count();
    //         $request->session()->put('total_users', $totalUsers);

    //         return redirect()->intended('/standard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid login credentials.']);
    // }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Current total users count
            $totalUsers = User::count();
    
            // Total users count at the end of last month
            $lastMonthEnd = Carbon::now()->startOfMonth()->subDay()->endOfDay();
    
            // Count of users registered **up to the end of last month**
            $totalUsersLastMonth = User::where('created_at', '<=', $lastMonthEnd)->count();
    
            // Calculate percentage difference
            // Prevent division by zero
            if ($totalUsersLastMonth > 0) {
                $percentageChange = (($totalUsers - $totalUsersLastMonth) / $totalUsersLastMonth) * 100;
            } else {
                // If no users last month, just show 100% increase or zero
                $percentageChange = $totalUsers > 0 ? 100 : 0;
            }
    
            // Put both into session
            $request->session()->put('total_users', $totalUsers);
            $request->session()->put('total_users_percentage_change', round($percentageChange, 2)); // rounded to 2 decimals
    
            return redirect()->intended('/standard');
        }
    
        return back()->withErrors(['email' => 'Invalid login credentials.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}


















    // public function showLoginForm() {
    //     return view('auth.login');
    // }
    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();
    //         return redirect()->intended('/standard');
    //     }
    //     return back()->withErrors(['email' => 'Invalid login credentials.']);
    // }
    // public function logout(Request $request) {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/login');
    // }