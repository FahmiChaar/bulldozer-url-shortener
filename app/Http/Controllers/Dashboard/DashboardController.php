<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Render the dashboard view.
     *
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('Dashboard');
    }
}
