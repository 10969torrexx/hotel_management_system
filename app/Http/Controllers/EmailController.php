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
                $otp = mt_rand(100000, 999999);
                session(['otp' => $otp]); // Store OTP in session
        
                $emailOtp = OneTimePassword::create([
                    'otp' => $otp,
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
        //
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
