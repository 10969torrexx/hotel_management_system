<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chats;
class ChatsController extends Controller
{
    //
    public function index()
    {
        // return view('chats.index');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        $chat = Chats::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
