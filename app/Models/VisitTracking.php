<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitTracking extends Model
{
    public $table = 'visits_tracking';

    public $fillable = [
        'url_id',
        'user_id',
        'ip',
        'country',
        'user_agent'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
