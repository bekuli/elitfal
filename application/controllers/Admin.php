<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('fal');

        if ($this->fal->check_admin_login() == false)
        {
            show_404();
            return;
        }
    }

	public function index()
	{

		$data["page_name"] = "home";
        $data["page_title"] = "Anasayfa";
		if (isset($_GET["pure"])){
            $this->load->view("back/admin/".$data["page_name"], $data);
            $this->fal->set_title_pure($data["page_title"], true);
        }
        else
            $this->load->view("back/admin/index", $data);
	}

    public function user_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(name, ' ', email) like '%".$q."%'");
        }

        $totalrows = $this->db->count_all_results("users");

        if ($totalrows > 0)
        {
            $rowsperpage = 10;
            $totalpages = ceil($totalrows / $rowsperpage);

            if ($page > $totalpages)
                $page = $totalpages;

            if ($page < 1)
                $page = 1;

            $offset = ($page - 1) * $rowsperpage;

            if ($q !== "")
                $this->db->where("CONCAT(name, ' ', email) like '%".$q."%'");

            $query = $this->db->order_by("id", "DESC")->get("users", $rowsperpage, $offset);

            $page_data["user_list"] = $query->result_array();

            $pgrange = 3;
            $pg = "";
            if ($page > 1) {
                $pg .= '<li class="page-item"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="1" class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li> ';
                $prevpage = $page - 1;
                $pg .= '<li class="page-item"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="'.$prevpage.'" class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li> ';
            }
            else{
                $pg .= '<li class="page-item disabled"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg.=' page="active" class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li> ';
                $pg .= '<li class="page-item disabled"><a ';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="active" class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li> ';
            }

            for ($x = ($page - $pgrange); $x < (($page + $pgrange) + 1); $x++) {
                if (($x > 0) && ($x <= $totalpages)) {
                    if ($x == $page){
                        $pg .= ' <li class="page-item active"><a ';
                        if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                        $pg.=' page="active" class="page-link" href="#">'.$x.'</a></li> ';
                    }else{
                        $pg .= ' <li class="page-item"><a';
                        if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                        $pg .=' page="'.$x.'" class="page-link" href="#">'.$x.'</a></li> ';
                    }
                }
            }

            if ($page != $totalpages) {
                $nextpage = $page + 1;
                $pg .= '<li class="page-item"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg.=' page="'.$nextpage.'" class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li> ';
                $pg .= '<li class="page-item"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="'.$totalpages.'" class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li> ';
            }
            else{
                $pg .= '<li class="page-item disabled"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="active" class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li> ';
                $pg .= '<li class="page-item disabled"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg.= ' page="active" class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li> ';
            }

            $page_data["pagination"] = $pg;
        }
        else
            $page_data["user_list"] = array();


        $this->load->view("back/admin/user_list", $page_data);
    }

    public function users($user_id = null, $action = null)
    {
        if ($user_id == null)
        {
            $page_data["page_name"] = "users";
            $page_data["page_title"] = "Kullanıcılar";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }
        else
        {
            if (!is_numeric($user_id)){
                show_404();
                return;
            }

            $query = $this->db->get_where("users", array("id" => $user_id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($action == null)//user stats
                {
                    $page_data["user_data"] = $query->row();
                    $page_data["page_name"] = "user_stats";
                    $page_data["page_title"] = "User Url Statistics:";

                    if (isset($_GET["pure"])){
                        $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                        $this->fal->set_title_pure($page_data["page_title"], true);
                    }
                    else
                        $this->load->view("back/admin/index", $page_data);
                }
                elseif ($action == "view")
                {
                    $page_data["user_data"] = $query->row();
                    $page_data["page_name"] = "user_view";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                elseif ($action == "edit")
                {
                    $page_data["page_name"] = "user_edit";
                    $page_data["user_data"] = $query->row();
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                elseif ($action == "update")
                {
                    if (isset($_POST["email"]))
                    {
                        if (empty($_POST["email"]) || empty($_POST["username"]))
                        {
                            echo "empty";
                            return;
                        }

                        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                            echo "bad_email";
                            return;
                        }

                        $data = array(
                            "email" => $this->input->post("email"),
                            "name" => $this->input->post("username")
                        );

                        if (!empty(trim($_POST["password"])))
                            $data["password"] = sha1($this->input->post("password"));

                        $this->db->where("id", $user_id);
                        $query = $this->db->update("users", $data);
                        if($query !== false){
                            echo "success";
                        } else {
                            echo "error";
                        }

                        return;
                    }
                }
                elseif ($action == "update-status")
                {
                    $this->db->where("id", $query->row()->id);
                    if ($query->row()->status == 0)
                        $data["status"] = 1;
                    else
                        $data["status"] = 0;
                    $query = $this->db->update("users", $data);
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }
                elseif ($action == "delete")
                {
                    if ($query->row()->user_type == "admin")
                        return "error";

                    $this->db->where("id", $query->row()->id);
                    $query = $this->db->delete("users");
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }
            }
            else
            {
                show_404();
                return;
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
}
