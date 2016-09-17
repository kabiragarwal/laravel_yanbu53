<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\MessageRequest;
use App\Message;

class MessagesController extends Controller
{
    public function sendMessage(MessageRequest $request){
        $message = Message::create($request->all());
        return 'Your message has been successfully send';
    }
}
