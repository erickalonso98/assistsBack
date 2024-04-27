<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::all();

        return response()->json([
            "status" => "success",
            "roles"  => $roles
        ],200);
    }

    public function show($id){
        $role = Role::find($id);

        if(is_object($role) && !empty($role) && isset($role)){
            $data = [
                "status"  => "success",
                "code"    => 200,
                "role"    => $role
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "No se encuentra el rol"
            ];
        }

        return response()->json($data,$data["code"]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);

        if($validator->fails()){
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "El rol es requerido"
            ];
        }else{
            $role = new Role();

            $role->name = $request->name;
            $role->permissions()->attach($request->permissions);

            $role->save();

            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Rol creado con exito!!",
                "role"    => $role
            ];
        }

        return response()->json($data,$data["code"]);
    }

    public function update(Request $request,$id){
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);

        if($validator->fails()){
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "El nombre del rol es requerido"
            ];
        }else{

            $role->name = $request->name;

            $role->save();

            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Rol actualizado con exito!!",
                "role"    => $role
            ];            
        }

        return response()->json($data,$data["code"]);
    }

    public function destroy($id){
        $role = Role::find($id);

        if(is_object($role) && !empty($role) && isset($role)){

            $role->delete();

            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Rol eliminado",
                "role"    => $role
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "No se encuentra el rol"
            ];
        }

        return response()->json($data,$data["code"]);
    }
}
