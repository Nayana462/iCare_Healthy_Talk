<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    use HasFactory;

    protected  $table = 'chat_messages';

    protected $fillable = [
        'chat_conversation_id',
        'sender_id',
        'receiver_id',
        'type',
        'message',
        'filename',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'read_at',
    ];}
