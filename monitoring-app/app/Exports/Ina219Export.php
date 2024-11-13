<?php

namespace App\Exports;

use App\Models\SensorIna219;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Ina219Export implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $mergedData;

    public function __construct($mergedData){
        $this->mergedData= $mergedData;
    }

    public function collection()
    {
        return new Collection($this->mergedData);
    }

    public function headings():array{
        return [
            'No',
            'Nama Device',
            'Tegangan',
            'Arus',
            'Daya',
            'Tanggal'
        ];
    }
}
