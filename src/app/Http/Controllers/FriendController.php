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
        $requests = $this->friendRepository->getFriendRequest();
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
            return responseOK($friends);
        } catch (\ErrorException $e) {
            return responseError($e->getCode(), $e->getMessage());
        }

    }

}
