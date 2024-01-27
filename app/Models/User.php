<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
