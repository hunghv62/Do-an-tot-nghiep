<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    const PRIVATE = 1;
    const GROUP = 2;
    const COMMENT = 3;

    protected $fillable = ['name', 'user_created', 'post_id', 'user_join', 'type'];
}
