<?php

class Junior extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('junior_model');
		$this->load->model('tipuser_model');
		$this->load->model('categorii_model');
		$this->load->model('user_model');
	}

	public function index()
	{	
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('junior/formlogin');
		}
		else
		{
			//model Junior_model/ver_ user() va returna 0=user incorect,1=admin,2=user
			$var = $this->junior_model->ver_user();
			if ($var ==1 )
			{
				// admin interfata listare utilizatori
				$data['title'] = 'Proiect test Junior';
				$data['users']=$this->junior_model->lista_utiliz();
				$data['categorii']=$this->categorii_model->lista_categorii();
				$data['tipuser']=$this->tipuser_model->lista_tipuser();
				
				$this->load->view('junior/header', $data);
				$this->load->view('junior/lista_utiliz', $data);
				$this->load->view('junior/footer');
			}
			if ($var ==2 )
			{
				//userul sa vada informatiile despre propriul user si sa le editeze
				//lansez lista inf_utiliz
				$data['title'] = 'Proiect test Junior';
				$data['user']=$this->junior_model->lista_ut1();
				$data['categorii']=$this->categorii_model->lista_categorii();
				$data['tipuser']=$this->tipuser_model->lista_tipuser();
				$this->load->view('junior/inf_utiliz', $data);
			}
		}
	}
	
	public function reset_password()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('junior/formemail');
		}
		else
		{
			$var = $this->junior_model->reset_password();
		}
		
	}
	
	public function ajax_example()
	{
		$this->junior_model->ajax_example();
	}
	
	public function load_feedback()
	{
		$this->user_model->load_feedback();
	}
	
	public function update_feedback()
	{
		$this->user_model->update_feedback();
	}
	
	public function load_feedback_egr()
	{
		$this->categorii_model->load_feedback_egr();
	}
	
	public function refresh_grupev()
	{
		$this->categorii_model->refresh_grupev() ;	
	}
	
	public function refresh_grupev_popup()
	{
		$this->categorii_model->refresh_grupev_popup();
	}
	
	public function load_sterg_grv()
	{
		$this->categorii_model->load_sterg_grv();
	}
	
	public function refresh_lista($filt)
	{
		//echo "junior controller refresh lista ".$filt;
		$filt=urldecode($filt);
		$this->junior_model->refresh_lista($filt) ;
	}
	
	public function refresh_infu()
	{
		$this->junior_model->refresh_infu() ;
	}
}
?>