<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers(){
        $users = DB::table('users')->get();
        return view('users.index',['users' => $users]);
    }

    public function postUpdate(Request $request){
		DB::table('users')->where('id', $request->ID_edit)->update([
            'role' => $request->role_edit
		]);
		return redirect('users');
    }

    public function getDelete(Request $request){
        DB::table('users')->where('id', '=', $request->ID_delete)->delete();
		return redirect('users');
    }
}
