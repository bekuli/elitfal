<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_control extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->library('session');
        $this->load->model('fal');
    }
	
    public function index()
    {
        show_404();
    }

    public function page_control()
    {
        switch ($this->uri->segment(1))
        {
            case "giris":
                if ($this->fal->check_login() == false)
                    $this->giris();
                else
                    redirect(base_url()."profil");
                return;
            case "logout":
                $this->session->sess_destroy();
                redirect(base_url());
            break;
            case "giris-ajax":
                if ($this->fal->check_login() == false)
                    $this->giris_ajax();
                return;
            case "kayit":
                $this->kayit();
                return;
            case "yorumcular":
                $this->yorumcular();
                return;
            case "yorumcu-ol":
                $this->yorumcu_ol();
                return;
            case "iletisim":
                $this->iletisim();
                return;
            case "fal-gonder":
                $yorumcu = $this->uri->segment(2);
                $query = $this->db->get_where("yorumcu", array("id" => $yorumcu, "status" => "1"));
                if ($query == false || $query->num_rows() == 0)
                {
                    show_404();
                    return;
                }

                $this->fal_gonder_redirect($yorumcu, $this->uri->segment(3));

                return;
                break;
            case "odeme":
                 if ($this->fal->check_login() == false)
                 {
                    show_404();
                    return;
                 }

                $islem = $this->uri->segment(2);
                if ($islem == "fal")
                {
                    $id = $this->uri->segment(3);

                    if ($id == null)
                    {
                        show_404();
                        return;
                    }
                    $this->odeme_fal($id);
                    return;

                }else{
                    $id = $this->uri->segment(2);
                    if ($id == null)
                    {
                        
                        return;
                    }
                    $this->odeme_kredi($id);
                    return;
                }
                break;
            case "kredi-satin-al":

                $this->kredi_satin_al();
                return;
                break;
            case "profil":
                if ($this->fal->check_login() == false)
                {
                    show_404();
                    return;
                }

                if($this->uri->segment(2) == "ayarlar")
                {
                    $this->profil_ayarlar();
                    return;
                }
                else if ($this->uri->segment(2) == "get-data"){
                    $this->get_user_data();
                    return;
                }else if ($this->uri->segment(2) == "cevap"){
                    $id = $this->uri->segment(3);

                    if ($id == null)
                    {
                        show_404();
                        return;
                    }
                    $this->cevaplanmis_fal($id);
                    return;
                }else{
                    $this->profil();
                    return;
                }
                break;
            default :
                show_404();
                break;
        }
    }

    public function giris()
    {
        if (isset($_POST["email"]) && isset($_POST["password"]))
        {
            $email = $this->input->post("email");
            $password = sha1($this->input->post("password"));

            if (valid_email($email))
            {
                
                $query = $this->db->get_where("users", array("email"=>$email));
                if ($query !== false && $query->num_rows() > 0)
                {
                    if ($query->row()->password == $password)
                    {
                        $this->session->set_userdata("user_login", "yes");
                        $this->session->set_userdata("id", $query->row()->id);
                        redirect(base_url()."profil");
                        return;
                    }
                }
                
                $query = $this->db->get_where("yorumcu", array("email"=>$email));
                if ($query !== false && $query->num_rows() > 0)
                {
                    if ($query->row()->password == $password)
                    {
                        $this->session->set_userdata("yorumcu_login", "yes");
                        $this->session->set_userdata("id", $query->row()->id);
                        redirect(base_url()."yorumcu");
                        return;
                    }
                }

                if ($this->fal->get_setting("admin_eposta") == $email)
                {
                    if ($this->fal->get_setting("admin_sifre") == $password)
                    {
                        $this->session->set_userdata("admin_login", "yes");
                        redirect(base_url()."admin");
                        return;
                    }
                }

                $data["error"] = "eposta veya şifre yanlış!";
            }
            else
            {
                $data["error"] = "Email adresi doğru bir email adresi değil!";
            }
        }

        $data["c"] = "c";

        $this->load->view('front/top');
        $this->load->view('front/giris', $data);
    }
    
    public function kayit()
    {
        $data["a"] = "a";
        $this->load->view('front/top');
        $this->load->view('front/kayit', $data);
    }

    public function giris_ajax(){
        if (isset($_POST["email"]) && isset($_POST["password"]))
        {
            $email = $this->input->post("email");
            $password = sha1($this->input->post("password"));

            if (empty($email) ||empty($this->input->post("password")))
            {
                echo "bos";
                return;
            }

            if (valid_email($email))
            {
                
                $query = $this->db->get_where("users", array("email"=>$email));
                if ($query !== false && $query->num_rows() > 0)
                {
                    if ($query->row()->password == $password)
                    {
                        $this->session->set_userdata("user_login", "yes");
                        $this->session->set_userdata("id", $query->row()->id);
                        echo "success.".$query->row()->password;
                        return;
                    }
                }

                echo "hata";
            }else
                echo "email";
        }else
        echo "error";
    }

    public function get_user_data()
    {
        $query = $this->db->get_where("users", array("id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            $data = array(
                "id" => $query->row()->id,
                "name" => $query->row()->name,
                "surname" => $query->row()->surname
            );

            echo json_encode($data);
            return;
        }
        echo "error";
    }

    public function yorumcular()
    {
        $id = $this->uri->segment(2);
        $islem = $this->uri->segment(3);

        if ($islem !== null)
        {
            $query = $this->db->get_where("yorumcu", array("id" => $id, "status" => "1"));
            if ($query !== false && $query->num_rows() > 0)
            {
                $data["yorumcu"] = $query->row();

            }
            else{
                show_404();
                return;
            }


            switch ($islem) {
                case 'katina-fali':
                    $data["faladi"] = "Katina Falı";
                    $data["falsayfasi"] = "katina-fali";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'kahve-fali':
                    $data["faladi"] = "Kahve Falı";
                    $data["falsayfasi"] = "kahve-fali";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'tarot-fali':
                    $data["faladi"] = "Tarot Falı";
                    $data["falsayfasi"] = "tarot-fali";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'su-fali':
                    $data["faladi"] = "Su Falı";
                    $data["falsayfasi"] = "su-fali";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'yildizname':
                    $data["faladi"] = "Yıldızname";
                    $data["falsayfasi"] = "yildizname";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'ruya-yorumu':
                    $data["faladi"] = "Rüya Yorumu";
                    $data["falsayfasi"] = "ruya-yorumu";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;

                case 'dert-ortagi':
                    $data["faladi"] = "Dert Ortağı";
                    $data["falsayfasi"] = "dert-ortagi";
                    $data["page"] = "fal-sayfasi";
                    $this->load->view('front/index', $data);
                    break;
                
                default:
                    show_404();
                    break;
            }
            return;
        }

        if ($id == null){
            $query = $this->db->get_where("yorumcu", array("status" => "1"));

            if ($query !== false && $query->num_rows() > 0){
                $data["yorumcular"] = $query->result_array();
            }else
                $data["yorumcular"] = array();

            $data["page"] = "yorumcular";
            $this->load->view('front/index', $data);
        }
        else
        {
            $query = $this->db->get_where("yorumcu", array("id" => $id, "status" => "1"));
            if ($query !== false && $query->num_rows() > 0)
            {
                $data["yorumcu"] = $query->row();
                $data["page"] = "yorumcu";
                $this->load->view('front/index', $data);
            }
            else{
                show_404();
            }
        }
    }

    public function odeme_fal($id)
    {
        $query = $this->db->get_where("fal_istekleri", array("user_id" => $this->session->userdata("id"), "perma" => $id, "status" => "2"));
        if ($query !== false && $query->num_rows() > 0)
        {
            $data["kredi"] = $query->row()->odeme;
            $data["perma"] = $id;

            $odeme_turu = $this->uri->segment(4);

            if ($odeme_turu !== null)
            {
                if ($odeme_turu == "kredi")
                {
                    $query1 = $this->db->get_where("users", array("id" => $this->session->userdata("id"), "status" => 1));
                    if ($query1 !== false && $query1->num_rows() > 0)
                    {
                        $odeme_sonucu = 0;
                        if ($query1->row()->kredi >= $query->row()->odeme)
                        {
                            $updatedata = array(
                                "kredi" => $query1->row()->kredi - $query->row()->odeme,
                            );

                            $updatedata2 = array(
                                "status" => 0
                            );

                            //$this->db->where("id", $this->session->userdata("id"))->update("users", $updatedata);
                            //$this->db->where("perma", $id)->update("fal_istekleri", $updatedata2);

                            $data["page"] = "odeme_basarili";
                            $data["neden"] = "Hesabınızdan kredi başarıyla çekildi!";
                            $this->load->view("front/index", $data);
                            $odeme_sonucu = 1;
                        }
                        else
                        {
                            $data["page"] = "odeme_basarisiz";
                            $data["neden"] = "Kredi bakiyeniz yetersiz!";
                            $this->load->view("front/index", $data);
                        }

                        $this->db->insert("odeme_log", array(
                            "yorumcu" => $query->row()->yorumcu,
                            "fal_id" => $query->row()->id,
                            "miktar" => $query->row()->odeme,
                            "odeme_turu" => 1,
                            "odeme_sonucu" => 1,
                            "tarih" => date("Y-m-d"),
                        ));

                        return;
                    }
                    else{
                        show_404();
                        return;
                    }
                }
            }

            $data["page"] = "odeme_fal";
            $this->load->view("front/index", $data);
        }
        else
            show_404();
    }

    public function kredi_satin_al()
    {
        $query = $this->db->get("kredi_listesi");
        if ($query !== false && $query->num_rows() > 0)
        {
            $data["krediler"] = $query->result_array();
            $data["page"] = "kredi_satin_al";
            $this->load->view("front/index", $data);
        }
        else
        {
            show_404();
        }
    }

    public function odeme_kredi($id)
    {
        $query = $this->db->get_where("kredi_listesi", array("id" => $id));
        if ($query !== false && $query->num_rows() > 0)
        {
            $data["odeme"] = $query->row();
            $data["page"] = "kredi_odeme";
            $this->load->view("front/index", $data);
        }else
        {
            show_404();
        }
    }

    public function profil()
    {
        $query = $this->db->get_where("users", array("id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            $data["profil"] = $query->row();

            $data["bekleyen_fallar"] = array();
            $data["bakilan_fallar"] = array();

            $query = $this->db->get_where("fal_istekleri", array("user_id" => $query->row()->id));
            if ($query !== false && $query->num_rows() > 0)
            {
                $fallar = $query->result_array();
                foreach ($fallar as $key => $row)
                {
                    $yorumcu = array("id", "pp", "name");
                    $query1 = $this->db->get_where("yorumcu", array("id" => $row["yorumcu"]));
                    if ($query1 !== false && $query1->num_rows() > 0)
                    {
                        $yorumcu["id"] = $query1->row()->id;
                        $yorumcu["pp"] = $query1->row()->pp;
                        $yorumcu["name"] = $query1->row()->name;
                    }
                    $fallar[$key]["yorumcu"] = $yorumcu;

                    if ($row["status"] == "1")
                    {
                        array_push($data["bakilan_fallar"], $fallar[$key]);
                    }else{
                        array_push($data["bekleyen_fallar"], $fallar[$key]);
                    }
                }
            }

            $data["page"] = "profil";
            $this->load->view("front/index", $data);
        }
        else
        {
            show_404();
        }
    }

    public function profil_ayarlar()
    {
        $query = $this->db->get_where("users", array("id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            $data["profil"] = $query->row();
            $data["page"] = "profil_ayarlar";
            $this->load->view("front/index", $data);
        }
        else
        {
            show_404();
        }
    }

    public function fal_gonder_redirect($yorumcu, $id)
    {
        switch ($id) {
            case 'dert-ortagi':
                $this->fal_gonder($yorumcu, "dert_ortagi", array("soru" => "soru"));
                break;

            case 'ruya-yorumu':
                $this->fal_gonder($yorumcu, "ruya_yorumu", array("soru" => "soru"));
                break;

            case 'yildizname':
                $fields = array(
                    "soru" => "soru",
                    "acilim" => "acilim",
                );

                if ($this->fal->empty($fields["acilim"]))
                {
                    echo "acilim";
                    return;
                }

                if ($this->fal->equals_sme($_POST["acilim"], array(1,0))){
                    show_404();
                    return;
                }

                $arrayfields = array(
                    "dogum_bilgileri" => array(
                        "dogum_gunu" => "dogum-gunu",
                        "dogum_yeri" => "dogum-yeri",
                        "dogum_saati" => "dogum-saati",
                        "anne_adi" => "anne-adi"
                    ),
                );

                if ($_POST["acilim"] == 1)
                {
                    $arrayfields["partner_bilgileri"] = array(
                        "partner_adi" => "partner-adi",
                        "partner_anne_adi" => "partner-anne-adi",
                        "partner_burcu" => "partner-burcu",
                        "partner_hakkinda" => "partner-hakkinda"
                    );
                }

                $this->fal_gonder($yorumcu, "yildizname", $fields, $arrayfields);
                break;

            case 'su-fali':
                $fields = array(
                    "soru" => "soru",
                    "acilim" => "acilim",
                );

                if ($this->fal->empty($fields["acilim"]))
                {
                    echo "acilim";
                    return;
                }

                if ($this->fal->equals_sme($_POST["acilim"], array(1,0))){
                    show_404();
                    return;
                }

                $arrayfields = array(
                    "dogum_bilgileri" => array(
                        "dogum_gunu" => "dogum-gunu",
                        "dogum_yeri" => "dogum-yeri",
                        "dogum_saati" => "dogum-saati",
                        "anne_adi" => "anne-adi"
                    ),
                );

                if ($_POST["acilim"] == 1)
                {
                    $arrayfields["partner_bilgileri"] = array(
                        "partner_adi" => "partner-adi",
                        "partner_anne_adi" => "partner-anne-adi",
                        "partner_burcu" => "partner-burcu",
                        "partner_hakkinda" => "partner-hakkinda"
                    );
                }

                $this->fal_gonder($yorumcu, "su_fali", $fields, $arrayfields);
                break;

            case "katina-fali":

                if (!isset($_POST["selected_cards"]))
                {
                    echo "card.10";
                    return;
                }

                $selected_cards = $this->input->post("selected_cards");
                if (empty($selected_cards)){
                    echo "card.10";
                    return;
                }

                $selected_cards = explode(",", $selected_cards);

                if (count($selected_cards) !== 10)
                {
                    echo "card.10";
                    return;
                }

                foreach ($selected_cards as $row)
                {
                    if (!is_numeric($row))
                    {
                        echo "card.10";
                        return;
                    }

                    if ($row > 78 || $row <= 0)
                    {
                        echo "card.10";
                        return;
                    }
                }

                $plus = array(
                    "kartlar" => $selected_cards
                );

                $arrayfields["partner_bilgileri"] = array(
                    "partner_adi" => "partner-adi",
                    "partner_anne_adi" => "partner-anne-adi",
                    "partner_burcu" => "partner-burcu",
                    "partner_hakkinda" => "partner-hakkinda"
                );

                $this->fal_gonder($yorumcu, "katina_fali", array("soru" => "soru"), $arrayfields, $plus);
                break;

            case "tarot-fali":

                $fields = array(
                    "soru" => "soru",
                    "acilim" => "acilim",
                );

                if ($this->fal->empty($_POST["acilim"]))
                {
                    echo "acilim";
                    return;
                }

                $max_cards = 7;
                if ($_POST["acilim"] == 0)
                    $max_cards = 10;

                if (!isset($_POST["selected_cards"]))
                {
                    echo "card.".$max_cards;
                    return;
                }

                $selected_cards = $this->input->post("selected_cards");
                if (empty($selected_cards)){
                    echo "card.".$max_cards;
                    return;
                }

                $selected_cards = explode(",", $selected_cards);

                if (count($selected_cards) !== $max_cards)
                {
                    echo "card.".$max_cards;
                    return;
                }

                foreach ($selected_cards as $row)
                {
                    if (!is_numeric($row))
                    {
                        echo "card.".$max_cards;
                        return;
                    }

                    if ($row > 78 || $row <= 0)
                    {
                        echo "card.".$max_cards;
                        return;
                    }
                }

                $plus = array(
                    "kartlar" => $selected_cards
                );

                if ($_POST["acilim"] == 1)
                {
                    $arrayfields["partner_bilgileri"] = array(
                        "partner_adi" => "partner-adi",
                        "partner_anne_adi" => "partner-anne-adi",
                        "partner_burcu" => "partner-burcu",
                        "partner_hakkinda" => "partner-hakkinda"
                    );
                }

                $this->fal_gonder($yorumcu, "tarot_fali", $fields, $arrayfields, $plus);
                break;

            case "kahve-fali":
                
                if (isset($_POST["images"]))
                {
                    echo "img_bos";
                    return;
                }
                $num_of_imgs = count($this->fal->reArrayFiles($_FILES['images']));
                if ($num_of_imgs > 5)
                {
                    echo "img_fazla";
                    return;
                }

                $this->fal_gonder($yorumcu, "kahve_fali", array("soru" => "soru"), null, null, true);
                break;
            
            default:
                show_404();
                return;
                break;
        }
    }

    public function fal_gonder($id, $tur, $fields, $arrayfields = null, $plus = null, $img = false)
    {
        if ($this->fal->check_login() == false)
        {
            echo "giris";
            return;
        }

        $json_data = array();

        if ($arrayfields !== null)
        {
            foreach ($arrayfields as $key => $value) {
                $arry = array();
                foreach ($value as $key1 => $value1) {
                    $var = trim($this->input->post($value1));
                    if ($this->fal->empty($var) || isset($_POST[$value1]) == false)
                    {
                        echo $value1."_bos";
                        return;
                    }

                    $arry[$key1] = $var;
                }

                $json_data[$key] = $arry;
            }
        }

        foreach ($fields as $key => $value) {
            $var = trim($this->input->post($value));
            if ($this->fal->empty($var) || isset($_POST[$value]) == false)
            {
                echo $value."_bos";
                return;
            }

            $json_data[$key] = $var;
        }

        if ($plus !== null)
            $json_data = array_merge($json_data, $plus);

        $profil_data = $this->fal->fal_gonder_check_profile_data();
        if (is_array($profil_data) == false){
            echo $profil_data;
            return;
        }
        $json_data["bilgiler"] = $profil_data;
        $json_data_array = $json_data;
        $json_data = json_encode($json_data);

        $odeme = json_decode($this->fal->get_fiyat_listesi($id), true)[$tur];

        if (!is_numeric($odeme)){
            echo "error";
            return;
        }

        $data = array(
            "fal_turu" => $tur,
            "yorumcu" => $id,
            "odeme" => $odeme,
            "fal_icerik" => $json_data,
            "tarih" => date("Y-m-d"),
            "user_id" => $this->session->userdata("id"),
            "status" => 2,
            "odeme_tamamlandimi" => 0,
            "odeme_turu" => 0,
            "perma" => $this->fal->generate_perma("fal_istekleri", "perma")
        );

        $this->db->insert("fal_istekleri", $data);
        if ($this->db->affected_rows() > 0){

            if ($img == true)
            {
                $id = $this->db->insert_id();
                $num_of_imgs = count($this->fal->reArrayFiles($_FILES['images']));
                $upload = $this->fal->resimUploadMultiple($_FILES["images"]);
                $json_data_array["resimler"] = $upload;
                $this->db->where("id", $id)->update("fal_istekleri", array("fal_icerik" => json_encode($json_data_array)));
                echo "success.".$data["perma"];
            }else
                echo "success.".$data["perma"];
        }
        else
            echo "error";
    }

    public function yorumcu_ol()
    {
        $data["page"] = "yorumcu_ol";
        $this->load->view("front/index", $data);
    }

    public function iletisim()
    {
        $data["page"] = "iletisim";
        $this->load->view("front/index", $data);
    }

    public function cevaplanmis_fal($id)
    {
        $query = $this->db->get_where("fal_istekleri", array("id" => $id, "status" => 1));
        if ($query !== false && $query->num_rows() > 0)
        {
            $page_data["fal_data"] = $query->row();

            $page_data["fal_icerik"] = json_decode($query->row()->fal_icerik, true);

            $page_data["page"] = "fal_cevap_goruntule";
            $this->load->view("front/index", $page_data);
        }
        else
        {
            show_404();
        }
    }
}
