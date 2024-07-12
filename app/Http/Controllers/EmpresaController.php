<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\SedeEmpresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use App\Exports\EmpresasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpresasExportCreate;


class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:empresa.index')->only('index');
        $this->middleware('can:empresa.create')->only('create');
        $this->middleware('can:empresa.edit')->only('edit', 'update');
    }

    public function obtenerInformacionSede(Request $request)
    {
        // Obtener el ID de la sede enviado desde la petición AJAX
        $sedeId = $request->input('sede_id');

        // Buscar la sede en la base de datos
        $sede = SedeEmpresa::find($sedeId);

        // Retornar la información de la sede en formato JSON
        return response()->json([
            'direccion' => $sede->direccion,
            'barrio' => $sede->barrio,
            'ciudad' => $sede->ciudad,
            'geoubicacion' => $sede->geoubicacion,
            'telefono' => $sede->telefono,
        ]);
    }

    public function index(Request $request)
    {
        $q = trim($request->get('query'));
        $user = User::findOrFail(auth()->id());
        
        $empresas = DB::table('empresas')
            ->select(
                'empresas.id',
                'empresas.name',
                'empresas.nit',
                'empresas.rep_legal',
                DB::raw('(SELECT estado FROM sedes_empresas WHERE sedes_empresas.empresa_id = empresas.id LIMIT 1) as estado')
            )
            ->leftJoin('users', 'empresas.user_id', '=', 'users.id')
            ->where(function ($query) use ($q) {
                $query->where('empresas.name', 'like', "%$q%")
                    ->orWhere('empresas.nit', 'like', "%$q%");
            })
            ->where('users.nmv_cliente_id', '=', $user->nmv_cliente_id)
            ->paginate(10);
        
        $query = $q;
    
        return view('empresa.index', compact('empresas', 'query'));
    }
    
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

    public function store(Request $request)
{
   
        $request->validate([
            'name' => 'required|unique:empresas',
            'nit' => 'required|unique:empresas',
            'nombre_sede' => 'required|unique:sedes_empresas',
            'direccion' => 'required',
            'barrio' => 'required',
            'ciudad' => 'required',
            'geoubicacion' => 'required',
            'telefono' => 'required',
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
        ]); 
            
            $empresa = new Empresa($request->all());
            $empresa->user_id = auth()->id();
            $empresa->save();
    
           
            $sede = new sedeEmpresa([
                'nombre_sede' => $request->nombre_sede,
                'direccion' => $request->direccion,
                'barrio' => $request->barrio,
                'ciudad' => $request->ciudad,
                'geoubicacion' => $request->geoubicacion,
                'telefono' => $request->telefono,
                'estado' => $request->estado,
                'empresa_id' => $empresa->id,
                'user_id' => auth()->id(),
            ]);

            $sede->user_id = auth()->id();
            $sede->save();
    
             
            return redirect()->route('empresa.create')->with('info', 'La empresa y sede se crearon con éxito');
    }

    public function exportEmpresasCreate(Request $request)
    {
        $search = $request->input('search'); 
        return Excel::download(new EmpresasExportCreate($search), 'empresas.xlsx');
    }
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);

        // Obtén las sedes asociadas
        $sedesAsociadas = $empresa->SedeEmpresa()->pluck('nombre_sede', 'id');
    
        // Obtén la primera sede asociada
        $primerSede = $empresa->SedeEmpresa()->first();
    
        return view('empresa.edit', compact('empresa', 'sedesAsociadas', 'primerSede'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:empresas,name,'.$id,
            'nit' => 'required|unique:empresas,nit,'.$id,
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
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->except('sede')); 

   
     // Si la sede asociada a la empresa está seleccionada
     if ($request->has('sede')) {
        $sedeId = $request->input('sede');
        $sede = SedeEmpresa::find($sedeId);

        // Si se encontró la sede, actualizar sus datos
        if ($sede) {
            $sede->update([
                'direccion' => $request->input('direccion'),
                'barrio' => $request->input('barrio'),
                'ciudad' => $request->input('ciudad'),
                'geoubicacion' => $request->input('geoubicacion'),
                'telefono' => $request->input('telefono'),
                'estado' => $request->input('estado')
            ]);
        } else {
            // Si no se encontró la sede, mostrar un mensaje de advertencia o manejar la situación de otra manera
            // Puedes redireccionar a la vista de edición con un mensaje de error
            return redirect()->route('empresa.edit', $empresa->id)->with('error', 'La sede seleccionada no existe.');
        }
    }
    return redirect()->route('empresa.edit', $empresa->id)->with('info', 'La empresa y la sede se actualizaron con éxito');
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

    public function exportarEmpresas()
    {
        return Excel::download(new EmpresasExport, 'empresas.xlsx');
    }
}
