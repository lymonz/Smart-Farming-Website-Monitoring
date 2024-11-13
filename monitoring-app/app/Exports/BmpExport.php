<?php

namespace App\Exports;

use App\Models\SensorBmp;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BmpExport implements FromCollection, WithHeadings
{
    
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $mergedData;

    public function __construct($mergedData){
        $this->mergedData = $mergedData;
    }
    public function collection()
    {
        return new Collection($this->mergedData);
    }
    public function headings(): array {
        return [
            'No',
            'Nama Device',
            'Tekanan Udara',
            'Tinggi Permukaan',
            'Battery',
            'Tanggal'
        ];
    }
}
