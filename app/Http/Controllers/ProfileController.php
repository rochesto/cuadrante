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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}