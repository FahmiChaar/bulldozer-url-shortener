<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UrlDataTable;
use App\Http\Controllers\Controller;
use App\Models\Url;
use Inertia\Inertia;

class UrlController extends Controller
{
    /**
     * Display a listing of the Product.
     *
     * @param UrlDataTable $urlDataTable
     * @return Response
     */
    public function index(UrlDataTable $urlDataTable)
    {
        return $urlDataTable->inertiaRender('Urls/Index');
    }

    public function showHistory($id) {
        $url = Url::find($id);
        if (!$url) {
            return redirect()->back();
        }
        return Inertia::render('Urls/Show');
    }
}