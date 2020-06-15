<?php

namespace App\Exports;

use App\Model\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;


class SaleRecordExport implements FromCollection
{
    /**
     *
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
//        $this->sales = $sales;
    }
    public function collection()
    {
//        return $this->sales;
    }
}
