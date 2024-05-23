<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Support\Facades\Auth;


class ReservationsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }

    public function make(Request $request)
    {
        $hasReservation = Reservations::where('user_id', Auth::user()->id)->whereAny(['status'], [0, 1,2])->first();
        if($hasReservation){
            return redirect(route('usersHome'))->with('error', 'You have an active reservation');
        }
        $rooms = Rooms::where('id', $request->id)
            ->where('status', 0)->first();
        return view('reservation.make', compact('rooms'));
    }

    public function makeReservation(Request $request) 
    {
        $this->validate($request, [
            'id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required'
        ]);

        $reservation = Reservations::create([
            'room_id' => $request->id,
            'user_id' => Auth::user()->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out
        ]);

        $rooms = Rooms::where('id', $request->id)->update([
            'status' => 1
        ]);

        return redirect(route('usersHome'))->with('success', 'Reservation made successfully');
    }

    public function store(Request $request)
    {
       
    }

    public function show(Request $request)
    {
       
    }

    public function update(Request $request)
    {
       
    }

    public function destroy($id)
    {
       
    }
}
