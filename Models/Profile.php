<?php

use App\Models\BaseModel;

class Profile extends BaseModel
{
    protected $table = 'users'; // Override table name to 'users'

    protected $fillable = [
        'user_id',      // Fillable properties allow mass assignment
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip_code'
    ];
}