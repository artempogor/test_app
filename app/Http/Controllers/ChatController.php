<?php

namespace App\Http\Controllers;


use App\Events\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController
{
    public function index(Request $request)
    {
        auth()->login(User::find(1));

        return view('chat.chat');
    }

    public function sendMessage(Request $request)
    {
        auth()->login(User::find(1));

        /** @var User $user */
        $user = auth()->user();

        /** @var Message $message */
        $message = Message::query()->create([
            'user_id_author' => $user->getKey(),
            'message' => $request->get('message'),
        ]);

        broadcast(new SendMessage($user, $message));

        return $message;
    }

    public function messages(): array|\Illuminate\Database\Eloquent\Collection
    {
        return Message::query()->where('user_id_author', 1)->get();
    }
}