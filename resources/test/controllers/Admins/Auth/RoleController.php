<?php

namespace {{! namespace controller !}};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth/Name;
use App\Http\Requests\Admins\Auth\Role\StoreRequest;
use App\Http\Requests\Admins\Auth\Role\UpdateRequest;
use App\Http\Resources\Admins\Auth\RoleResource;

class RoleController extends Controller
{
    public function index(){
      $roles = RoleResource::collection(Name::orderByDesc('id')->get());
      return inertia('{{! Inertia/Page !}}', compact('roles'));
    }
    
    public function store(CreateRequest $req){
      Name::create($req->validated());
      return redirect()->route('auth.role.index')->with('toast', [
        'message' => 'Role create successful', 
        'type' => 'success'
      ]);
    }
    
    public function update($id, UpdateRequest $req){
      Name::find($id)->update($req->validated());
      return redirect()->route('auth.role.index')->with('toast', [
        'message' => 'Role update successful', 
        'type' => 'success'
      ]);
    }
    
    public function destroy($id){
      Name::find($id)->delete();
      return redirect()->route('auth.role.index')->with('toast', [
        'message' => 'Role delete successfull', 
        'type' => 'success'
      ]);
    }
}
