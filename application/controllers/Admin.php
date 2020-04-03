<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->library('session');
        $this->load->model('fal');
        $this->load->model('charts');

        if ($this->fal->check_admin_login() == false)
        {
            show_404();
            return;
        }
    }

	public function index()
	{
        $data["chart"]["fallar"]["today"] = $this->charts->fallar("today");
        $data["chart"]["fallar"]["all"] = $this->charts->fallar(null);
        $data["chart"]["kredi"]["today"] = $this->charts->kredi("today");
        $data["chart"]["kredi"]["all"] = $this->charts->kredi(null);
        $data["chart"]["uye"]["today"] = $this->charts->uyeler("today");
        $data["chart"]["uye"]["all"] = $this->charts->uyeler(null);
        $data["chart"]["hits"]["today"] = $this->charts->hits(null);
        $data["chart"]["hits"]["all"] = $this->charts->hits(null);

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
                if ($action == "view")
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
                else if ($action == "kredi-ekle")
                {
                    $kredi = $this->input->post("kredi");
                    if (!is_numeric($kredi)){
                        echo "error";
                        return;
                    }

                    $kredi_gonder = $this->fal->kredi("admin-deposit", "user", $user_id, $kredi);
                    if ($kredi_gonder == true)
                        echo "success";
                    else
                        echo "error";
                }
                else if ($action == "kredi-azalt-update")
                {
                    $kredi = $this->input->post("kredi");
                    if (!is_numeric($kredi)){
                        echo "error";
                        return;
                    }

                    if ($query->row()->kredi < $kredi){
                        echo "max";
                        return;
                    }

                    $kredi_gonder = $this->fal->kredi("admin-withdraw", "user", $user_id, $kredi);
                    if ($kredi_gonder == true)
                        echo "success";
                    else
                        echo "error";
                }
                else if ($action == "kredi-azalt")
                {
                    $page_data["user_data"] = $query->row();
                    $page_data["kredi"] = $query->row()->kredi;
                    $page_data["page_name"] = "user_kredi_azalt";
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

    public function yorumcular_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(name, ' ', email) like '%".$q."%'");
        }

        $totalrows = $this->db->count_all_results("yorumcu");

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

            $query = $this->db->order_by("id", "DESC")->get("yorumcu", $rowsperpage, $offset);

            $page_data["yorumcular_list"] = $query->result_array();

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
            $page_data["yorumcular_list"] = array();


        $this->load->view("back/admin/yorumcular_list", $page_data);
    }

    public function yorumcular($id = null, $action = null)
    {
        if ($id == null)
        {
            $page_data["page_name"] = "yorumcular";
            $page_data["page_title"] = "Yorumcular";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }
        else
        {
            if (!is_numeric($id)){
                if ($id == "ekle-view")
                {
                    $page_data["page_name"] = "yorumcular_ekle";
                    $page_data["fal_fiyat"] = json_decode($this->fal->get_setting("fiyat_listesi"), true);
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                    return;
                }elseif ($id == "ekle")
                {
                    if (isset($_POST["email"]))
                    {
                        
                        $isim = $this->input->post("name");
                        $email = $this->input->post("email");
                        $kack = $this->input->post("aciklama");
                        $uack = $this->input->post("aciklama_uzun");
                        $pp = $this->input->post("image");

                        if (empty($isim) || empty($kack) || empty($uack) || empty($email) || empty($pp))
                        {
                            echo "false";
                            return;
                        }

                        if (strlen($kack) > 130)
                        {
                            echo "long";
                            return;
                        }

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

                        $dataf["kahve_fali"] = $this->input->post("fiyat_kf");
                        $dataf["tarot_fali"] = $this->input->post("fiyat_tf");
                        $dataf["yildizname"] = $this->input->post("fiyat_yn");
                        $dataf["ruya_yorumu"] = $this->input->post("fiyat_ry");
                        $dataf["katina_fali"] = $this->input->post("fiyat_ktf");
                        $dataf["su_fali"] = $this->input->post("fiyat_sf");
                        $dataf["dert_ortagi"] = $this->input->post("fiyat_do");

                        foreach ($dataf as $row)
                        {
                            if ($this->fal->empty_fal($row))
                            {
                                echo "false";
                                return;
                            }
                        }

                        $data = json_encode($data);
                        $dataf = json_encode($dataf);

                        $udata = array(
                            "name" => $isim,
                            "email" => $email,
                            "aciklama" => $kack,
                            "aciklama_uzun" => $uack,
                            "fiyat_listesi" => $dataf,
                            "baktigi_fallar" => $data,
                            "status" => 1,
                            "tarih" => date("Y-m-d"),
                            "last_online" => null
                        );

                        $udata["password"] = sha1($_POST["password"]);

                        $imgdata = $pp;
                        $image_array_1 = explode(";", $imgdata);
                        $image_array_2 = explode(",", $image_array_1[1]);
                        $imgdata = base64_decode($image_array_2[1]);
                        $img_rname = random_string('alnum', 12).".png";
                        $image_name = "./uploads/".$img_rname;
                        file_put_contents($image_name, $imgdata);
                        $udata["pp"] = $img_rname;

                        $this->db->insert("yorumcu", $udata);
                        if ($this->db->affected_rows() > 0)
                        {
                            echo "success";
                        }else
                        echo "error";
                        return;
                    }
                }
                else{
                    show_404();
                    return;
                }
            }

            $query = $this->db->get_where("yorumcu", array("id" => $id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($action == "view")
                {
                    $page_data["yorumcu_data"] = $query->row();
                    $page_data["page_name"] = "yorumcular_view";
                    if (empty($page_data["yorumcu_data"]->fiyat_listesi))
                        $page_data["yorumcu_data"]->fiyat_listesi = json_decode($this->fal->get_setting("fiyat_listesi"), true);
                    else
                        $page_data["yorumcu_data"]->fiyat_listesi = json_decode($page_data["yorumcu_data"]->fiyat_listesi, true);
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                elseif ($action == "edit")
                {
                    $page_data["page_name"] = "yorumcular_edit";
                    $page_data["yorumcu_data"] = $query->row();
                    if (empty($page_data["yorumcu_data"]->fiyat_listesi))
                        $page_data["yorumcu_data"]->fiyat_listesi = json_decode($this->fal->get_setting("fiyat_listesi"), true);
                    else
                        $page_data["yorumcu_data"]->fiyat_listesi = json_decode($page_data["yorumcu_data"]->fiyat_listesi, true);
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                elseif ($action == "pp-change")
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

                        $this->db->where("id", $id)->update("yorumcu", array("pp" => $img_rname));
                        if ($this->db->affected_rows() > 0)
                        {
                            echo "success.".$return;
                            if (!empty($query->row()->pp))
                                unlink("./uploads/".$query->row()->pp);
                        }else{
                            echo "error";
                            unlink($image_name);
                        }
                    }
                    else{
                        show_404();
                    }
                }
                elseif ($action == "update")
                {
                    if (isset($_POST["email"]))
                    {
                        
                        $isim = $this->input->post("name");
                        $email = $this->input->post("email");
                        $kack = $this->input->post("aciklama");
                        $uack = $this->input->post("aciklama_uzun");

                        if (empty($isim) || empty($kack) || empty($uack) || empty($email))
                        {
                            echo "false";
                            return;
                        }

                        if (strlen($kack) > 130)
                        {
                            echo "long";
                            return;
                        }

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

                        $dataf["kahve_fali"] = $this->input->post("fiyat_kf");
                        $dataf["tarot_fali"] = $this->input->post("fiyat_tf");
                        $dataf["yildizname"] = $this->input->post("fiyat_yn");
                        $dataf["ruya_yorumu"] = $this->input->post("fiyat_ry");
                        $dataf["katina_fali"] = $this->input->post("fiyat_ktf");
                        $dataf["su_fali"] = $this->input->post("fiyat_sf");
                        $dataf["dert_ortagi"] = $this->input->post("fiyat_do");

                        foreach ($dataf as $row)
                        {
                            if ($this->fal->empty_fal($row))
                            {
                                echo "false";
                                return;
                            }
                        }

                        $data = json_encode($data);
                        $dataf = json_encode($dataf);

                        $udata = array(
                            "name" => $isim,
                            "email" => $email,
                            "aciklama" => $kack,
                            "aciklama_uzun" => $uack,
                            "fiyat_listesi" => $dataf,
                            "baktigi_fallar" => $data
                        );

                        if (!empty($_POST["password"]))
                            $udata["password"] = sha1($_POST["password"]);

                        $this->db->where("id", $query->row()->id)->update("yorumcu", $udata);
                        echo "success";

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
                    $query = $this->db->update("yorumcu", $data);
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }
                elseif ($action == "delete")
                {
                    $this->db->where("id", $query->row()->id);
                    $query = $this->db->delete("yorumcu");
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }else if ($action == "kredi-ekle")
                {
                    $kredi = $this->input->post("kredi");
                    if (!is_numeric($kredi)){
                        echo "error";
                        return;
                    }

                    $kredi_gonder = $this->fal->kredi("admin-deposit", "yorumcu", $id, $kredi);
                    if ($kredi_gonder == true)
                        echo "success";
                    else
                        echo "error";
                }
                else if ($action == "kredi-azalt-update")
                {
                    $kredi = $this->input->post("kredi");
                    if (!is_numeric($kredi)){
                        echo "error";
                        return;
                    }

                    if ($query->row()->kredi < $kredi){
                        echo "max";
                        return;
                    }

                    $kredi_gonder = $this->fal->kredi("admin-withdraw", "yorumcu", $id, $kredi);
                    if ($kredi_gonder == true)
                        echo "success";
                    else
                        echo "error";
                }
                else if ($action == "kredi-azalt")
                {
                    $page_data["user_data"] = $query->row();
                    $page_data["kredi"] = $query->row()->kredi;
                    $page_data["page_name"] = "yorumcu_kredi_azalt";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
            }
            else
            {
                show_404();
                return;
            }
        }
    }

    public function get_chart_data()
    {
        $chartdata1 = $this->charts->fallar("monthly");
        $chartdata2 = $this->charts->kredi("monthly");
        $chartdata3 = $this->charts->uyeler("monthly");
        $chartdata4 = $this->charts->hits("monthly");

        $data = array(
            "fallar" => $chartdata1,
            "kredi" => $chartdata2,
            "uyeler" => $chartdata3,
            "hits" => $chartdata4
        );

        echo json_encode($data);
    }

    public function ayarlar($islem = null)
    {
        if ($islem == null)
        {
            $page_data["fal_fiyat"] = json_decode($this->fal->get_setting("fiyat_listesi"), true);
            $page_data["page_name"] = "ayarlar";
            $page_data["page_title"] = "Ayarlar";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }elseif ($islem == "email")
        {
            $email = trim($this->input->post("email"));
            if (!valid_email($email))
            {
                echo "false";
            }else
            {
                if ($this->fal->get_setting("admin_eposta") == $email)
                {
                    echo "success";
                    return;
                }
                $query = $this->fal->set_setting("admin_eposta", $email);
                if ($query == true){
                    echo "success";
                    return;
                }
                echo "error";
            }
        }else if ($islem == "sifre")
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

            if ($this->fal->get_setting("admin_sifre")!== sha1($msifre)){
                echo "no_match_org";
                return;
            }

            if (sha1($msifre) == sha1($ysifre))
            {
                echo "success";
                return;
            }

            $query = $this->fal->set_setting("admin_sifre", sha1($ysifre));
            if ($query == true){
                echo "success";
                return;
            }
            echo "error";
        }else if ($islem == "fiyat-listesi")
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
                if ($this->fal->empty_fal($row))
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
            if ($data !== $this->fal->get_setting("fiyat_listesi"))
            {
                $query = $this->fal->set_setting("fiyat_listesi", $data);
                if ($query == true){
                    echo "success";
                    return;
                }
                echo "error";
            }else{
                echo "success";
            }

        }elseif ($islem == "komisyon")
        {
            $komisyon = trim($this->input->post("komisyon"));
            if (!is_numeric($komisyon))
            {
                echo "false";
            }else
            {
                if ($this->fal->get_setting("komisyon") == $komisyon)
                {
                    echo "success";
                    return;
                }
                $query = $this->fal->set_setting("komisyon", $komisyon);
                if ($query == true){
                    echo "success";
                    return;
                }
                echo "error";
            }
        }
    }

    public function yorumcu_basvurulari_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(name, ' ', email) like '%".$q."%'");
        }

        $totalrows = $this->db->count_all_results("yorumcu_basvurulari");

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

            $query = $this->db->order_by("tarih", "DESC")->get("yorumcu_basvurulari", $rowsperpage, $offset);

            $page_data["basvuru_list"] = $query->result_array();

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
            $page_data["basvuru_list"] = array();


        $this->load->view("back/admin/yorumcu_basvurulari_list", $page_data);
    }

    public function yorumcu_basvurulari($id = null, $action = null)
    {
        if ($id == null)
        {
            $page_data["page_name"] = "yorumcu_basvurulari";
            $page_data["page_title"] = "Yorumcu Başvuruları";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }
        else
        {
            if (!is_numeric($id)){
                show_404();
                return;
            }

            $query = $this->db->get_where("yorumcu_basvurulari", array("id" => $id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($action == "delete")
                {
                    $this->db->where("id", $query->row()->id);
                    $query = $this->db->delete("yorumcu_basvurulari");
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }elseif ($action == "view")
                {
                    $page_data["data"] = $query->row();
                    $page_data["page_name"] = "yorumcu_basvurulari_view";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                else{
                    show_404();
                }
            }
        }
    }

    public function iletisim_list($page = 1, $q = "")
    {
        if ($q !== ""){
            $q = filter_var($q, FILTER_SANITIZE_STRING);
            $this->db->where("CONCAT(name, ' ', email) like '%".$q."%'");
        }

        $totalrows = $this->db->count_all_results("iletisim");

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

            $query = $this->db->order_by("tarih", "DESC")->get("iletisim", $rowsperpage, $offset);

            $page_data["iletisim_list"] = $query->result_array();

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
            $page_data["iletisim_list"] = array();


        $this->load->view("back/admin/iletisim_list", $page_data);
    }


    public function iletisim($id = null, $action = null)
    {
        if ($id == null)
        {
            $page_data["page_name"] = "iletisim";
            $page_data["page_title"] = "İletişim";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }
        else
        {
            if (!is_numeric($id)){
                show_404();
                return;
            }

            $query = $this->db->get_where("iletisim", array("id" => $id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($action == "delete")
                {
                    $this->db->where("id", $query->row()->id);
                    $query = $this->db->delete("iletisim");
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }elseif ($action == "view")
                {
                    $page_data["data"] = $query->row();
                    $page_data["page_name"] = "iletisim_view";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }
                else{
                    show_404();
                }
            }
        }
    }

    public function odeme_gecmisi_list($page = 1, $q = '')
    {
        $totalrows = $this->db->count_all_results("odeme_log");

        if ($totalrows > 0)
        {
            $rowsperpage = 10;
            $totalpages = ceil($totalrows / $rowsperpage);

            if ($page > $totalpages)
               $page = $totalpages;

            if ($page < 1) 
               $page = 1;

            $offset = ($page - 1) * $rowsperpage;

            $query = $this->db->order_by("tarih", "DESC")->get("odeme_log", $rowsperpage, $offset);

            $page_data["odeme_list"] = $query->result_array();

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
            $page_data["odeme_list"] = array();

        $this->load->view("back/admin/odeme_gecmisi_list", $page_data);
    }

    public function withdraw_requests_list($page = 1, $q = '')
    {
        $totalrows = $this->db->count_all_results("withdraw_requests");

        if ($totalrows > 0)
        {
            $rowsperpage = 10;
            $totalpages = ceil($totalrows / $rowsperpage);

            if ($page > $totalpages)
               $page = $totalpages;

            if ($page < 1) 
               $page = 1;

            $offset = ($page - 1) * $rowsperpage;

            $query = $this->db->order_by("tarih", "DESC")->get("withdraw_requests", $rowsperpage, $offset);

            $page_data["withdraw_list"] = $query->result_array();

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
            $page_data["withdraw_list"] = array();

        $this->load->view("back/admin/withdraw_requests_list", $page_data);
    }

    public function odemeler($id = null, $islem = null)
    {
        if ($id == null)
        {
            $page_data["page_name"] = "odemeler";
            $page_data["page_title"] = "Ödemeler";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"]);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }else
        {
            if ($islem == "withdraw_answer")
            {
                $msg = $this->input->post("sonuc");
                if (empty($msg))
                {
                    echo "false";
                    return;
                }

                $query = $this->db->get_where("withdraw_requests", array("id" => $id));
                if ($query == false || $query->num_rows() < 0)
                {
                    echo "error";
                    return;
                }

                $this->db->where("id", $id)->update("withdraw_requests", array("sonuc" => $msg));
                if ($this->db->affected_rows() > 0){
                    echo "success";
                    return;
                } 

                echo "error";
            }
        }
    }

    public function kredi_list($page = 1, $q = "")
    {
        $totalrows = $this->db->count_all_results("kredi_listesi");

        if ($totalrows > 0)
        {
            $rowsperpage = 10;
            $totalpages = ceil($totalrows / $rowsperpage);

            if ($page > $totalpages)
                $page = $totalpages;

            if ($page < 1)
                $page = 1;

            $offset = ($page - 1) * $rowsperpage;


            $query = $this->db->get("kredi_listesi", $rowsperpage, $offset);

            $page_data["kredi_list"] = $query->result_array();

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
            $page_data["kredi_list"] = array();


        $this->load->view("back/admin/kredi_list", $page_data);
    }

    public function kredi($id = null, $islem = null)
    {
        if ($id == null)
        {
            $page_data["page_name"] = "kredi";
            $page_data["page_title"] = "Kredi";

            if (isset($_GET["pure"])){
                $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                $this->fal->set_title_pure($page_data["page_title"], true);
            }
            else
                $this->load->view("back/admin/index", $page_data);
        }
        else
        {
            if (!is_numeric($id)){
                if ($id == "ekle-view")
                {
                    $page_data["page_name"] = "kredi_ekle";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                    return;
                }elseif ($id == "ekle")
                {
                    $fiyat = trim($this->input->post("fiyat"));
                    $aciklama = trim($this->input->post("aciklama"));
                    $kredi = trim($this->input->post("kredi"));

                    if ($this->fal->empty_fal($fiyat) || $this->fal->empty_fal($kredi)){
                        echo "false";
                        return;
                    }

                    if (!is_numeric($fiyat) || !is_numeric($kredi)){
                        echo "number";
                        return;
                    }

                    $data = array(
                        "fiyat" => $fiyat,
                        "aciklama" => $aciklama,
                        "kredi" => $kredi
                    );

                    $this->db->insert("kredi_listesi", $data);
                    if ($this->db->affected_rows() > 0){
                        echo "success";
                    }else
                    echo "error";
                }
            }

            $query = $this->db->get_where("kredi_listesi", array("id" => $id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if ($islem == "delete")
                {
                    $this->db->where("id", $query->row()->id);
                    $query = $this->db->delete("kredi_listesi");
                    if ($query !== false)
                        echo "success";
                    else
                        echo "error";
                }elseif ($islem == "edit")
                {
                    $page_data["data"] = $query->row();
                    $page_data["page_name"] = "kredi_edit";
                    $this->load->view("back/admin/".$page_data["page_name"], $page_data);
                }elseif ($islem == "update")
                {
                    $fiyat = trim($this->input->post("fiyat"));
                    $aciklama = trim($this->input->post("aciklama"));
                    $kredi = trim($this->input->post("kredi"));

                    if ($this->fal->empty_fal($fiyat) || $this->fal->empty_fal($kredi)){
                        echo "false";
                        return;
                    }

                    if (!is_numeric($fiyat) || !is_numeric($kredi)){
                        echo "number";
                        return;
                    }

                    $data = array(
                        "fiyat" => $fiyat,
                        "aciklama" => $aciklama,
                        "kredi" => $kredi
                    );

                    $this->db->where("id", $id)->update("kredi_listesi", $data);
                    if ($this->db->affected_rows() > 0){
                        echo "success";
                    }else
                    echo "error";
                }
                else{
                    show_404();
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
}
