<?php

namespace App\Http\Controllers\Admin\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\Gate\RoleResource;

class RoleController extends Controller
{
    public function index(Request $req){
      $roles = RoleResource::collection(Role::orderByDesc('id')->get());
      //return $roles;
      return inertia('Admins/Gate/Role', compact('roles'));
    }
    
    public function store(RoleStoreRequest $req){
      Role::create($req->validated());
      return redirect()->route('admin.gate.role.index')->with('toast', [
        'message' => 'Role create successful', 
        'type' => 'success'
      ]);
    }
    
    public function update($id, RoleUpdateRequest $req){
      Role::find($id)->update($req->validated());
      return redirect()->route('admin.gate.role.index')->with('toast', [
        'message' => 'Role update successful', 
        'type' => 'success'
      ]);
    }
    
    public function destroy($id){
      //abort(403);
      //Role::find($id)->delete();
      return redirect()->route('admin.gate.role.index')->with('toast', [
        'message' => 'Role delete successfull', 
        'type' => 'success'
      ]);
    }
}
