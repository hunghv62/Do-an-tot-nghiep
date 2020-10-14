<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    const PRIVATE = 1;
    const PUBLIC = 2;
    const ONLY_FRIEND = 3;

    protected $fillable = ['content_text', 'content_media', 'type', 'room_id'];
}
