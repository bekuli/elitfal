<?php defined('BASEPATH') OR exit('No direct script access allowed');

$user_data = null;

if ($this->fal->check_login() == true)
{
	$query = $this->db->get_where("users", array("id" => $this->session->userdata("id"), "status" => 1));
    if ($query !== false && $query->num_rows() > 0)
    {
        $user_data = $query->row();
    }
}

include "top.php";
include "header.php";
include $page.".php";
include "footer.php";