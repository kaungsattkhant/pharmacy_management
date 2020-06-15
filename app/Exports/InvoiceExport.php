<?php

namespace App\Exports;

use App\Model\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{
    private $sales;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct( $sales)
    {
        $this->sales = $sales;
    }
    public function collection()
    {
        return $this->sales;
    }
}
