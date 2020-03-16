<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientLists extends Model
{
    protected $fillable = [
        'client_name',
        'contact_person',
        'contact_number',
        'client_address',
        'client_email',
        'keyword'
    ];
}
