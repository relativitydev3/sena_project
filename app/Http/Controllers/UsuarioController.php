<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente xdd
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;


class UsuarioController extends Controller
{
    function __construct()
    {
         
         $this->middleware('permission:usuarios', ['only' => ['create','store' , 'destroy' , 'edit','update' , 'index' ]]);
         $this->middleware('permission:clientes', ['only' => ['createc','storec' , 'destroyc' , 'editc','updatec' , 'indexc' ]]);
    }


    public function adminDashboard()
    {
        // Lógica y datos necesarios para el dashboard del administrador

        return view('admin.dashboard');
    }

    public function admingrafica()
    {
        // Lógica y datos necesarios para el dashboard del administrador

        return view('admin.grafica');
    }

    public function clienteDashboard()
    {
        // Lógica y datos necesarios para el dashboard del cliente

        return view('cliente.dashboard');
    }

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        
        $usuarios = User::with('pedidos')->get();
         
         
        return view('usuarios.index',compact('usuarios')); 

        
        

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    //Clientes

    public function indexc(Request $request)
    {      
        
        $usuarios = User::with('pedidos')->get();
        return view('A_clientes.index',compact('usuarios')); 

        //Con paginación
        // $usuarios = User::paginate(10);
        // return view('A_clientes.index',compact('usuarios'));

        

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }





    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    //clientes

    public function createc()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('A_clientes.crear',compact('roles'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
    //         'apellidos' => 'required|regex:/^[A-Za-z]+$/|max:20',
    //         'estado' => 'boolean',
    //         'documento' => [
    //             'nullable',
    //             'string',
    //             'min:8',
    //             'max:15',
    //             'unique:users,documento',
    //             'regex:/^[0-9]+$/'
    //         ],
    //         'telefono' => 'nullable|numeric|digits:10',
    //         'direccion' => 'nullable|max:50',
    //         'email' => 'required|email|unique:users,email|max:60',
    //         'password' => 'required|same:confirm-password|max:15',
    //         'roles' => 'required'
    //     ], [
    //         'name.required' => 'El campo nombre es obligatorio.',
    //         'name.regex' => 'El campo nombre solo debe contener letras.',
    //         'name.max' => 'El campo nombre no debe tener más de 20 caracteres.',
    //         'apellidos.required' => 'El campo apellidos es obligatorio.',
    //         'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
    //         'apellidos.max' => 'El campo apellidos no debe tener más de 20 caracteres.',
    //         'documento.min' => 'El campo documento debe tener al menos 8 dígitos.',
    //         'documento.unique' => 'El documento ingresado ya está en uso.',
    //         'documento.regex' => 'El campo documento solo puede contener números.',
    //         'telefono.numeric' => 'El campo teléfono debe contener solo números.',
    //         'telefono.digits' => 'El campo teléfono debe tener exactamente 10 dígitos.',
    //         'email.required' => 'El campo email es obligatorio.',
    //         'email.email' => 'El campo email debe ser una dirección de correo válida.',
    //         'email.max' => 'El campo email no debe tener más de 60 caracteres.',
    //         'email.unique' => 'El email ingresado ya está en uso.',
    //         'password.required' => 'El campo contraseña es obligatorio.',
    //         'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
    //         'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
    //         'roles.required' => 'Debe seleccionar un rol.'
    //     ]);

       
    
    //     $input = $request->all();
    //     $input['password'] = Hash::make($input['password']);
        
    //     // Asegurarse de que el campo 'estado' esté presente en la solicitud y tener un valor booleano
    //     $input['estado'] = $request->has('estado');
        
    //     $user = User::create($input);
    //     $user->assignRole($request->input('roles'));
        
    //     $userEstado = $user->estado;
    //     return redirect()->route('usuarios.index')->with('userEstado', $userEstado);
       
        
    // }

    // //clientes

    public function storec(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'estado' => 'boolean',
            'documento' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'unique:users,documento',
                'regex:/^[0-9]+$/'
            ],
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:60',
            'password' => 'required|same:confirm-password|max:15',
            'roles' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'estado.required' => 'El campo estado es requerido.',
            'documento.min' => 'El campo documento debe tener al menos 8 dígitos.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.unique' => 'El documento ingresado ya está en uso.',
            'documento.regex' => 'El campo documento solo puede contener números.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe ser valido sin extensiones solo numeros colombianos.',
            'telefono.digits' => 'El campo teléfono no es valido.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.max' => 'El campo dirección no debe tener más de 50 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'email.unique' => 'El email ingresado ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
        

       
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        // Asegurarse de que el campo 'estado' esté presente en la solicitud y tener un valor booleano
        $input['estado'] = $request->has('estado');
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        $userEstado = $user->estado;
        return redirect()->route('A_clientes.index')->with('userEstado', $userEstado);
       
        
    }

    public function store(Request $request)
    {
        $rol = $request->input('rol');

        
    
        $roleAdministrador = Role::where('name', 'administrador')->first();
    
        if ($roleAdministrador && $rol === $roleAdministrador->name) {
            return $this->storeAdmin($request);
        } else {
            return $this->storeCliente($request);
        }
    }

    private function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'estado' => 'boolean',
            'documento' => [
                'nullable',
                'string',
                'min:6',
                'max:15',
                'unique:users,documento',
                'regex:/^[0-9]+$/'
            ],
            'telefono' => 'nullable|numeric|digits:10',
            'direccion' => 'nullable|max:50',
            'email' => 'required|email|unique:users,email|max:60',
            'password' => 'required|same:confirm-password|max:15',
            'roles' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'documento.min' => 'El documento debe ser valido.',
            'documento.unique' => 'El documento ingresado ya está en uso.',
            'documento.regex' => 'El campo documento solo puede contener números.',
            'telefono.numeric' => 'El campo teléfono debe contener solo números.',
            'telefono.digits' => 'El campo teléfono debe tener exactamente 10 dígitos.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'email.unique' => 'El email ingresado ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        // Asegurarse de que el campo 'estado' esté presente en la solicitud y tenga un valor booleano
        $input['estado'] = $request->has('estado');
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        $userEstado = $user->estado;


        if ($user->hasRole('cliente')) {
        return redirect()->route('A_clientes.index')->with('userEstado', $userEstado)->with('success', 'Cliente creado exitosamente');
        } else {
        return redirect()->route('usuarios.index')->with('userEstado', $userEstado)->with('success', 'Usuario creado exitosamente');
        }

    }
    
    private function storeCliente(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'estado' => 'boolean',
            'documento' => [
                'required',
                'string',
                'min:6',
                'max:15',
                'unique:users,documento',
                'regex:/^[0-9]+$/'
            ],
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:60',
            'password' => 'required|same:confirm-password|max:15',
            'roles' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'estado.required' => 'El campo estado es requerido.',
            'documento.min' => 'El campo documento debe tener al menos 6 dígitos.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.unique' => 'El documento ingresado ya está en uso.',
            'documento.regex' => 'El campo documento solo puede contener números.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe ser válido sin extensiones, solo números colombianos.',
            'telefono.digits' => 'El campo teléfono no es válido.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.max' => 'El campo dirección no debe tener más de 50 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'email.unique' => 'El email ingresado ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        // Asegurarse de que el campo 'estado' esté presente en la solicitud y tenga un valor booleano
        $input['estado'] = $request->has('estado');
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        $userEstado = $user->estado;
        if ($user->hasRole('cliente')) {
            return redirect()->route('A_clientes.index')->with('userEstado', $userEstado)->with('success', 'Cliente creado exitosamente');
        } else {
            return redirect()->route('usuarios.index')->with('userEstado', $userEstado)->with('success', 'Usuario creado exitosamente');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('usuarios.show', compact('user'));

}

public function showc($id)
{
    $user = User::findOrFail($id);
    return view('A_clientes.show', compact('user'));

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('usuarios.editar',compact('user','roles','userRole'));
    }
    
    //clientes

    public function editc($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('A_clientes.editar',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, $id)
{
    $rol = $request->input('roles');
    // dd($rol);

    $roleAdministrador = Role::where('name', 'administrador')->first();

    if ($roleAdministrador && $rol === $roleAdministrador->name) {
        return $this->updateA($request, $id); // Pasa $id como argumento
    } else {
        return $this->updatec($request, $id); // Pasa $id como argumento
    }
}
     
    public function updateA(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'estado' => 'boolean',
            'documento' => [
                'nullable',
                'string',
                'min:6',
                'max:15',
                'regex:/^[0-9]+$/'
            ],
            'telefono' => 'nullable|numeric|digits:10',
            'direccion' => 'nullable|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password|max:15',
            'roles' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'telefono.numeric' => 'El campo teléfono no válido.',
            'telefono.digits' => 'El campo teléfono no válido.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
        

        
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        

        if ($user->hasRole('cliente')) {
            return redirect()->route('A_clientes.index')->with('success', 'Cliente actualizado exitosamente');
        } else {
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
        }
        
    }

    //clientes

    public function updatec(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'estado' => 'boolean',
            'documento' => [
                'required',
                'string',
                'min:6',
                'max:15',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) use ($id) {
                    $existingUser = User::where('documento', $value)->first();
                    
                    if ($existingUser && $existingUser->id != $id) {
                        $fail('Este documento ya está siendo utilizado por otro usuario.');
                    }
                }
            ],
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password|max:15',
            'roles' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.regex' => 'El campo documento no válido.',
            'documento.max' => 'El campo documento no debe tener más de 15 caracteres.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe contener solo números.',
            'telefono.digits' => 'El campo teléfono debe tener 10 dígitos.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.max' => 'El campo dirección no debe tener más de 50 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
        
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        if ($user->hasRole('cliente')) {
            return redirect()->route('A_clientes.index')->with('success', 'Cliente actualizado exitosamente');
        } else {
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
        }

        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
    
        if ($usuario->pedidos->isEmpty()) {
            $usuario->delete();
            Alert::success('Usuario eliminado', 'El usuario ha sido eliminado exitosamente.');
        } else {
            Alert::error('No se puede eliminar', 'El usuario tiene pedidos asociados y no puede ser eliminado.');
        }
    
        return redirect()->route('usuarios.index');
    }

    //clientes

    public function destroyc($id)
    {
        $usuario = User::find($id);
    
        if ($usuario->pedidos->isEmpty()) {
            $usuario->delete();
            Alert::success('Usuario eliminado', 'El usuario ha sido eliminado exitosamente.');
        } else {
            Alert::error('No se puede eliminar', 'El usuario tiene pedidos asociados y no puede ser eliminado.');
        }
    
        return redirect()->route('A_clientes.index');
    }

    public function updatePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Verificar si la contraseña actual ingresada coincide con la contraseña actual del usuario
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es válida.']);
    }

    // Actualizar la contraseña
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'La contraseña se ha actualizado correctamente.');
}

}