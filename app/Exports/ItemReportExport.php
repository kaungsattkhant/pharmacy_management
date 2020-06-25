<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ItemReportExport implements FromCollection,WithHeadings
{
    private $items;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($items)
    {
        $this->items=$items;
    }

    public function collection()
    {
        return $this->items;
    }
    public function headings(): array
    {
       return [
           'Name','Price','Total Qty','Total','Category','Branch'
       ];
    }
}
