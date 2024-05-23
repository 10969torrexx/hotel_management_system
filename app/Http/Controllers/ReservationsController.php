<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;

class ReservationsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }

    public function make(Request $request)
    {
        return view('reservation.make');
    }

    public function makeReservation(Request $request) {

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
