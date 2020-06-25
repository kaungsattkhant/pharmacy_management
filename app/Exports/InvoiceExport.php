<?php

namespace App\Exports;

use App\Model\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection,WithHeadings
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
    public function headings(): array
    {
        return [
            'Invoice No',
            'Date Time',
            'Total Kyat',
            'FrontMan'
        ];
    }
}
