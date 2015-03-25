<?php namespace Cuadrante\Http\Controllers;

use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;

use Illuminate\Http\Request;

class IntroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('intro');	
	}


}
