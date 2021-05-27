<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datos['usuarios']=usuario::paginate(4);
        return view('usuario.index',$datos);

        // $datos= usuario::all();
        // return $datos;

        // $sql = 'SELECT id,pNombre,sNombre,pApellido,sApellido,fechadenacimiento,tipo,telefono,direccion,foto, TIMESTAMPDIFF(YEAR,fechadenacimiento,CURDATE()) AS edad
        // FROM db_prueba.usuarios;';
        // $datos = DB::table('usuario')->get();
        // return view('usuario.index',$datos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

/*Validaciones */
$campos=[

    'pNombre'=>'required|string|max:100',
    'sNombre'=>'required|string|max:100',
    'pApellido'=>'required|string|max:100',
    'sApellido'=>'required|string|max:100',
    'fechadenacimiento'=>'required|date|before:2003-01-01',
    'tipo'=>'required|string|max:100',
    'telefono'=>'required|string|max:100',
    'direccion'=>'required|string|max:100',
    'foto'=>'required|max:10000|mimes:jpeg,png,jpg'

];

$mensaje=[

    'required'=>' :attribute es requerido',
    'foto.required'=>'La foto  es requerida',
    'fechadenacimiento.required'=>'Debe ser mayor de edad para realizar el registro'
];

$this->validate($request,$campos,$mensaje);





/*Eliminar Token en el formulario  */
        $datosUsuario = request()->except('_token');
       
        if($request->hasFile('foto')){
            $datosUsuario['foto']=$request->file('foto')->store('uploads','public');
        }
         
        usuario::insert( $datosUsuario );
        

/*Mensaje a la hora de agregar un usuario */
       return redirect('usuario')->with('Mensaje','usuario agregado con éxito');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $usuario=usuario::findOrFail($id);
        return view('usuario.edit', compact('usuario') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[

    'pNombre'=>'required|string|max:100',
    'sNombre'=>'required|string|max:100',
    'pApellido'=>'required|string|max:100',
    'sApellido'=>'required|string|max:100',
    'fechadenacimiento'=>'required|date|before:2003-01-01',
    'tipo'=>'required|string|max:100',
    'telefono'=>'required|string|max:100',
    'direccion'=>'required|string|max:100',
    'foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        
        ];
        
        $mensaje=[
        
            'required'=>' :attribute es requerido',
            'foto.required'=>'La foto requerida',
            'fechadenacimiento.required'=>'Debe ser mayor de edad para realizar el registro'
        ];
        
        $this->validate($request,$campos,$mensaje);
        



        $datosUsuario = request()->except(['_token','_method']);
        
        /*poder recuperar informacion de la foto cuando se quiere editar */
        if($request->hasFile('foto')){

            
            // $usuario = usuario::findOrFail($id);
            // Storage::delete('public/'.$usuario->foto);

            $datosUsuario['foto']=$request->file('foto')->store('uploads','public');
        }

        usuario::where('id','=',$id)->update($datosUsuario);
        $usuario = usuario::findOrFail($id);

       
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

/*borrado foto de la carpeta storage */
$usuario = usuario::findOrFail($id);
if(Storage::delete('public/'.$usuario->foto)){
    usuario::destroy($id);    
}

        return redirect('usuario')->with('Mensaje','usuario borrado');
    }
}


