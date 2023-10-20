<?php
/**
 * Project: thuvien.
 * File: memberController.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 18:50 - 05/10/2013
 * Website: www.xiao.vn
 */
Class memberController extends baseController
{
    public function index()
    {
		if(!(isset($_SESSION['xID']) && $_SESSION['xID'] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->show("member_show");
    }
	public function deposit()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$orderno = general::getInstance()->generateid("transaction");
		$checkingcode = "FBO".$orderno;
		$param = array(
			'api_key' => ZPAY_API_KEY,
			'api_secrect' => ZPAY_API_SECRECT,
			'amount' => "50000",
			'bank' => '2',
			'customer' => $_SESSION['user_phone'],
			'order_no' => $orderno,
			'checkingcode' => $checkingcode 
		);
		$url = 'http://api.dovebay.com/service/createrequest';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, count($param));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param); 
		$result = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($result,true);
		if($response['status'] == "200")
		{	
			$db->query("INSERT INTO fb_deposites (uid,deposite_order, deposit_method, deposit_amount, deposit_code, deposit_status) VALUES ('".$_SESSION['uid']."','".$orderno."', '1', '50000', '".$checkingcode."', '0');");
			$this->view->data['qrcode'] =  $response['qrcode'];
		}
		else
		{
			$this->view->data['qrcode'] = "";
		}
		$this->view->data['orderno'] = $orderno;
		$this->view->data['checkingcode'] = $checkingcode;
		$this->view->show("deposit");
	}
	public function addfund()
	{
		$this->view->show("transactions");
	}
	public function avatar($para)
	{
		$uid = $para[1];
		//$_SESSION['uid']
		$avatar = "no-avatar.jpg";
		if(general::getInstance()->get_user_info($uid,"user_avatar"))
		{
			$avatar = general::getInstance()->get_user_info($uid,"user_avatar");
		}
		$avatar_path = XC_URL."/uploads/users/".$avatar;
		//echo $avatar_path;
		general::getInstance()->resize_image_crop($avatar_path);
	}
	public function panel($para)
	{
		if(isset($_SESSION['xID']) && $_SESSION['xID'] != "")
		{
			switch($para[1])
			{
				case "post":
				{
					$this->view->show("member_show");
					break;
				}
				case "like":
				{
					$this->view->show("member_like_post");
					break;
				}
				case "bst":
				{
					$this->view->show("member_bosuutap");
					break;
				}
				case "info":
				{
					$this->view->show("member_info");
					break;
				}
				case "naptien":
				{
					$this->view->show("member_napthe");
					break;
				}
				case "ruttien":
				{
					$this->view->show("member_ruttien");
					break;
				}
				case "history":
				{
					$this->view->show("member_payment_history");
					break;
				}
				default:
				{
					break;
				}
			}
		}
		else
		{
			header("Location: ".XC_URL."/member/login");
		}
	}
	
	public function spost()
	{
		$this->view->show("post");
	}
	public function login()
	{
		if(isset($_SESSION['xID']) && $_SESSION['xID'] != "")
		{
			header("Location: ".XC_URL);
		}
		else
		{
			$this->view->show("login");
		}
	}
    public function register()
    {
		$this->view->show('register');
    }
	//========
    public function ajaxcheckcaptcha()
    {
        //echo $_SESSION['captcha'];
        if(isset($_POST['code']) && $_POST['code'] != "")
        {
            $code = $_POST['code'];
            if(trim(strtolower($code)) == $_SESSION['captcha'])
            {
                echo "OK";
            }
            else
            {
                echo "ERROR";
            }
        }
        else
        {
            echo 'ERROR';
        }
    }
	public function ajaxlogin()
	{
		$username = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
        $member_login = $this->model->get('memberloginModel')->check_login($username,$password);
		if($member_login)
		{
			echo $_SESSION['xUser'];
		}
		else
		{
			echo "error";
		}
	}
	public function logout()
	{
		//session_start();
		session_destroy();
		header("Location: ".XC_URL);
	}
    public function ajaxsubs()
    {
        if(isset($_POST['email']) && $_POST['email'] != "")
        {
            $email = $_POST['email'];
            if(member::getInstance()->check_subs($email))
            {
                return false;
            }
            else
            {
                global $db;
                $db->query("INSERT INTO xdata_subscribe(xemail) VALUES('".$email."')");
            }
        }
        else
        {
            echo 'ERROR';
        }
    }
	public function apilogin()
	{
		if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	echo general::getInstance()->apilogin($provider);
        }
	}
	

}