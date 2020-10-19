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
    const STATUS_TEXT = [
        self::ACCEPTED => 'Friends',
        self::PENDING => 'Requested',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }

    protected $fillable = ['user_created', 'friend_id', 'status'];
}
