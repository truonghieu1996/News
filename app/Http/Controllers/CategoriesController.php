<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAdd(Request $request)
    {
		 $this->validate($request, [
             'name' => 'required|string|max:100|unique:categories'
         ]);
		
		DB::table('categories')->insert([
			'name' => $request->name,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
		
		return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Postupdate(Request $request)
    {
        $this->validate($request, [
			'name_edit' => 'required|max:255|unique:categories,name,' . $request->ID_edit . ',id'
		]);
		
		DB::table('categories')->where('id', $request->ID_edit)->update([
			'name' => $request->name_edit
		]);
		return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete(Request $request)
    {
        DB::table('categories')->where('id', '=', $request->ID_delete)->delete();
		return redirect('categories');
    }
}
