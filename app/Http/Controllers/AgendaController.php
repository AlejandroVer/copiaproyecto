<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('can:agendas.index')->only('index');
        $this->middleware('can:agendas.create')->only('create');
    }

    public function index(Request $request)
    {
        
            $user = auth()->user();

            $nmv_cliente_id = $user->nmv_cliente_id;
        
            $fechaCita = $request->input('fecha_cita');
        
            $agendas = Agenda::whereHas('user', function ($query) use ($nmv_cliente_id) {
                $query->where('nmv_cliente_id', $nmv_cliente_id);
            })
            ->whereDate('fecha_cita', $fechaCita)
            ->with('sedeEmpresa') 
            ->paginate(10);

            $sedeCoordinates = $agendas->map(function ($agenda) {
                return $agenda->sedeEmpresa->geoubicacion;
            })->toArray();

            $centerCoordinate = count($sedeCoordinates) > 0 ? $sedeCoordinates[0] : '4.134282,-73.637742';

            
            return view('agendas.index', compact('agendas','sedeCoordinates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $q=trim($request->get('query'));
        $user=User::findOrFail(auth()->id());
        $empresas = DB::table('empresas')
        ->leftJoin('sedes_empresas', 'empresas.id', '=', 'sedes_empresas.empresa_id')
        ->leftJoin('users', 'empresas.user_id', '=', 'users.id')
        ->select(
            'empresas.id',
            'empresas.name',
            'empresas.nit',
            'sedes_empresas.id as sede_empresa_id',
            DB::raw('COALESCE(sedes_empresas.nombre_sede, "") as nombre_sede'),
            DB::raw('COALESCE(sedes_empresas.ciudad, "") as ciudad'),
            DB::raw('COALESCE(sedes_empresas.direccion, "") as direccion'),
            DB::raw('COALESCE(sedes_empresas.barrio, "") as barrio'),
            DB::raw('COALESCE(sedes_empresas.telefono) as telefono'),
            DB::raw('COALESCE(sedes_empresas.geoubicacion, "") as geoubicacion')
        )
        ->where(function ($query) use ($q) {
            $query->where('empresas.name', 'like', "%$q%")
                ->orWhere('empresas.nit', 'like', "%$q%");
        })
        ->where('users.nmv_cliente_id', '=', $user->nmv_cliente_id)
        ->paginate(10);

        $query = $q;

    return view('agendas.create', compact('empresas', 'query'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'objetivo' => 'required',
        ]);
    
        $empresaId = $request->input('empresa_id');
        $sedeEmpresaId = $request->input('sede_empresa_id');
    
        $agenda = new Agenda();
        $agenda->fecha_cita = $validatedData['fecha'];
        $agenda->hora_cita = $validatedData['hora'];
        $agenda->objetivo_visita = $validatedData['objetivo'];
        $agenda->user_id = auth()->user()->id;
        $agenda->empresa_id = $empresaId;
        $agenda->sede_empresa_id = $sedeEmpresaId;
    
        $agenda->name = $request->input('name');
        $agenda->nombre_sede = $request->input('sede');
        $agenda->direccion = $request->input('direccion');
        $agenda->barrio = $request->input('barrio');
        $agenda->ciudad = $request->input('ciudad');
        $agenda->telefono = $request->input('telefono');
        $agenda->agendada_el = Carbon::now();
    
    
        $agenda->save();
    
        return redirect()->route('agendas.create')->with('success', 'Agenda de visita creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
}
