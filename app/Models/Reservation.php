<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'machine_id',
        'member_id',
        'date',
        'duration',
        'price',
        'paid',
        'paid_date',
        'paid_amount',
        'paid_method',
        'paid_reference',
        'paid_comment',
        'comment',
        'created_at',
        'updated_at',
    ];

}
