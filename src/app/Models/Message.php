<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    const PRIVATE = 1;
    const GROUP = 2;
    const COMMENT = 3;

    protected $fillable = ['user_created', 'room_id', 'content_text', 'content_media', 'reply_to'];
}
