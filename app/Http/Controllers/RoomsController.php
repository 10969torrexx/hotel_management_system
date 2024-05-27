<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Reservations;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }
    
    public function add()
    {
        return view('rooms.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:255', 'unique:rooms'],
            'description' => ['required', 'string', 'max:255'],
            'img' => ['required', 'mimes:jpeg,jpg,pdf'],
            'type' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric']
        ]);
        
        if($request->hasFile('img'))
        {
            $image = $request->img;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'rooms/'.$imagename;
            $image->move(public_path('rooms'),$imagename);
        }

        $room = Rooms::create([
            'number' => $request->number,
            'name' => $imagename,
            'description' => $request->description,
            'file_path' => $imagePath,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price
        ]);
        
        return redirect(route('roomsIndex'))->with('success', 'Room created successfully');
    }

    public function show(Request $request)
    {
        $room = Rooms::where('id', decrypt($request->id))->first();
        return response()->json([
            'status' => 200,
            'data' => $room
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric']
        ]);

        $ifRoomReserved = Reservations::where('room_id', $request->id)->first();
        if($ifRoomReserved)
        {
            return redirect(route('roomsIndex'))->with('error', 'Room cannot be updated because it is reserved');
        }

        if($request->hasFile('img'))
        {
            $image = $request->img;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'rooms/'.$imagename;
            $image->move(public_path('rooms'),$imagename);

            $room = Rooms::where('id', $request->id)->update([
                'number' => $request->number,
                'name' => $imagename,
                'description' => $request->description,
                'file_path' => $imagePath,
                'type' => $request->type,
                'status' => $request->status,
                'price' => $request->price
            ]);
        } else {
            $room = Rooms::where('id', $request->id)->update([
                'number' => $request->number,
                'description' => $request->description,
                'type' => $request->type,
                'status' => $request->status,
                'price' => $request->price
            ]);
        }

        return redirect(route('roomsIndex'))->with('success', 'Room updated successfully');
    }

    public function destroy($id)
    {
        $ifRoomReserved = Reservations::where('room_id', decrypt($id))->first();
        if($ifRoomReserved)
        {
            return redirect(route('roomsIndex'))->with('error', 'Room cannot be deleted because it is reserved');
        }
        $room = Rooms::where('id', decrypt($id))->delete();
        return redirect(route('roomsIndex'))->with('success', 'Room deleted successfully');
    }
}
