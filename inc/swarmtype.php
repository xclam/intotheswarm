<?php
require_once("model.php");

class SwarmType extends Model{

	protected $table = "swarm_types";
	
	protected $data = [
		"id" => "",
		"name" => "",
		"strength" => "",
		"fertility" => "",
		"swarming" => "",
		"gluttony" => "",
	];
	
	public static function get_all(){
		return $this->all();
	}
	
}