<?php
/**
 * Project: xvn.
 * File: memberloginModel.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 4:31 PM - 7/30/13
 * Website: www.xiao.vn
 */
Class memberloginModel extends baseModel
{
	/*
    public function check_login($user,$pass)
    {
        global $db;
        $cl = $db->query("SELECT * FROM xdata_account WHERE (username = '".$user."' OR id = '".$user."' OR email = '".$user."') AND password = '".$pass."'");
        if(mysql_num_rows($cl) == 1)
        {
            $row = $db->fetch_object($first_row = true);
            $_SESSION['xID'] = $row->xid;
            $_SESSION['xUser'] = $row->username;
            $_SESSION['xEmail'] = $row->email;
            $_SESSION['xGroup'] = $row->xgroup;
            $_SESSION['LoggedIn'] = 1;
            if($row->group == 7)
            {
                $_SESSION['isAdmin'] = 1;
            }
            else{$_SESSION['isAdmin'] = 0;}
            return true;
        }
        else
        {
            return false;
        }
    }
	*/
	public function user_login($user,$pass)
    {
        global $db;
        $cl = $db->query("SELECT * FROM portal_customers WHERE (cus_code = '".$user."' OR cus_username = '".$user."' OR cus_email = '".$user."' OR cus_phone = '".$user."') AND cus_password = '".$pass."' AND cus_status = '1'");
        if(mysql_num_rows($cl) == 1)
        {
            $row = $db->fetch_object(true);
            $_SESSION['user']['id'] = $row->id;
            $_SESSION['user']['code'] = $row->cus_code;
            $_SESSION['user']['email'] = $row->cus_email;
            $_SESSION['user']['phone'] = $row->cus_phone;
            $_SESSION['user']['fullname'] = $row->cus_fullname;
            $_SESSION['user']['LoggedIn'] = 1;
            
			$ipaddress = '';
				if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
				} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
					$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
				} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
					$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
				} else if (isset($_SERVER['HTTP_FORWARDED'])) {
					$ipaddress = $_SERVER['HTTP_FORWARDED'];
				} else if (isset($_SERVER['REMOTE_ADDR'])) {
					$ipaddress = $_SERVER['REMOTE_ADDR'];
				} else {
					$ipaddress = 'UNKNOWN';
				}
			/*
			if($row->user_country == "")
			{
				$ipaddress = '';
				if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
				} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
					$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
				} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
					$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
				} else if (isset($_SERVER['HTTP_FORWARDED'])) {
					$ipaddress = $_SERVER['HTTP_FORWARDED'];
				} else if (isset($_SERVER['REMOTE_ADDR'])) {
					$ipaddress = $_SERVER['REMOTE_ADDR'];
				} else {
					$ipaddress = 'UNKNOWN';
				}
				$json     = file_get_contents("http://ipinfo.io/".$ipaddress."/geo");
				$json     = json_decode($json, true);
				
			}
			*/
			//$db->query("UPDATE portal_customers SET user_lastlogin = '".date("Y-m-d H:i:s")."' WHERE id = '".$row->id."'");
			$db->query("INSERT INTO portal_customer_logs(cid,log_key,log_value,log_agent,log_ip) VALUES('".$row->id."','LOGGEDIN','','".$_SERVER['HTTP_USER_AGENT']."','".$ipaddress."')");
			$db->query("UPDATE portal_customers SET cus_ip = '".$ipaddress."' WHERE id = '".$row->id."'");
            return true;
        }
        else
        {
            return false;
        }
    }
}