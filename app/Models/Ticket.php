<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const STATUS_UNSOLVED = 'unsolved';
    const STATUS_SOLVED = 'solved';
    const STATUS_AUTO_CLOSED = 'auto_closed';
    const STATUS_REOPEN = 'reopen';

    protected $fillable = [
        'ticket_number',
        'user_id',
        'name',
        'email',
        'order_number',
        'topic',
        'question',
        'token',
        'ticket_request',
        'shop_name',
        'shop_domain',
        'status'
    ];
}
