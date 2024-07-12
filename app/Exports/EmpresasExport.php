<?php

namespace App\Exports;

use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpresasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Empresa::select('id', 'name', 'nit', 'rep_legal', 'estado_empresa')->get();
    }
     /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Razon',
            'NIT',
            'Rep.Legal',
            'Estado',
        ];
    }

}
