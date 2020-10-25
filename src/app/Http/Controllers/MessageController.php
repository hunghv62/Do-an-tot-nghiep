<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function getMessage()
    {
        $this->messageRepository->getAll();
        return view('message.index');
    }

    public function storeMessage(Request $request)
    {
        try {
            $message = $request->message;
            $data = [
                'user_created' => auth()->id(),
                'room_id' => 1,
                'content_text' => $request->message
            ];
            $this->messageRepository->store($data);
            event(new MyEvent($message, auth()->id()));
            return responseOK($data);
        } catch (\ErrorException $e) {
            return responseError($e->getCode(), $e->getMessage());
        }


    }
}
