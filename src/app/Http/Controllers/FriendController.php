<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Repositories\FriendRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class FriendController extends Controller
{
    protected $friendRepository;
    protected $userRepository;

    public function __construct(
        FriendRepository $friendRepository,
        UserRepository $userRepository
    )
    {
        $this->friendRepository = $friendRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $friends = $this->friendRepository->getFriends();
        $requests = $this->friendRepository->getFriendRequested();
        return view('friend.index', [
            'data' => $friends,
            'dataRequest' => $requests
        ]);
    }

    public function search(Request $request)
    {
        try {
            $key = $request->key_search;
            $friends = $this->userRepository->findUserByName($key);
            $friend_requested = $this->friendRepository->getFriendRequest();
            return responseOK([
                'friends' => $friends,
                'friend_requested' => $friend_requested
            ]);
        } catch (\ErrorException $e) {
            return responseError($e->getCode(), $e->getMessage());
        }

    }

    public function create(Request $request)
    {
        try {
            $data = [
                'user_created' => auth()->id(),
                'friend_id' => $request->id,
                'status' => Friend::PENDING,
            ];
            $this->friendRepository->store($data);
            return responseOK(['success' => 'gửi yêu cầu kết bạn thành công']);
        } catch (\Exception $exception) {
            return responseError($exception->getCode(), $exception->getMessage());
        }
    }

}
