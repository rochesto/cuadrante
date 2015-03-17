<?php namespace Cuadrante\Http\Controllers;

use Cuadrante\Http\Requests;
use Cuadrante\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Cuadrante\Turno;
use Cuadrante\UserProfile;

class ProfileController extends Controller {

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
			

			// $profil = UserProfile::where('user_id', '=', $id)->get();
			
			// if(!$profil){
				
			// 	$profile = new UserProfile();
			// 	$profile->user_id = $id;
	  //       	$profile->asuntos_propios = '5';
	  //       	$profile->vacaciones = '22';
	  //       	$profile->permiso_urgente = '0';
	  //       	$profile->baja = '0';
	  //       	$profile->indisposicion = '0';
	  //       	$profile->examen = '0';
	  //       	$profile->comision = '0';
	  //       	$profile->horas_semanales = '40';
	  //       	$profile->singularizados = '0';

	  //       	$profile->save();
			// }

		    $turnos = Turno::where('user_id', '=', 1000)
		    	->orWhere('user_id', '=', $id)
		    	->get(array('id', 'user_id', 'title', 'description', 'horas', 'backgroundColor'));
			$turnos = json_encode($turnos);

			$horas = UserProfile::where('user_id', '=', $id)
				->get(array('id', 'asuntos_propios', 'vacaciones', 'permiso_urgente', 'baja', 'indisposicion', 'examen'));
			$horas = json_encode($horas);

			return view('profile')->with(compact('turnos'))->with(compact('horas'));
		}
		else
		{
			return view('auth/login');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function updateProfile()
	{

		if ($profile = UserProfile::find($_POST['id'])){

			if($profile->asuntos_propios = $_POST['asuntos_propios']){
				if($profile->vacaciones = $_POST['vacaciones']){
					if($profile->save()){
						return 'Ok';
					}
				}
			}
		}
		return 'Error';
	}
}