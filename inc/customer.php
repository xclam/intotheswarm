<?php

require_once("model.php");
require_once("poste.php");

class Customer extends Model{
    
    protected $table = "customers";

    protected $data = [
		"id" => "",
        "code" => "",
        "name" => "",
        "directory" => "",
        "active" => "",
		"format" => "",
		"ftp_host" => "",
		"ftp_user" => "",
		"ftp_pass" => "",
    ];
	
	protected $postes = array();
	
	public function create(){
		$this->fill($_POST);
        if($_POST['active'] == 'on'){
            $this->active = 1;
        } else {
            $this->active = 0;
        }
        $id = parent::create();
        echo $id;
		$postes = array();
		foreach($_POST['poste-poste'] as $k=>$poste ){
			$postes[$k]['poste'] = $poste;
			$postes[$k]['description'] = $_POST['poste-description'][$k];
		}
		
		foreach( $postes as $poste ){
			$p = new Poste;
			$p->customer_id = $id;
			$p->poste = $poste['poste'];
			$p->description = $poste['description'];
			$p->create();
			$this->postes[] = $p;
		}
		
		$this->get($id);
	}
	
	public function update(){
		$this->fill($_POST);
        if($_POST['active'] == 'on'){
            $this->active = 1;
        } else {
            $this->active = 0;
        }
        parent::update();
		
		$postes = array();
		foreach($_POST['poste-poste'] as $k=>$poste ){
			$postes[$k]['poste'] = $poste;
			$postes[$k]['description'] = $_POST['poste-description'][$k];
		}

		$this->get($this->id);

		foreach( $this->postes as $poste ){
			$poste->delete();
		}

		foreach( $postes as $poste ){
			$p = new Poste;
			$p->customer_id = $this->id;
			$p->poste = $poste['poste'];
			$p->description = $poste['description'];
			$p->create();
			$this->postes[] = $p;
		}
		
		
        $this->get($this->id);
	}

	public function delete(){
		parent::delete();
		header('Location: ' . APP_URL . '/?m=customer&v=list');
	}
	
	public function postes(){
		return $this->postes;
	}
	
	public function get($id){
		parent::get($id);
		$p = new Poste;
		$this->postes = $p->all("customer_id=".$this->id);
	}
}
