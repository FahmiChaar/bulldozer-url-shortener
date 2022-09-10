<?php

namespace App\DataTables;

use App\Models\Url;
use Spatie\QueryBuilder\QueryBuilder;

class UrlDataTable extends VueDataTable {

    protected $rowPerPage = 10;

    public function query() {
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
            // 
        ];
    }

    protected function getColumns() {
        return [
            ['value'=> 'id', 'text'=> 'id', 'visible'=> false],
            ['value' => 'long', 'text' => "URL d'origine"],
            ['value' => 'short', 'text' => 'URL raccourcie'],
            ['value' => 'formated_created_at', 'text' => 'Crée le'],
            ['value' => 'actions', 'text' => 'Actions', 'sortable'=> false]
        ];
    }

}
