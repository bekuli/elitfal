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

    function ipadres() 
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'BILINMEYEN';
        return $ipaddress;
    }

    function hit()
    {
        if ($this->ipadres() != "BILINMEYEN")
        {
            $this->db->select("ipadres");
            $this->db->from("hits");
            $this->db->where("ipadres", $this->ipadres());
            $query = $this->db->get();
        
            if ($query->num_rows() == 0)
            {
                $veriler = array(
                    "ipadres" => $this->ipadres(),
                    "tarih" => date("Y-m-d")
                 );
                $this->db->insert("hits", $veriler);
            }
        }
    }

    function set_title_pure($title, $admin = false)
    {
        if (isset($_GET["title"]))
        {
            if ($admin == false)
                echo '<script>document.title = "Yorumcu Panel - ' . $title . '"</script>';
            else
                echo '<script>document.title = "Admin Panel - ' . $title . '"</script>';
        }
    }

    function fal_gonder_check_profile_data()
    {
        $profil_data = array(
            "ad" => trim($this->input->post("ad")),
            "soyad" => trim($this->input->post("soyad")),
            "email" => trim($this->input->post("email")),
            "cinsiyet" => trim($this->input->post("cinsiyet")),
            "iliski" => trim($this->input->post("iliski_durumu")),
            "tarih" => trim($this->input->post("dogum_tarihi"))
        );

        foreach ($profil_data as $key => $row)
        {
            if ($this->empty_fal($row)){
                return $key."_bos";
            }
        }

        if (!isset($_POST["kosullar"]))
            return "kosullar";

        $iliski_durumu = array("İlişki Durumu", "Ayrı yaşıyor", "Boşanmış", "Evli", "Karmaşık", "İlişkisi var", "İlişkisi yok");

        $cinsiyet = array("erkek", "kadın");

        $isiliski = false;
        $iscinsiyet = false;


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

    function generate_perma($db, $row)
    {
        $random_type = "alnum";
        $length = 7;
        $name = random_string($random_type, 7);
        
        $query = $this->db->get_where($db, array($row => $name));
        if($query !== false && $query->num_rows() > 0)
            return $this->generate_perma();
        else
            return $name;
    }

    function equals_sme($val, $array)
    {
        foreach ($array as $row)
        {
            if ($row == $val)
                return false;
        }

        return true;
    }

    function empty_fal($data)
    {
        if (trim($data) == "" || $data == null)
            return true;

        return false;
    }

    function resimUpload($resim, $rndName = true, $resizeConfig = null, $thumbConfig = null, $custompath = null, $customname = null)
    {
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->helper('string');
        
        if (empty($resim["name"]))
            return array("error" => "Resim seçilmedi");
        
        $name = $resim['name'];
        
        $_FILES['userfile']['name']= $resim['name'];
        $_FILES['userfile']['type']= $resim['type'];
        $_FILES['userfile']['tmp_name']= $resim['tmp_name'];
        $_FILES['userfile']['error']= $resim['error'];
        $_FILES['userfile']['size']= $resim['size'];
        
        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
        
        if ($custompath == null)
            $config["upload_path"] = "./uploads/";
        else
            $config["upload_path"] = $custompath;
        
        $config['allowed_types'] = "gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JPEG|BMP";
        
        if ($rndName == true) {
            $name = random_string('alnum', 12);
            $config['remove_spaces'] = true;
            $config['file_name'] = $name;
        }elseif ($customname !== null) {
            $name = $customname;
            $config['remove_spaces'] = true;
            $config['file_name'] = $name;
        }
        
        $config['overwrite'] = true;
        
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload())
            return array("error" => $this->upload->display_errors());
        
        $uploadInfo = $this->upload->data();
        
        if ($resizeConfig !== null) {
            
            if (isset($resizeConfig["custom"]) && $resizeConfig["custom"] == true)
            {
                list($width, $height) = getimagesize($config["upload_path"].$uploadInfo["file_name"]);
                
                $newResizeConfig = array();
                
                if ($width > $height)
                    $newResizeConfig["width"] = $resizeConfig["width"];
                elseif ($height > $width)
                    $newResizeConfig["height"] = $resizeConfig["height"];
                    
                $newResizeConfig["maintain_ratio"] = true;
                $newResizeConfig["source_image"] = $uploadInfo['full_path'];
                
                $this->image_lib->initialize($newResizeConfig);
                $this->image_lib->resize($newResizeConfig);
                $this->image_lib->clear();
                
                //echo "width-height: ".$width." ".$height;
                //print_r($newResizeConfig);
            }
            else
            {
                $resizeConfig['source_image'] = $uploadInfo['full_path'];
                $this->image_lib->initialize($resizeConfig);
                $this->image_lib->resize($resizeConfig);
                $this->image_lib->clear();
            }
        }
        
        if ($thumbConfig !== null) {
            
            if ($custompath == null)
                $thumbConfig["new_image"] = "./uploads/".$name."_thumb";
            else
                $thumbConfig["new_image"] = $custompath.$name."_thumb";
            
            $thumbConfig['source_image'] = $uploadInfo['full_path'];
            
            $this->image_lib->initialize($thumbConfig);
            $this->image_lib->resize($thumbConfig);
            $this->image_lib->clear();
        }

        return array("orjinalResimAdi" => $_FILES["userfile"]["name"] , "resimAdi" => $uploadInfo["file_name"]);
        
    }

    function resimUploadMultiple($resimler, $rndName = true, $resizeConfig = null, $thumbConfig = null, $custompath = null, $custom_names = null)
    {
        $resimler = $this->reArrayFiles($resimler);
        $return = array();
        
        $i = 0;
        foreach ($resimler as $resim){
            
            if (empty($resim["name"])){
                $i++; continue;
            }
            
            $custom_name = null;
            
            if ($custom_names != null)
                $custom_name = $custom_names[$i];
            
            $upload = $this->resimUpload($resim, $rndName, $resizeConfig, $thumbConfig, $custompath, $custom_name);
            if (!isset($upload["hata"]))
                array_push($return, $upload["resimAdi"]);
            else
                array_push($return, $upload["error"]);
            $i++;
        }
        
        return $return;
    }

    function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    function check_any_fal_with_yorumcu($id)
    {
        $user_id = $this->session->userdata("id");
        $where = "yorumcu='$id' AND user_id='$user_id' AND status = 0 OR status = 1";
        $query = $this->db->where($where)->get("fal_istekleri");
        if ($query !== false && $query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function check_any_fal_exists_yorumcu()
    {
        $user_id = $this->session->userdata("id");
        $where = "yorumcu='$user_id' AND status = 0";
        $query = $this->db->where($where)->get("fal_istekleri");
        if ($query !== false && $query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function check_any_fal_exists()
    {
        $user_id = $this->session->userdata("id");
        $where = "user_id='$user_id' AND status = 0 OR status = 1";
        $query = $this->db->where($where)->get("fal_istekleri");
        if ($query !== false && $query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function check_message_session($user, $yorumcu)
    {
        $query = $this->db->get_where("message_sessions", array("user" => $user, "yorumcu" => $yorumcu));
        if ($query !== false && $query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function create_message_session($user, $yorumcu)
    {
        $data = array(
            "yorumcu" => $yorumcu,
            "user" => $user
        );

        $this->db->insert("message_sessions", $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return false;
    }

    function get_message_session($user, $yorumcu)
    {
        $query = $this->db->get_where("message_sessions", array("user" => $user, "yorumcu" => $yorumcu));
        if ($query !== false && $query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

    function send_message_from_yorumcu($user, $yorumcu, $msg, $session_id)
    {
        $data = array(
            "from_who" => "yorumcu",
            "sender_id" => $yorumcu,
            "receiver_id" => $user,
            "date_send" => date("Y-m-d H:i:s"),
            "session_id" => $session_id,
            "is_read" => "false",
            "message" => $msg,
        );

        $this->db->insert("messages", $data);
        if ($this->db->affected_rows() == 0)
            return "error";

        $this->db->where("id", $session_id)->update("message_sessions", array("notify_user" => "true"));
        return true;
    }

    function send_message_from_user($user, $yorumcu, $msg, $session_id)
    {
        $data = array(
            "from_who" => "user",
            "sender_id" => $user,
            "receiver_id" => $yorumcu,
            "date_send" => date("Y-m-d H:i:s"),
            "session_id" => $session_id,
            "is_read" => "false",
            "message" => $msg,
        );

        $this->db->insert("messages", $data);
        if ($this->db->affected_rows() == 0)
            return "error";

        $this->db->where("id", $session_id)->update("message_sessions", array("notify_yorumcu" => "true"));
        return true;
    }

    function get_messages_yorumcu($user, $yorumcu, $session_id)
    {
        $query = $this->db->order_by("date_send")->get_where("messages", 
            array(
                "session_id" => $session_id,
            )
        );

        if ($query !== false && $query->num_rows() > 0)
        {
            $msgs = $query->result_array();

            foreach ($msgs as $row)
            {
                if ($row["is_read"] == "false" && $row["from_who"] == "user")
                    $this->db->where("id", $row["id"])->update("messages", array("is_read" => "true"));
            }

            $this->db->where("id", $session_id)->update("message_sessions", array("notify_yorumcu" => "false"));

            return $msgs;
        }else{
            return false;
        }
    }

    function get_messages_user($user, $yorumcu, $session_id)
    {
        $query = $this->db->order_by("date_send")->get_where("messages", 
            array(
                "session_id" => $session_id,
            )
        );

        if ($query !== false && $query->num_rows() > 0)
        {
            $msgs = $query->result_array();

            foreach ($msgs as $row)
            {
                if ($row["is_read"] == "false" && $row["from_who"] == "yorumcu")
                    $this->db->where("id", $row["id"])->update("messages", array("is_read" => "true"));
            }

            $this->db->where("id", $session_id)->update("message_sessions", array("notify_user" => "false"));

            return $msgs;
        }else{
            return false;
        }
    }

    function get_new_messages_user($user, $yorumcu, $session_id, $update = true)
    {
        $query = $this->db->get_where("messages", 
            array(
                "session_id" => $session_id,
                "receiver_id" => $user,
                "sender_id" => $yorumcu,
                "from_who" => "yorumcu",
                "is_read" => "false"
            )
        );

        if ($query !== false && $query->num_rows() > 0)
        {
            $msgs = $query->result_array();

            if ($update == true){
                foreach ($msgs as $row)
                {
                    if ($row["is_read"] == "false")
                        $this->db->where("id", $row["id"])->update("messages", array("is_read" => "true"));
                }
                $this->db->where("id", $session_id)->update("message_sessions", array("notify_user" => "false"));
            }

            return $msgs;
        }else{
            return false;
        }
    }

    function get_new_messages_yorumcu($user, $yorumcu, $session_id, $update = true)
    {
        $query = $this->db->get_where("messages", 
            array(
                "session_id" => $session_id,
                "receiver_id" => $yorumcu,
                "sender_id" => $user,
                "from_who" => "user",
                "is_read" => "false"
            )
        );

        if ($query !== false && $query->num_rows() > 0)
        {
            $msgs = $query->result_array();

            if ($update == true){
                foreach ($msgs as $row)
                {
                    if ($row["is_read"] == "false")
                        $this->db->where("id", $row["id"])->update("messages", array("is_read" => "true"));
                }
                $this->db->where("id", $session_id)->update("message_sessions", array("notify_yorumcu" => "false"));
            }

            return $msgs;
        }else{
            return false;
        }
    }

    function check_any_message_available_user()
    {
        $query = $this->db->get_where("message_sessions", array("user" => $this->session->userdata("id"), "notify_user" => "true"));
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return false;
    }

    function check_any_message_available_yorumcu()
    {
        $query = $this->db->get_where("message_sessions", array("yorumcu" => $this->session->userdata("id"), "notify_yorumcu" => "true"));
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return false;
    }

    function check_fal_istekleri_status_1_unseen()
    {
        $query = $this->db->get_where("fal_istekleri", array("status" => "1", "seen" => "false", "user_id" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return false;
    }

    function check_fal_istekleri_status_0_unanswered()
    {
        $query = $this->db->get_where("fal_istekleri", array("status" => "0", "seen" => "false", "yorumcu" => $this->session->userdata("id")));
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return false;
    }

    function get_message_sessions($yorumcu)
    {
        $query = $this->db->get_where("message_sessions", array("yorumcu" => $yorumcu));
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return array();
    }

    function get_yorumcu_comments($id)
    {
        $query = $this->db->select("comment, puan, tarih")->from("fal_istekleri")->where("yorumcu", $id)->where("puan > 0")->get();
        if ($query !== false && $query->num_rows() > 0)
        {
            return $query->result_array();
        }

        return array();
    }

    function yorumcu_puan_ortalama($id, $puanlar)
    {
        $toplam = 0;
        foreach ($puanlar as $yorum)
            $toplam += $yorum["puan"];
        
        if ($toplam == 0)
            return 0;
        
        $ortalama = $toplam /  count($puanlar);
        
        return round($ortalama);
    }

    function yorumcu_baktigi_fallar($fallar)
    {
        if (!empty($fallar))
            return json_decode($fallar, true);

         return array(
            "kahve_fali" => "",
            "tarot_fali" => "",
            "yildizname" => "",
            "ruya_yorumu" => "",
            "katina_fali" => "",
            "su_fali" => "",
            "dert_ortagi" => ""
        );
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
            case 'katina_fali':
                return "Katina Falı";
                break;
            default:
                return $name;
                break;
        }
    }

    function komisyon_hesapla($kredi)
    {
        return ($kredi / 10) - (($kredi / 10) / $this->get_setting("komisyon"));
    }

    function kredi($islem, $user_type, $id, $miktar, $success = false, $odeme_turu = null, $yorumcu_id = null)
    {
        $this->db->where("id", $id);

        if ($user_type == "yorumcu")
            $query = $this->db->get("yorumcu");
        else if ($user_type == "user")
            $query = $this->db->get("users");
        else
            return false;

        if ($query == false || $query->num_rows() == 0)
            return false;

        if ($user_type == "user")
        {
            if ($islem == "deposit")
            {
                $data = array(
                    "islem" => "user-deposit",
                    "user_type" => "user",
                    "user_id" => $id,
                    "yorumcu_id" => "-",
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => $odeme_turu,
                    "odeme_sonucu" => "0"
                );

                if ($success == true)
                    $data["odeme_sonucu"] = "1";

                $this->db->insert("odeme_log", $data);

                if ($success == true)
                {
                    $this->db->where("id", $id)->update("users", array("kredi" => $query->row()->kredi + $miktar));
                    if ($this->db->affected_rows() > 0)
                        return true;
                    else
                        return "error_0";
                }
                else
                    return true;
            }
            else if ($islem == "buy")
            {
                $data = array(
                    "islem" => "user-buy",
                    "user_type" => "user",
                    "user_id" => $id,
                    "yorumcu_id" => $yorumcu_id,
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => $odeme_turu,
                    "odeme_sonucu" => "0"
                );

                if ($success == true)
                    $data["odeme_sonucu"] = "1";

                $this->db->insert("odeme_log", $data);

                if ($success == true)
                {
                    if ($odeme_turu == "kredi")
                        $this->db->where("id", $id)->update("users", array("kredi" => $query->row()->kredi - $miktar));

                    $yorumcu_query = $this->db->get_where("yorumcu", array("id" => $yorumcu_id));
                    $this->db->where("id", $yorumcu_id)->update("yorumcu", array("kredi" => $yorumcu_query->row()->kredi + $miktar));
                    if ($this->db->affected_rows() > 0)
                        return true;
                    else
                        return "error_1";
                }
                else
                    return true;
            }
            else if ($islem == "admin-deposit")
            {
                $data = array(
                    "islem" => "admin-deposit",
                    "user_type" => "user",
                    "user_id" => $id,
                    "yorumcu_id" => "-",
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => "-",
                    "odeme_sonucu" => "1"
                );

                $this->db->insert("odeme_log", $data);


                $this->db->where("id", $id)->update("users", array("kredi" => $query->row()->kredi + $miktar));
                if ($this->db->affected_rows() > 0)
                    return true;
                else
                    return "error_2";
                
            }
            else if ($islem == "admin-withdraw")
            {
                $data = array(
                    "islem" => "admin-withdraw",
                    "user_type" => "user",
                    "user_id" => $id,
                    "yorumcu_id" => "-",
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => "-",
                    "odeme_sonucu" => "1"
                );

                $this->db->insert("odeme_log", $data);


                $this->db->where("id", $id)->update("users", array("kredi" => $query->row()->kredi - $miktar));
                if ($this->db->affected_rows() > 0)
                    return true;
                else
                    return "error_3";
                
            }else
                return false;
        }
        else if ($user_type == "yorumcu")
        {
            if ($islem == "withdraw")
            {
                $data = array(
                    "islem" => "yorumcu-withdraw",
                    "user_type" => "yorumcu",
                    "user_id" => "-",
                    "yorumcu_id" => $id,
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => "-",
                    "odeme_sonucu" => "1"
                );

                $this->db->insert("odeme_log", $data);

                $this->db->where("id", $id)->update("yorumcu", array("kredi" => $query->row()->kredi - $miktar));
                if ($this->db->affected_rows() > 0)
                    return true;
                else
                    return "error_4";
            }
            else if ($islem == "admin-deposit")
            {
                $data = array(
                    "islem" => "admin-deposit",
                    "user_type" => "yorumcu",
                    "user_id" => "-",
                    "yorumcu_id" => $id,
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => "-",
                    "odeme_sonucu" => "1"
                );

                $this->db->insert("odeme_log", $data);


                $this->db->where("id", $id)->update("yorumcu", array("kredi" => $query->row()->kredi + $miktar));
                if ($this->db->affected_rows() > 0)
                    return true;
                else
                    return "error_5";
                
            }
            else if ($islem == "admin-withdraw")
            {
                $data = array(
                    "islem" => "admin-withdraw",
                    "user_type" => "yorumcu",
                    "user_id" => "-",
                    "yorumcu_id" => $id,
                    "tarih" => date("Y-m-d H:i:s"),
                    "miktar" => $miktar,
                    "odeme_turu" => "-",
                    "odeme_sonucu" => "1"
                );

                $this->db->insert("odeme_log", $data);

                $this->db->where("id", $id)->update("yorumcu", array("kredi" => $query->row()->kredi - $miktar));
                if ($this->db->affected_rows() > 0)
                    return true;
                else
                    return "error_2";
                
            }else
                return false;
        }else
                return false;
    }

}