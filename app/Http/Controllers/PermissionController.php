<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\RouteModel;

class PermissionController extends Controller
{
    public function index(){
        $routes = RouteModel::get();
        $permission = Permission::get();
        return view('backend.permission', compact('permission'));
    }

    public function create(){
    }

    public function store(Request $request){
        Permission::create(['name'=> $request->name]);
        return view('backend.permission');

    }
    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
