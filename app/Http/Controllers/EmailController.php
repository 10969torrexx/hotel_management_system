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
