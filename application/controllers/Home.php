<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('fal');

        $this->fal->hit();
    }

	public function index()
	{
        $query = $this->db->get_where("yorumcu", array("status" => "1"));

        if ($query !== false && $query->num_rows() > 0){
            $data["yorumcular"] = $query->result_array();
        }else
            $data["yorumcular"] = array();


		$data["page"] = "home";
		$this->load->view('front/index', $data);
	}
}
