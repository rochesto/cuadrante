<?php namespace Cuadrante\Http\Controllers;

use Auth;
use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;
use Request;

use Cuadrante\Event;
use Cuadrante\Turno;
use Carbon\Carbon;

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
			$events = $this::allEvents();
 			$turnos = $this::allTurnos();
 			$horas = $this::getHoursMoth(3, 2015);

			return view('index')->with(compact('events'))->with(compact('turnos'))->with(compact('horas'));
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
        	if($_POST['id'] == 10){

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

	        	$eventoT->turno_id = '1';
	        	$eventoM->turno_id = '2';
	        	$eventoN->turno_id = '3';
	        	$eventoS->turno_id = '4';
	        	$eventoL->turno_id = '5';
	        	$eventoL2->turno_id = '5';

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
        	}elseif($_POST['id'] == 11){

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

	        	$eventoT->turno_id = '1';
	        	$eventoM->turno_id = '2';
	        	$eventoN->turno_id = '3';
	        	$eventoS->turno_id = '4';
	        	$eventoL->turno_id = '5';


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
        	
        	}
        	else{

        		$evento = new Event;

	        	$evento->user_id = Auth::id();
	        	$evento->turno_id = $_POST['id'];
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	*/

	public function allTurnos(){

		$id = Auth::id();

		$turnos = Turno::where('user_id', '=', 10)
		    	->orWhere('user_id', '=', $id)
		    	->get(array('id', 'user_id', 'title', 'description', 'horas', 'backgroundColor'));
		$turnos = json_encode($turnos);

		return $turnos;
	}

	/**
	 * 
	 *
	 * @return 
	*/

	public function allEvents(){

		$id = Auth::id();

		$events = Event::where('user_id', '=', $id)
				->get(array('id', 'turno_id', 'title', 'description', 'allDay', 'start', 'end', 'url', 'className', 'color', 'backgroundColor', 'borderColor', 'textColor'));

		$events = json_encode($events);

		return $events;
	}


	/**
	 * Obtener las horas entre dos fechas
	 * @param start
	 * @param  end
	 *
	 * @return Response
	*/

	public function getHoursWeek($start, $end)
	{	
		
		$total = 0.0;

		$events = Event::where('start', '>=', $start)
			->Where('start', '<', $end)
			->get(array('turno_id', 'start'));
		foreach ($events as $key => $value) {
			if($value['turno_id'] != 3){
				$horas = Turno::find($value['turno_id'], array('horas'));
	    		$horas = floatval($horas['horas']);
	    		$total = $total + $horas;
			}elseif ($value['turno_id'] == 3) {
				if($end == $value['start']){
					$total = $total + 2.0;
				}else{
					$horas = Turno::find($value['turno_id'], array('horas'));
	    			$horas = floatval($horas['horas']);
	    			$total = $total + $horas;
				}
			}
		}
		return $total;
	}
	/**
	 * Obtener las horas entre dos fechas
	 * @param month
	 * 		obtenidos por post
	 *
	 * @return Response
	*/

	public function getHoursMoth($month, $year)
	{
		$jueves = "";
		$lastDayMonth = "";
		$dia = $year.'-'.$month.'-01';

		$numeroSemanas = 0;
		$primeraSemana = 0;
		$semana1 = "";
		$semana2 = "";
		$semana3 = "";
		$semana4 = "";
		$semana5 = "";
		$semana6 = "";
		$semana7 = "";
		$totalHoras = 0;

		/*
		//Comprobar las semanas del mes y los dias de cada semana
		*/
	
		$semana1 = new Carbon($dia);
		$semana1 = $semana1->modify('Last Monday');


		// Primer jueves del mes
		$jueves = new Carbon($dia);
		if($jueves->format('l') != 'Thursday'){
			$jueves = $jueves->modify('Next	 Thursday');
		}

		$semana2 =  new Carbon($semana1);
		$semana2 = $semana2->modify('Next Monday');

		$semana3 =  new Carbon($semana2);
		$semana3 = $semana3->modify('Next Monday');

		$semana4 =  new Carbon($semana3);
		$semana4 = $semana4->modify('Next Monday');

		$semana5 =  new Carbon($semana4);
		$semana5 = $semana5->modify('Next Monday');
		$semana5 = $semana5->modify('Next Thursday');

		if ($semana5->month == $month) {
			$numeroSemanas = 5;
		}else{
			$numeroSemanas = 4;
		}

		$semana5 = $semana5->modify('Last Monday');

		$semana6 =  new Carbon($semana5);
		$semana6 = $semana6->modify('Next Monday');

		$semana7 =  new Carbon($semana6);
		$semana7 = $semana7->modify('Next Monday');

		/*
		// Creamos variable con numero de horas por semana
		 */
		if ($jueves->day <= 4) {
			$primerdia = new Carbon($semana1);
			$primeraSemana = 1;
		}else{
			$primerdia = new Carbon($semana2);
			$primeraSemana = 2;
		}

		if ($numeroSemanas == 5) {
			$ultimodia = new Carbon($semana5);
			$ultimodia = $ultimodia->modify('Next Monday');
		}else{
			$ultimodia = new Carbon($semana5);
		}
		
		$totalHoras = $this::getHoursWeek($primerdia, $ultimodia);

		$semana1 = $this::getHoursWeek($semana1, $semana2);
		$semana2 = $this::getHoursWeek($semana2, $semana3);
		$semana3 = $this::getHoursWeek($semana3, $semana4);
		$semana4 = $this::getHoursWeek($semana4, $semana5);
		$semana5 = $this::getHoursWeek($semana5, $semana6);
		$semana6 = $this::getHoursWeek($semana6, $semana7);

		$semanas = array('semana1' => $semana1, 'semana2' => $semana2, 'semana3' => $semana3, 'semana4' => $semana4, 'semana5' => $semana5, 'semana6' => $semana6,  'semana' => $totalHoras, 'primeraSemana' => $primeraSemana, 'numeroSemanas' => $numeroSemanas);

		return json_encode($semanas);

	}

}