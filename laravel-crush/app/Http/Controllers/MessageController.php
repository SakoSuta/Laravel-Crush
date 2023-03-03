<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        return view('message.index');
    }

    public function create()
    {
        return view('message.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|min:15'
        ]);

        $message = new Message;
        $message->message = $request->message;
        $message->token = Crypt::encryptString($request->message);
        $message->save();

        $data = [
            'message' => $message
        ];

        Mail::send('message.email', $data, function($message) use($request) {
            $message->to($request->email)->subject('Message secret');
        });

        return redirect()->route('message.sent', ['token' => $message->token]);
    }

    public function show($token)
    {
        $message = Message::where('token', $token)->firstOrFail();
        $message->delete();
        return view('message.show', ['message' => $message]);
    }
}