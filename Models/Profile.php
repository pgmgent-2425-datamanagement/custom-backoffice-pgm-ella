<?php

use App\Models\BaseModel;

class Profile extends BaseModel
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code'
    ];
}