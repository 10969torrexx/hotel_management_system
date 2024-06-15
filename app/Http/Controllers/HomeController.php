<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Reservations;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
        $isBookNowClicked = Session::get('bookNowClicked');
        $checkIn = Session::get('checkIn');
        $checkOut = Session::get('checkOut');
       
        if($isBookNowClicked){
            Session::forget('bookNowClicked');
            Session::forget('checkIn');
            Session::forget('checkOut');
            return redirect(route('usersFindRooms', [
                'checkIn' => encrypt($checkIn), 
                'checkOut' => encrypt($checkOut),
                'isBookNowClicked' => $isBookNowClicked
            ]));
        }

        $rooms = Rooms::get();
        return view('users.index', compact('rooms'));
    }
}
