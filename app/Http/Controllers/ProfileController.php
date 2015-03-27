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

		    $turnos = Turno::where('user_id', '=', 10)
		    	->orWhere('user_id', '=', $id)
		    	->get(array('id', 'user_id', 'title', 'description', 'horas', 'backgroundColor'));
			$turnos = json_encode($turnos);

			$horas = UserProfile::where('user_id', '=', $id)
				->get(array('id', 'asuntos_propios', 'vacaciones', 'permiso_urgente', 'baja', 'indisposicion', 'examen', 'comision', 'horas_semanales'));
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
					if($profile->horas_semanales = $_POST['horas']){
						if($profile->save()){
							return 'Ok';
						}
					}
				}
			}
		}
		return 'Error';
	}
}