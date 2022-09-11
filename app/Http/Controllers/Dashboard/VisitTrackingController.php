<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\VisitTracking;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class VisitTrackingController extends Controller
{
    
    public function __invoke($token)
    {
        $url = Url::whereToken($token)->first();
        if (!$url) {
            return redirect(route('dashboard.home'))
                ->withErrors('Lien introuvable !');
        }
        // $ip = request()->ip(); // return wrong ip address so i use my custom method
        $ip = $this->getUserIP();
        $location = Location::get($ip);
        if ($location) {
            VisitTracking::create([
                'url_id' => $url->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip' => $ip,
                'user_agent' => request()->userAgent(),
                'country' => $location->countryName
            ]);
        }

        return Inertia::location($url->link);
    }

    private function getUserIP()
    {
        return trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
    }
}
