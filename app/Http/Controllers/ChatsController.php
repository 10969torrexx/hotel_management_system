<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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

    public function show(Request $request) {
        $chat = Chats::where('id', $request->id)->first();
        return response()->json([
            'status' => 200,
            'data' => $chat,
            'request' => $request->all()
        ]);
    }

    public function reply(Request $request) {
        $this->validate($request, [
            'reply' => 'required'
        ]);
        $chat = Chats::where('id', $request->id)->first();
        $email = $chat->email;
        Mail::send('email.reply', ['chatMessage' => $chat->message, 'replyMessage' => $request->reply], function ($message) use ($email) {
            $message->to($email)->subject('Reply from GMB chat bot');
        });
        $chat->status = 1;
        $chat->reply = $request->reply;
        $chat->save();
        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
