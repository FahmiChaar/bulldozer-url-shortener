<?php

namespace App\DataTables;

use App\Models\Url;
use Spatie\QueryBuilder\QueryBuilder;

class UrlDataTable extends VueDataTable {

    protected $rowPerPage = 10;

    public function query() {
        // Here i use QueryBuilder package to handle datatable sort and filter requests.
        $sortField = request()->get('sort');
        $urls = auth()->user()->urls();
        $query = QueryBuilder::for($urls);
        if ($sortField) {
            $query->allowedSorts($sortField);
        }
        $query->defaultSort('-updated_at');
        return $query;
    }

    public function model()
    {
        return Url::class;
    }

    protected function editedColumns($item)
    {
        return [
            'token' => url($item->token)
        ];
    }

    protected function getColumns() {
        return [
            ['value'=> 'id', 'text'=> 'id', 'visible'=> false],
            ['value' => 'link', 'text' => "URL d'origine"],
            ['value' => 'shorten_link', 'text' => 'URL raccourcie'],
            ['value' => 'formated_created_at', 'text' => 'Crée le'],
            ['value' => 'actions', 'text' => 'Actions', 'sortable'=> false]
        ];
    }

}
