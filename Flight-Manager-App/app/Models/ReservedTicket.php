<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'is_paid',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'departs_at',
        'lands_at',
    ];
}
