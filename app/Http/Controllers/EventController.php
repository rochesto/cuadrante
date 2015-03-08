<?php namespace Cuadrante\Http\Controllers;

use Auth;
use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;
use Request;

use Cuadrante\Event;
use Cuadrante\Turno;

class EventController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		

		if (Auth::check())
		{
		    $id = Auth::id();

			$turnos = Turno::where('user_id', '=', 1000)
		    	->orWhere('user_id', '=', $id)
		    	->get(array('id', 'user_id', 'title', 'description', 'horas', 'backgroundColor'));
			$turnos = json_encode($turnos);

			$events = Event::where('user_id', '=', $id)
				->get(array('id', 'title', 'description', 'allDay', 'start', 'end', 'url', 'className', 'color', 'backgroundColor', 'borderColor', 'textColor'));

			$events = json_encode($events);

			return view('index')->with(compact('events'))->with(compact('turnos'));
		}
		else
		{
			return view('auth/login');
		}
		

	}

	/**
	 * Añadir a BD el evento cuando se arrastra
	 *
	 * @return Response
	 */
	public function addEvent()
	{	

		if(Request::ajax()){
        	if($_POST['id'] == 1000){

        		$eventoT = new Event;
        		$eventoM = new Event;
        		$eventoN = new Event;
        		$eventoS = new Event;
        		$eventoL = new Event;
        		$eventoL2 = new Event;

	        	$eventoT->user_id = Auth::id();
	        	$eventoM->user_id = Auth::id();
	        	$eventoN->user_id = Auth::id();
	        	$eventoS->user_id = Auth::id();
	        	$eventoL->user_id = Auth::id();
	        	$eventoL2->user_id = Auth::id();

	        	$eventoT->title = 'Tarde';
	        	$eventoM->title = 'Mañana';
	        	$eventoN->title = 'Noche';
	        	$eventoS->title = 'Saliente';
	        	$eventoL->title = 'Libre';
	        	$eventoL2->title = 'Libre';

	        	$dia = date($_POST['start']);
	        	$eventoT->start = $dia;
	        	$eventoM->start = date('Y-m-d', strtotime($dia."+1 day"));
	        	$eventoN->start = date('Y-m-d', strtotime($dia."+1 day"));
	        	$eventoS->start = date('Y-m-d', strtotime($dia."+2 day"));
	        	$eventoL->start = date('Y-m-d', strtotime($dia."+3 day"));
	        	$eventoL2->start = date('Y-m-d', strtotime($dia."+4 day"));


	        	$eventoT->end = '0000-00-00';
	        	$eventoM->end = '0000-00-00';
	        	$eventoN->end = '0000-00-00';
	        	$eventoS->end = '0000-00-00';
	        	$eventoL->end = '0000-00-00';
	        	$eventoL2->end = '0000-00-00';

	        	$eventoT->className = 'Tarde';
	        	$eventoM->className = 'Mañana';
	        	$eventoN->className = 'Noche';
	        	$eventoS->className = 'Saliente';
	        	$eventoL->className = 'Libre';
	        	$eventoL2->className = 'Libre';

	        	$eventoT->backgroundColor = '#357CA5';
	        	$eventoM->backgroundColor = '#357CA5';
	        	$eventoN->backgroundColor = '#357CA5';
	        	$eventoS->backgroundColor = '#00ffff';
	        	$eventoL->backgroundColor = 'green';
	        	$eventoL2->backgroundColor = 'green';

	        	$eventoT->borderColor = 'black';
	        	$eventoM->borderColor = 'black';
	        	$eventoN->borderColor = 'black';
	        	$eventoS->borderColor = 'black';
	        	$eventoL->borderColor = 'black';
	        	$eventoL2->borderColor = 'black';
	        	
	        	$eventoT->textColor = 'white';
	        	$eventoM->textColor = 'white';
				$eventoN->textColor = 'white';
				$eventoS->textColor = 'white';
				$eventoL->textColor = 'white';
				$eventoL2->textColor = 'white';

	        	if ($eventoT->save()){
	        		if ($eventoM->save()){
	        			if ($eventoN->save()){
	        				if ($eventoS->save()){
	        					if ($eventoL->save()){
	        						if ($eventoL2->save()){
										return 'Oka';
									}
								}
							}
						}
					}
				}
				return 'Error';
        	}elseif($_POST['id'] == 1001){

        		$eventoT = new Event;
        		$eventoM = new Event;
        		$eventoN = new Event;
        		$eventoS = new Event;
        		$eventoL = new Event;

	        	$eventoT->user_id = Auth::id();
	        	$eventoM->user_id = Auth::id();
	        	$eventoN->user_id = Auth::id();
	        	$eventoS->user_id = Auth::id();
	        	$eventoL->user_id = Auth::id();

	        	$eventoT->title = 'Tarde';
	        	$eventoM->title = 'Mañana';
	        	$eventoN->title = 'Noche';
	        	$eventoS->title = 'Saliente';
	        	$eventoL->title = 'Libre';

	        	$dia = date($_POST['start']);
	        	$eventoM->start = $dia;
	        	$eventoT->start = date('Y-m-d', strtotime($dia."+1 day"));
	        	$eventoN->start = date('Y-m-d', strtotime($dia."+2 day"));
	        	$eventoS->start = date('Y-m-d', strtotime($dia."+3 day"));
	        	$eventoL->start = date('Y-m-d', strtotime($dia."+4 day"));


	        	$eventoT->end = '0000-00-00';
	        	$eventoM->end = '0000-00-00';
	        	$eventoN->end = '0000-00-00';
	        	$eventoS->end = '0000-00-00';
	        	$eventoL->end = '0000-00-00';

	        	$eventoT->className = 'Tarde';
	        	$eventoM->className = 'Mañana';
	        	$eventoN->className = 'Noche';
	        	$eventoS->className = 'Saliente';
	        	$eventoL->className = 'Libre';

	        	$eventoT->backgroundColor = '#357CA5';
	        	$eventoM->backgroundColor = '#357CA5';
	        	$eventoN->backgroundColor = '#357CA5';
	        	$eventoS->backgroundColor = '#00ffff';
	        	$eventoL->backgroundColor = 'green';

	        	$eventoT->borderColor = 'black';
	        	$eventoM->borderColor = 'black';
	        	$eventoN->borderColor = 'black';
	        	$eventoS->borderColor = 'black';
	        	$eventoL->borderColor = 'black';
	        	
	        	$eventoT->textColor = 'white';
	        	$eventoM->textColor = 'white';
				$eventoN->textColor = 'white';
				$eventoS->textColor = 'white';
				$eventoL->textColor = 'white';

	        	if ($eventoT->save()){
	        		if ($eventoM->save()){
	        			if ($eventoN->save()){
	        				if ($eventoS->save()){
	        					if ($eventoL->save()){
									return 'Oka';
								}
							}
						}
					}
				}
				return 'Error';
        	}elseif($_POST['id'] == 1002){

        		$eventoT = new Event;
        		$eventoT2 = new Event;
        		$eventoM = new Event;
        		$eventoM2 = new Event;
        		$eventoN = new Event;
        		$eventoN2 = new Event;
        		$eventoS = new Event;
        		$eventoL = new Event;
        		$eventoL2 = new Event;

	        	$eventoT->user_id = Auth::id();
	        	$eventoT2->user_id = Auth::id();
	        	$eventoM->user_id = Auth::id();
	        	$eventoM2->user_id = Auth::id();
	        	$eventoN->user_id = Auth::id();
	        	$eventoN2->user_id = Auth::id();
	        	$eventoS->user_id = Auth::id();
	        	$eventoL->user_id = Auth::id();
	        	$eventoL2->user_id = Auth::id();

	        	$eventoT->title = 'Tarde';
	        	$eventoT2->title = 'Tarde';
	        	$eventoM->title = 'Mañana';
	        	$eventoM2->title = 'Mañana';
	        	$eventoN->title = 'Noche';
	        	$eventoN2->title = 'Noche';
	        	$eventoS->title = 'Saliente';
	        	$eventoL->title = 'Libre';
	        	$eventoL2->title = 'Libre';

	        	$dia = date($_POST['start']);
	        	$eventoM->start = $dia;
	        	$eventoM2->start = date('Y-m-d', strtotime($dia."+1 day"));
	        	$eventoT->start = date('Y-m-d', strtotime($dia."+2 day"));
	        	$eventoT2->start = date('Y-m-d', strtotime($dia."+3 day"));
	        	$eventoN->start = date('Y-m-d', strtotime($dia."+4 day"));
	        	$eventoN2->start = date('Y-m-d', strtotime($dia."+5 day"));
	        	$eventoS->start = date('Y-m-d', strtotime($dia."+6 day"));
	        	$eventoL->start = date('Y-m-d', strtotime($dia."+7 day"));
	        	$eventoL2->start = date('Y-m-d', strtotime($dia."+8 day"));


	        	$eventoT->end = '0000-00-00';
	        	$eventoT2->end = '0000-00-00';
	        	$eventoM->end = '0000-00-00';
	        	$eventoM2->end = '0000-00-00';
	        	$eventoN->end = '0000-00-00';
	        	$eventoN2->end = '0000-00-00';
	        	$eventoS->end = '0000-00-00';
	        	$eventoL->end = '0000-00-00';
	        	$eventoL2->end = '0000-00-00';

	        	$eventoT->className = 'Tarde';
	        	$eventoT2->className = 'Tarde';
	        	$eventoM->className = 'Mañana';
	        	$eventoM2->className = 'Mañana';
	        	$eventoN->className = 'Noche';
	        	$eventoN2->className = 'Noche';
	        	$eventoS->className = 'Saliente';
	        	$eventoL->className = 'Libre';
	        	$eventoL2->className = 'Libre';

	        	$eventoT->backgroundColor = '#357CA5';
	        	$eventoT2->backgroundColor = '#357CA5';
	        	$eventoM->backgroundColor = '#357CA5';
	        	$eventoM2->backgroundColor = '#357CA5';
	        	$eventoN->backgroundColor = '#357CA5';
	        	$eventoN2->backgroundColor = '#357CA5';
	        	$eventoS->backgroundColor = '#00ffff';
	        	$eventoL->backgroundColor = 'green';
	        	$eventoL2->backgroundColor = 'green';

	        	$eventoT->borderColor = 'black';
	        	$eventoT2->borderColor = 'black';
	        	$eventoM->borderColor = 'black';
	        	$eventoM2->borderColor = 'black';
	        	$eventoN->borderColor = 'black';
	        	$eventoN2->borderColor = 'black';
	        	$eventoS->borderColor = 'black';
	        	$eventoL->borderColor = 'black';
	        	$eventoL2->borderColor = 'black';
	        	
	        	$eventoT->textColor = 'white';
	        	$eventoT2->textColor = 'white';
	        	$eventoM->textColor = 'white';
	        	$eventoM2->textColor = 'white';
				$eventoN->textColor = 'white';
				$eventoN2->textColor = 'white';
				$eventoS->textColor = 'white';
				$eventoL->textColor = 'white';
				$eventoL2->textColor = 'white';

	        	if ($eventoT->save()){
	        		if ($eventoT2->save()){
	        			if ($eventoM->save()){
	        				if ($eventoM2->save()){
	        					if ($eventoN->save()){
	        						if ($eventoN2->save()){
	        							if ($eventoS->save()){
	        								if ($eventoL->save()){
	        									if ($eventoL2->save()){
													return 'Oka';
												}
											}
										}
									}
								}
							}
						}
					}
				}
				return 'Error';
        	}
        	else{

        		$evento = new Event;

	        	$evento->user_id = Auth::id();
	        	$evento->title = $_POST['title'];
	        	$evento->description = '';
	        	$evento->allDay = true;
	        	$evento->start = $_POST['start'];
	        	$evento->end = '0000-00-00';
	        	$evento->url = '';
	        	$evento->className = $_POST['title'];
	        	$evento->backgroundColor = $_POST['backgroundColor'];
	        	$evento->borderColor = 'black';
	        	$evento->textColor = 'white';

	        	if ($evento->save()){
					return 'Ok';
				}
				return 'Error';
	        }
        	
        }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroyEvent()
	{
		if(Request::ajax()){

			$evento = Event::find($_POST['id']);
			if ($evento){
				if($evento->delete()){
					return 'Ok';
				}
			}
			return 'Error';

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	*/
	public function updateEvent()
	{
		if(Request::ajax()){

			if ($evento = Event::find($_POST['id'])){

				if($evento->start = $_POST['start']){
					if($evento->save()){

						return 'Ok';
					}
				}
			}
			return 'Error';
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	*/
	public function editEvent()
	{
		if(Request::ajax()){

			if ($evento = Event::find($_POST['id'])){
				
				$evento->title = $_POST['title'];
        		$evento->backgroundColor = $_POST['backgroundColor'];

        		if ($evento->save()) {
        			return 'Ok';
        		}

			}
			return 'Error';
		}
	}

}