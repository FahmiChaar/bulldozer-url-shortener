<?php

namespace App\DataTables;

use App\Models\Url;

class UrlDataTable extends VueDataTable {

    protected $rowPerPage = 10;

    public function query() {
        return Url::query();
    }

    public function model()
    {
        return Url::class;
    }

    protected function getColumns() {
        return [
            ['value'=> 'id', 'text'=> 'id', 'visible'=> false],
            
            ['value' => 'actions', 'text' => 'Actions', 'sortable'=> false]
        ];
    }

}
