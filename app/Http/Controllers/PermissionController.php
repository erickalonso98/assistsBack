<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return response()->json(["permissions" => $permissions],200);
    }

    public function show($id){
        $permission = Permission::where('id',$id)->first();

        if(is_object($permission) && !empty($permission) && isset($permission)){
            $data = [
                "status"     => "success",
                "code"       => 200,
                "permission" => $permission
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "No se encuentra ningun permiso"
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
                "code"    => 500,
                "message" => "El permiso es requerido"
            ];
        }else{
            $permission = new Permission();

            $permission->name = $request->name;

            $permission->save();

            $data = [
                "status"     => "success",
                "code"       => 200,
                "message"    => "Permiso creado con exito!!",
                "permission" => $permission
            ];
        }

        return response()->json($data,$data["code"]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);

        if($validator->fails()){
            $data = [
                "status"  => "error",
                "code"    => 500,
                "message" => "El permiso es requerido"
            ];
        }else{
            
            $params = [
                "name" => $request->name
            ];

            $permission = Permission::where('id',$id)->update($params);

            $data = [
                "status"     => "success",
                "code"       => 200,
                "message"    => "Permiso actualizado con exito!!",
                "permission" => $permission,
                "changes"    => $params
            ]; 
        }

        return response()->json($data,$data["code"]);
    }

    public function destroy($id){
        $permission = Permission::where('id',$id)->first();

        if(is_object($permission) && !empty($permission) && isset($permission)){

            $permission->delete();

            $data = [
                "status"     => "success",
                "code"       => 200,
                "message"    => "Permiso eliminado con exito!!",
                "permission" => $permission
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "No se encuentra ningun permiso"
            ];
        }

        return response()->json($data,$data["code"]);
    }
}
