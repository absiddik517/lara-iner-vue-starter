<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admins/Dashboard');
    }
    
    public function table(Request $req)
    {
      $params = [
        'search' => $req->input('search') ?? '',
        'itemPerPage' => $req->input('itemPerPage') ?? 10,
      ];
      $users = User::query()->orderByDesc('id')
          ->when($req->input('search'), function($query, $search){
            $query->where('name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%');
          })
          ->paginate($params['itemPerPage'])->withQueryString();
      //return $users;
      //dd($users);
      return inertia('Admins/Table', compact('users', 'params'));
    }
    
}

