<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use Illuminate\Support\Facades\Log;
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
            Log::info([
                'variable' => [
                    'checkIn' => $checkIn,
                    'checkOut' => $checkOut,
                    'isBookNowClicked' => $isBookNowClicked
                ],
                'session' => [
                    'checkIn' => session('checkIn'),
                    'checkOut' => session('checkOut'),
                    'bookNowClicked' => session('bookNowClicked')
                ]
            ]);
            session()->forget('bookNowClicked');
            session()->forget('checkIn');
            session()->forget('checkOut');
            return redirect(route('usersFindRooms', ['checkIn' => $checkIn, 'checkOut' => $checkOut]));
        }
      
        $rooms = Rooms::get();
        return view('users.index', compact('rooms'));
    }
}
