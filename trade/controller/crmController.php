<?php
Class crmController extends baseController
{
	
	public function index()
	{
		$this->checklogin();
		
	}
	public function leads()
	{
		if(!(isset($_SESSION['user']) && $_SESSION['user'] != null)){ header("Location: ".XC_URL."/login"); }
		
		$this->view->show("leads");
	}
	public function motaikhoan()
	{
		if(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == "1" || $_SESSION['user']['id'] == "17"))
		{
			global $db;
			$db->query("SELECT * FROM crm_open_accounts ORDER BY acc_register_date DESC");
			$this->view->data["listopen"] = $db->fetch_object();
			$this->view->show("openaccount");
		}
	}
	public function profile()
	{
		if(!(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM crm_users WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data['aid'] = $_SESSION['user']['id'];
		$this->view->data['agentdata'] = $db->fetch_object(true);
		$this->view->show("agent-profile");
	}
	public function testlevel()
	{
		global $db;
		$db->query("SELECT * FROM crm_users");
		$listuser = $db->fetch_object();
		foreach($listuser as $user)
		{
			echo $user->user_username." | ".crm::getInstance()->cal_top($user->id)."<br>";
		}
	}
	public function ourcustomers()
	{
		header("Location: ".XC_URL."/crm/leads");
	}
	public function ranking()
	{
		global $db;
		$db->query("SELECT *, (SELECT COUNT(*) as countlead FROM crm_user_logs WHERE uid = u.id AND log_key = 'GETLEADS') as countlead, (SELECT COUNT(*) as countnote FROM crm_customer_notes WHERE uid = u.id) as countnote, (SELECT COUNT(*) as countlevel FROM crm_user_logs WHERE uid = u.id AND log_key = 'SUCCESSLEVELLEAD') as countuplevel FROM `crm_users` as u
		LEFT JOIN crm_departments as d ON u.user_dept = d.id
		LEFT JOIN crm_teams as team ON u.user_team = team.id
		WHERE u.user_level_point = 1
		ORDER BY countuplevel DESC, u.user_level DESC, countnote DESC, countlead DESC");
		$this->view->data["users"] = $db->fetch_object();
		$this->view->show("ranking");
	}
	public function report()
	{
		header("Location: ".XC_URL."/crm/leads");
	}
	public function allnote()
	{
		if(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == "1" || $_SESSION['user']['id'] == "17"))
		{
			global $db;
			$db->query("SELECT *,c.id as cid FROM crm_customer_notes as n
			LEFT JOIN crm_customers as c  ON n.cid = c.id
			LEFT JOIN crm_users as u ON n.uid = u.id
			ORDER BY n.note_time DESC
			");
			$this->view->data["notes"] = $db->fetch_object();
			$this->view->show("customer-notes");
		}
		elseif(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == "13" || $_SESSION['user']['id'] == "16"))
		{
			global $db;
			$db->query("SELECT *,c.id as cid FROM crm_customer_notes as n
			LEFT JOIN crm_customers as c  ON n.cid = c.id
			LEFT JOIN crm_users as u ON n.uid = u.id
			WHERE NOT(n.note_method = '6')
			ORDER BY n.note_time DESC
			");
			$this->view->data["notes"] = $db->fetch_object();
			$this->view->show("customer-notes");
		}
		elseif(isset($_SESSION['user']['id']) && ($_SESSION['user']['group'] == "2"))
		{
			global $db;
			$db->query("SELECT *,c.id as cid FROM crm_customer_notes as n
			LEFT JOIN crm_customers as c  ON n.cid = c.id
			LEFT JOIN crm_users as u ON n.uid = u.id
			WHERE u.user_team = '".$_SESSION['user']['teamid']."'
			ORDER BY n.note_time DESC
			");
			$this->view->data["notes"] = $db->fetch_object();
			$this->view->show("customer-notes");
		}
		else
		{
			global $db;
			$db->query("SELECT *,c.id as cid FROM crm_customer_notes as n
			LEFT JOIN crm_customers as c  ON n.cid = c.id
			LEFT JOIN crm_users as u ON n.uid = u.id
			WHERE n.uid = '".$_SESSION['user']['id']."' 
			ORDER BY n.note_time DESC
			");
			$this->view->data["notes"] = $db->fetch_object();
			$this->view->show("customer-notes");
		}
	}
	public function customers($para)
	{
		if(!(isset($_SESSION['user']) && $_SESSION['user'] != null)){ header("Location: ".XC_URL."/login"); }
		if(isset($para[1]) && $para[1] != "")
		{
			global $db;
			$cid = $para[2];
			if($para[1] = "detail")
			{
				$db->query("SELECT *,c.id as cid FROM crm_customers as c
				LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
				LEFT JOIN crm_users as u ON u.id = c.cus_assigned_to
				WHERE c.id = '".$cid."'
				");
				$db->num_row();
				if($db->num_row())
				{
					$this->view->data["cus"] = $cus = $db->fetch_object(true);
					if($_SESSION['user']['id'] == "1" || $_SESSION['user']['id'] == "17")
					{
						$db->query("SELECT * FROM crm_users WHERE user_status = '1'");
					}
					else
					{
						$db->query("SELECT * FROM crm_users WHERE user_team = '".$cus->user_team."' AND user_status = '1' OR id = '1' OR id = '17'");
					}
					
					$this->view->data["assignlist"] = $db->fetch_object();
					$this->view->show("customer-view");
				}
			}
			elseif($para[1] = "activity")
			{
			}
			else
			{
				
			}
		}
		else
		{
			if(isset($_GET['type']) && $_GET['type'] == "potential")
			{
				$this->view->show("potentialcustomers");
			}
			else
			{
				$this->view->show("customers");
			}
				
		}
		
	}
	
	public function updateprofile()
	{
		if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != "")
		{
			global $db;
			$updatekey = $_POST['updatekey'];
			$updatekey = explode(',',$updatekey);
			foreach($updatekey as $key)
			{
				echo $key."-".$_POST[$key]."<br>";
				if($_POST[$key] != "")
				{
					$db->query("UPDATE crm_users SET ".$key." = '".$_POST[$key]."' WHERE id = '".$_SESSION['user']['id']."'");
				}
			}
			header("Location: ".XC_URL."/crm/profile");
		}
		else
		{
			header("Location: ".XC_URL);
		}
	}
	public function createuser()
	{
		$result = array();
		$username = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$dept = $_POST['dept'];
		if($dept != 3)
		{
			$team = '0';
		}
		else
		{
			$team = $_POST['team'];
		}
		global $db;
		$db->query("SELECT * FROM crm_users WHERE user_username = '".$username."' OR user_phone = '".$phone."' ");
		if($db->num_row())
		{
			$result['status'] = '403';
			$result['message'] = 'User already in database, please choice another username!';
		}
		else
		{
			$token = general::getInstance()->generate_string(16);
			$otp = general::getInstance()->generate_number(6);
			$sql = "INSERT INTO crm_users(user_username, user_password,user_group,user_token,user_verify_otp,user_status,user_dept,user_team,user_phone,user_email) VALUES('".$username."','".$password."','3','".$token."','".$otp."','1','".$dept."','".$team."','".$phone."','".$email."')";
			$db->query($sql);
			$result['status'] = '200';
			$result['message'] = 'Success to create user: '.$username.'!';
			//$result["message"] = $sql."sss";
		}
		echo json_encode($result);
	}
	public function resetpass()
	{
		$result = array();
		if(isset($_POST['uid']) && $_POST['uid'] != "")
		{
			$uid = $_POST['uid'];
			$password = $_POST['password'];
			global $db;
			$db->query("SELECT * FROM crm_users WHERE id = '".$uid."'");
			if($db->num_row())
			{
				$db->query("UPDATE crm_users SET user_password = '".md5($password)."' WHERE id = '".$uid."'");
				$db->query("INSERT INTO crm_user_logs(uid,log_key,log_value) VALUES('".$uid."','ADMINCHANGEPASS','Password has been change by administrator or leader.')");
				$result['status'] = "200";
				$result['message'] = "Success!";
			}
			else
			{
				$result['status'] = "404";
				$result['message'] = "User not found!";
			}
		}
		else
		{
			$result['status'] = "403";
			$result['message'] = "Access denied!";
		}
		echo json_encode($result);
	}
	public function suspenduser()
	{
		$result = array();
		$uid = $_POST['uid'];
		global $db;
		$db->query("SELECT * FROM crm_users WHERE id = '".$uid."'");
		if($db->num_row())
		{
			$db->query("UPDATE crm_users SET user_status = '0' WHERE id = '".$uid."'");			
			$result['status'] = "200";
			$result['message'] = "Success!";
		}
		else
		{
			$result['status'] = "404";
			$result['message'] = "User not found!";
		}
		echo json_encode($result);
	}
	public function calendar()
	{
		$this->view->show("calendar");
	}
	public function users($para)
	{
		
		$this->view->data['access_zone'] = "agent";
		if(isset($para[1]) && $para[1] == "overview")
		{
			$this->view->data["view"] = "overview";
			$uid = $para[2];
			global $db;
			$db->query("SELECT * FROM crm_users as u
			LEFT JOIN crm_departments as d ON u.user_dept = d.id
			WHERE u.id = '".$uid."'");
			if($db->num_row())
			{
				
				$this->view->data['uid'] = $uid;
				$this->view->data['user'] = $db->fetch_object(true);
				$this->view->show("user-detail");
			}
			else
			{
				header("Location: ".XC_URL."/crm/users");
			}
		}
		elseif(isset($para[1]) && $para[1] == "info")
		{
			$this->view->data["view"] = "info";
			if(isset($_POST['hash']) && $_POST['hash'] != "")
			{
				global $db;
				$uid = $_POST['uid'];
				$updatekey = $_POST['update_key'];
				$key = explode(",",$updatekey);
				foreach($key as $k)
				{
					$db->query("UPDATE crm_users SET ".$k." = '".$_POST[$k]."' WHERE id = '".$uid."'");
				}
			}
			$uid = $para[2];
			global $db;
			$db->query("SELECT * FROM crm_users as u
			LEFT JOIN crm_departments as d ON u.user_dept = d.id
			WHERE u.id = '".$uid."'");
			if($db->num_row())
			{
				
				$this->view->data['uid'] = $uid;
				$this->view->data['user'] = $db->fetch_object(true);
				$this->view->show("user-personal-infomation");
			}
			else
			{
				header("Location: ".XC_URL."/crm/users");
			}
		}
		elseif(isset($para[1]) && $para[1] == "account")
		{
			$this->view->data["view"] = "account";
			if(isset($_POST['hash']) && $_POST['hash'] != "")
			{
				global $db;
				$uid = $_POST['uid'];
				$updatekey = $_POST['update_key'];
				$key = explode(",",$updatekey);
				foreach($key as $k)
				{
					$db->query("UPDATE bet_users SET ".$k." = '".$_POST[$k]."' WHERE id = '".$uid."' AND user_ref_uid = '".$_SESSION['user']['id']."'");
				}
			}
			$uid = $para[2];
			global $db;
			$db->query("SELECT * FROM crm_users WHERE id = '".$uid."'");
			if($db->num_row())
			{
				
				$this->view->data['uid'] = $uid;
				$this->view->data['user'] = $db->fetch_object(true);
				$this->view->show("user-account");
			}
			else
			{
				header("Location: ".XC_URL."/crm/users");
			}
		}
		elseif(isset($para[1]) && $para[1] == "customerlist")
		{
			$this->view->data["view"] = "customerlist";
			$uid = $para[2];
			global $db;
			$db->query("SELECT * FROM crm_users as u
			LEFT JOIN crm_departments as d ON u.user_dept = d.id
			WHERE u.id = '".$uid."'");
			if($db->num_row())
			{
				
				$this->view->data['uid'] = $uid;
				$this->view->data['user'] = $db->fetch_object(true);
				$this->view->show("user-customer");
			}
			else
			{
				header("Location: ".XC_URL."/crm/users");
			}
		}
		elseif(isset($para[1]) && $para[1] == "report")
		{
			$this->view->data["view"] = "finance";
			$uid = $para[2];
			global $db;
			$db->query("SELECT * FROM crm_users WHERE id = '".$uid."'");
			if($db->num_row())
			{
				$this->view->data['user'] = $db->fetch_object(true);
				$this->view->data['uid'] = $uid;
				$this->view->show("user-report");
			}
			else
			{
				header("Location: ".XC_URL."/crm/users");
			}
		}
		else
		{
			
			if(!(isset($_SESSION['user']) && $_SESSION['user'] != null)){ header("Location: ".XC_URL."/login"); }
			global $db;
			if($_SESSION['user']['group'] == "2")
			{
				$sql = "SELECT * FROM crm_users WHERE user_status = '1' AND user_team = '".$_SESSION['user']['teamid']."' ORDER BY id DESC";
			}
			elseif($_SESSION['user']['id'] == "1" || $_SESSION['user']['id'] == "17" || $_SESSION['user']['id'] == "13" || $_SESSION['user']['id'] == "16")
			{
				$sql = "SELECT * FROM crm_users WHERE  NOT(user_dept = 1) ORDER BY id DESC";
			}
			$db->query($sql);
			$this->view->data['countuser'] = $db->num_row();
			$this->view->data['users'] = $db->fetch_object();
			$this->view->show("user-list");
			
		}
		//$this->view->show("agent-users");
	}
	
	public function active($para)
	{
		$token = $para[1];
		global $db;
		$db->query("SELECT * FROM sgt_users WHERE email_token = '".$token."' LIMIT 1");
		$this->view->data['token'] = $token;
		$this->view->data['check'] = $db->num_row();
		$this->view->data['users'] = $db->fetch_object(true);
		$this->view->admintmp("active");
	}
	public function checklogin()
	{
		if(!(isset($_SESSION['xID']) && $_SESSION['xID'] != ""))
		{
			header("Location: ".XC_URL."/crm/leads");
		}
	}
	public function logout()
	{
		//session_start();
		session_destroy();
		header("Location: ".XC_URL."/crm");
	}
	public function schedule()
	{
		$this->checklogin();
		//$this->view->admintmp("login");
	}
	public function inbox()
	{
		$this->view->admintmp("inbox");
	}
	public function emailabc($para)
	{
		$name = "Quang, Le Ngoc";
		$email = "quanghaiau.qn@gmail.com";
		echo baseMailler::getInstance()->cmsn($name,$email);
		//echo baseMailler::getInstance()->sendtask("Seagull Travel","no-reply@xiao.vn",$name,$email,"New Task Status T00087","");
		//echo baseMailler::getInstance()->newaccount("Thai Dinh Sang","sangtd@xiao.vn","sangtd",XC_URL."/crm/active/213123124sadasd1212");
		//echo $email." - ".$name;
		//echo baseMailler::getInstance()->send2("Seagull Travel","sangtd@xiao.vn","Sang Thai Dinh","kenzakivn@gmail.com","Thu gui tu VeMayBayHaiAu","Noi dung thu gui tu VeMayBayHaiAu");
		//echo baseMailler::getInstance()->sendersmtp("Ken Zaki","kenzakivn@gmail.com","test",$content,$value);
	}
	public function tasklist()
	{
		$this->view->data['tasks'] = hr::getInstance()->get_running_task($_SESSION['xID']);
		$this->view->admintmp("tasks");
	}
	public function testabcd()
	{
		//echo md5(date("d-m-Y H:i:s"))."<br>";
		echo substr(md5(date("d-m-Y H:i:s")),2,32);
		//3b1393d647f307a0420d6182609e3844

	}
	public function tour($para)
	{
		$this->view->admintmp("accessdenine");
	}
	public function login()
	{
		$this->view->admintmp("login");
	}
	public function send_mail($email,$subject,$msg) {
		 $api_key="key-901ede91ccd250f9b78b6923f98996f4";/* Api Key got from https://mailgun.com/cp/my_account */
		 $domain ="sandboxfab42856df0c462ba99f8d56b18f4a7c.mailgun.org";/* Domain Name you given to Mailgun */
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		 curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		 curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.$domain.'/messages');
		 curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		  'from' => 'Sang TD <sangtd@xiao.vn>',
		  'to' => $email,
		  'subject' => $subject,
		  'html' => $msg
		 ));
		 $result = curl_exec($ch);
		 curl_close($ch);
		 return $result;
		}
	
	public function sms($para)
	{
		switch($para[1])
		{
			case "new":
			{
				//$this->view->admintmp("newcustomer");
				break;
			}
			case "sent":
			{
				$this->view->admintmp("sms_sent");
				break;
			}
			default:
			{
				$this->view->admintmp("smscampain");
				break;
			}
		}
		
	}
	public function customesrs($para)
	{
		switch($para[1])
		{
			case "new":
			{
				$this->view->admintmp("newcustomer");
				break;
			}
			case "detail":
			{
				//echo $para[2];
				$this->view->data['cus'] = $this->model->get("customerModel")->get_customer_detail($para[2]);
				$this->view->admintmp("customer_detail");
				break;
			}
			default:
			{
				$this->view->data['customerlists'] = $this->model->get("customerModel")->get_customers_list();
				$this->view->admintmp("customers");
				break;
			}
		}
		
	}
	public function company($para)
	{
		switch($para[1])
		{
			case "detail":
			{
				echo $para[2];
				$this->view->admintmp("company_detail");
				break;
			}
			default:
			{
				$this->view->data['companylist'] = $this->model->get("companyModel")->get_companys_list();
				$this->view->admintmp("companys");
				break;
			}
		}
	}
	public function category($para)
	{
		$this->checklogin();
		switch($para[1])
		{
			case "menu":
			{
				$this->view->data['listmenu'] = crm::getInstance()->get_list_menu();
				$this->view->admintmp("thucdon");
				break;
			}
			case "restaurants":
			{
				$this->view->data['listres'] = crm::getInstance()->get_list_res();
				$this->view->admintmp("nhahang");
				break;
			}
			default:
			{
				break;
			}
		}
	}
	public function sales($para)
	{
		$this->checklogin();
		switch($para[1])
		{
			case "tiec-cuoi":
			{
				$this->view->admintmp("tieccuoi");
				break;
			}
			case "hoi-nghi":
			{
				$this->view->admintmp("event-booking");
				break;
			}
			default:
			{
				break;
			}
		}
	}
	public function functionsheet($para)
	{
		$this->view->data['invoiceid'] = $para[1];
		$this->view->admintmp("functionsheet");
	}
	public function airlineticket($para)
	{
		$this->checklogin();
		switch($para[1])
		{
			case "promotion":
			{
				$this->view->data['promolist'] = $this->model->get("promotionModel")->get_promotion();
				$this->view->admintmp("airpromotion");
				break;
			}
			case "booking":
			{
				if($_SESSION['xGroup'] == 5)
				{
					$this->view->data['listbooking'] = booking::getInstance()->get_list_booking_by_staff($_SESSION['xID']);
				}
				else
				{
					$this->view->data['listbooking'] = booking::getInstance()->get_list_booking_by_all();
				}
				$this->view->admintmp("booking");
				break;
			}
			case "new":
			{
				$this->view->admintmp("newbooking");
				break;
			}
			default:
			{
				break;
			}
		}
	}
}