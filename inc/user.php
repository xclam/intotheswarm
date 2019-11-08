<?php

require_once("model.php");
require_once("swarm.php");

class User extends Model{

	protected $table = "users";

	protected $data = [
		"id" => 1,
		"login",
		"email",
		"password",
		// "creation_date",
		// "modification_date",
		// "last_connection_date",
		// "validation_date",
	];

	public function swarms(){
		$s = new Swarm();
		return $s->all("user_id=".$this->id);
	}
}