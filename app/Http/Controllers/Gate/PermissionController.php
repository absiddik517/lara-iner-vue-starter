<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Requests\Gate\Permission\StoreRequest;
use App\Http\Requests\Gate\Permission\UpdateRequest;
use App\Http\Resources\Gate\PermissionResource;

class PermissionController extends Controller
{
    public function index(){
      $permissions = PermissionResource::collection(Permission::orderByDesc('id')->get());
      return inertia('Gate/Permission', compact('permissions'));
    }
    
    public function store(StoreRequest $req){
      Permission::create($req->validated());
      return redirect()->route('gate.permission.index')->with('toast', [
        'message' => 'Permission create successful', 
        'type' => 'success'
      ]);
    }
    
    public function update($id, UpdateRequest $req){
      Permission::find($id)->update($req->validated());
      return redirect()->route('gate.permission.index')->with('toast', [
        'message' => 'Permission update successful', 
        'type' => 'success'
      ]);
    }
    
    public function destroy($id){
      sleep(2);
      //Permission::find($id)->delete();
      return redirect()->route('gate.permission.index')->with('toast', [
        'message' => 'Permission delete successfull', 
        'type' => 'success'
      ]);
    }
}
