<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\OneTimePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($email)
    {
        $ifEmailExist = OneTimePassword::where('email', $email)->first();
        $otp = null;
        if(!$ifEmailExist){
            // Check if OTP already exists in session
            if (!session()->has('otp')) {
                $oneTimePassword = mt_rand(100000, 999999);
                session(['otp' => $otp]); // Store OTP in session
        
                $emailOtp = OneTimePassword::create([
                    'one_time_password' => $oneTimePassword,
                    'email' => $email
                ]);
        
                // Send OTP email
                Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
                    $message->to($email)->subject('One Time Password');
                });
            } else {
                $otp = session('otp'); // Retrieve OTP from session
            }
        }
        return view('email.index', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);
        $otp = $request->otp;
        $email = $request->email;
        $emailOtp = OneTimePassword::where('email', $email)->first();
        if ($emailOtp->one_time_password == $otp) {
            $user = User::where('email', $email)->first();
            if(!$user){
                $user = User::create([
                    'email' => $email,
                    'name' => Session::get('googleUser')['name'],
                    'picture' => !empty(Session::get('googleUser')['picture']) ? Session::get('googleUser')['picture'] : null,
                    'role' => !empty(Session::get('googleUser')['role']) ? Session::get('googleUser')['role'] : 'user',
                    'password' => Hash::make(!empty(Session::get('googleUser')['password']) ? Session::get('googleUser')['password'] : 'ExampleString')
                ]);
            }
            OneTimePassword::where('email', $email)->delete();
            Auth::login($user);
            return response()->json([
                'status' => 200, // 'error
                'message' => 'OTP verified successfully'
            ]);
        } else {
            return response()->json([
                'status' => 500, // 'error
                'message' => 'Invalid OTP',
                'request' => $request->all()
            ]);
        }
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
