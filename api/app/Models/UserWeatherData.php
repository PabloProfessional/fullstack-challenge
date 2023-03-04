<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeatherData extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','current_weather'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
