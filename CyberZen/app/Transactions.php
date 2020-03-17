<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'id',
        'rfid_number',
        'transactiontype_id',
        'amount',
        'updated_by'
    ];
}
