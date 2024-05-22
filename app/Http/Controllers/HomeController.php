<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        return view('keto.index');
    }

    public function About()
    {
        return view('keto.about');
    }

    public function our_room()
    {
        return view('keto.room');
    }

    public function gallery()
    {
        return view('keto.gallery');
    }

    public function blog()
    {
        return view('keto.blog');
    }

    public function contact_us()
    {
        return view('keto.contact');
    }
}
