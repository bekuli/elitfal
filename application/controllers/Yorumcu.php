<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yorumcu extends CI_Controller {

    public $profil = array();

	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('fal');

        if ($this->fal->check_yorumcu_login() == false)
        {
            show_404();
            return;
        }

        $query = $this->db->get_where("yorumcu", array("id" => $this->session->userdata('id')));
        if ($query !== false && $query->num_rows() > 0)
            $this->profil = $query->row();
        else{
            show_404();
            return;
        }


    }

	public function index()
	{
        $data["profil"] = $this->profil;

		$data["page_name"] = "home";
        $data["page_title"] = "Anasayfa";
		if (isset($_GET["pure"])){
            $this->load->view("back/yorumcu/".$data["page_name"], $data);
            $this->fal->set_title_pure($data["page_title"], true);
        }
        else
            $this->load->view("back/yorumcu/index", $data);
	}

    public function falistekleri_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(fal_turu, ' ', id) like '%".$q."%'");
        }

        $totalrows = $this->db->where("yorumcu", $this->session->userdata('id'))->count_all_results("fal_istekleri");

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
                $this->db->where("CONCAT(fal_turu, ' ', id) like '%".$q."%'");

            $query = $this->db->order_by("id", "DESC")->where("yorumcu", $this->session->userdata('id'))->get("fal_istekleri", $rowsperpage, $offset);

            $page_data["fal_list"] = $query->result_array();

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
            $page_data["fal_list"] = array();

        $this->load->view("back/yorumcu/falistekleri_list", $page_data);
    }

    public function falistekleri($fal_id = null, $action = null)
    {
        $page_data["profil"] = $this->profil;
        if ($fal_id == null)
        {
            $page_data["page_name"] = "falistekleri";
            $page_data["page_title"] = "Fal İstekleri";

            if (isset($_GET["pure"])){
                $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"]);
            }
            else
                $this->load->view("back/yorumcu/index", $page_data);
        }
        else
        {
            if (!is_numeric($fal_id)){
                show_404();
                return;
            }
            
            $query = $this->db->get_where("fal_istekleri", array("yorumcu" => $this->session->userdata('id'), "id" => $fal_id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($action == null)//view
                {
                    $page_data["fal_data"] = $query->row();

                    $page_data["fal_icerik"] = json_decode($query->row()->fal_icerik, true);

                    $page_data["page_name"] = "falistekleri_view";
                    $page_data["page_title"] = "Fal :". $query->row()->id. " - ". $query->row()->fal_turu;

                    if (isset($_GET["pure"])){
                        $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                        $this->fal->set_title_pure($page_data["page_title"]);
                    }
                    else
                        $this->load->view("back/yorumcu/index", $page_data);
                }
                elseif ($action == "cevapla")
                {
                    $page_data["fal_data"] = $query->row();

                    $page_data["fal_icerik"] = json_decode($query->row()->fal_icerik, true);

                    $page_data["page_name"] = "falistekleri_cevapla";
                    $page_data["page_title"] = "Fal cevapla";

                    if (isset($_GET["pure"])){
                        $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                        $this->fal->set_title_pure($page_data["page_title"]);
                    }
                    else
                        $this->load->view("back/yorumcu/index", $page_data);
                }
                elseif ($action == "cevap-gonder")
                {
                    $page_data["fal_data"] = $query->row();

                    $cevap = $this->input->post("cevap");

                    if ($this->fal->empty($cevap)){
                        echo "Cevap boş bırakılımaz!";
                        return;
                    }

                    $data = array("fal_cevap" => $cevap, "status" => 1);

                    $this->db->where(array("id" => $query->row()->id, "yorumcu" => $this->profil->id))->update("fal_istekleri", $data);
                    if ($this->db->affected_rows() > 0){
                        echo "success";
                        return;
                    }else
                        echo "Bilinmeyen bir hata oluştu!";
                }
                elseif ($action == "update")
                {
                    echo $this->shortener_model->update_url($query->row());
                }
                elseif ($action == "update-status")
                {
                    $this->db->where("id", $query->row()->id);
                    $this->db->where("yorumcu", $query->row()->yorumcu);
                    if ($query->row()->status == 0)
                        $data["status"] = 1;
                    else
                        $data["status"] = 0;
                    $query = $this->db->update("fal_istekleri", $data);
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
