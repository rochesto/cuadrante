<?php namespace Cuadrante\Http\Controllers;

use Auth;
use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;

use Request;

use Cuadrante\Turno;

class TurnosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function addTurno()
	{
		if(Request::ajax()){
    	
      	$turno = new Turno;

      	$turno->user_id = Auth::id();
      	$turno->title = $_POST['title'];
      	
      	$turno->horas = $_POST['horas'];
      	$turno->backgroundColor = $_POST['backgroundColor'];
      	$turno->borderColor = 'black';
      	$turno->textColor = 'white';

      	if ($turno->save()){
			return 'Ok';
		}
			return 'Error';
    	}

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function removeTurno()
	{

		if(Request::ajax()){

			$turno = Turno::find($_POST['id']);
			if ($turno){
				if($turno->delete()){
					return 'Ok';
				}
			}
			return 'Error';
    	}

	}

}
