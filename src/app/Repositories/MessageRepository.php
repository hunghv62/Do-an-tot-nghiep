<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageRepository
{
    public function getAll()
    {
        Message::all();
    }

    public function store($data)
    {
        Message::create($data);
    }
}
