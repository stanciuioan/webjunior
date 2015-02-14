<?php
class User_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function load_feedback()
	{
		
		$username=$this->input->get_post('username');
		$password1=$this->input->get_post('password');
		$password=md5($password1);
		$name=$this->input->get_post('name');
		$email=$this->input->get_post('email');
		$phone=$this->input->get_post('phone');
		$description=$this->input->get_post('description');
		$codtipu=$this->input->get_post('codtipu');
		$codgrupv=$this->input->get_post('codgrupv');
		$cda_am=$this->input->get_post('cda_am');
	
		if ($cda_am == "A"){
			//verific daca userul $username mai exista in baza de date; oricum ar iesi pe eroare deoarece este chie primara
			$selsql="SELECT username FROM user WHERE username='$username'";
			$query = $this->db->query($selsql);
			if(!$query){echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message(); return;}
			if ($query->num_rows() > 0) {echo "userul $username este deja introdus in baza de date" ; return ;}
			
			//inserare
			$data = array(
				'username' => $username , 
				'codtipu' => $codtipu ,
				'password' => $password ,
				'name' => $name ,
				'email' => $email ,
				'phone' => $phone ,
				'description' => $description,
				'codgrupv' => $codgrupv 
				);
			$raspuns = $this->db->insert('user', $data);
			if(!$raspuns){
				$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
			}	
			else{
				$string="Inserare facuta cu succes";
			}
		}
	
		if ($cda_am == "M"){
			$data = array(
				//'username' => $username , 
				'codtipu' => $codtipu ,
				//'password' => $password ,
				'name' => $name ,
				'email' => $email ,
				'phone' => $phone ,
				'description' => $description,
				'codgrupv' => $codgrupv 
				);
			$this->db->where('username', $username);
			$raspuns = $this->db->update('user', $data);
			if(!$raspuns){
				$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
			}	
			else{
				$string="Modificare facuta cu succes";
			}
		}
		
		echo $string;
	}
	
	public function update_feedback()
	{
		$username=$this->input->get_post('username');
		$name=$this->input->get_post('name');
		$email=$this->input->get_post('email');
		$phone=$this->input->get_post('phone');
		$description=$this->input->get_post('description');
		$codgrupv=$this->input->get_post('codgrupv');
	
		$data = array(
				'name' => $name ,
				'email' => $email ,
				'phone' => $phone ,
				'description' => $description,
				'codgrupv' => $codgrupv 
				);
			$this->db->where('username', $username);
			$raspuns = $this->db->update('user', $data);
			if(!$raspuns){
				$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
			}	
			else{
				$string="Modificare facuta cu succes";
			}
		echo $string;
	}
	
	public function userinf()
	{
		$vusername=$this->input->post("username");
		$this->db->where('username', $vusername);
		$query = $this->db->get('user');
		if (!$query){
			echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
		}
		else{
			return $query->result_array();
		}
	}
}