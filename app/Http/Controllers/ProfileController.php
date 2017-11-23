<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getProfile(){
        $user = DB::table('users')->where('id', '=', Auth::user()->id)->first();
        return view('profile.index',['user'=>$user]);
    }

    public function postUpdate(Request $request){
        $this->validate($request, [
			'name_edit' => 'required|max:100|unique:users,name,' . $request->ID_edit . ',id'
		]);
		
		DB::table('users')->where('id', $request->ID_edit)->update([
			'name' => $request->name_edit
		]);
		return redirect('profile');
    }
}
