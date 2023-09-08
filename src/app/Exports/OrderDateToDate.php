<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderDateToDate implements FromView
{
    public $data;

    public function view(): View
    {
        return view('exports.order_date_to_date', [
            'datas' => $this->data,
        ]);
    }

    public function getDownloadByQuery($data)
    {
        $this->data = $data;

        return $this;
    }
}
