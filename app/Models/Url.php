<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    public $table = 'urls';

    public $fillable = [
        'link',
        'token',
        'user_id'
    ];
    public $appends = ['formated_created_at', 'shorten_link'];
    public $datatable = ['token'];

    public function getFormatedCreatedAtAttribute() {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
    
    public function getShortenLinkAttribute() {
        return url($this->token);
    }

    public static function generateToken($tokenLength = 4) {
        return substr(md5(uniqid(rand(), true)), 0 ,$tokenLength);
    }
    
    public static function deleteLast() {
        return static::orderBy('id', 'desc')->limit(1)->delete();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function visits() {
        return $this->HasMany(VisitTracking::class, 'url_id')
                    ->with('user');
    }

}
