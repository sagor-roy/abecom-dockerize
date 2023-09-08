<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class Order implements FromView
{
    public $data;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.order', [
            'datas' => $this->data
        ]);
    }

    public function getDownloadByQuery($data)
    {
        $this->data = $data;

        return $this;
    }
}
