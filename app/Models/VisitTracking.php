<?php

namespace App\Models;

use Carbon\Carbon;
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
    public $appends = ['formated_created_at'];

    public function getFormatedCreatedAtAttribute() {
        return Carbon::parse($this->created_at)->format('d-m-Y H:m');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
