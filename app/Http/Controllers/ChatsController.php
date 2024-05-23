<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chats;
class ChatsController extends Controller
{
    //
    public function index()
    {
        $chats = Chats::where('status', 0)->get();
        return view('chats.index', compact('chats'));
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

    public function get(Request $request) {
        $chats = Chats::where('status', $request->status)->get();
        return response()->json([
            'status' => 200,
            'data' => $chats
        ]);
    }
}
