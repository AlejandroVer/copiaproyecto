<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\SedeEmpresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q=trim($request->get('query'));
        $user=User::findOrFail(auth()->id());
        $empresas =DB::table('empresas')
                    ->select('empresas.id','empresas.name','empresas.nit','empresas.telefono', 'empresas.estado_empresa')
                    ->leftJoin('users', 'empresas.user_id', '=', 'users.id')
                    ->where(function ($query) use ($q) {
                        $query->where('empresas.name', 'like', "%$q%")
                        ->orWhere('empresas.nit', 'like', "%$q%");
                    })
                    ->where('users.nmv_cliente_id', '=', $user->nmv_cliente_id)
                    ->paginate(10);
        $query =$q;

        

        return view('empresa.index', compact('empresas','query'));
    }
    
    /**
     * Show the form for creating a new resource
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
            DB::raw('COALESCE(sedes_empresas.nombre_sede, "") as nombre_sede'),
            DB::raw('COALESCE(sedes_empresas.ciudad, "") as ciudad'),
            DB::raw('COALESCE(sedes_empresas.direccion, "") as direccion'),
            DB::raw('COALESCE(sedes_empresas.barrio, "") as barrio'),
            DB::raw('COALESCE(sedes_empresas.geoubicacion, "") as geoubicacion')
        )
        ->where(function ($query) use ($q) {
            $query->where('empresas.name', 'like', "%$q%")
                ->orWhere('empresas.nit', 'like', "%$q%");
        })
        ->where('users.nmv_cliente_id', '=', $user->nmv_cliente_id)
        ->paginate(10);

        $query = $q;
        $queryName = is_numeric($q) ? null : $q;
        $queryNit = is_numeric($q) ? $q : null;

        return view('empresa.create', compact('empresas', 'query', 'queryName', 'queryNit'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:empresas',
        'nit' => 'required',
        'telefono' => 'required|unique:empresas',
        'celular' => 'required|unique:empresas',
        'rep_legal' => 'required',
        'cel_rep_legal' => 'required|unique:empresas',
        'cargo_rep_legal' => 'required',
        'email_rep_legal' => 'required|unique:empresas',
        'jefe_th' => 'required',
        'cargo_jefe_th' => 'required',
        'cel_jefe_th' => 'required',
        'email_jefe_th' => 'required|unique:empresas',
        'contacto_th' => 'required',
        'cargo_contacto_th' => 'required',
        'cel_contacto_th' => 'required|unique:empresas',
        'email_contacto_th' => 'required|unique:empresas',
        'numero_trabajadores' => 'required',
        'estado_empresa' => 'required',
    ]); 

    
    $empresa = new Empresa($request->all());

    
    $empresa->user_id = auth()->id();

    
    $empresa->save();
    
    
    return redirect()->route('empresa.create')->with('info', 'La empresa se creó con éxito');
    
}

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empresa=Empresa::findOrFail($id);

        $sedesAsociadas = $empresa->SedeEmpresa()->pluck('nombre_sede', 'id');
        /* $sedes = SedeEmpresa::all()->pluck('nombre_sede', 'id'); */

        return view('empresa.edit', compact('empresa', 'sedesAsociadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:empresas,name,'.$id,
            'nit' => 'required|unique:empresas,nit,'.$id,
            'telefono' => 'required|unique:empresas,telefono,'.$id,
            'celular' => 'required|unique:empresas,celular,'.$id,
            'rep_legal' => 'required',
            'cel_rep_legal' => 'required|unique:empresas,cel_rep_legal,'.$id,
            'cargo_rep_legal' => 'required',
            'email_rep_legal' => 'required|unique:empresas,email_rep_legal,'.$id,
            'jefe_th' => 'required',
            'cargo_jefe_th' => 'required',
            'cel_jefe_th' => 'required|unique:empresas,cel_jefe_th,'.$id,
            'email_jefe_th' => 'required|unique:empresas,email_jefe_th,'.$id,
            'contacto_th' => 'required',
            'cargo_contacto_th' => 'required',
            'cel_contacto_th' => 'required|unique:empresas,cel_contacto_th,'.$id,
            'email_contacto_th' => 'required|unique:empresas,email_contacto_th,'.$id,
            'numero_trabajadores' => 'required',
            'estado_empresa' => 'required',
        ]);

       $empresa=Empresa::findOrFail($id);
       $empresa->name=$request->input('name');
       $empresa->nit=$request->input('nit');
       $empresa->telefono=$request->input('telefono');
       $empresa->celular=$request->input('celular');
       $empresa->rep_legal=$request->input('rep_legal');
       $empresa->cel_rep_legal=$request->input('cel_rep_legal');
       $empresa->cargo_rep_legal=$request->input('cargo_rep_legal');
       $empresa->email_rep_legal=$request->input('email_rep_legal');
       $empresa->jefe_th=$request->input('jefe_th');
       $empresa->cargo_jefe_th=$request->input('cargo_jefe_th');
       $empresa->cel_jefe_th=$request->input('cel_jefe_th');
       $empresa->email_jefe_th=$request->input('email_jefe_th');
       $empresa->contacto_th=$request->input('contacto_th');
       $empresa->cargo_contacto_th=$request->input('cargo_contacto_th');
       $empresa->cel_contacto_th=$request->input('cel_contacto_th');
       $empresa->email_contacto_th=$request->input('email_contacto_th');
       $empresa->numero_trabajadores=$request->input('numero_trabajadores');
       $empresa->estado_empresa=$request->input('estado_empresa');
       $empresa->save();
       return redirect()->route('empresa.edit', $empresa->id)->with('info', 'La empresa se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresa.index')->with('info', 'La empresa se eliminó con éxito');  
    }
}
