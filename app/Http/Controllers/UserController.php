<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Perfil;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\SedeNmvCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function exportUsers(Request $request)
    {
        $nmv_cliente_id = $request->query('nmv_cliente_id');

        return Excel::download(new UsersExport($nmv_cliente_id), 'users.xlsx');
    }
   
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit', 'update');
    }
    
    public function index(Request $request)
    {
        $query = trim($request->get('query'));
        $user = auth()->user(); 

    
        $users = $user->nmvCliente->users()
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%$query%")
                ->orWhere('apellidos', 'like', "%$query%")
                ->orWhere('identificacion', 'like', "%$query%");
                  })
            ->with('roles', 'areas') 
            ->paginate(10);

        return view('users.index', compact('users', 'query'));
    }

   
    public function create()
    {
        
    $usuario = Auth::user(); 

    $sedes = SedeNmvCliente::where('nmv_cliente_id', $usuario->nmv_cliente_id)->get();
    $roles = Role::all();

    return view('users.create', compact('sedes', 'roles'));

    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:users,identificacion',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|exists:roles,id',
            'area' => 'required|string|in:Comercial y mercadeo,Aportes,Empleo,Afiliaciones',
            'usuario' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sede' => 'required'
        ]);
    
        // Crear el usuario
        $user = new User([
            'name' => $request->input('name'),
            'apellidos' => $request->input('apellidos'),
            'identificacion' => $request->input('identificacion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'username' => $request->input('usuario'),
            'password' => Hash::make($request->input('password')),
            'foto' => $request->input('foto'),
            'nmv_cliente_id' => $request->input('nmv_cliente_id'),
            'sede_id' => $request->input('sede')
        ]);
    
        // Guardar el usuario en la base de datos
        $user->save();
    
        // Asignar el rol al usuario
        $role = Role::findById($request->role);
        $user->assignRole($role);
    
        // Obtener el área por nombre y adjuntarla al usuario
        $areaNombre = $request->input('area');
        $area = Area::where('name', $areaNombre)->first()->id;
        $user->areas()->attach($area);

    return redirect()->route('users.index')->with(['update_user'=>'El usuario se creó con éxito']);
    }


    public function edit(User $user)
    {
        $usuario = Auth::user(); 

        $sedes = SedeNmvCliente::where('nmv_cliente_id', $usuario->nmv_cliente_id)->get();
        $roles = Role::all();

        return view('users.edit', compact('user', 'sedes', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => "required|string|max:255|unique:users,identificacion,$user->id",
            'telefono' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,$user->id",
            'role' => 'required|exists:roles,id',
            'area' => 'required|string|in:Comercial y mercadeo,Aportes,Empleo,Afiliaciones',
            'usuario' => "required|string|max:255|unique:users,username,$user->id",
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sede' => 'required|exists:sedes_nmvclientes,id',
        ]);

        $data = $request->all();

        
        $user->sede_id = $data['sede'];
            
        $areaId = Area::where('name', $data['area'])->value('id');

    
        $user->areas()->sync   ([$areaId]);

        unset($data['role'], $data['area'], $data['sede']);
        
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if(isset($data['usuario']) && $data['usuario'] !== $user->username){
            $request->validate([
                'usuario' => "unique:users,username",
            ]);
            $user->username = $data['usuario'];
        }

        $user->update($data);
        // Actualizar el rol del usuario
        $role = Role::findById($request->role);
        $user->syncRoles($role);

        return redirect()->route('users.index')->with('update_user', 'El usuario se actualizó con éxito');
    }

    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('empresa.index')->with('info', 'El usuario se eliminó con éxito');
    }
}
