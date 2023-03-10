<?php

namespace App\Http\Controllers\Admin\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\Gate\PermissionResources;

class PermissionController extends Controller
{
  public function index(){
    //return 'hello';
    $permissions = PermissionResources::collection(Permission::orderByDesc('id')->get());
    //return $permissions;
    //return $roles;
    return inertia('Admins/Gate/Permission', compact('permissions'));
  }
  
  
    public function store(RoleStoreRequest $req){
      Role::create($req->validated());
      return redirect()->route('admin.gate.permission.index')->with('toast', [
        'message' => 'Permission create successful', 
        'type' => 'success'
      ]);
    }
    
    public function destroy($id){
      //abort(403);
      Role::find($id)->delete();
      return redirect()->route('admin.gate.permission.index')->with('toast', [
        'message' => 'Permission delete successfull', 
        'type' => 'success'
      ]);
    }
    
    public function update($id, RoleUpdateRequest $req){
      Role::find($id)->update($req->validated());
      return redirect()->route('admin.gate.permission.index')->with('toast', [
        'message' => 'Permission update successful', 
        'type' => 'success'
      ]);
    }
    
}
