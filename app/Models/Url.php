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
        'user_id',
    ];
    public $appends = ['shorten_link'];
    public $datatable = ['token', 'created_at'];

    public function getShortenLinkAttribute() {
        return url($this->token);
    }

    public static function generateToken($tokenLength = 4) {
        return substr(md5(uniqid(rand(), true)), 0 ,$tokenLength);
    }
    
    public static function deleteLast() {
        return static::orderBy('id', 'desc')->limit(1)->delete();
    }

    public static function deleteOlderThanOneDay() {
        return static::where('created_at', '<', Carbon::yesterday())->delete();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function visits() {
        return $this->HasMany(VisitTracking::class, 'url_id')
                    ->with('user');
    }

}
