<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use App\Repositories\RoomRepository;

class MessageController extends Controller
{
    protected $messageRepository;
    protected $roomRepository;

    public function __construct(
        MessageRepository $messageRepository,
        RoomRepository $roomRepository
    )
    {
        $this->messageRepository = $messageRepository;
        $this->roomRepository = $roomRepository;
    }

    public function getMessage(Request $request)
    {
        $room = '';
        if ($request->id) {
            // make room chat
            $room = $this->roomRepository->findRoom(auth()->id(), $request->id);
            if (!$room) {
                try {
                    $room = $this->roomRepository->store([
                        'user_created' => auth()->id(),
                        'user_join' => $request->id,
                        'type' => Room::PRIVATE
                    ]);
                } catch (\Exception $exception) {
                    return back()->with('error', $exception->getMessage());
                }
            }

        }
        return view('message.index', [
            'room_id' => $room->id ?? ''
        ]);
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

    public function createMessage(Request $request)
    {
        dd($request->all());
    }
}
