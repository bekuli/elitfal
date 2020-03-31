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
        $this->load->helper('email');
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

    public function mesajlar()
    {
        $msgsessions = $this->fal->get_message_sessions($this->profil->id);
        foreach ($msgsessions as $key => $row) {
            $query = $this->db->get_where("users", array("id" => $row["user"]));
            if ($query !== false && $query->num_rows() > 0){
                $msgsessions[$key]["user"] = $query->row();
            }
        }
        $data["message_sessions"] = $msgsessions;

        $data["profil"] = $this->profil;
        $data["page_name"] = "mesajlar";
        $data["page_title"] = "Mesajlar";
        if (isset($_GET["pure"])){
            $this->load->view("back/yorumcu/".$data["page_name"], $data);
            $this->fal->set_title_pure($data["page_title"], true);
        }
        else
            $this->load->view("back/yorumcu/index", $data);
    }

    public function get_messages($user)
    {
        $session_check = $this->fal->check_message_session($user, $this->session->userdata("id"));
        if ($session_check == false)
        {
            echo "error";
            return;
        }

        $session = $this->fal->get_message_session($user, $this->session->userdata("id"));
        if ($session == false)
        {
            echo "error";
            return;
        }

        $messages = array();

        $msgs = $this->fal->get_messages_yorumcu($user, $this->session->userdata("id"), $session->id);
        if ($msgs !== false)
            $messages = $msgs;

        echo json_encode($messages);
    }

    public function send_message($user)
    {
        $msg = trim($this->input->post("message"));
        if ($this->fal->empty($msg))
        {
            echo "none";
            return;
        }

        $session_check = $this->fal->check_message_session($user, $this->session->userdata("id"));
        if ($session_check == false)
        {
            echo "error";
            return;
        }

        $session = $this->fal->get_message_session($user, $this->session->userdata("id"));
        if ($session == false)
        {
            echo "error";
            return;
        }

        $send = $this->fal->send_message_from_yorumcu($user, $this->session->userdata("id"), $msg, $session->id);
        if ($session == false)
        {
            echo "error";
            return;
        }else{
            echo "success";
        }
    }

    public function fal_istek_check()
    {
        $falcheck = $this->fal->check_any_fal_exists_yorumcu();
        if ($falcheck == false)
        {
            show_404();
            return;
        }

        $fals = $this->fal->check_fal_istekleri_status_0_unanswered();
        if ($fals == false)
        {
            echo "false";
            return;
        }

        $return_data = array();

        foreach ($fals as $row)
        {
            $data = array(
                "name" => $this->fal->fal_turu_name_to_org($row["fal_turu"]),
                "id" => $row["id"]
            );
            array_push($return_data, $data);
        }
         
         echo json_encode($return_data);
    }

    public function mesaj_check($id = false)
    {
        $session = $this->fal->check_any_message_available_yorumcu();
        if ($session == false)
        {
            echo "false";
            return;
        }

        $return_data = array();

        foreach ($session as $row)
        {
            $query = $this->db->get_where("users", array("id" => $row["user"]));
            if ($query !== false && $query->num_rows() > 0)
            {
                $data = array(
                    "name" => $query->row()->name." ".$query->row()->surname, 
                    "id" => $query->row()->id
                );

                if ($id == $query->row()->id)
                {
                    $msgs = $this->fal->get_new_messages_yorumcu($row["user"], $this->session->userdata("id"), $row["id"]);
                    if ($msgs !== false){
                        $data["messages"] = $msgs;
                        $data["message_list"] = "true";
                    }
                    else{
                        $data["messages"] = "false";
                        $data["message_list"] = "false";
                    }
                }

                array_push($return_data, $data);
            }
        }

        echo json_encode($return_data);
    }

    public function keep_online()
    {
        $this->db->where("id", $this->profil->id)->update("yorumcu", array("last_online" => date("Y-m-d H:i:s")));
    }

    public function yorumlar_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(comment, ' ', puan) like '%".$q."%'");
        }

        $totalrows = $this->db->where("yorumcu", $this->session->userdata('id'))->where("comment IS NOT NULL AND comment != ''")->count_all_results("fal_istekleri");

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
                $this->db->where("CONCAT(comment, ' ', puan) like '%".$q."%'");

            $query = $this->db->order_by("id", "DESC")->where("yorumcu", $this->session->userdata('id'))->where("comment IS NOT NULL AND comment != ''")->get("fal_istekleri", $rowsperpage, $offset);

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

        $this->load->view("back/yorumcu/yorumlar_list", $page_data);
    }

    public function yorumlar($fal_id = null, $action = null)
    {
        $page_data["profil"] = $this->profil;
        if ($fal_id == null)
        {
            $page_data["page_name"] = "yorumlar";
            $page_data["page_title"] = "Yorumlar";

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
                if ($action == "view")//view
                {
                    $page_data["fal_data"] = $query->row();
                    $page_data["page_name"] = "yorum_view";
                    $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                }
                elseif ($action == "delete")
                {
                    $this->db->where(array("id" => $query->row()->id))->update("fal_istekleri", array("comment" => "", "puan" => "0"));
                    if ($this->db->affected_rows() > 0)
                        echo "success";
                    else
                        echo "error";
                }else{
                    show_404();
                    return;
                }
            }
            else
            {
                show_404();
                return;
            }
        }
    }

    public function ayarlar($islem = null)
    {
        if ($islem == null)
        {
            $page_data["profil"] = $this->profil;
            $page_data["page_name"] = "ayarlar";
            $page_data["page_title"] = "Ayarlar";
            $page_data["profil"]->baktigi_fallar = $this->fal->yorumcu_baktigi_fallar($page_data["profil"]->baktigi_fallar);
            if (empty($this->profil->fiyat_listesi))
                $page_data["profil"]->fiyat_listesi = json_decode($this->fal->get_setting("fiyat_listesi"), true);
            else
                $page_data["profil"]->fiyat_listesi = json_decode($page_data["profil"]->fiyat_listesi, true);

            if (isset($_GET["pure"])){
                $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"]);
            }
            else
                $this->load->view("back/yorumcu/index", $page_data);
        }
        else if ($islem == "email")
        {
            $email = trim($this->input->post("email"));
            if (!valid_email($email))
            {
                echo "false";
            }else
            {
                if ($this->profil->email == $email)
                {
                    echo "success";
                    return;
                }
                $this->db->where("id", $this->profil->id)->update("yorumcu", array("email" => $email));
                if ($this->db->affected_rows() > 0){
                    echo "success";
                }else
                    echo "error";
            }
        }
        else if ($islem == "sifre")
        {
            $msifre = $this->input->post("msifre");
            $ysifre = $this->input->post("ysifre");
            $ysifre_tekrar = $this->input->post("ysifre_tekrar");
            if (empty($msifre) || empty($ysifre) || empty($ysifre_tekrar))
            {
                echo "empty";
                return;
            }

            if ($ysifre !== $ysifre_tekrar)
            {
                echo "no_match";
                return;
            }

            if ($this->profil->password !== sha1($msifre)){
                echo "no_match_org";
                return;
            }

            if (sha1($msifre) == sha1($ysifre))
            {
                echo "success";
                return;
            }

            $this->db->where("id", $this->profil->id)->update("yorumcu", array("password" => sha1($ysifre)));
            if ($this->db->affected_rows() > 0){
                echo "success";
            }else
                echo "error";
        }
        else if ($islem == "baktigim-fallar")
        {
            $data = array();

            if (isset($_POST["kahve_fali"]))
                $data["kahve_fali"] = "";

            if (isset($_POST["tarot_fali"]))
                $data["tarot_fali"] = "";

            if (isset($_POST["yildizname"]))
                $data["yildizname"] = "";

            if (isset($_POST["ruya_yorumu"]))
                $data["ruya_yorumu"] = "";

            if (isset($_POST["katina_fali"]))
                $data["katina_fali"] = "";

            if (isset($_POST["su_fali"]))
                $data["su_fali"] = "";

            if (isset($_POST["dert_ortagi"]))
                $data["dert_ortagi"] = "";

            $data = json_encode($data);

            if ($data == $this->profil->baktigi_fallar)
            {
                echo "success";
                return;
            }

            $this->db->where("id", $this->profil->id)->update("yorumcu", array("baktigi_fallar" => $data));
            if ($this->db->affected_rows() > 0){
                echo "success";
            }else
                echo "error";

        }
        else if ($islem == "fiyat-listesi")
        {
            $data["kahve_fali"] = $this->input->post("kahve_fali");
            $data["tarot_fali"] = $this->input->post("tarot_fali");
            $data["yildizname"] = $this->input->post("yildizname");
            $data["ruya_yorumu"] = $this->input->post("ruya_yorumu");
            $data["katina_fali"] = $this->input->post("katina_fali");
            $data["su_fali"] = $this->input->post("su_fali");
            $data["dert_ortagi"] = $this->input->post("dert_ortagi");

            foreach ($data as $row)
            {
                if ($this->fal->empty($row))
                {
                    echo "false";
                    return;
                }

                if (!is_numeric($row))
                {
                    echo "false_n";
                    return;
                }
            }

            $data = json_encode($data);
            if ($data == $this->fal->get_setting("fiyat_listesi"))
            {
                if ($this->profil->fiyat_listesi !== $data)
                {
                    $this->db->where("id", $this->profil->id)->update("yorumcu", array("fiyat_listesi" => ""));
                    if ($this->db->affected_rows() > 0){
                        echo "success";
                        return;
                    }else
                    {
                        echo "error";
                        return;
                    }
                }
                else
                    echo "success";
                return;
            }

            if ($this->profil->fiyat_listesi == $data)
            {
                echo "success";
                return;
            }

            $this->db->where("id", $this->profil->id)->update("yorumcu", array("fiyat_listesi" => $data));
            if ($this->db->affected_rows() > 0){
                echo "success";
                return;
            }

            echo "error";
        }
        else{
            show_404();
        }
    }

    public function profil($islem = null)
    {
        if ($islem == null)
        {
            $page_data["profil"] = $this->profil;
            $page_data["page_name"] = "profil";
            $page_data["page_title"] = "Profil";

            if (isset($_GET["pure"])){
                $this->load->view("back/yorumcu/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"]);
            }
            else
                $this->load->view("back/yorumcu/index", $page_data);
        }else if ($islem == "pp-change")
        {
            if (isset($_POST["image"]))
            {
                $imgdata = $_POST["image"];
                $image_array_1 = explode(";", $imgdata);
                $image_array_2 = explode(",", $image_array_1[1]);
                $imgdata = base64_decode($image_array_2[1]);
                $img_rname = random_string('alnum', 12).".png";
                $image_name = "./uploads/".$img_rname;
                file_put_contents($image_name, $imgdata);
                $return = base_url()."uploads/".$img_rname;

                $this->db->where("id", $this->profil->id)->update("yorumcu", array("pp" => $img_rname));
                if ($this->db->affected_rows() > 0)
                {
                    echo "success.".$return;
                    if (!empty($this->profil->pp))
                        unlink("./uploads/".$this->profil->pp);
                }else{
                    echo "error";
                    unlink($image_name);
                }
            }
            else{
                show_404();
            }
        }
        else if ($islem = "profil-bilgileri")
        {
            $isim = $this->input->post("name");
            $kack = $this->input->post("aciklama");
            $uack = $this->input->post("aciklama_uzun");

            if (empty($isim) || empty($kack) || empty($uack))
            {
                echo "false";
                return;
            }

            if (strlen($kack) > 130)
            {
                echo "long";
                return;
            }

            $this->db->where("id", $this->profil->id)->update("yorumcu", array("name" => $isim, "aciklama" => $kack, "aciklama_uzun" => $uack));

            if ($this->db->affected_rows() > 0)
            {
                echo "success";
            }else{
                echo "error";
            }
        }
        else{
            show_404();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

}
