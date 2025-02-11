<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'country',
        'city',
        'address_line_1',
        'address_line_2',
        'phone_number',
        'postal_code',
    ];
}
