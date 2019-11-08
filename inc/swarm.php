<?php

require_once("model.php");
require_once("swarmtype.php");

class Swarm extends Model{

	protected $table = "swarms";

	protected $data = [
		"id",
		"user_id",
		"name",
		"swarmtype_id",
		"score" => 0,
		"hive_id" => null,
		"strength",
		"fertility",
		"swarming",
		"gluttony",
		"creation_date",
	];
	
	public function new_swarm($name, $swarmtype_id){
		// $this->user_id = ???;
		$this->name = $name;
		$this->swarmtype_id = swarmtype_id;
		$this->strength = ini_value(SwarmType::strength($swarmtype_id));
		$this->fertility = ini_value(SwarmType::fertility($swarmtype_id));
		$this->swarming = ini_value(SwarmType::swarming($swarmtype_id));
		$this->gluttony = ini_value(SwarmType::gluttony($swarmtype_id));
	}
	
	public function ini_value($value, $min = -10, $max = 10){
		if($min < -100 or $max > 100 or $min > $max)
			return "Invalid min and max";
		
		return rand($min,$max) * $value + $value;
	}
	
	public function search_hive($min = 1, $max = 10){
		$found = rand($min,$max);
		
	}
	
	// public function move_to_hive(){
		
	// }
}