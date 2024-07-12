<?php

namespace App\Exports;

use App\Models\Empresa;
use App\Models\SedeEmpresa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpresasExportCreate implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Empresa::join('sedes_empresas', 'empresas.id', '=', 'sedes_empresas.empresa_id')
            ->select(
                'empresas.id',
                'empresas.name',
                'sedes_empresas.ciudad',
                'sedes_empresas.nombre_sede',
                'sedes_empresas.direccion',
                'sedes_empresas.barrio',
                'sedes_empresas.geoubicacion'
            )
            ->where('empresas.name', 'LIKE', '%' . $this->search . '%')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Razon Social',
            'Ciudad',
            'Nombre Sede',
            'Direccion',
            'Barrio',
            'GeoUbicacion'
        ];
    }
}
