<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;

class RoomsController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'img' => ['required', 'mimes:jpeg,jpg,pdf'],
            'type' => ['required', 'string', 'max:255'],
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
            'price' => $request->price
        ]);
        
        return redirect(route('roomsIndex'))->with('success', 'Room created successfully');
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
