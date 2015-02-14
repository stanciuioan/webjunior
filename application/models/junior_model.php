<?php
class Junior_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}
	
	public function ver_user()
	{
		//va returna 0=eroare conectare,1=admin,2=user
		//if (isset($_POST['username'])) {$vusername=$_POST['username'];}
		//if (isset($_POST['password'])) {$vpassword=$_POST['password'];}
		$vusername=$this->input->post("username");
		$vpassword=$this->input->post("password");
		
			//cautare user si verificare parola
			$selsql="SELECT user.username, user.password, tipuser.dentipu
				FROM user,tipuser
				WHERE user.codtipu=tipuser.codtipu and user.username='$vusername'";
			$query = $this->db->query($selsql);
			if(!$query){echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message(); return;}
			if ($query->num_rows() == 0) {echo "Utilizator inexistent $vusername " ; return 0;}
			if ($query->num_rows() > 1) {echo "Utilizatorul $vusername apare de mai multe ori in tabela user. " ; return 0;}
			$row = $query->row_array();
			if ($row['password']!=md5($vpassword)) {echo "Parola eronata "; return 0;}
			//verific daca username este user sau admin
			if ($row['dentipu'] == "admin") {//echo "Tipuser= admin";
									return 1;}
			if ($row['dentipu'] == "user") {//echo "Tipuser=user"; 
									return 2;}
	}
		public function reset_password()
		{
			//cautare adresa de email
			//$vemail=$_POST['email'];
			$vemail=$this->input->post("email");
			
			$selsql="SELECT email,username FROM user WHERE email='$vemail'";
			$query = $this->db->query($selsql);
			if(!$query){echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message(); return;}
			if ($query->num_rows() > 1) {echo "Adresa de e-mail $vemail apare de mai multe ori in baza de date" ; return 0;}
			if ($query->num_rows() == 0) {echo "Email inexistent $vemail " ; return 0;}
			$row = $query->row_array();
			$vusername=$row['username'];
			//generez un numar aleator intre 10000 si 99999 si pun o litera in fata
			$vpassword="P".rand(10000,99999);
			///echo "<br/>";
			//echo "Parola generata aleator din intervalul 10000-99999: ".$vpassword;
			//echo "<br/>";
			//echo "Utilzator".$vusername;
			
			//creez mesaj email si il trimit prin e-mail, dau mesaj de parola transmisa cu succes
			$this->email->from('stanciu_ioan@yahoo.com', 'Stanciu Ioan');
			$to="$vemail";
			$this->email->to($to); 
			$this->email->subject('Reset password');
			$message="Hi $vusername, \r\n you or someone else have requested your account details. \r\n 
			Here is your account information please keep this as you may need this at a later stage.
			\r\n Your username is $vusername \r\n your password is $vpassword 
			\r\n Your password has been reset please login and change your password to something more rememberable.
			\r\n Regards Site Admin";
			$this->email->message($message); 
			if ( ! $this->email->send())
				{	
					echo "<p>Erorr sending email.Please enter your e-mail address. You will receive a new password via e-mail.</p>";
					//return 0;
				}
			else
				{
					echo "<p>You have been sent an email with your account details to $vemail</p>";
					//se inregistreaza parola criptat cu md5() in baza de date
					//invalidez codul;nuschimb parola deoarece mail-ul nu se transmite
					//$var_password=md5($vpassword);
					//$data = array(
					//	'password' => $var_password
					//);
					//$this->db->where('email', $vemail);
					//$raspuns = $this->db->update('user', $data);
					//if(!$raspuns){
					//	$string = "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message();
					//}	
					//else{
					//	$string="Modificare email facuta cu succes";
					//}
					//echo $string;
				}
		}
		
	public function lista_utiliz()
	{
		$query = $this->db->query(
		'SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu ,user.codgrupv
				FROM user,tipuser,grupv
				WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv
				ORDER BY user.username ASC');

		return $query->result_array();
	}
	
	public function lista_ut1()
	{
		$vusername=$this->input->post("username");
		//echo "\$vusername= ".$vusername;
		$select="SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu ,user.codgrupv
				FROM user,tipuser,grupv
				WHERE user.username='".$vusername."' and user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv";
		$query = $this->db->query($select);
		if(!$query){
			echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message().$select;
			}
			else {
				return $query->result_array();
			}
	}

	public function ajax_example()
	{	
	//conexiune la baza de date
		//$connstr=array("hostname"=>"localhost", "username"=>"root", "password"=>"", "database"=>"mnd3db1", "dbdriver"=>"mysql");
		//$conn=$this->load->database($connstr,TRUE);
		//if (empty($conn)) die("Eroare de conectare la baza de date mnd3db1 ");
		
		$paramsort=$this->input->get('nume_get');
		$ordsort=$this->input->get('ordsort');
		$filt=$this->input->get('filt');
		$filt=urldecode($filt);
		
	// Escape User Input to help prevent SQL Injection
		$paramsort = mysql_real_escape_string($paramsort);
		$ordsort = mysql_real_escape_string($ordsort);
		
		if ($filt!="-"){
		$query = "SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu, user.codgrupv
					FROM user,tipuser,grupv
					WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv ".$filt." ORDER BY $paramsort $ordsort";
			}
			else{
			$query = "SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu, user.codgrupv
					FROM user,tipuser,grupv
					WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv 
					ORDER BY $paramsort $ordsort";
			}
			
	//Execute query	
		$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
		$display_string = "<table border='1'>";
		$display_string .= "<tr>";
		$display_string .= "<th id='username' value='user.username' onclick=\"ajaxFunction('username','1')\">username</th>";
		$display_string .= "<th id='tipuser' value='tipuser.dentipu' onclick=\"ajaxFunction('tipuser','2')\">tip user</th>";
		$display_string .= "<th id='name' value='user.name' onclick=\"ajaxFunction('name','3')\">name</th>";
		$display_string .= "<th id='email' value='user.email' onclick=\"ajaxFunction('email','4')\">email</th>";
		$display_string .= "<th id='phone' value='user.phone' onclick=\"ajaxFunction('phone','5')\">phone</th>";
		$display_string .= "<th id='dengrupv' value='grupv.dengrupv' onclick=\"ajaxFunction('dengrupv','6')\">grupa varsta</th>";
		$display_string .= "</tr >";

// Insert a new row in the table for each person returned
		while($row = mysql_fetch_array($qry_result)){
			$display_string .= "<tr title='$row[description]', onclick='overlay_b(\"$row[username]\",\"$row[dentipu]\",\"$row[name]\"
												,\"$row[email]\",\"$row[phone]\",\"$row[dengrupv]\",\"$row[description]\"
												,\"$row[codtipu]\",\"$row[codgrupv]\")'>";
			$display_string .= "<td>$row[username]</td>";
			$display_string .= "<td>$row[dentipu]</td>";
			$display_string .= "<td>$row[name]</td>";
			$display_string .= "<td>$row[email]</td>";
			$display_string .= "<td>$row[phone]</td>";
			$display_string .= "<td>$row[dengrupv]</td>";
			$display_string .= "</tr>";
		}
	
	$display_string .= "</table>";
	echo $display_string;

	}
		
	public function refresh_lista($filt)
	{
		//conexiune la baza de date
		/////$connstr=array("hostname"=>"localhost", "username"=>"root", "password"=>"", "database"=>"mnd3db1", "dbdriver"=>"mysql");
		/////$conn=$this->load->database($connstr,TRUE);
		/////if (empty($conn)) die("Eroare de conectare la baza de date mnd3db1 ");
		
		//$paramsort = $_GET['nume_get'];
		//$paramsort=$this->input->get('nume_get');
		//$ordsort=$this->input->get('ordsort');
		//echo "<br/>";
		//echo "parametru sortare: ".$paramsort ;
		//echo "ordine sortare: ".$ordsort;
		//echo "<br/>";
	// Escape User Input to help prevent SQL Injection
		//$paramsort = mysql_real_escape_string($paramsort);
		//$ordsort = mysql_real_escape_string($ordsort);
		if ($filt!="-"){
			$query = "SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu, user.codgrupv
					FROM user,tipuser,grupv
					WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv ".$filt." ORDER BY user.username ASC";
					//ORDER BY $paramsort $ordsort";
			}
			else{
				$query = "SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu, user.codgrupv
					FROM user,tipuser,grupv
					WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv ORDER BY user.username ASC";
					//ORDER BY $paramsort $ordsort";
			}
			
	//Execute query	
		$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
		$display_string = "<table border='1'>";
		$display_string .= "<tr>";
		$display_string .= "<th id='username' value='user.username' onclick=\"ajaxFunction('username','1')\">username</th>";
		$display_string .= "<th id='tipuser' value='tipuser.dentipu' onclick=\"ajaxFunction('tipuser','2')\">tip user</th>";
		$display_string .= "<th id='name' value='user.name' onclick=\"ajaxFunction('name','3')\">name</th>";
		$display_string .= "<th id='email' value='user.email' onclick=\"ajaxFunction('email','4')\">email</th>";
		$display_string .= "<th id='phone' value='user.phone' onclick=\"ajaxFunction('phone','5')\">phone</th>";
		$display_string .= "<th id='dengrupv' value='grupv.dengrupv' onclick=\"ajaxFunction('dengrupv','6')\">grupa varsta</th>";
		$display_string .= "</tr >";

// Insert a new row in the table for each person returned
		while($row = mysql_fetch_array($qry_result)){
			$display_string .= "<tr title='$row[description]', onclick='overlay_b(\"$row[username]\",\"$row[dentipu]\",\"$row[name]\"
												,\"$row[email]\",\"$row[phone]\",\"$row[dengrupv]\",\"$row[description]\"
												,\"$row[codtipu]\",\"$row[codgrupv]\")'>";
			$display_string .= "<td>$row[username]</td>";
			$display_string .= "<td>$row[dentipu]</td>";
			$display_string .= "<td>$row[name]</td>";
			$display_string .= "<td>$row[email]</td>";
			$display_string .= "<td>$row[phone]</td>";
			$display_string .= "<td>$row[dengrupv]</td>";
			$display_string .= "</tr>";
			}
			
	$display_string .= "</table>";
	echo $display_string;

	}
	
	public function refresh_infu()
	{
		$username=$this->input->get_post('username');
		
		$select="SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv, user.description, user.codtipu ,user.codgrupv
				FROM user,tipuser,grupv
				WHERE user.username='".$username."' and user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv";
		$query = $this->db->query($select);
		if(!$query){
			echo "EROARE BAZA DE DATE: ".$this->db->_error_number()." -> ".$this->db->_error_message().$select;
		}
		else{
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					
					$display_string = "<table border='1'>";
					$display_string .="<tr><th align='left'>username</th><td>$row[username]</td></tr>";
					$display_string .="<tr><th align='left'>tipuser</th><td>$row[dentipu]</td></tr>";
					$display_string .="<tr><th align='left'>name</th><td>$row[name]</td></tr>";
					$display_string .="<tr><th align='left'>email</th><td>$row[email]</td></tr>";
					$display_string .="<tr><th align='left'>phone</th><td>$row[phone]</td></tr>";
					$display_string .="<tr><th align='left'>grupa varsta</th><td>$row[dengrupv]</td></tr>";
					$display_string .="<tr><th align='left'>description</th><td>$row[description]</td></tr>";
					$display_string .="</table>";
					
					$display_string .="<br/ ><br/ >";
					$display_string .="<p>";
					
					$display_string .="<input type='button' value='Editare' onclick = 'overlay_m(\"$row[username]\",
					\"$row[dentipu]\",\"$row[name]\",\"$row[email]\",\"$row[phone]\",\"$row[dengrupv]\",\"$row[description]\",
					\"$row[codtipu]\",\"$row[codgrupv]\")' />";
					
					$display_string .="</p>";
					
					echo $display_string;
				}
			}
	}
}