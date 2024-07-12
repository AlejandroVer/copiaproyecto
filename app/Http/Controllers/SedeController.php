<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\SedeEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SedeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:sedes.create')->only('create');
        
    }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = Auth::user();

        /* $empresas = Empresa::all(); */

        $nmvClienteId = $usuario->nmv_cliente_id;
    
        // Obtener las empresas asociadas al nmv_cliente_id del usuario
        $empresas = Empresa::whereHas('users', function ($query) use ($nmvClienteId) {
            $query->where('nmv_cliente_id', $nmvClienteId);
        })->get();
        
        return view('sedes.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_sede' => 'required|unique:sedes_empresas',
            'direccion' => 'required',
            'barrio' => 'required',
            'ciudad' => 'required',
            'geoubicacion' => 'required',
            'telefono' => 'required',
            'estado' => 'required',
            'empresa_id' => 'required'
        ]);

        $data = $request->all();
        if (!isset($data['estado'])) {
            $data['estado'] = 'Activa';
        }
        
        $sedes = new SedeEmpresa($request->all());

        $sedes->user_id = auth()->id();

        $sedes->save();

        return redirect()->route('sedes.create')->with('success', 'La sede se creó con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SedeEmpresa $sedeEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SedeEmpresa $sedeEmpresa)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SedeEmpresa $sedeEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SedeEmpresa $sedeEmpresa)
    {
        //
    }
}
