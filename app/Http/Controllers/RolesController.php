<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
