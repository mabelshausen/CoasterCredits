<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coaster_id',
        'first_ride_date',
        'rides_count'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
