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

    public function myReservations()
    {
        $reservations = Reservations::where('user_id', Auth::user()->id)
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select('reservations.*', 'rooms.*', 'reservations.status as reservation_status', 'rooms.status as room_status')
            ->get();
        return view('reservation.reservation', compact('reservations'));
    }

    /**
     * TODO: this page is accessible only to the admin
     */
    public function pending()
    {
        $reservations = Reservations::where('reservations.status', 0)
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select('reservations.*', 'rooms.*', 'users.*', 'reservations.status as reservation_status', 'rooms.status as room_status', 'users.name as client_name')
            ->get();
        // "id" => 2
        // "room_id" => 2
        // "user_id" => 2
        // "status" => 1
        // "check_in" => "2024-05-23 00:00:00"
        // "check_out" => "2024-05-25 00:00:00"
        // "created_at" => "2024-05-23T13:55:53.000000Z"
        // "updated_at" => "2024-05-23T13:55:53.000000Z"
        // "number" => "1244"
        // "name" => "Pablito P Torrecampo Jr."
        // "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
        // "file_path" => "rooms/1716480447.jpg"
        // "type" => "4"
        // "price" => 2000.0
        // "email" => "10969torrexx@gmail.com"
        // "email_verified_at" => null
        // "role" => "user"
        // "picture" => "default.jpg"
        // "password" => "$2y$12$5/TIvzxSb.7NrqijogKs5ObmfF9j7NydsDT/vc0o1qrKlG2PwBU7q"
        // "remember_token" => null
        // "reservation_status" => 0
        // "room_status" => 1
        // "client_name" => "Pablito P Torrecampo Jr."
        return view('reservation.pending', compact('reservations'));
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
