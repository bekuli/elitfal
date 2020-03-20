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
        if ($this->session->userdata('login') == 'yes') {
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

}