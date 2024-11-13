<?php

namespace App\Exports;

use App\Models\SensorThigrow;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ThigrowExport implements FromCollection, WithHeadings
{
    use Exportable;
    protected $mergedData;
    public function __construct($mergedData){
        $this->mergedData = $mergedData;
    }
    public function collection()
    {
        return new Collection($this->mergedData);
        // return SensorThigrow::query();
    }

    public function headings(): array 
    {
        return [
            'No',
            'Nama Device',
            'Kelembaban Tanah (TH)',
            'Kelembaban Tanah (SM)',
            'Kelembaban Udara',
            'Intensitas Cahaya',
            'Battery',
            'Temperature',
            'Kadar Garam',
            'Tanggal',
        ];
    }
}
