<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Fal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function set_setting($name, $value)
    {
            $this->db->where("ayaradi", $name);
            return $this->db->update("ayarlar", array("ayardeger" => $value));
    }

    function get_setting($name)
    {
            $setting_query = $this->db->get_where('ayarlar', array('ayaradi' => $name));
            if($setting_query !== false && $setting_query->num_rows() > 0)
                    return $setting_query->row()->ayardeger;

            return false;
    }
    
    function check_admin_login()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    function check_yorumcu_login()
    {
        if ($this->session->userdata('yorumcu_login') == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    function check_login()
    {
        if ($this->session->userdata('user_login') == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    function set_title_pure($title, $admin = false)
    {
        if (isset($_GET["title"]))
        {
            if ($admin == false)
                echo '<script>document.title = "User Panel - ' . $title . '"</script>';
            else
                echo '<script>document.title = "Admin Panel - ' . $title . '"</script>';
        }
    }

    function fal_turu_name_to_org($name)
    {
        switch ($name) {
            case 'kahve_fali':
                return "Kahve Falı";
                break;
             case 'tarot_fali':
                return "Tarot Falı";
                break;
             case 'yildizname':
                return "Yıldız Name";
                break;
             case 'ruya_yorumu':
                return "Rüya Yorumu";
                break;
             case 'katina_ask_fali':
                return "Katina Aşk Falı";
                break;
             case 'su_fali':
                return "Su Falı";
                break;
             case 'dert_ortagi':
                return "Dert Ortağı";
                break;
            default:
                return $name;
                break;
        }
    }


    function fal_gonder_check_profile_data()
    {
        $profil_data = array(
            "ad" => trim($this->input->post("ad")),
            "soyad" => trim($this->input->post("soyad")),
            "email" => trim($this->input->post("email")),
            "sektor" => trim($this->input->post("sektor")),
            "cinsiyet" => trim($this->input->post("cinsiyet")),
            "iliski" => trim($this->input->post("iliski_durumu")),
            "tarih" => trim($this->input->post("dogum_tarihi"))
        );

        foreach ($profil_data as $key => $row)
        {
            if (empty($row)){
                return $key."_bos";
            }
        }

        $sektor = array("Belirtilmemiş", "İşsiz", "Diğer", "Basın-Yayın", "Danışmanlık", "Doktor", "Emekli", "Ev Kadını", "Halkla İlişkiler", "Hukukçu", "Kamu Sektörü", "Manken/Model", "Mimar", "Muhasebe", "Mühendis", "Müzik", "Otomotiv", "Psikolog", "Reklam", "Sanatçı", "Satış/Pazarlama", "Sağlık Hizmetleri", "Sağlık Sektörü", "Serbest Meslek", "Sigortacı", "Sport", "Tekstil", "Ticaret", "Turizm", "Yöneticilik", "Öğrenci", "Öğretim Görevlisi/Asistan", "Öğretmen", "İnsan Kaynakları");

        $iliski_durumu = array("İlişki Durumu", "Ayrı yaşıyor", "Boşanmış", "Evli", "Karmaşık", "İlişkisi var", "İlişkisi yok");

        $cinsiyet = array("erkek", "kadın");

        $issektor = false;
        $isiliski = false;
        $iscinsiyet = false;

        foreach ($sektor as $row)
        {
            if ($profil_data["sektor"] == $row)
            {
                $issektor = true;
                break;
            }
        }

        if ($issektor == false)
            return "sektor_bos";

        foreach ($iliski_durumu as $row)
        {
            if ($profil_data["iliski"] == $row)
            {
                $isiliski = true;
                break;
            }
        }

        if ($isiliski == false)
            return "iliski_bos";

        foreach ($cinsiyet as $row)
        {
            if ($profil_data["cinsiyet"] == $row)
            {
                $iscinsiyet = true;
                break;
            }
        }

        if ($issektor == false)
            return "sektor_bos";

        return $profil_data;
    }

    function get_fiyat_listesi($id = null)
    {
        $default = false;
        if ($id !== null){
            $query = $this->db->get_where("yorumcu", array("id" => $id));
            if ($query !== false && $query->num_rows() > 0)
            {
                if (empty($query->row()->fiyat_listesi)){
                    $default = true;
                }
                else
                    return $query->row()->fiyat_listesi;
            }
            else
                $default = true;
        }else
            $default = true;

        if ($default == true)
        {
            return $this->get_setting("fiyat_listesi");
        }
    }
}