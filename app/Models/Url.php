<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    public $table = 'urls';

    public $fillable = ['long'];
    public $appends = ['formated_created_at'];
    public $datatable = ['short'];

    public function getFormatedCreatedAtAttribute() {
        return Carbon::parse($this->created_at)->format('d-m-Y H:m');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
