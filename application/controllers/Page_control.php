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
                $this->giris();
                return;
            case "kayit":
                $this->kayit();
                return;
            case "yorumcular":
                $this->yorumcular();
                return;
            case "odeme":
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
                $this->profil();
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

        $data["a"] = "a";
        $this->load->view('front/top');
        $this->load->view('front/giris', $data);
    }
    
    public function kayit()
    {
        $data["a"] = "a";
        $this->load->view('front/top');
        $this->load->view('front/kayit', $data);
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
        $data["kredi"] = 900;
        $data["page"] = "odeme_fal";
        $this->load->view("front/index", $data);

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
            $data["page"] = "profil";
            $this->load->view("front/index", $data);
        }
        else
        {
            show_404();
        }
    }
}
