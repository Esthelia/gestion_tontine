<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getShow(Request $request)
    {
        return view('pages.admin.login.show');
    }

    public function postStore(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
        
            if (!Auth::attempt($credentials)) {
                return back()->withErrors(['error' => 'Email ou mot de passe incorrect.']);
            }
        
            return redirect()->route('Admin-DashboardGetShow');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
        }
    }

    public function postLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('Auth-LoginGetShow');
    }
}
