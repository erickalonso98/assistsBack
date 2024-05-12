<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\State;

class StateController extends Controller
{
    public function index(){
        $states = State::all();
        return response()->json([
            "status" => "success",
            "states" => $states
        ],200);
    }

    public function show($id){
        $state = State::find($id);

        if(is_object($state) && !empty($state)){
            $data = [
                "status" => "success",
                "code"   => 200,
                "state"  => $state
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "no se encuentra el estado"
            ];
        }

        return response()->json($data,$data['code']);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);

        if($validator->fails()){
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "El campo es obligatorio"
            ];
        }else{
            $state = new State();

            $state->name = $request->name;

            $state->save();

            $data = [
                "status"  => "success",
                "code"    => 201,
                "state"   => $state,
                "message" => "Estado Creado con exito!!"
            ]; 
        }

        return response()->json($data,$data['code']);
    }

    public function destroy($id){
        
        $state = State::where('id',$id)->first();

        if(is_object($state) && !empty($state)){
            
            $state->delete();
            
            $data = [
                "status"  => "success",
                "code"    => 200,
                "message" => "Estado Eliminado con exito!!"
            ];
        }else{
            $data = [
                "status"  => "error",
                "code"    => 404,
                "message" => "no se encuentra el estado"
            ];
        }

       return response()->json($data,$data['code']);
    }

}
