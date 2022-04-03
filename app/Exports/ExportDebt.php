<?php

namespace App\Exports;

use App\Models\User;
use App\Service\DebtService;
use App\Service\OrderService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportDebt implements FromView
{

    protected $search;

    public function __construct($search) {
        $this->search = $search;
    }

    public function view(): View
    {
        return view('download.debt', [
            'search' => $this->search,
            'items'  => DebtService::getDebtes($this->search,false),
        ]);
     }
}
