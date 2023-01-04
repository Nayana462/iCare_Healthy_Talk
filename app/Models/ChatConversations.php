<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatConversations extends Model
{
    use HasFactory;

    protected $table = 'chat_conversations';
    protected $fillable = [
        'user_1',
        'user_2',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
