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
