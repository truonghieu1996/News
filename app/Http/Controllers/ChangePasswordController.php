<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Hashing\BcryptHasher;
use Carbon\Carbon;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getChangePassword()
	{
		return view('auth.changepassword');
	}
	
	public function postChangepassword(Request $request)
	{
		$this->validate($request, [
			'old_password' => 'required|max:255',
            'new_password' => 'required|min:6|confirmed'
		]);
		
		$users = DB::table('users')->where('id', '=', Auth::user()->id)->first();
		$hash = new BcryptHasher();
		if($hash->check($request->old_password, $users->password))
		{
			DB::table('users')->where('id', Auth::user()->id)->update([
				'password' => bcrypt($request->new_password),
				'updated_at' => Carbon::now()
			]);
			return redirect('/changepassword')->with('success', 'Đổi mật khẩu thành công!');
		}
		else
			return redirect('/changepassword')->with('warning', 'Mật khẩu cũ không chính xác!');
	}
}
