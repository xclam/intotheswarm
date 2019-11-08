<?php

class Bootstrap{
	
	protected $model = null;
	protected $last_model = null;
	
	protected $action = null;
	protected $last_action = null;
	
	protected $view = null;
	protected $last_view = null;
	
	protected $id = null;
	
	protected $obj = null;
	
	public function __construct(){
		$this->route();
		$this->includes();
		$this->init();
	}
	
	public function route(){
		// m, a, v, 
		if( isset($_GET['m']) && $_GET['m'] != "" ){
			$this->last_model = $this->model;
			$this->model = $_GET['m'];
		}
		if( isset($_GET['v']) && $_GET['v'] != "" ){
			$this->last_view = $this->view;
			$this->view = $_GET['v'];
		}
		if( isset($_REQUEST['id']) && $_REQUEST['id'] != "" ){
			$this->id = $_REQUEST['id'];
			
		}
		if( isset($_POST['action']) && in_array($_POST['action'], ["create","update","delete"] ) ){
			$this->last_action = $this->action;
			$this->action = $_POST['action'];
		}
	}
	
	public function includes(){
		if( file_exists( APP_PATH . "/inc/" . $this->model . ".php" ) ){
			include( APP_PATH . "/inc/" . $this->model . ".php" );
		}
	}
	
	public function init(){
		if( class_exists( $this->model ) ){
			$this->obj = new $this->model;
			if( !is_null( $this->id ) ){
				$this->obj->get($this->id);
			}
			if( !is_null( $this->action ) ){
				$this->obj->{$this->action}();
			}
			if( !is_null( $this->id ) ){
				$this->obj->get($this->id);
			}
		}
	}
	
	public function __get( $name ){
		if( isset( $this->$name ) ){
			return $this->$name;
		}
	}
	
	public function render(){
		if( file_exists( APP_PATH . "/view/" . $this->model . "/" . $this->view . ".php" ) ){
			include( APP_PATH . "/view/" . $this->model . "/" . $this->view . ".php" );
		} else {
			include( APP_PATH . "/view/home.php" );
		}
	}
}