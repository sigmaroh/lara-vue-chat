<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function __construct(User $user){
    	$this->middleware('auth');
    	// $this->message = $message;
    	// $this->user  = $user;
    }
    public function chat(){
    	return view('chat');
    }
    public function send(Request $request){
    	// dd($request->message);
    	$user  =User::find(Auth::id());
        $this->saveToSession($request);
    	 event(new ChatEvent($request->message,$user));
    	 // broadcast(new ChatEvent($request->message,$user)->toOthers();
    }
    public function saveToSession(Request $request){
    
        session()->put("chat",$request->chat);
    }
    public function getOldMessages(){
        return session('chat');
    }
    public function check(){
        return session('chat');
    }
    public function forgetChatSession(){
        return session()->forget('chat');
    }
}
