<?php namespace Cuadrante\Http\Controllers;

use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Cuadrante\Noticia;
use Cuadrante\Comment;

class IntroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$noticias = Noticia::orderBy('created_at', 'desc')->get();
			// ->simplePaginate(5);

		$comentarios = Comment::orderBy('created_at', 'desc')
			->simplePaginate(5);

		return view('intro')->with(compact('noticias'))->with(compact('comentarios'));
	}


}
