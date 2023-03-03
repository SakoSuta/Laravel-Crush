<?php

// namespace App\Http\Controllers;

// use App\Models\Message;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Mail;

// class MessageController extends Controller
// {
//     public function index()
//     {
//         return view('message.index');
//     }

//     public function create()
//     {
//         return view('message.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'message' => 'required|min:15'
//         ]);

//         $message = new Message;
//         $message->message = $request->message;
//         $message->token = Crypt::encryptString($request->message);
//         $message->save();

//         $data = [
//             'message' => $message
//         ];

//         Mail::send('message.email', $data, function($message) use($request) {
//             $message->to($request->email)->subject('Message secret');
//         });

//         return redirect()->route('message.sent', ['token' => $message->token]);
//     }

//     public function show($token)
//     {
//         $message = Message::where('token', $token)->firstOrFail();
//         $message->delete();
//         return view('message.show', ['message' => $message]);
//     }
// }

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $users = DB::select('select * from users where active = ?', [1]);
        $users = "test";
 
        return view('formulaire', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function send(Request $request): RedirectResponse
    {
        
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required|min:15',
        ]);

        $email = $request->old('email');
        $message = $request->old('message');

        if($validated){
            $message = Message::create($request->all());
            $message->token = Str::random(15);
            $message->save();

            $content= "$message->message";

            Mail::to($message->email)->send(new MessageMail($message->token));

        }

        return redirect('/');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function view(): View
    {
        // $users = DB::select('select * from users where active = ?', [1]);
        $users = "test";
 
        return view('message', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}