<?php

namespace App\Exports;

use App\Service\RevenueService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportRevenue implements FromView
{

    protected $search;

    public function __construct($search) {
        $this->search = $search;
    }

    public function view(): View
    {
        return view('download.revenue', [
            'search' => $this->search,
            'order'  => RevenueService::getRevenues($this->search,false),
        ]);
     }
}
