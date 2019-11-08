<?php


class Model{

    protected $db;

    protected $credat;

    protected $moddat;

    protected $table;

    protected $data;

    public function __construct(){
        $this->db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASS);
    }

    public function create(){
		$data = array_filter($this->data, function($k) {
			return $k != 'id';
		}, ARRAY_FILTER_USE_KEY);
		
		$sColumns = implode(", ", array_keys($data));
		$sFields = implode(',', array_fill(0, count($data), '?'));
		$sql = "INSERT INTO " . $this->table . " ($sColumns) VALUES ($sFields)";
		
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array_values($data));
        return $this->db->lastInsertId();
    }
    
    public function delete(){
        $sql = "DELETE FROM " . $this->table;
        $sql .= " WHERE id=" . $this->id;
        $this->db->query($sql);
    }

    public function update(){
        $sql = "UPDATE " . $this->table . " SET ";
        $sql .= implode(', ', array_map(
					function ($k) { return sprintf("%s=?", $k); },
					array_keys($this->data)
				));
        $sql .= " WHERE id=" . $this->id;
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array_values($this->data));
    }

    public function fill($data){
        if(!is_array($data))
            die("not an array");

        foreach(array_intersect_key($this->data,$data) as $n=>$v){
            $this->$n = $data[$n];
        }
    }

    public function all($where = ""){
        $sql = "SELECT * FROM " . $this->table;
        if( $where != "" ){
            $sql .= " WHERE " . $where;
        }
		$r = $this->db->query($sql);
		$r->setFetchMode(PDO::FETCH_CLASS, get_class($this));

        return $r->fetchAll();
    }

    public function get($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $r = $this->db->query($sql);
        $elt = $r->fetch(PDO::FETCH_ASSOC);
		foreach($elt as $k=>$v){
			$this->data[$k] = $v;
		}
    }
	
	public function __get( $name ){
		 if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
		
		// if( $name == "id" )
			// return $this->id;
    }
	
	public function __set( $name, $value ){
        if (array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
        }
    }
}
