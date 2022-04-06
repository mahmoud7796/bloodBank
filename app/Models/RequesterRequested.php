<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequesterRequested extends Model
{
    use HasFactory;


    protected $table = "Requester_Requested";

    protected $fillable = [
        'id',
        'requested_id',
        'requester_id',
    ];

}
