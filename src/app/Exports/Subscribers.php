<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Subscribers implements FromView
{
    public $data;

    public function view(): View
    {
        return view('exports.subscribers', [
            'datas' => $this->data,
        ]);
    }

    public function getDownloadByQuery($data)
    {
        $this->data = $data;

        return $this;
    }
}
