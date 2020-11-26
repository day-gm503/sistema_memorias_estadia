<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\User;  
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function login(Request $request)
    {
        $data=request()->validate([
            'usuario'=>'required',
            'contrasena'=>'required'
        ],
        [
            'usuario.required'=>'Ingrese usuario',
            'contrasena.required'=>'Ingrese contraseña',
        ]);
        if(Auth::attempt($data))
        {
            $con='ok';
        }
        $usuario = $request->get('usuario');
        $query= User::where('usuario','=',$usuario)->get();
        if($query->count() !=0)
        {
            $pass=$request->get('contrasena');
            $query = User::where('contrasena','=',$pass)->get();
            if($query->count() !=0 )
            {
                return view('inicio');
            }
            else
            {
                return back()->withErrors(['Contrasena'=>'Contraseña no valida'])->withInput([request('contrasena')]);
            }
        }
        else{
            return back()->withErrors(['usuario'=>'Usuario no valido'])->withInput([request('usuario')]);
        }
        
    }
    public function index()
    {
        $usuarios = \DB::table('usuarios')
            ->select('usuarios.*')
            ->orderBy('id','DESC')->paginate(5);//simplePaginate es para previous y next
        $perfiles = \DB::table('perfil');
            
        return view('usuarios',compact('perfiles'))->with('usuarios',$usuarios, 'perfil',$perfiles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'genero'=>'required',
            'fecha_nacimiento'=>'required',
            'telefono'=>'required',
            'email'=>'required|min:3|email',
            'usuario'=>'required',
            'contrasena'=>'required',
            'perfil'=>'required'
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert','Favor de llenar todos los campos')
            ->withErrors($validator);
        }else{
            $usuario = new User;
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido_paterno = $request->input('apellido_paterno');
            $usuario->apellido_materno = $request->input('apellido_materno');
            $usuario->genero = $request->input('genero');
            $usuario->fecha_nacimiento = $request->input('fecha_nacimiento');
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('email');
            $usuario->usuario = $request->input('usuario');
            $usuario->contrasena = $request->input('contrasena');
            $usuario->perfil = $request->input('perfil');

            $usuario->save();
            return back()->with('Listo','Se ha insertado correctamente');
            }
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/admin/usuarios');
    }

    public function editarUsuario(Request $request)
    {
        $usuario = User::find($request->id);
        $validator = Validator::make($request->all(),[
            'nombre'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'genero'=>'required',
            'fecha_nacimiento'=>'required',
            'telefono'=>'required',
            'email'=>'required|min:3|email',
            'usuario'=>'required',
            'perfil'=>'required'
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert','Favor de llenar todos los campos')
            ->withErrors($validator);
        }else{
            $usuario->nombre = $request->nombre;
            $usuario->apellido_paterno = $request->apellido_paterno;
            $usuario->apellido_materno = $request->apellido_materno;
            $usuario->genero = $request->genero;
            $usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $usuario->telefono = $request->telefono;
            $usuario->email = $request->email;
            $usuario->usuario = $request->usuario;
            $usuario->perfil = $request->perfil;
            $usuario->save();
            return back()->with('Listo','Se ha insertado correctamente');
        }
    }
}