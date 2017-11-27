<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Hashing\BcryptHasher;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function getNews(){
        $news = DB::table('news')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where('approved','=',1)
        ->select('news.*', 'users.name')
        ->get();
        return view('home',['news'=>$news]);
    }
    
    public function getMostNews(){
        $news = DB::table('news')->orderBy('created_at', 'DESC')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where('approved','=',1)
        ->select('news.*', 'users.name')
        ->get();
        return view('home',['news'=>$news]);
    }
    
    public function getMostView(){
        $news = DB::table('news')->orderBy('amount_view','DESC')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where('approved','=',1)
        ->select('news.*', 'users.name')
        ->get();
        return view('home',['news'=>$news]);
	}
}
