<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('users.login');
    }

    public function register()
    {
        return view('users.register');
    }

    /**
     * Display a listing of the resource.
     */
    public function confirmLogin(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && password_verify($request->password, $user->password)) {
            Auth::login($user);
            return response()->json([
                'status' => 200,
                'message' => 'Login successful',
                'account' => $user
            ]);
        }
        return response()->json([
            'status' => 300,
            'message' => 'Invalid email or password'
        ]);
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/'],
            'role' => ['required', 'string', 'max:255']
        ]);
        Session::put('googleUser', $request->all());
        return redirect()->route('emailIndex', ['email' => $request->email]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
