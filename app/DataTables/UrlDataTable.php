<?php

namespace App\DataTables;

use App\Models\Url;
use Carbon\Carbon;
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
            'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:m')
        ];
    }

    protected function getColumns() {
        return [
            ['value'=> 'id', 'text'=> 'id', 'visible'=> false],
            ['value' => 'link', 'text' => "url.link"],
            ['value' => 'shorten_link', 'text' => 'url.short'],
            ['value' => 'created_at', 'text' => 'url.created_at'],
            ['value' => 'actions', 'text' => 'Actions', 'sortable'=> false]
        ];
    }

}
