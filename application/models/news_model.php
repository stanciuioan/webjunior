<?php
class News_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get_news($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('news');  // select * from news
			return $query->result_array();    //returns the query result as a pure array
		}

		$query = $this->db->get_where('news', array('slug' => $slug)); // select *from news where slug=$slug
		return $query->row_array();           //returneaza un singur rand -un array
	}
	public function set_news()
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text')
		);

	return $this->db->insert('news', $data);
	}
}