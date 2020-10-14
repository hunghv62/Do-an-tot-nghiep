<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friend extends Model
{
    use HasFactory, SoftDeletes;

    const ACCEPTED = 1;
    const REJECTED = 2;
    const PENDING = 3;

    protected $fillable = ['user_created', 'friend_id', 'status'];
}
