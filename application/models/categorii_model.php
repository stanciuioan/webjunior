<?php
class Categorii_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lista_categorii()
	{
		$this->db->order_by("dengrupv", "asc");	
        $query = $this->db->get('grupv');
		if(!$query){
			echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
			}
			else {
				return $query->result_array();
			}
	}
	
	public function load_feedback_egr()
	{
		$dengrupv=$this->input->get_post('dengrupv');
		
		//verific daca grupa de varsta $dengrupv mai exista in baza de date
		$selsql="SELECT dengrupv FROM grupv WHERE dengrupv='$dengrupv'";
		$query = $this->db->query($selsql);
		if(!$query){echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message(); return;}
		if ($query->num_rows() > 0) {echo "grupa de varsta $dengrupv este deja introdus in baza de date" ; return ;}
		//inserare
		$data = array(
				'dengrupv' => $dengrupv
				);
		$raspuns = $this->db->insert('grupv', $data);
		if(!$raspuns){
			$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
		}	
		else{
			$string="Inserare grupa varsta facuta cu succes";
		}
		//$string=$dengrupv;
		echo $string;
	}
	public function load_sterg_grv()
	{
		$codgrupv=$this->input->get_post('codgrupv');
		
		//verific daca exista useri care au grupa de varsta $codgrupv
		$selsql="SELECT codgrupv FROM user WHERE codgrupv='$codgrupv'";
		$query = $this->db->query($selsql);
		if(!$query){echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message(); return;}
		if ($query->num_rows() > 0) {echo "Nu puteti sterge grupa $codgrupv; exista useri incadrati la aceasta grupa de varsta" ; return ;}
		//stergere
		$this->db->where('codgrupv', $codgrupv);
		$raspuns = $this->db->delete('grupv');
		if(!$raspuns){
			$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
		}	
		else{
			$string="Am sters grupa ".$codgrupv;
		}
		//$string="voi sterge grupa".$codgrupv;
		echo $string;
	}
	
	public function refresh_grupev()
	{
		//conexiune la baza de date
		//$connstr=array("hostname"=>"localhost", "username"=>"root", "password"=>"", "database"=>"mnd3db1", "dbdriver"=>"mysql");
		//$conn=$this->load->database($connstr,TRUE);
		//if (empty($conn)) die("Eroare de conectare la baza de date mnd3db1 ");
		$query = "SELECT codgrupv,dengrupv from grupv ORDER BY dengrupv";
		
		//Execute query	
		$qry_result = mysql_query($query) or die(mysql_error());
		//Build Result String
		$display_string = "<table border='1' >";
		$display_string .= "<tr><th>selecteaza</th><th>grupe varsta</th></tr>";
		
		// Insert a new row in the table for each grupv returned
		while($row = mysql_fetch_array($qry_result)){
			$display_string .= "<tr>";
			$display_string .= "<td><input type='radio' name='nume' value=$row[codgrupv] onclick=\"set_cheie($row[codgrupv])\"></td>";
			$display_string .= "<td>$row[dengrupv]</td>";
			$display_string .= "</tr>";
		}
		$display_string .= "</table>";
		echo $display_string;
	}
	
	public function refresh_grupev_popup()
	{
		//conexiune la baza de date
		//$connstr=array("hostname"=>"localhost", "username"=>"root", "password"=>"", "database"=>"mnd3db1", "dbdriver"=>"mysql");
		//$conn=$this->load->database($connstr,TRUE);
		//if (empty($conn)) die("Eroare de conectare la baza de date mnd3db1 ");
		//echo "refresh grupev";
		$query = "SELECT codgrupv,dengrupv from grupv ORDER BY dengrupv";
		
		//Execute query	
		$qry_result = mysql_query($query) or die(mysql_error());
		//Build Result String
		$display_string = "<option value=0></option>";
	
		// Insert a new row in the table for each grupv returned
		while($row = mysql_fetch_array($qry_result)){
			$display_string .= "<option value=$row[codgrupv]>$row[dengrupv]</option>";
		}
		echo $display_string;
	}
}