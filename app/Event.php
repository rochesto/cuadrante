<?php namespace Cuadrante;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

	protected $table = "events";

	public function getEventsTitleAttribute(){

		return 	$this->id .' '. $this->title ;

	}

}
