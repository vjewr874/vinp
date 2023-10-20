<?php
Class pageController extends baseController
{
	public function index()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
	}
	public function test()
	{
		$this->view->show("frontend/index");
	}
	public function about()
	{
		$this->view->show("about");
	}
	public function login()
	{
		$this->view->show("frontend/login");
	}
	public function register()
	{
		$this->view->show("frontend/register");
	}
	public function testmail()
	{
		baseMailler::getInstance()->sendtask2("An Loc FSC Gia Lai","support@anlocgroup.vn","Thái Đình Sang","sangthaidinh@gmail.com","Xác minh địa chỉ email","222333");
	}
	public function account()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."'");
		$this->view->data["banklist"] = $db->fetch_object();
		$this->view->show('account');
	}
	public function deposit()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."'");
		$this->view->data["banklist"] = $db->fetch_object();
		$db->query("SELECT *, db.id as dbid FROM hicrm_deposit_banks as db
		LEFT JOIN system_banks as b ON db.bankid = b.id
		WHERE db.bank_status = 1
		ORDER BY RAND() LIMIT 1
		");
		$this->view->data["deposit_banks"] = $db->fetch_object();
		$this->view->data["page"]["title"] = "Nạp tiền";
		$this->view->data["page"]["key"] = "deposit";
		$this->view->show('deposit');
	}
	public function withdraw()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		//$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."' ORDER BY cb.id ASC LIMIT 1");
		$this->view->data["b"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$this->view->data["bankupdate"] = true;
		}
		else
		{
			$this->view->data["bankupdate"] = false;
		}
		$this->view->data["banklist"] = $db->fetch_object(true);
		$this->view->data["page"]["title"] = "Rút tiền";
		$this->view->data["page"]["key"] = "withdraw";
		$this->view->show('withdraw');
	}
	public function profile()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$this->view->data["bankupdate"] = true;
		}
		else
		{
			$this->view->data["bankupdate"] = false;
		}
		$this->view->data["banklist"] = $db->fetch_object(true);
		$this->view->show('profile');
	}
	public function trading()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$this->view->data["page"]["title"] = "Giao dịch";
		$this->view->data["page"]["key"] = "trading";
		$this->view->show('trading');
	}
	public function setting()
	{
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$this->view->show("setting");
	}
	public function verify()
	{
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		
		$this->view->show("verify");
	}
	public function banklist()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT *, cb.id as cbid FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.cid = '".$_SESSION['user']['id']."'");
		$this->view->data["banklist"] = $db->fetch_object();
		$this->view->show("banklist");
	}
	public function transactions()
	{
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		$db->query("SELECT * FROM portal_transactions as t
		LEFT JOIN portal_customer_banks as b ON t.trans_bank = b.id
		WHERE uid = '".$_SESSION['user']['id']."' AND (trans_type = 1 OR trans_type = 2 OR trans_type = 8) ORDER BY trans_time DESC");
		$this->view->data["transactions"] = $db->fetch_object();
		$this->view->data["page"]["title"] = "Lịch sử giao dịch";
		$this->view->data["page"]["key"] = "transactions";
		$this->view->show('transactions');
	}
	public function listunnote()
	{
		global $db;
		$db->query("SELECT *, c.id as cid, COUNT(m.id) AS countnote
		FROM crm_customers AS c
		LEFT JOIN crm_customer_notes AS m ON c.id = m.cid
		WHERE c.cus_assigned_to = '27' AND date(cus_assigned_time) < '2020-06-17'
		GROUP BY c.id
		HAVING countnote < 2");
		$listcus = $db->fetch_object();
		foreach($listcus as $cus)
		{
			$cid = $cus->cid;
			$uid = $cus->cus_assigned_to;
			$db->query("UPDATE crm_customers SET cus_assigned_to = '0', cus_status = '1' WHERE id = '".$cid."'");
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','1','BACKTOLEADS')");
			$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','LEADFAIL')");
			$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$_SESSION['user']['id']."','".$cid."','Đã chuyển leads về kho do không tương tác','6','3')");
			//$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."' LIMIT 1");
			//$cus = $db->fetch_object(true);
			echo $content = "Khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn đã được thu hồi do không tương tác!";
			echo "<br>";
			$url = XC_URL."/crm/customers/".$cid;
			crm::getInstance()->CreateNotification($uid,$content,$url);
		}
	}
	public function testpdf()
	{
		//baseMailler::getInstance()->newaccount("Sang Thai Dinh","sangthaidinh@gmail.com","sangtd","https://anlocgroup.vn");
		$to      = 'sangthaidinh@gmail.com';
		$subject = 'the subject';
		$message = 'hello';
		$headers = 'From: anloc@manage.anlocgroup.vn' . "\r\n" .
			'Reply-To: anloc@manage.anlocgroup.vn' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		echo mail($to, $subject, $message, $headers);
	}
	public function taihoso($para)
	{
		
		
	}
	public function thisweek()
	{
		echo $start = date("Y-m-d H:i:s",strtotime('this week - 1 day'));
		echo "<br>";
		echo $finish = date("Y-m-d H:i:s",strtotime('last week'));
	}
	public function sendallwelcome()
	{
		global $db;
		$db->query("SELECT * FROM crm_users WHERE NOT(user_zalo_id = '')");
		$listuser = $db->fetch_object();
		foreach($listuser as $user)
		{
			//$this->sendtest($user->user_title,$user->user_lastname,$user->user_zalo_id);
			//echo $user->user_title." ".$user->user_lastname."<br>";
			
		}
	}
	private function sendtest($title,$name,$uid)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.zalo.me/v2.0/oa/message?access_token=fZZfVTw2yNcbCEDntuBuVACvvNZPdRGe_bN-KkwUbn_3Uj10wPs8C_0ZycUFmvKPiYxQLSx1dXxjFTXZYTAY2AyJyGMMzRrCiIVKIB7KgJ7F5EH-qUYN9VqkaN_vzVSKt3keMShS-bpkBEOpqz-TPTmmssx6wfmhomgQG-RQypVVQBLftAdv4C5EanhViSvd-0-ZFVtckNJh1gS5z-NyPlKEY0w5ivPAhth9EewLc4YjSCCIY9-aI_Oct2_JbPvIypB51ulJt0BnRPzluO6POUrQon1kR4cAAppSdF5s",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>'{
							  "recipient": {
								"user_id": "'.$uid.'"
							  },
							  "message": {
								"attachment": {
									"type": "template",
									"payload": {
										"template_type": "list",
										"elements": [{
											"title": "An Loc Group - CRM",
											"subtitle": "Cảm ơn '.$title.' '.$name.' đã cung cấp thông tin hỗ trợ CRM. Xin vui lòng giữ kết nối để được cập nhật thông tin từ CRM.",
											"image_url": "https://anlocgroup.vn/crmbanner.jpg",
											"default_action": {
												"type": "oa.open.url",
												"url": "https://manage.anlocgroup.vn/"
												}
										}]
									}
								}
							  }
							}',
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;

	}
	public function testzalo()
	{
		global $db;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.zalo.me/v2.0/oa/getfollowers?access_token=fZZfVTw2yNcbCEDntuBuVACvvNZPdRGe_bN-KkwUbn_3Uj10wPs8C_0ZycUFmvKPiYxQLSx1dXxjFTXZYTAY2AyJyGMMzRrCiIVKIB7KgJ7F5EH-qUYN9VqkaN_vzVSKt3keMShS-bpkBEOpqz-TPTmmssx6wfmhomgQG-RQypVVQBLftAdv4C5EanhViSvd-0-ZFVtckNJh1gS5z-NyPlKEY0w5ivPAhth9EewLc4YjSCCIY9-aI_Oct2_JbPvIypB51ulJt0BnRPzluO6POUrQon1kR4cAAppSdF5s&data=%7B%22offset%22:0,%22count%22:30%7D",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($response,true);
		$listuid = $response["data"]["followers"];
		foreach($listuid as $uid)
		{
			echo $uid["user_id"]."<br>";
			$data = $this->get_zalo_uid_info($uid["user_id"]);
			var_dump($data);
			echo "<br>";
		}
		

	}
	private function get_zalo_uid_info($uid)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://openapi.zalo.me/v2.0/oa/getprofile?access_token=fZZfVTw2yNcbCEDntuBuVACvvNZPdRGe_bN-KkwUbn_3Uj10wPs8C_0ZycUFmvKPiYxQLSx1dXxjFTXZYTAY2AyJyGMMzRrCiIVKIB7KgJ7F5EH-qUYN9VqkaN_vzVSKt3keMShS-bpkBEOpqz-TPTmmssx6wfmhomgQG-RQypVVQBLftAdv4C5EanhViSvd-0-ZFVtckNJh1gS5z-NyPlKEY0w5ivPAhth9EewLc4YjSCCIY9-aI_Oct2_JbPvIypB51ulJt0BnRPzluO6POUrQon1kR4cAAppSdF5s&data={"user_id":"'.$uid.'"}',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($response,true);
		return $response["data"]["shared_info"];
		//return $response;
	}
	public function refundlist()
	{
		global $db;
		$db->query("SELECT * FROM crm_notifications");
		$listnoti = $db->fetch_object();
		foreach($listnoti as $noti)
		{
			$content = explode(" ",$noti->content);
			
			$db->query("SELECT * FROM crm_customers WHERE cus_code = '".$content[2]."' LIMIT 1");
			$cus = $db->fetch_object(true);
			echo $sql = "UPDATE crm_customers SET cus_status = '2', 	cus_assigned_to = '".$noti->receiver."', cus_assigned_by = '1', cus_assigned_time = '".date("Y-m-d H:i:s")."' WHERE id = '".$cus->id."'";
			$db->query($sql);
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cus->id."','".$noti->receiver."','ASSIGNTOUSER')");
			$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$noti->receiver."','GETLEADS')");
			echo $content[2]." Done<br>";
			//$result["status"] = '200';
			//$result["message"] = "Khách hàng ".$cus->cus_firstname." ".$cus->cus_lastname." đã được điều chuyển!";
		}
	}
	public function sendnotification()
	{
		global $db;
		$db->query("SELECT * FROM crm_users");
		$listuser = $db->fetch_object();
		foreach($listuser as $user)
		{
			$db->query("INSERT INTO crm_notifications(sender,receiver,title,content) VALUES('1','".$user->id."','Thu hồi lead','Lead cũ đã được khôi phục!')");
		}
	}
	public function checkcuslist()
	{
		global $db;
		$db->query("SELECT c.id as cid, c.cus_code, u.id as uid, u.user_username, (SELECT count(*) FROM crm_customer_notes WHERE cid = c.id) as countnote 
		FROM `crm_customers` as c 
		LEFT JOIN crm_users as u ON u.id = c.cus_assigned_to
		WHERE c.cus_status = 1 AND (c.cus_assigned_time < '2020-05-27 00:00:00' AND c.cus_assigned_time > '2020-05-24 00:00:00')
		");
		$listcus = $db->fetch_object();
		foreach($listcus as $cus)
		{
			echo $cus->cus_code." ".$cus->user_username." ".$cus->countnote."<br>";
			
			$uid = $cus->uid;
			$cid = $cus->cid;
			$db->query("SELECT *,u.id as uid FROM crm_customer_notes as n
			LEFT JOIN crm_users as u ON n.uid = u.id
			WHERE cid = '".$cus->cid."'");
			$listnote = $db->fetch_object();
			foreach($listnote as $note)
			{
				echo $note->uid." ".$note->user_username." ".$note->note_time." ".$note->note_description."<br>";
			}
			if($uid)
			{
				//$db->query("UPDATE crm_customers SET cus_assigned_to = '0', cus_status = '1' WHERE id = '".$cid."'");
				//$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','1','BACKTOLEADS')");
				//$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','LEADFAIL')");
				//echo $note = 'Khách hàng '.$cid.' vừa bị thu hồi do không tương tác';
				//echo "<br>";
				//$db->query("INSERT INTO crm_notifications(sender,receiver,title,content) VALUES('1','".$uid."','Thu hồi lead','".$note."')");
			}
			echo "<hr>";
		}
	}
	public function config()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		if(isset($_POST['updatekey']) && $_POST['updatekey'] != "")
		{
			global $db;
			$listkey = explode(',',$_POST['updatekey']);
			for($i = 0;$i< count($listkey);$i++)
			{
				$db->query("SELECT id FROM fb_configs WHERE config_key = '".$listkey[$i]."'");
				if($db->num_row())
				{
					$db->query("UPDATE fb_configs SET config_value = '".$_POST[$listkey[$i]]."' WHERE config_key = '".$listkey[$i]."'");
				}
				else
				{
					$db->query("INSERT INTO fb_configs(config_key,config_value) VALUES('".$listkey[$i]."','".$_POST[$listkey[$i]]."')");
				}
			}
			header("Location: ".XC_URL."/page/config");
		}
		else
		{
			$this->view->show("config");
		}
	}
	private function imageResize($imageResourceId,$width,$height) {
		$targetWidth =200;
		$targetHeight =200;
		$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
		imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
		return $targetLayer;
	}
	public function updateavatar2()
	{
		if($_FILES['avatar']['name'])
		{
			$file = $_FILES['avatar']['tmp_name']; 
			$avatar = "mualinkfb-".md5(time())."-tumb-".$_FILES['avatar']['name'];
			$sourceProperties = getimagesize($file);
			$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			$imageType = $sourceProperties[2];
			$folderPath = "./uploads/users/";

			switch ($imageType) {
				case IMAGETYPE_PNG:
					$imageResourceId = imagecreatefrompng($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagepng($targetLayer,$folderPath.$avatar);
					break;
				case IMAGETYPE_GIF:
					$imageResourceId = imagecreatefromgif($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagegif($targetLayer,$folderPath.$avatar);
					break;


				case IMAGETYPE_JPEG:
					$imageResourceId = imagecreatefromjpeg($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagejpeg($targetLayer,$folderPath.$avatar);
					break;


				default:
					echo "Invalid Image type.";
					exit;
					break;
			}

			//move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
			move_uploaded_file($file,"./uploads/users/".$avatar);
		}
		else
		{
			$avatar = "no-avatar.jpg";
		}
		global $db;
		$db->query("UPDATE fb_users SET user_avatar = '".$avatar."' WHERE id = '".$_SESSION['uid']."'");
		header("Location: ".XC_URL);
	}
	public function updateavatar()
	{
		if($_FILES['avatar']['name'])
		{
			$file = $_FILES['avatar']['tmp_name']; 
			$sourceProperties = getimagesize($file);
			$fileNewName = "portal-anlocgroup-".md5(time())."-".$_SESSION['user']['id']."-tumb-";
			$folderPath = "./uploads/users/";
			$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			$imageType = $sourceProperties[2];


			switch ($imageType) {


				case IMAGETYPE_PNG:
					$imageResourceId = imagecreatefrompng($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagepng($targetLayer,$folderPath. $fileNewName. $ext);
					break;


				case IMAGETYPE_GIF:
					$imageResourceId = imagecreatefromgif($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagegif($targetLayer,$folderPath. $fileNewName. $ext);
					break;


				case IMAGETYPE_JPEG:
					$imageResourceId = imagecreatefromjpeg($file); 
					$targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagejpeg($targetLayer,$folderPath. $fileNewName.  $ext);
					break;


				default:
					echo "Invalid Image type.";
					exit;
					break;
			}
			$avatarname = $fileNewName.  $ext;

			move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
		}
		else
		{
			$avatarname = "no-avatar.jpg";
		}
		global $db;
		$db->query("UPDATE portal_customers SET  cus_avatar = '".$avatarname. "' WHERE id = '".$_SESSION['user']['id']."'");
		header("Location: ".XC_URL."/ho-so.html");
	}
	public function exportuser()
	{
		general::getInstance()->exportuser();
	}
	public function export()
	{
		$file = $_GET['file'];
		$type = $_GET['type'];
		if($file == "excel")
		{
			general::getInstance()->exportexcel($type);
		}
		else
		{
			$handle = fopen("mualinkfb-mylink.txt", "w");
			global $db;
			$db->query("SELECT * FROM fb_accounts WHERE account_type = '".$type."' AND account_buyer = '".$_SESSION['uid']."' AND account_status = '1'");
			$listmylink = $db->fetch_object();
			foreach($listmylink as $link)
			{
				fwrite($handle, $link->account_link."|".$link->account_businessid."\r\n");
			}
			fclose($handle);
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename('mualinkfb-mylink.txt'));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('mualinkfb-mylink.txt'));
			readfile('mualinkfb-mylink.txt');
			exit;
		}
	}
	
	public function exporttxt($para)
	{
		
	}
	
}