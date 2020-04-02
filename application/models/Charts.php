<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function fallar($time, $id=null)
    {
        if ($id !== null)
            $this->db->where("yorumcu", $id);

         $this->db->where("(status=0 OR status=1)");

        switch ($time) {
            case 'today':
                $this->db->where("YEAR(tarih)='".date("Y")."'AND MONTH(tarih)='".date("m")."' AND DAY(tarih)='".date("d")."'");
                break;

            case 'monthly':

                $this->db->where("DATE(tarih) > (NOW() - INTERVAL 12 MONTH)");
                $query = $this->db->get("fal_istekleri");
                if ($query !== false && $query->num_rows() > 0)
                {

                    $result = $query->result_array();
                    $data = array (
                        "0"=>array(0,"Ocak"),
                        "1"=>array(0,"Şubat"),
                        "2"=>array(0,"Mart"),
                        "3"=>array(0,"Nisan"),
                        "4"=>array(0,"Mayıs"),
                        "5"=>array(0,"Haziran"),
                        "6"=>array(0,"Temmuz"),
                        "7"=>array(0,"Ağustos"),
                        "8"=>array(0,"Eylül"),
                        "9"=>array(0,"Ekim"),
                        "10"=>array(0,"Kasım"),
                        "11"=>array(0,"December"),
                    );

                    foreach ($result as $q)
                    {
                        $date = strtotime($q["tarih"]);
                        $month = strtolower(date("F",$date));
                        switch ($month)
                        {
                            case "january":
                                $data["0"]["0"]++;
                            break;
                            case "february":
                                $data["1"]["0"]++;
                            break;
                            case "march":
                                $data["2"]["0"]++;
                            break;
                            case "april":
                                $data["3"]["0"]++;
                            break;
                            case "may":
                                $data["4"]["0"]++;
                            break;
                            case "june":
                                $data["5"]["0"]++;
                            break;
                            case "july":
                                $data["6"]["0"]++;
                            break;
                            case "august":
                                $data["7"]["0"]++;
                            break;
                            case "september":
                                $data["8"]["0"]++;
                            break;
                            case "october":
                                $data["9"]["0"]++;
                            break;
                            case "november":
                                $data["10"]["0"]++;
                            break;
                            case "december":
                                $data["11"]["0"]++;
                            break;
                        }
                    }

                    $hits = array();
                    switch (strtolower(date("F")))
                    {
                        case "january":
                            $hits[0] = $data[1];
                            $hits[1] = $data[2];
                            $hits[2] = $data[3];
                            $hits[3] = $data[4];
                            $hits[4] = $data[5];
                            $hits[5] = $data[6];
                            $hits[6] = $data[7];
                            $hits[7] = $data[8];
                            $hits[8] = $data[9];
                            $hits[9] = $data[10];
                            $hits[10] = $data[11];
                            $hits[11] = $data[0];
                        break;

                        case "february":
                            $hits[0] = $data[2];
                            $hits[1] = $data[3];
                            $hits[2] = $data[4];
                            $hits[3] = $data[5];
                            $hits[4] = $data[6];
                            $hits[5] = $data[7];
                            $hits[6] = $data[8];
                            $hits[7] = $data[9];
                            $hits[8] = $data[10];
                            $hits[9] = $data[11];
                            $hits[10] = $data[0];
                            $hits[11] = $data[1];
                        break;

                        case "march":
                            $hits[0] = $data[3];
                            $hits[1] = $data[4];
                            $hits[2] = $data[5];
                            $hits[3] = $data[6];
                            $hits[4] = $data[7];
                            $hits[5] = $data[8];
                            $hits[6] = $data[9];
                            $hits[7] = $data[10];
                            $hits[8] = $data[11];
                            $hits[9] = $data[0];
                            $hits[10] = $data[1];
                            $hits[11] = $data[2];
                        break;

                        case "april":
                            $hits[0] = $data[4];
                            $hits[1] = $data[5];
                            $hits[2] = $data[6];
                            $hits[3] = $data[7];
                            $hits[4] = $data[8];
                            $hits[5] = $data[9];
                            $hits[6] = $data[10];
                            $hits[7] = $data[11];
                            $hits[8] = $data[0];
                            $hits[9] = $data[1];
                            $hits[10] = $data[2];
                            $hits[11] = $data[3];
                        break;

                        case "may":
                            $hits[0] = $data[5];
                            $hits[1] = $data[6];
                            $hits[2] = $data[7];
                            $hits[3] = $data[8];
                            $hits[4] = $data[9];
                            $hits[5] = $data[10];
                            $hits[6] = $data[11];
                            $hits[7] = $data[0];
                            $hits[8] = $data[1];
                            $hits[9] = $data[2];
                            $hits[10] = $data[3];
                            $hits[11] = $data[4];
                        break;

                        case "june":
                            $hits[0] = $data[6];
                            $hits[1] = $data[7];
                            $hits[2] = $data[8];
                            $hits[3] = $data[9];
                            $hits[4] = $data[10];
                            $hits[5] = $data[11];
                            $hits[6] = $data[0];
                            $hits[7] = $data[1];
                            $hits[8] = $data[2];
                            $hits[9] = $data[3];
                            $hits[10] = $data[4];
                            $hits[11] = $data[5];
                        break;

                        case "july":
                            $hits[0] = $data[7];
                            $hits[1] = $data[8];
                            $hits[2] = $data[9];
                            $hits[3] = $data[10];
                            $hits[4] = $data[11];
                            $hits[5] = $data[0];
                            $hits[6] = $data[1];
                            $hits[7] = $data[2];
                            $hits[8] = $data[3];
                            $hits[9] = $data[4];
                            $hits[10] = $data[5];
                            $hits[11] = $data[6];
                        break;

                        case "august":
                            $hits[0] = $data[8];
                            $hits[1] = $data[9];
                            $hits[2] = $data[10];
                            $hits[3] = $data[11];
                            $hits[4] = $data[0];
                            $hits[5] = $data[1];
                            $hits[6] = $data[2];
                            $hits[7] = $data[3];
                            $hits[8] = $data[4];
                            $hits[9] = $data[5];
                            $hits[10] = $data[6];
                            $hits[11] = $data[7];
                        break;

                        case "september":
                            $hits[0] = $data[9];
                            $hits[1] = $data[10];
                            $hits[2] = $data[11];
                            $hits[3] = $data[0];
                            $hits[4] = $data[1];
                            $hits[5] = $data[2];
                            $hits[6] = $data[3];
                            $hits[7] = $data[4];
                            $hits[8] = $data[5];
                            $hits[9] = $data[6];
                            $hits[10] = $data[7];
                            $hits[11] = $data[8];
                        break;

                        case "october":
                            $hits[0] = $data[10];
                            $hits[1] = $data[11];
                            $hits[2] = $data[0];
                            $hits[3] = $data[1];
                            $hits[4] = $data[2];
                            $hits[5] = $data[3];
                            $hits[6] = $data[4];
                            $hits[7] = $data[5];
                            $hits[8] = $data[6];
                            $hits[9] = $data[7];
                            $hits[10] = $data[8];
                            $hits[11] = $data[9];
                        break;

                        case "november":
                            $hits[0] = $data[11];
                            $hits[1] = $data[0];
                            $hits[2] = $data[1];
                            $hits[3] = $data[2];
                            $hits[4] = $data[3];
                            $hits[5] = $data[4];
                            $hits[6] = $data[5];
                            $hits[7] = $data[6];
                            $hits[8] = $data[7];
                            $hits[9] = $data[8];
                            $hits[10] = $data[9];
                            $hits[11] = $data[10];
                        break;

                        case "december":
                            $hits[0] = $data[0];
                            $hits[1] = $data[1];
                            $hits[2] = $data[2];
                            $hits[3] = $data[3];
                            $hits[4] = $data[4];
                            $hits[5] = $data[5];
                            $hits[6] = $data[6];
                            $hits[7] = $data[7];
                            $hits[8] = $data[8];
                            $hits[9] = $data[9];
                            $hits[10] = $data[10];
                            $hits[11] = $data[11];
                        break;
                    }
                    return $hits;

                }
                else
                    return "no_data";

                break;
        }

        $query = $this->db->get("fal_istekleri");
        return $query->num_rows();
    }

    function kredi($time, $id=null)
    {
        if ($id !== null)
            $this->db->where("yorumcu_id", $id);

        $this->db->where("((islem = 'user-buy' OR islem = 'admin-deposit') AND odeme_sonucu = 1)");

        switch ($time) {
            case 'today':
                $this->db->where("YEAR(tarih)='".date("Y")."'AND MONTH(tarih)='".date("m")."' AND DAY(tarih)='".date("d")."'");
                break;

            case 'monthly':

                $this->db->where("DATE(tarih) > (NOW() - INTERVAL 12 MONTH)");
                $query = $this->db->get("odeme_log");
                if ($query !== false && $query->num_rows() > 0)
                {

                    $result = $query->result_array();
                    $data = array (
                        "0"=>array(0,"Ocak"),
                        "1"=>array(0,"Şubat"),
                        "2"=>array(0,"Mart"),
                        "3"=>array(0,"Nisan"),
                        "4"=>array(0,"Mayıs"),
                        "5"=>array(0,"Haziran"),
                        "6"=>array(0,"Temmuz"),
                        "7"=>array(0,"Ağustos"),
                        "8"=>array(0,"Eylül"),
                        "9"=>array(0,"Ekim"),
                        "10"=>array(0,"Kasım"),
                        "11"=>array(0,"December"),
                    );

                    foreach ($result as $q)
                    {
                        $date = strtotime($q["tarih"]);
                        $month = strtolower(date("F",$date));
                        switch ($month)
                        {
                            case "january":
                                $data["0"]["0"]+=$q["miktar"];
                            break;
                            case "february":
                                $data["1"]["0"]+=$q["miktar"];
                            break;
                            case "march":
                                $data["2"]["0"]+=$q["miktar"];
                            break;
                            case "april":
                                $data["3"]["0"]+=$q["miktar"];
                            break;
                            case "may":
                                $data["4"]["0"]+=$q["miktar"];
                            break;
                            case "june":
                                $data["5"]["0"]+=$q["miktar"];
                            break;
                            case "july":
                                $data["6"]["0"]+=$q["miktar"];
                            break;
                            case "august":
                                $data["7"]["0"]+=$q["miktar"];
                            break;
                            case "september":
                                $data["8"]["0"]+=$q["miktar"];
                            break;
                            case "october":
                                $data["9"]["0"]+=$q["miktar"];
                            break;
                            case "november":
                                $data["10"]["0"]+=$q["miktar"];
                            break;
                            case "december":
                                $data["11"]["0"]+=$q["miktar"];
                            break;
                        }
                    }

                    $hits = array();
                    switch (strtolower(date("F")))
                    {
                        case "january":
                            $hits[0] = $data[1];
                            $hits[1] = $data[2];
                            $hits[2] = $data[3];
                            $hits[3] = $data[4];
                            $hits[4] = $data[5];
                            $hits[5] = $data[6];
                            $hits[6] = $data[7];
                            $hits[7] = $data[8];
                            $hits[8] = $data[9];
                            $hits[9] = $data[10];
                            $hits[10] = $data[11];
                            $hits[11] = $data[0];
                        break;

                        case "february":
                            $hits[0] = $data[2];
                            $hits[1] = $data[3];
                            $hits[2] = $data[4];
                            $hits[3] = $data[5];
                            $hits[4] = $data[6];
                            $hits[5] = $data[7];
                            $hits[6] = $data[8];
                            $hits[7] = $data[9];
                            $hits[8] = $data[10];
                            $hits[9] = $data[11];
                            $hits[10] = $data[0];
                            $hits[11] = $data[1];
                        break;

                        case "march":
                            $hits[0] = $data[3];
                            $hits[1] = $data[4];
                            $hits[2] = $data[5];
                            $hits[3] = $data[6];
                            $hits[4] = $data[7];
                            $hits[5] = $data[8];
                            $hits[6] = $data[9];
                            $hits[7] = $data[10];
                            $hits[8] = $data[11];
                            $hits[9] = $data[0];
                            $hits[10] = $data[1];
                            $hits[11] = $data[2];
                        break;

                        case "april":
                            $hits[0] = $data[4];
                            $hits[1] = $data[5];
                            $hits[2] = $data[6];
                            $hits[3] = $data[7];
                            $hits[4] = $data[8];
                            $hits[5] = $data[9];
                            $hits[6] = $data[10];
                            $hits[7] = $data[11];
                            $hits[8] = $data[0];
                            $hits[9] = $data[1];
                            $hits[10] = $data[2];
                            $hits[11] = $data[3];
                        break;

                        case "may":
                            $hits[0] = $data[5];
                            $hits[1] = $data[6];
                            $hits[2] = $data[7];
                            $hits[3] = $data[8];
                            $hits[4] = $data[9];
                            $hits[5] = $data[10];
                            $hits[6] = $data[11];
                            $hits[7] = $data[0];
                            $hits[8] = $data[1];
                            $hits[9] = $data[2];
                            $hits[10] = $data[3];
                            $hits[11] = $data[4];
                        break;

                        case "june":
                            $hits[0] = $data[6];
                            $hits[1] = $data[7];
                            $hits[2] = $data[8];
                            $hits[3] = $data[9];
                            $hits[4] = $data[10];
                            $hits[5] = $data[11];
                            $hits[6] = $data[0];
                            $hits[7] = $data[1];
                            $hits[8] = $data[2];
                            $hits[9] = $data[3];
                            $hits[10] = $data[4];
                            $hits[11] = $data[5];
                        break;

                        case "july":
                            $hits[0] = $data[7];
                            $hits[1] = $data[8];
                            $hits[2] = $data[9];
                            $hits[3] = $data[10];
                            $hits[4] = $data[11];
                            $hits[5] = $data[0];
                            $hits[6] = $data[1];
                            $hits[7] = $data[2];
                            $hits[8] = $data[3];
                            $hits[9] = $data[4];
                            $hits[10] = $data[5];
                            $hits[11] = $data[6];
                        break;

                        case "august":
                            $hits[0] = $data[8];
                            $hits[1] = $data[9];
                            $hits[2] = $data[10];
                            $hits[3] = $data[11];
                            $hits[4] = $data[0];
                            $hits[5] = $data[1];
                            $hits[6] = $data[2];
                            $hits[7] = $data[3];
                            $hits[8] = $data[4];
                            $hits[9] = $data[5];
                            $hits[10] = $data[6];
                            $hits[11] = $data[7];
                        break;

                        case "september":
                            $hits[0] = $data[9];
                            $hits[1] = $data[10];
                            $hits[2] = $data[11];
                            $hits[3] = $data[0];
                            $hits[4] = $data[1];
                            $hits[5] = $data[2];
                            $hits[6] = $data[3];
                            $hits[7] = $data[4];
                            $hits[8] = $data[5];
                            $hits[9] = $data[6];
                            $hits[10] = $data[7];
                            $hits[11] = $data[8];
                        break;

                        case "october":
                            $hits[0] = $data[10];
                            $hits[1] = $data[11];
                            $hits[2] = $data[0];
                            $hits[3] = $data[1];
                            $hits[4] = $data[2];
                            $hits[5] = $data[3];
                            $hits[6] = $data[4];
                            $hits[7] = $data[5];
                            $hits[8] = $data[6];
                            $hits[9] = $data[7];
                            $hits[10] = $data[8];
                            $hits[11] = $data[9];
                        break;

                        case "november":
                            $hits[0] = $data[11];
                            $hits[1] = $data[0];
                            $hits[2] = $data[1];
                            $hits[3] = $data[2];
                            $hits[4] = $data[3];
                            $hits[5] = $data[4];
                            $hits[6] = $data[5];
                            $hits[7] = $data[6];
                            $hits[8] = $data[7];
                            $hits[9] = $data[8];
                            $hits[10] = $data[9];
                            $hits[11] = $data[10];
                        break;

                        case "december":
                            $hits[0] = $data[0];
                            $hits[1] = $data[1];
                            $hits[2] = $data[2];
                            $hits[3] = $data[3];
                            $hits[4] = $data[4];
                            $hits[5] = $data[5];
                            $hits[6] = $data[6];
                            $hits[7] = $data[7];
                            $hits[8] = $data[8];
                            $hits[9] = $data[9];
                            $hits[10] = $data[10];
                            $hits[11] = $data[11];
                        break;
                    }
                    return $hits;

                }
                else
                    return "no_data";

                break;
        }

        $query = $this->db->get("odeme_log");
        $count = 0;
        foreach ($query->result_array() as $row)
        {
            $count += $row["miktar"];
        }

        return $count;
    }

}