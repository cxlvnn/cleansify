<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/recitations');
        }

        return back()->withErrors(['email' => 'Credentials do not match our records']);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
