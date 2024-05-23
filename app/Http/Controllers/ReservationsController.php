<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Support\Facades\Mail;
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

    public function myReservations()
    {
        $reservations = Reservations::where('user_id', Auth::user()->id)
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select('reservations.*', 'rooms.*', 'reservations.status as reservation_status', 'rooms.status as room_status')
            ->get();
        return view('reservation.reservation', compact('reservations'));
    }

    /**
     * TODO: these page is accessible only to the admin
     */
        public function pending()
        {
            $reservations = Reservations::where('reservations.status', 0)
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->select('reservations.*', 'rooms.*', 'users.*', 'reservations.status as reservation_status', 'reservations.id as reservation_id', 'rooms.status as room_status', 'users.name as client_name')
                ->get();
        
            return view('reservation.pending', compact('reservations'));
        }

        public function accepted(Request $request)
        {
            $email = $request->email;
            Mail::raw("Your reservation for Room #: $request->number has been ACCEPTED", function ($message) use ($email) {
                $message->to($email)->subject('Reservatio Update');
            });
            $reservation = Reservations::where('id', $request->id)->update([
                'status' => 1
            ]);
            return redirect(route('reservationPending'))->with('success', 'Reservation accepted');
        }

        public function declined(Request $request)
        {
            $email = $request->email;
            Mail::raw("Your reservation for Room #: $request->number has been DECLINED", function ($message) use ($email) {
                $message->to($email)->subject('Reservatio Update');
            });
            $reservation = Reservations::where('id', $request->id)->update([
                'status' => 2
            ]);
            return redirect(route('reservationPending'))->with('success', 'Reservation accepted');
        }

    public function update(Request $request)
    {
       
    }

    public function destroy($id)
    {
       
    }
}