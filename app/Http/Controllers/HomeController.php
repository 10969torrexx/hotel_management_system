<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;

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
        $isBookNowClicked = session('bookNowClicked');
        $checkIn = session('checkIn');
        $checkOut = session('checkOut');

        if($isBookNowClicked){
            dd($isBookNowClicked, $checkIn, $checkOut);
        }
      
        $rooms = Rooms::get();
        return view('users.index', compact('rooms'));
    }
}
