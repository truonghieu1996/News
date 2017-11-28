<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getNews(){
        $news = DB::table('news')
        ->join('categories', 'categories.id', '=', 'news.category_id')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->select('news.*', 'categories.name_category', 'users.name')
        ->orderBy('news.created_at', 'asc')->get();
        return view('news.index',['news'=>$news]);
    }

    public function getMyNews(){
        $categories = DB::table('categories')->get();
        $mynews = DB::table('news')
        ->join('categories', 'categories.id', '=', 'news.category_id')
        ->select('news.*', 'categories.name_category')
        ->orderBy('news.created_at', 'asc')
        ->where('user_id', '=', Auth::user()->id)->get();
        return view('news.mynews',['mynews' => $mynews, 'categories' => $categories]);
    }

    public function postAdd(Request $request){
		$this->validate($request, [
            'title' => 'required|max:225',
			'category_id' => 'required',
			'summary' => 'required',
			'content' => 'required',
        ]);
		
		if(Auth::user()->role == 1)
			$approved = 1;
		else
			$approved = 0;
		
		DB::table('news')->insert([
			'category_id' => $request->category_id,
			'user_id' => Auth::user()->id,
			'title' => $request->title,
			'summary' => $request->summary,
			'content' => $request->content,
			'amount_view' => 0,
			'approved' => $approved,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
		
		return redirect('news/mynews')->with("success", "Đăng bài viết thành công!");
    }

    public function postUpdate(Request $request){
        $this->validate($request, [
            'title_edit' => 'required|max:225',
			'category_id_edit' => 'required',
			'summary_edit' => 'required',
			'content_edit' => 'required',
        ]);

		DB::table('news')->where('id', $request->ID_edit)->update([
			'category_id' => $request->category_id_edit,
			'user_id' => Auth::user()->id,
			'title' => $request->title_edit,
			'summary' => $request->summary_edit,
			'content' => $request->content_edit,
			'updated_at' => Carbon::now()
		]);
		
		return redirect('news/mynews')->with("success", "Cập nhật bài viết thành công!");
    }

    public function getDeleteMyNew(Request $request){
        DB::table('news')->where('id', '=', $request->ID_delete)->delete();
		return redirect('news/mynews');
    }

    public function getApproved($id, $status)
	{
		DB::table('news')->where('id', $id)->update([
			'approved' => $status
		]);
		
		// if($status == 1)
		// {
		// 	$nd_bv = DB::table('users as u')
		// 			->join('baiviet as b', 'u.id', '=', 'b.id_user')
		// 			->where('b.id', '=', $id)
		// 			->select('b.tieu_de', 'u.email', 'u.name')->first();
			// $data = [
			// 	'name' => $nd_bv->name,
			// 	'email' => $nd_bv->email,
			// 	'tieu_de' => $nd_bv->tieu_de
			// ];
			
			// Mail::send('emails.duyetbaiviet', $data, function($msg) use ($data){
			// 	$msg->from('inews.agu@gmail.com', 'Ban quản trị iNews');
			// 	$msg->subject('Bài viết đã duyệt');
			// 	$msg->to($data['email'], $data['name']);
			// });
		//}
		return redirect('news');
	}
	public function getDetail($id, $amount, $user_id){
		$amount++;
		$new = DB::table('news')->where('id','=', $id)->first();
		if(Auth::user()->id != $user_id){
			DB::table('news')->where('id', $id)->update([
				'amount_view' => $amount
			]);
		}
		return view('news/detail',['new'=>$new]);
	}

	public function getDeleteNew(Request $request){
		DB::table('news')->where('id', '=', $request->ID_delete)->delete();
		return redirect('news');
	}
}
