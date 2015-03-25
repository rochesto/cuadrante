<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        //insertamos los usuarios
        $this->call('UserTableSeeder');
        //mostramos el mensaje de que los usuarios se han insertado correctamente
        $this->command->info('User table seeded!');

        //insertamos los usuarios
        $this->call('TurnoTableSeeder');
        //mostramos el mensaje de que los usuarios se han insertado correctamente
        $this->command->info('Turno table seeded!');

        //insertamos los usuarios
        $this->call('ProfileUserTableSeeder');
        //mostramos el mensaje de que los usuarios se han insertado correctamente
        $this->command->info('Profile table seeded!');
        
	}

}

//clase para insertar usuarios
class UserTableSeeder extends Seeder {
 
    public function run()
    {
 		
 		DB::table('users')->insert(array(
            'id' => '10',
            'name' => 'xefe',
            'email' => 'rocho06@gmail.com',
            'password' => Hash::make('Ches9755')
        ));

        DB::table('users')->insert(array(
        	'id' => '1',
            'name' => 'rochesto',
            'email' => 'rochesto@hotmail.com',
            'password' => Hash::make('Ches9755')
        ));

    }
}

//clase para insertar usuarios
class TurnoTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Tarde',
	        'description' => 'Turno de tarde',
	        'horas' => 8,
	        'allDay' => '0',
	        'backgroundColor' => '#357CA5',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Mañana',
	        'description' => 'Turno de mañana',
	        'horas' => '8',
	        'allDay' => '0',
	        'backgroundColor' => '#357CA5',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Noche',
	        'description' => 'Turno de noche',
	        'horas' => '8',
	        'allDay' => '0',
	        'backgroundColor' => '#357CA5',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Saliente',
	        'description' => 'Turno de Saliente',
	        'horas' => '0',
	        'allDay' => '0',
	        'backgroundColor' => '#00ffff',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Libre',
	        'description' => 'Turno de Libre',
	        'horas' => '0',
	        'allDay' => '1',
	        'backgroundColor' => 'green',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Asunto Propio',
	        'description' => 'Día de asunto propio',
	        'horas' => '7.5',
	        'allDay' => '1',
	        'backgroundColor' => 'grey',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Singularizado',
	        'description' => 'Singularizado',
	        'horas' => '0',
	        'allDay' => '1',
	        'backgroundColor' => '#22ee11',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Vacaciones',
	        'description' => 'Vacaciones',
	        'horas' => '7.5',
	        'allDay' => '1',
	        'backgroundColor' => 'olive',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Baja',
	        'description' => 'Baja',
	        'horas' => '7.5',
	        'allDay' => '1',
	        'backgroundColor' => '#cceecc',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
			'user_id' => '10',
	        'title' => 'Permiso Urgente',
	        'description' => 'Día de permiso urgente',
	        'horas' => '7.5',
	        'allDay' => '1',
	        'backgroundColor' => 'green',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
        	'id' => '20',
			'user_id' => '10',
	        'title' => 'Turno(MTNSL)',
	        'description' => 'Mañana tarde noche',
	        'horas' => '24',
	        'allDay' => '1',
	        'backgroundColor' => 'black',
	        'textColor' => 'white'
        ));
        DB::table('turnos')->insert(array(
        	'id' => '21',
			'user_id' => '10',
	        'title' => 'Turno(TM/NSLL)',
	        'description' => 'Tarde mañana noche',
	        'horas' => '24',
	        'allDay' => '1',
	        'backgroundColor' => 'black',
	        'textColor' => 'white'
        )); 
    }
}

//clase para insertar usuarios
class ProfileUserTableSeeder extends Seeder {
 
    public function run()
    {
 		
 		DB::table('user_profile')->insert(array(
        	'user_id' => '1',
        	'asuntos_propios' => '5',
        	'vacaciones' => '22',
        	'permiso_urgente' => '0',
        	'baja' => '0',
        	'indisposicion' => '0',
        	'examen' => '0',
        	'comision' => '0',
        	'horas_semanales' => '40',
        	'singularizados' => '0'
        ));

    }
}