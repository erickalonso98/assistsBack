<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();            

        return response()->json([
            "status" => "success",
            "code"   => 200,
            "users"  => $users
        ],200);
    }

    public function show($id){

        //$user = User::where('id',$id)->first();
        $user = User::find($id);

        if(is_object($user) && !empty($user) && isset($user)){
            $data = [
                "status" => "success",
                "code"   => 200,
                "user"   => $user,
            ];

        }else{
            $data = [
                "status"  => "error",
                "code"    => 400,
                "message" => "no se encontro el usuario"
            ];
        }

        return response()->json($data,$data['code']);
    }

    public function store(Request $request){
       
        $validator = Validator::make($request->all(),[
            "name"     => "required",
            "surnames" => "required",
            "email"    => "required|email",
            "password" => "required"
        ]);

        if($validator->fails()){
            $data = [
                "status"  => "error",
                "code"    => 400,
                "message" => "Llena todos los campos"
            ];
        }else{
            $user = new User();

            $user->name = $request->input("name");
            $user->surnames = $request->input("surnames");
            $user->email = $request->input("email");
            $pwd = Hash::make($request->input("password"));
            $user->password = $pwd;

            $user->save();

            //$roles = Role::find($request->roles);
            $user->roles()->attach($request->roles);

            $token = JWTAuth::fromUser($user);

            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Usuario creado con exito!!",
                "user"    => $user,
                "token"   => $token
             ];
        }

        return response()->json($data,$data['code']);
    }

    public function update(Request $request, $id){
        
    }

    public function login(LoginRequest $request){
        
        $credentials = $request->only('email','password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(["message" => "Error de Autenticacion"],400);
            }
        }catch(JWTException $e){
            return response()->json(["error" => $e->getMessage()],500);
        }

        $identity = auth()->user();

        return response()->json(compact('token','identity'));
    }

    public function destroy($id){
        $user = User::find($id);

        if(is_object($user) && !empty($user) && isset($user)){

            $user->delete();

            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Usuario eliminado",
                "user"    => $user
            ];

        }else{
            $data = [
                "status"  => "error",
                "code"    => 400,
                "message" => "no se encontro el usuario a eliminar"
            ];
        }

        return response()->json($data,$data['code']);
    }

}
