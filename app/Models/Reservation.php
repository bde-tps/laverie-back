<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'machine',
        'comment',
        'start_at',
        'end_at',
        'room_id',
    ];

    public $timestamps = true;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
