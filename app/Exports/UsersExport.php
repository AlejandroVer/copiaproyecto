<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{

    protected $nmvClienteId;

    public function __construct($nmvClienteId)
    {
        $this->nmvClienteId = $nmvClienteId;
    }

    public function collection()
    {
        return User::with(['roles', 'areas'])
                    ->where('nmv_cliente_id', $this->nmvClienteId)
                    ->get()
                    ->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'apellidos'=> $user->apellidos,
                'identificacion' => $user->identificacion,
                'perfil' => $user->roles->pluck('name')->implode(', '),
                'area' => $user->areas->pluck('name')->implode(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Apellidos',
            'Identificacion',
            'Perfil',
            'Area',
        ];
    }
}