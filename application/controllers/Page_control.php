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

        $this->fal->hit();
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
            case "kayit-ajax":
                if ($this->fal->check_login() == false)
                    $this->kayit_ajax();
                return;
            case "demo":
                $this->load->view("front/demo");
                return;
            case "yorumcular":
                $this->yorumcular();
                return;
            case "yorumcu-ol":
                $this->yorumcu_ol($this->uri->segment(2));
                return;
            case "iletisim":
                $this->iletisim($this->uri->segment(2));
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
            case "mesaj":
                if ($this->fal->check_login() == false)
                {
                    show_404();
                    return;
                }

                if($this->fal->empty_fal($this->uri->segment(2)))
                {
                    show_404();
                    return;
                }

                $check = $this->fal->check_any_fal_with_yorumcu($this->uri->segment(2));
                if ($check == false)
                {
                    show_404();
                    return;
                }

                if ($this->uri->segment(3) == "gonder")
                {
                    $this->mesaj_gonder($this->uri->segment(2));
                    return;
                }else
                    $this->mesaj_yorumcu($this->uri->segment(2));
                return;
            break;
            case "mesaj-check":
                if ($this->fal->check_login() == false)
                {
                    show_404();
                    return;
                }
                $id = false;
                if ($this->fal->empty_fal($this->uri->segment(2)) == false)
                    $id = $this->uri->segment(2);
                $this->mesaj_check($id);
                return;
            break;
            case "fal-istek-check":
                if ($this->fal->check_login() == false)
                {
                    show_404();
                    return;
                }
                $this->fal_istek_check();
                return;
            break;
            case "profil":
                if ($this->fal->check_login() == false)
                {
                    show_404();
                    return;
                }

                if ($this->uri->segment(2) == "ayarlar-kaydet"){
                    $this->ayarlar_kaydet();
                    return;
                }else if ($this->uri->segment(2) == "get-data"){
                    $this->get_user_data();
                    return;
                }else if ($this->uri->segment(2) == "kredi-islemleri"){
                    $page = $this->uri->segment(3);
                    $this->kredi_islemleri($page);
                    return;
                }else if ($this->uri->segment(2) == "cevap"){
                    $id = $this->uri->segment(3);

                    if ($id == null)
                    {
                        show_404();
                        return;
                    }

                    if ($this->uri->segment(4) == "comment")
                        $this->comment($id);
                    else
                        $this->cevaplanmis_fal($id);
                    return;
                }else if ($this->uri->segment(2) == "get-data"){
                    $this->get_user_data();
                    return;
                }else{
                    $this->profil();
                    return;
                }
                break;
            case "kahve-fali":
                $this->yorumcu_list_for("kahve_fali");
                break;
            case "tarot-fali":
                $this->yorumcu_list_for("tarot_fali");
                break;
            case "yildizname":
                $this->yorumcu_list_for("yildizname");
                break;
            case "ruya-yorumu":
                $this->yorumcu_list_for("ruya_yorumu");
                break;
            case "katina-ask-fali":
                $this->yorumcu_list_for("katina_fali");
                break;
            case "su-fali":
                $this->yorumcu_list_for("su_fali");
                break;
            case "dert-ortagi":
                $this->yorumcu_list_for("dert_ortagi");
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
                        echo "success";
                        return;
                    }
                }

                echo "hata";
            }else
                echo "email";
        }else
        echo "error";
    }

    public function kayit_ajax()
    {
        $ad = trim($this->input->post("ad"));
        $soyad = trim($this->input->post("soyad"));
        $tel = trim($this->input->post("tel"));
        $email = trim($this->input->post("email"));
        $sifre = trim($this->input->post("password"));
        $sifretekrar = trim($this->input->post("password-repeat"));

        if (empty($ad) || empty($soyad) || empty($tel) || empty($email) || empty($sifre) || empty($sifretekrar))
        {
            echo "bos";
            return;
        }

        if (!valid_email($email))
        {
            echo "email";
            return;
        }

        if (!is_numeric($tel))
        {
            echo "tel";
            return;
        }

        if ($sifre !== $sifretekrar)
        {
            echo "no_match";
            return;
        }

        $query = $this->db->get_where("users", array("email" => $email));
        if ($query !== false && $query->num_rows() > 0)
        {
            echo "exists";
            return;
        }

        $data = array(
            "name" => $ad,
            "surname" => $soyad,
            "telefon" => $tel,
            "email" => $email,
            "password" => sha1($sifre),
            "tarih" => date("Y-m-d"),
            "status" => "1",
            "kredi" => 0
        );

        $this->db->insert("users", $data);
        if ($this->db->affected_rows() > 0)
        {
            $this->session->set_userdata("user_login", "yes");
            $this->session->set_userdata("id", $this->db->insert_id());
            echo "success";
        }else
        echo "error";
    }

    public function ayarlar_kaydet()
    {
        $sifre = trim($this->input->post("password"));
        $sifretekrar = trim($this->input->post("password-repeat"));

        $profil_data = array(
            "name" => trim($this->input->post("name")),
            "surname" => trim($this->input->post("surname")),
            "telefon" => trim($this->input->post("tel")),
            "email" => trim($this->input->post("email")),
            "cinsiyet" => trim($this->input->post("cinsiyet")),
            "iliski_durumu" => trim($this->input->post("iliski_durumu")),
            "dogum_tarihi" => trim($this->input->post("dogum_tarihi"))
        );

        foreach ($profil_data as $key => $row)
        {
            if (empty($row)){
                echo "bos";
                return;
            }
        }

        if (!valid_email($profil_data["email"]))
        {
            echo "email";
            return;
        }

        if (!is_numeric($profil_data["telefon"]))
        {
            echo "tel";
            return;
        }

        if (!empty($sifre))
        {
            if ($sifre !== $sifretekrar)
            {
                echo "no_match";
                return;
            }

            $profil_data["sifre"] = sha1($profil_data["sifre"]);
        }

        $this->db->where("id", $this->session->userdata("id"))->update("users", $profil_data);
        if ($this->db->affected_rows() > 0)
        {
            echo "success";
            return;
        }

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
                "surname" => $query->row()->surname,
                "kredi" => $query->row()->kredi,
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

        if ($id !== null){
            $data["comments"] = $this->fal->get_yorumcu_comments($id);
            $data["puan"] = $this->fal->yorumcu_puan_ortalama($id, $data["comments"]);
        }

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
                $data["yorumcu"]->baktigi_fallar = $this->fal->yorumcu_baktigi_fallar($query->row()->baktigi_fallar);
                if (empty($data["yorumcu"]->fiyat_listesi))
                    $data["yorumcu"]->fiyat_listesi = json_decode($this->fal->get_setting("fiyat_listesi"), true);
                else
                    $data["yorumcu"]->fiyat_listesi = json_decode($data["yorumcu"]->fiyat_listesi, true);
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
                        $kredi = $query->row()->odeme;

                        if ($query1->row()->kredi >= $query->row()->odeme)
                        {
                            $this->fal->kredi(
                                "buy", "user", $this->session->userdata("id"), 
                                $kredi, true, "kredi",  $query->row()->yorumcu);

                            $this->db->where("perma", $id)->update("fal_istekleri", array("status" => 0));

                            $data["page"] = "odeme_basarili";
                            $data["neden"] = "Hesabınızdan kredi başarıyla çekildi!";
                            $this->load->view("front/index", $data);
                        }
                        else
                        {
                            $this->fal->kredi(
                                "buy", "user", $this->session->userdata("id"), 
                                $kredi, false, "kredi",  $query->row()->yorumcu);
                            $data["page"] = "odeme_basarisiz";
                            $data["neden"] = "Kredi bakiyeniz yetersiz!";
                            $this->load->view("front/index", $data);
                        }

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

                if ($this->fal->empty_fal($fields["acilim"]))
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

                if ($this->fal->empty_fal($fields["acilim"]))
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

                if ($this->fal->empty_fal($_POST["acilim"]))
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

                $arrayfields = null;
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
                    $var = strip_tags(trim($this->input->post($value1)));
                    if ($this->fal->empty_fal($var) || isset($_POST[$value1]) == false)
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
            $var = strip_tags(trim($this->input->post($value)));
            if ($this->fal->empty_fal($var) || isset($_POST[$value]) == false)
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

    public function yorumcu_ol($islem = null)
    {
        if ($islem == null)
        {
            $data["page"] = "yorumcu_ol";
            $this->load->view("front/index", $data);
        }else if ($islem == "submit")
        {
            if (isset($_POST["yorumcu_ol"]))
            {
                $name = $this->input->post("name");
                $email = $this->input->post("email");
                $tel = $this->input->post("tel");
                $message = $this->input->post("message");

                if (empty($name) ||empty($email) || empty($tel) ||empty($message))
                {
                    echo "false";
                    return;
                }

                $data = array(
                    "name" => $name,
                    "email" => $email,
                    "tel" => $tel,
                    "message" => $message,
                    "tarih" => date("Y-m-d H:i:s")
                );

                $this->db->insert("yorumcu_basvurulari", $data);
                if ($this->db->affected_rows() > 0)
                {
                    echo "success";
                }else
                echo "error";
            }else{
                show_404();
            }
        }
    }

    public function iletisim($islem = null)
    {
        if ($islem == null)
        {
            $data["page"] = "iletisim";
            $this->load->view("front/index", $data);
        }else if ($islem == "submit")
        {
            if (isset($_POST["iletisim"]))
            {
                $name = $this->input->post("name");
                $email = $this->input->post("email");
                $tel = $this->input->post("tel");
                $message = $this->input->post("message");

                if (empty($name) ||empty($email) || empty($tel) ||empty($message))
                {
                    echo "false";
                    return;
                }

                $data = array(
                    "name" => $name,
                    "email" => $email,
                    "tel" => $tel,
                    "message" => $message,
                    "tarih" => date("Y-m-d H:i:s")
                );

                $this->db->insert("iletisim", $data);
                if ($this->db->affected_rows() > 0)
                {
                    echo "success";
                }else
                echo "error";
            }else{
                show_404();
            }
        }
    }



    public function cevaplanmis_fal($id)
    {
        $query = $this->db->get_where("fal_istekleri", array("id" => $id, "status" => 1, "user_id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            $this->db->where("id", $query->row()->id)->update("fal_istekleri", array("seen" => "true"));
            $page_data["fal_data"] = $query->row();

            $page_data["fal_icerik"] = json_decode($query->row()->fal_icerik, true);

            $yorumcu = array("id", "pp", "name");
            $query1 = $this->db->get_where("yorumcu", array("id" => $query->row()->yorumcu));
            if ($query1 !== false && $query1->num_rows() > 0)
            {
                $yorumcu["id"] = $query1->row()->id;
                $yorumcu["pp"] = $query1->row()->pp;
                $yorumcu["name"] = $query1->row()->name;
                $yorumcu["aciklama"] = $query1->row()->aciklama;
                $yorumcu["last_online"] = $query1->row()->last_online;
                $page_data["comments"] = $this->fal->get_yorumcu_comments($yorumcu["id"]);
                $page_data["puan"] = $this->fal->yorumcu_puan_ortalama($yorumcu["id"], $page_data["comments"]);
            }
            $page_data["fal_data"]->yorumcu = $yorumcu;

            $page_data["page"] = "fal_cevap_goruntule";
            $this->load->view("front/index", $page_data);
        }
        else
        {
            show_404();
        }
    }

    public function mesaj_yorumcu($yorumcu_id)
    {
        $session_check = $this->fal->check_message_session($this->session->userdata("id"), $yorumcu_id);

        $messages = array();

        if ($session_check == true)
        {
            $session = $this->fal->get_message_session($this->session->userdata("id"), $yorumcu_id);
            if ($session == false)
            {
                echo "error";
                return;
            }

            $msgs = $this->fal->get_messages_user($this->session->userdata("id"), $yorumcu_id, $session->id);
            if ($msgs !== false)
                $messages = $msgs;
        }

        $query = $this->db->get_where("yorumcu", array("id" => $yorumcu_id));
        if ($query !== false && $query->num_rows() > 0)
        {
            $page_data["yorumcu"] = $query->row();
        }else{
            show_404();
            return;
        }

        $page_data["messages"] = $messages;
        $page_data["page"] = "mesaj_to_yorumcu";
        $this->load->view("front/index", $page_data);
    }

    public function mesaj_gonder($yorumcu_id)
    {
        $msg = trim($this->input->post("message"));
        if ($this->fal->empty_fal($msg))
        {
            echo "none";
            return;
        }

        $session_check = $this->fal->check_message_session($this->session->userdata("id"), $yorumcu_id);

        if ($session_check == false)
        {
            $session = $this->fal->create_message_session($this->session->userdata("id"), $yorumcu_id);
            if ($session == false)
            {
                echo "error";
                return;
            }
        }

        $session = $this->fal->get_message_session($this->session->userdata("id"), $yorumcu_id);
        if ($session == false)
        {
            echo "error";
            return;
        }

        $send = $this->fal->send_message_from_user($this->session->userdata("id"), $yorumcu_id, $msg, $session->id);
        if ($session == false)
        {
            echo "error";
            return;
        }else{
            echo "success";
        }
    }

    public function mesaj_check($id = false)
    {
        $session = $this->fal->check_any_message_available_user();
        if ($session == false)
        {
            echo "false";
            return;
        }

        $return_data = array();

        foreach ($session as $row)
        {
            $query = $this->db->get_where("yorumcu", array("id" => $row["yorumcu"]));
            if ($query !== false && $query->num_rows() > 0)
            {
                $data = array(
                    "name" => $query->row()->name, 
                    "id" => $query->row()->id
                );

                if ($id == $query->row()->id)
                {
                    $msgs = $this->fal->get_new_messages_user($this->session->userdata("id"), $row["yorumcu"], $row["id"]);
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

    public function fal_istek_check()
    {
        $falcheck = $this->fal->check_any_fal_exists();
        if ($falcheck == false)
        {
            show_404();
            return;
        }

        $fals = $this->fal->check_fal_istekleri_status_1_unseen();
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

    public function comment($id)
    {
        $query = $this->db->get_where("fal_istekleri", array("id" => $id, "status" => 1, "user_id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            if ($this->fal->empty_fal($query->row()->comment))
            {
                $comment = trim($this->input->post("comment"));
                if (empty($comment))
                {
                    echo "false";
                    return;
                }

                $puan = trim($this->input->post("oy_value"));
                if (empty($puan))
                {
                    echo "false";
                    return;
                }

                if ($puan <= 0 || $puan > 5){
                    echo "false";
                    return;
                }

                $this->db->where("id", $id)->update("fal_istekleri",array("comment" => $comment, "puan" => $puan));
                if ($this->db->affected_rows() > 0){
                    echo "true";
                }else
                    echo "false";
            }else{
                show_404();
                return;
            }
        }else{
            show_404();
            return;
        }
    }

    public function yorumcu_list_for($fal_turu)
    {
        $yorumcular = array();
        $query = $this->db->get_where("yorumcu", array("status" => "1"));
        if ($query !== false && $query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                if (empty($row["baktigi_fallar"]))
                {
                    array_push($yorumcular, $row);
                    continue;
                }
                $bfallar = json_decode($row["baktigi_fallar"], true);
                foreach ($bfallar as $key => $value)
                {
                    if ($key == $fal_turu)
                    {
                        array_push($yorumcular, $row);
                        break;
                    }
                }
            }
        }

        $data["yorumcular"] = $yorumcular;
        $data["page"] = "yorumcular";
        $this->load->view('front/index', $data);
    }

    public function kredi_islemleri($page = null, $q = null)
    {
        $totalrows = $this->db->where("(islem='user-buy' OR islem='user_deposit' OR islem='admin-deposit' OR islem='admin-withdraw') AND user_id='".$this->session->userdata("id")."'")->count_all_results("odeme_log");

        if ($totalrows > 0)
        {
            $rowsperpage = 10;
            $totalpages = ceil($totalrows / $rowsperpage);

            if ($page > $totalpages)
               $page = $totalpages;

            if ($page < 1) 
               $page = 1;

            $offset = ($page - 1) * $rowsperpage;

            $query = $this->db->order_by("tarih", "DESC")->where("(islem='user-buy' OR islem='user_deposit' OR islem='admin-deposit' OR islem='admin-withdraw') AND user_id='".$this->session->userdata("id")."'")->get("odeme_log", $rowsperpage, $offset);

            $page_data["odeme_list"] = $query->result_array();

            $pgrange = 3;
            $pg = "";
            if ($page > 1) {
               $pg .= '<li class="page-item"><a'; 
               if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
               $pg .=' page="1" class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a></li> ';
               $prevpage = $page - 1;
               $pg .= '<li class="page-item"><a';
               if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
               $pg .=' page="'.$prevpage.'" class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li> ';
            }
            else{
                $pg .= '<li class="page-item disabled"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg.=' page="active" class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a></li> ';
                $pg .= '<li class="page-item disabled"><a ';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="active" class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li> ';
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
               $pg.=' page="'.$nextpage.'" class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li> ';
               $pg .= '<li class="page-item"><a';
               if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
               $pg .=' page="'.$totalpages.'" class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a></li> ';
            } 
            else{
                $pg .= '<li class="page-item disabled"><a';
                if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
                $pg .=' page="active" class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li> ';
               $pg .= '<li class="page-item disabled"><a';
               if ($q !== ""){ $pg .= ' search="'.$q.'"' ;}
               $pg.= ' page="active" class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a></li> ';
            }

            $page_data["pagination"] = $pg;
        }
        else
            $page_data["odeme_list"] = array();

        $this->load->view("front/odeme_gecmisi_list", $page_data);
    }
}
