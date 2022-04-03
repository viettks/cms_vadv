<?php

namespace App\Exports;

use App\Models\User;
use App\Service\OrderService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportOrder implements FromView
{

    protected $search;

    public function __construct($search) {
        $this->search = $search;
    }

    public function view(): View
    {
        return view('download.order', [
            'search' => $this->search,
            'order'  => OrderService::getListOrder($this->search,false),
        ]);
     }
}
