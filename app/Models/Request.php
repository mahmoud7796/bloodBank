<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'phone_number',
        'governorate_id',
        'city_id',
        'blood_type',
        'no_of_bags',
        'request_expiredDate',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

}
