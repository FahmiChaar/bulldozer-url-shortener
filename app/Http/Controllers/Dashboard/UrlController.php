<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UrlDataTable;
use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;
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

    public function show($id) {
        $url = Url::find($id);
        if (!$url) {
            return redirect()->back();
        }
        return Inertia::render('Urls/Show');
    }

    public function create() {
        return Inertia::render('Urls/Create');
    }

    public function store(Request $request) {
        $request->validate([ 'link' => 'required|string|url' ]);

        Url::create([
            'link' => $request->link,
            'token' => Url::generateToken(),
            'user_id' => auth()->id()
        ]);

        flash('Le lien a été raccourci avec succès')->success();

        return redirect(route('dashboard.urls.index'));
    } 
}