<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//dd($request->segments());

		$arrUrl=$request->segments();

		echo count($arrUrl);

		//return view('welcome');
	}
}
