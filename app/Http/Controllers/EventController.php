<?php namespace Cuadrante\Http\Controllers;

use Auth;
use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;
use Request;

use Cuadrante\Event;
use Cuadrante\Turno;
use Cuadrante\UserProfile;
use Carbon\Carbon;

class EventController extends Controller {

	private $countDays = 0;

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

			$perfil = UserProfile::where('user_id', "=", $id)->get();
			
			/*COmprobamos si existe el perfil y lo creamos*/
			if ($perfil->isEmpty()) {

				$newperfil = new UserProfile;

				$newperfil->user_id = $id;
				$newperfil->asuntos_propios = 5;
				$newperfil->baja = 0;
				$newperfil->vacaciones = 0;
				$newperfil->permiso_urgente = 0;
				$newperfil->indisposicion = 0;
				$newperfil->examen = 0;
	        	$newperfil->horas_semanales = 37.5;
				$newperfil->save();

			}

			$events = $this::allEvents();
 			$turnos = $this::allTurnos();
 			$perfil = $this::getHoursWeekProflie();
 			$horas = $this::getHoursMoth(Request::input('month'), Request::input('year'), $id);

			return view('index')->with(compact('events'))->with(compact('turnos'))->with(compact('horas'))->with('mes', Request::input('month'))->with('year', Request::input('year'))->with('horasProfile', $perfil);
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
        	if($_POST['id'] == 20){

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

        	}elseif($_POST['id'] == 21){

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
	        	$eventoN->start = date('Y-m-d', strtotime($dia."+2 day"));
	        	$eventoS->start = date('Y-m-d', strtotime($dia."+3 day"));
	        	$eventoL->start = date('Y-m-d', strtotime($dia."+4 day"));
	        	$eventoL2->start = date('Y-m-d', strtotime($dia."+5 day"));


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
        	
        	}
        	else{

        		$end = new Carbon($_POST['end']);

        		$evento = new Event;

	        	$evento->user_id = Auth::id();
	        	$evento->turno_id = $_POST['id'];
	        	$evento->title = $_POST['title'];
	        	$evento->description = '';
	        	$evento->allDay = true;
	        	$evento->start = $_POST['start'];
	        	$evento->end = $end;
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
					if($evento->end = $_POST['end']){
						if($evento->save()){
							return 'Ok';
						}
					}
				}
			}
			return 'Error';
		}
		return 'Error';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	*/
	public function resizeEvent()
	{
		if(Request::ajax()){

			if ($evento = Event::find($_POST['id'])){
				
				if($evento->start = $_POST['start']){
					if($evento->end = $_POST['end']){
						if($evento->save()){
							return 'Ok';
						}
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
	 * 
	 *
	 * @return 
	*/

	public function getHoursWeekProflie(){

		$id = Auth::id();

		$perfil = UserProfile::where('user_id', '=', $id)
				->get(array('horas_semanales'));

		return $perfil;
	}


	/**
	 * Calculamos horas por turno
	 *
	 * @return 
	*/

	public function getHoursTurno($idTurno, $domingo = false){

		if($idTurno == 3){
			if($domingo){
				return 2;
			}else{
				return 8;
			}
		}elseif ($idTurno <= 2) {
			$horas = Turno::find($idTurno, array('horas'));
			$horas = floatval($horas['horas']);
			return $horas;
		}elseif ($idTurno > 5 && $idTurno <= 10) {
			$this->countDays = $this->countDays + 1;
			if($this::getHoursWeekProflie()[0]['horas_semanales'] == 40){
				return 8;
			}else{
				return 7.5;
			}
		}
		
		$horas = Turno::find($idTurno, array('horas'));
		$horas = floatval($horas['horas']);
		return $horas;	
		
	}


	/**
	 * Obtener las horas entre dos fechas
	 * @param start
	 * @param  end
	 *
	 * @return Response
	*/

	public function getHoursWeek($start, $end, $id)
	{	
		
		$total = 0.0;
		$mesAntes =  new Carbon($start);
		$mesAntes = $mesAntes->subMonth();
		$mesPost =  new Carbon($start);
		$mesPost = $mesPost->addMonth();
		$start = new Carbon($start);
		$end = new Carbon($end);

		$events = Event::where('user_id', '=', $id)
			->Where('start', '>=', $mesAntes)
			->Where('start', '<', $mesPost)
			->get(array('turno_id', 'start', 'end'));

		foreach ($events as $key => $value) {
			$startEvent = new Carbon($value['start']);
			$endEvent = new Carbon($value['end']);


			// COmprobamos si la semana anterior hay noche en el domingo y sumamos 6 horas en caso afirmativo
			$domingoAnterior = new Carbon($start);
			$domingoAnterior = $domingoAnterior->subDay();

			if($value['turno_id'] == 3 && ($startEvent == $domingoAnterior || ($endEvent > $domingoAnterior && $startEvent <= $domingoAnterior))){
				$total = $total + 6;
			}

			// Comprobamos si el evento avarca un solo dia
			if(($value['end'] == '0000-00-00 00:00:00') || $endEvent->diffInDays($startEvent) < 2){

				if($startEvent->gte($start) && $startEvent->lt($end)){
					if($startEvent->dayOfWeek == 0){
						$total = $total + $this::getHoursTurno($value['turno_id'], true);
					}else{
						$total = $total + $this::getHoursTurno($value['turno_id']);
					}
				}

			}
			// Comprobamos si termina y empieza dentro de la semana
			if (($startEvent >= $start) && ($endEvent <= $end)) {

				if($value['turno_id'] == 3){
					$var = ($endEvent->diffInDays($startEvent) * 8);
					$total = $total + $var;

					if($endEvent->eq($end)){
						$total = $total - 6;
					}
				}
				elseif ($value['turno_id'] == 5 || $value['turno_id'] == 4) {
					$total = $total;
				}elseif ($value['turno_id'] <= 2) {
					$total = $total + $this::getHoursTurno($value['turno_id']) * $endEvent->diffInDays($startEvent);
				}elseif ($value['turno_id'] > 5 && $value['turno_id'] <= 10) {
					$this->countDays = $this->countDays + ($endEvent->diffInDays($startEvent));
					if($this::getHoursWeekProflie()[0]['horas_semanales'] == 40){
						$var = ($endEvent->diffInDays($startEvent) * 8);
						$total = $total + $var;
					}else{
						$var = ($endEvent->diffInDays($startEvent) * 7.5);
						$total = $total + $var;
					}
				}elseif ($value['turno_id'] > 10){
					$total = $total + $this::getHoursTurno($value['turno_id']) * $endEvent->diffInDays($startEvent);
				}
			}

			// Comprobamos si empieza y termina fuera de la semana
			elseif (($endEvent >= $end) && ($startEvent <= $start)) {
				if($value['turno_id'] == 3){
					$var = (7 * 8) - 6;
					$total = $total + $var;
				}elseif ($value['turno_id'] <= 2) {
					$total = $total + $this::getHoursTurno($value['turno_id']) * 7;
				}elseif ($value['turno_id'] > 5 && $value['turno_id'] <= 10) {
					return $this::getHoursWeekProflie()[0]['horas_semanales'];
				}else{
					$total = $total + $this::getHoursTurno($value['turno_id']) * 7;
				}
			}

			// Comprobamos si empieza en la misma semana y acaba en la siguiente
			elseif (($startEvent >= $start) && ($endEvent > $end)) {

				if($startEvent < $end){
					if($value['turno_id'] == 3){
						$var = ($end->diffInDays($startEvent) * 8);
						$total = $total + $var;

						if($endEvent->eq($end)){
							$total = $total - 6;
						}
					}
					elseif ($value['turno_id'] == 5 || $value['turno_id'] == 4) {
						$total = $total;
					}elseif ($value['turno_id'] <= 2) {
						$total = $total + $this::getHoursTurno($value['turno_id']) * $end->diffInDays($startEvent);
					}elseif ($value['turno_id'] > 5 && $value['turno_id'] <= 10) {
						$this->countDays = $this->countDays + ($end->diffInDays($startEvent));
						if($this::getHoursWeekProflie()[0]['horas_semanales'] == 40){
							$var = ($end->diffInDays($startEvent) * 8);
							$total = $total + $var;
						}else{
							$var = ($end->diffInDays($startEvent) * 7.5);
							$total = $total + $var;
						}
					}elseif ($value['turno_id'] > 10){
						$total = $total + $this::getHoursTurno($value['turno_id']) * $end->diffInDays($startEvent);
					}
				}
			}
			// COmprobamos si empieza en la semana anterior y acaba en la misma
			elseif (($startEvent < $start) && ($endEvent < $end)) {

				if($endEvent > $start){
					if($value['turno_id'] == 3){
						$var = ($endEvent->diffInDays($start) * 8);
						$total = $total + $var;

						if($endEvent->eq($end)){
							$total = $total - 6;
						}
					}
					elseif ($value['turno_id'] == 5 || $value['turno_id'] == 4) {
						$total = $total;
					}elseif ($value['turno_id'] <= 2) {
						$total = $total + $this::getHoursTurno($value['turno_id']) * $endEvent->diffInDays($start);
					}elseif ($value['turno_id'] > 5 && $value['turno_id'] <= 10) {
						$this->countDays = $this->countDays + ($endEvent->diffInDays($start));
						if($this::getHoursWeekProflie()[0]['horas_semanales'] == 40){
							$var = ($endEvent->diffInDays($start) * 8);
							$total = $total + $var;
						}else{
							$var = ($endEvent->diffInDays($start) * 7.5);
							$total = $total + $var;
						}
					}elseif ($value['turno_id'] > 10){
						$total = $total + $this::getHoursTurno($value['turno_id']) * $endEvent->diffInDays($start);
					}
				}
			}

		}

		if ($this->countDays >= 6){
			return $this::getHoursWeekProflie()[0]['horas_semanales'];
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

	public function getHoursMoth($month, $year, $id)
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
		if($semana1->dayOfWeek != 1){
			$semana1 = $semana1->modify('Last Monday');
		}
		
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

		$semana6 =  new Carbon($semana5);
		$semana6 = $semana6->modify('Next Monday');

		$semana7 =  new Carbon($semana6);
		$semana7 = $semana7->modify('Next Monday');

		/*
		// Creamos variable con numero de horas por semana y asignamos cual es la primera semana
		 */
		$numeroSemanas = new Carbon($semana5);
		$numeroSemanas->modify('Next Thursday');

		if ($numeroSemanas->month == intval($month)) {
			$numeroSemanas = 5;
		}else{
			$numeroSemanas = 4;
		}

		if ($jueves->day <= 4) {
			$primerdia = new Carbon($semana1);
			$primeraSemana = 1;
		}else{
			$primerdia = new Carbon($semana2);
			$primeraSemana = 2;
			$numeroSemanas = $numeroSemanas - 1; // Restamos la primera semana que no cuenta para el mes
		}

		if ($numeroSemanas == 5) {
			$ultimodia = new Carbon($semana5);
			$ultimodia = $ultimodia->modify('Next Monday');
		}else{
			$ultimodia = new Carbon($semana5);
		}
		

		$semana1 = $this::getHoursWeek($semana1, $semana2, $id);
		$semana2 = $this::getHoursWeek($semana2, $semana3, $id);
		$semana3 = $this::getHoursWeek($semana3, $semana4, $id);
		$semana4 = $this::getHoursWeek($semana4, $semana5, $id);
		$semana5 = $this::getHoursWeek($semana5, $semana6, $id);
		$semana6 = $this::getHoursWeek($semana6, $semana7, $id);

		if($primeraSemana == 1){
			$totalHoras = $semana1 + $semana2 + $semana3 + $semana4;
			if($numeroSemanas == 5){
				$totalHoras = $totalHoras + $semana5;
			}
		}else{
			$totalHoras = $semana2 + $semana3 + $semana4 + $semana5;
			if($numeroSemanas == 5){
				$totalHoras = $totalHoras + $semana6;
			}
		}

		$semanas = array('semana1' => $semana1, 'semana2' => $semana2, 'semana3' => $semana3, 'semana4' => $semana4, 'semana5' => $semana5, 'semana6' => $semana6,  'semana' => $totalHoras, 'primeraSemana' => $primeraSemana, 'numeroSemanas' => $numeroSemanas);

		return json_encode($semanas);

	}

	/**
	 * Obtener las horas entre dos fechas
	 * @param month
	 * 		obtenidos por post
	 *
	 * @return Response
	*/

	public function ajaxHoursMoth()
	{
		$id = Auth::id();
		if(Request::ajax()){
			$horas = $this::getHoursMoth(Request::input('month'), Request::input('year'), $id);
			return $horas;
		}
		
		return 'Error';
	}

}