<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SecretMessage;
use Illuminate\Support\Str;


class MessageController extends Controller
{
    //
    public function index()
    {
        return view('message');
    }

    public function sendMessage(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'message' => 'required|min:15',
        ]);

        $message = $validatedData['message'];
        $token = Str::random(16);

        $data = [
            'link' => url('/message/' . $token),
        ];

        DB::beginTransaction();

        try {
            Mail::to($validatedData['email'])->send(new SecretMessage($data));

            $newMessage = new Message;
            $newMessage->message = $message;
            $newMessage->token = $token;
            $newMessage->save();

            DB::commit();

            return redirect()->back()->with('message', 'Ton message secret a été envoyé 😳 !');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'envoi de ton message.');
        }
    }

    public function show($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        try{
            $message =  Message::where('token', $token)->firstOrFail();
            $message->delete();
            return view('secret')->with('message', $message->message);
        } catch (ModelNotFoundException $exception){
            $message = 'Tu l\'a déjà lu ! ( si c\'est pas toi dommage il a été détruit 🤭 ) ' ;
            return view('secret')->with('message', $message);

        }
    }
}
