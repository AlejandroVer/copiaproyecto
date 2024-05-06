<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Perfil;
use App\Models\User;
use App\Models\SedeNmvCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            ->with('perfiles', 'areas') 
            ->paginate(10);

        return view('users.index', compact('users', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    $usuario = Auth::user(); 

    $sedes = SedeNmvCliente::where('nmv_cliente_id', $usuario->nmv_cliente_id)->get();

    return view('users.create', compact('sedes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $request->validate([
        
        'name' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'identificacion' => 'required|string|max:255|unique:users,identificacion',
        'telefono' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'perfil' => 'required|string|in:Admin Sistemas,Gerente,Jefe de area,Coor. Area,Asesor',
        'area' => 'required|string|in:Comercial y mercadeo,Aportes,Empleo,Afiliaciones',
        'usuario' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:8|confirmed',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'sede' => 'required'
    ]);

    

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


    $user->save();

    $perfilNombre = $request->input('perfil');
    $areaNombre = $request->input('area');

// Busca los IDs correspondientes a partir de los nombres
    $perfil = Perfil::where('name', $perfilNombre)->first()->id;
    $area = Area::where('name', $areaNombre)->first()->id;
    /* $sede = SedeNmvCliente::where('nombre_sede', $nombreSede)->first()->id; */

// Adjunta los perfiles y áreas al usuario utilizando los IDs obtenidos
    $user->perfiles()->attach($perfil);
    $user->areas()->attach($area);
    /* $user->sedes_nmvclientes()->attach($sede); */
    

    return redirect()->route('users.index')->with(['update_user'=>'El usuario se creó con éxito']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $usuario = Auth::user(); 

        $sedes = SedeNmvCliente::where('nmv_cliente_id', $usuario->nmv_cliente_id)->get();

        return view('users.edit', compact('user', 'sedes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => "required|string|max:255|unique:users,identificacion,$user->id",
            'telefono' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,$user->id",
            'perfil' => 'required|string|in:Admin Sistemas,Gerente,Jefe de area,Coor. Area,Asesor',
            'area' => 'required|string|in:Comercial y mercadeo,Aportes,Empleo,Afiliaciones',
            'usuario' => "required|string|max:255|unique:users,username,$user->id",
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sede' => 'required|exists:sedes_nmvclientes,id',
        ]);

        $data = $request->all();

        // Actualizar la sede del usuario
        $user->sede_id = $data['sede'];
            
      $perfilId = Perfil::where('name', $data['perfil'])->value('id');
        $areaId = Area::where('name', $data['area'])->value('id');

    // Sincronizar relaciones de perfil y área
        $user->perfiles()->sync([$perfilId]);
        $user->areas()->sync([$areaId]);

    // Actualizar el usuario con los otros datos
        unset($data['perfil'], $data['area'], $data['sede']);
        
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

        return redirect()->route('users.index')->with('update_user', 'El usuario se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
