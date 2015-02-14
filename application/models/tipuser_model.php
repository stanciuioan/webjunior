<?php
class Tipuser_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lista_tipuser()
	{
		$this->db->order_by("dentipu", "asc");
        $query = $this->db->get('tipuser');	
		if(!$query){
			echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
			}
			else {
				return $query->result_array();
			}		
	}
}