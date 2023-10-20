<?php

Class ajaxController extends baseController
{
    public function index()
    {
        echo "Hello! sangtd@xiao.vn";
    }
	public function userlogin()
	{
		$result = array();
		$username = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
        $member_login = $this->model->get('memberloginModel')->user_login($username,$password);
		if($member_login)
		{
			$result["status"] = "200";
			$result["name"] = $_SESSION['user']['fullname'];
			//echo $_SESSION['user']['id'];
		}
		else
		{
			$result["status"] = "500";
			//echo "error";
		}
		echo json_encode($result);
	}
	public function userloginold()
	{
		$result = array();
		$username = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
        $member_login = $this->model->get('memberloginModel')->user_login($username,$password);
		if($member_login)
		{
			//$result["status"] = "200";
			//$result["name"] = $_SESSION['user']['fullname'];
			echo $_SESSION['user']['id'];
		}
		else
		{
			//$result["status"] = "500";
			echo "error";
		}
		//echo json_encode($result);
	}
	public function register()
	{
		if(isset($_POST['phone']) && $_POST['phone'] != "")
		{
			$role = 2;
			if(isset($_POST['role']) && $_POST['role'] != "")
			{
				$role = $_POST['role'];
			}
			$username = mysql_real_escape_string($_POST["phone"]);
			$password = md5(mysql_real_escape_string($_POST["password"]));
			global $db;
			$db->query("SELECT id FROM fb_users WHERE user_phone = '".$username."'");
			if($db->num_row())
			{
				echo "503";
			}
			else
			{
				$db->query("INSERT INTO fb_users(user_phone,user_password,user_group,user_status,user_balance) VALUES('".$username."','".$password."','".$role."','1',0)");
				echo "200";
			}
		}
	}
	
	public function checklimit()
	{
		if(isset($_SESSION['uid']) && $_SESSION['uid'] != "")
		{
			$limitamounttocheck = general::getInstance()->get_config("min_amount_to_use_tools");
			global $db;
			$db->query("SELECT * FROM fb_users WHERE id = '".$_SESSION['uid']."' LIMIT 1");
			$user =  $db->fetch_object(true);
			if($user->user_balance < $limitamounttocheck)
			{
				$result['status'] = "503";
				$result['message'] = "Công cụ này là miễn phí, tuy nhiên bạn cần có số dư tối thiểu: ".number_format($limitamounttocheck,0)."đ để sử dụng!";
			}
			else
			{
				$bmid = $_POST['listbmid'];
				$bmids = explode(PHP_EOL,$bmid);
				$result = array();
				$listerror = array();
				$list350 = array();
				$list50 = array();
				$listdie = array();
				$total350 = 0;
				$total50 = 0;
				$totalerror = 0;
				$totaldie = 0;
				foreach($bmids as $id)
				{
					if($id != "")
					{
						$res = file_get_contents("https://graph.facebook.com/v4.0/".$id."?access_token=EAAGNO4a7r2wBAAS2JUhVV62wxvweuSVhmYZAZBW9PdtkyvWJ4j5muZALVIgOKP7srhbt8VMJMShti0rUMt3BBxbnuGi0fJ3ZAGr3dnTr9vUDpXPcZBPP3JlPFimzgafOCIQk1wc5jZAEyQ6k0hScpjZBLeUBP2qCCm8NtVnMLkZAbgZDZD&__business_id=436761779744620&_index=4&_reqName=object%3Abrand&_reqSrc=BrandResourceRequests.brands&date_format=U&fields=%5B%22id%22%2C%22name%22%2C%22vertical_id%22%2C%22timezone_id%22%2C%22picture.type(square)%22%2C%22primary_page.fields(name%2C%20picture%2C%20link)%22%2C%22payment_account_id%22%2C%22link%22%2C%22created_time%22%2C%22created_by.fields(name)%22%2C%22updated_time%22%2C%22updated_by.fields(name)%22%2C%22extended_updated_time%22%2C%22two_factor_type%22%2C%22allow_page_management_in_www%22%2C%22eligible_app_id_for_ami_initiation%22%2C%22verification_status%22%2C%22sharing_eligibility_status%22%2C%22can_create_ad_account%22%2C%22can_use_extended_credit%22%2C%22is_business_verification_eligible%22%2C%22is_non_discrimination_certified%22%2C%22can_add_or_create_page%22%5D&locale=en_US&method=get&pretty=0&suppress_http_code=1&xref=f1916eb590d9e8");
						$res = json_decode($res,true);
						$live = "Live";
						if($res["allow_page_management_in_www"] == false)
						{
							$live = "Die";
						}
						else
						{
							$live = "Live";
						}
						$type = "$350";
						if($res["sharing_eligibility_status"] == "enabled"){
							$type  = "$350";
						}
						else
						{
							$type = "$50";
						}
						$row = array();
						
						if($res["name"] == "")
						{
							$row["id"] = $id;
							$row["name"] = "Invaild ID";
							$row["live"] = "Die";
							$row["type"] = "$0";
							array_push($listerror,$row);
						}
						else
						{
							$row["id"] = $res["id"];
							$row["name"] = $res["name"];
							$row["type"] = $type;
							if($live == "Live")
							{
								if($type == "$350")
								{
									array_push($list350,$row);
								}
								else
								{
									array_push($list50,$row);
								}
							}
							else
							{
								array_push($listdie,$row);
							}
						}
						
					}
					
				}
				$result['status'] = "200";
				$result["listid"] = $bmids;
				$result["count"]["total"] = count($bmids);
				$result["count"]["bm350"] = count($list350);
				$result["count"]["bm50"] = count($list50);
				$result["count"]["bmerror"] = count($listerror);
				$result["count"]["bmdie"] = count($listdie);
				$result["data"]["error"] = $listerror;
				$result["data"]["die"] = $listdie;
				$result["data"]["list350"] = $list350;
				$result["data"]["list50"] = $list50;
			}
			
		}
		else
		{
			$result["status"] = "500";
			$result["message"] = "Vui lòng đăng nhập trước khi sử dụng công cụ này!";
		}
		echo json_encode($result);
		//$res = file_get_contents("");
		//echo $res;
	}
	public function createrequest()
	{
		global $db;
	
		$param = array(
			'api_key' => ZPAY_API_KEY,
			'api_secrect' => ZPAY_API_SECRECT,
			'amount' => $_POST['amount'],
			'bank' => '2',
			'customer' => $_SESSION['user_phone'],
			'order_no' => $_POST['orderno'],
			'checkingcode' => $_POST['checkingcode']
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
			$db->query("SELECT * FROM fb_deposites WHERE uid = '".$_SESSION['uid']."' AND deposite_order = '".$_POST['orderno']."'");
			if($db->num_row())
			{
				$db->query("UPDATE fb_deposites SET deposit_amount = '".$_POST['amount']."'  WHERE uid = '".$_SESSION['uid']."' AND deposite_order = '".$_POST['orderno']."'");
			}
			else
			{
				$db->query("INSERT INTO fb_deposites(uid,deposite_order, deposit_method, deposit_amount, deposit_code, deposit_status) VALUES ('".$_SESSION['uid']."','".$_POST['orderno']."', '1', '".$_POST['amount']."', '".$_POST['checkingcode']."', '0');");
			}
			
			echo $response['qrcode'];
		}
		else
		{
			echo "";
		}
	}
	public function testrequest()
	{
		$param = array(
			'api_key' => ZPAY_API_KEY,
			'api_secrect' => ZPAY_API_SECRECT,
			'amount' => "100000",
			'bank' => '2',
			'customer' => "0917281333",
			'order_no' => "22222",
			'checkingcode' => "TESTTCODE"
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
			var_dump($response);
		}
		else
		{
			var_dump($response);
		}
	}
	public function cronupdatedeposit()
	{
		global $db;
		$db->query("INSERT INTO fb_logs(time) VALUES('".date("Y-m-d H:i:s")."')");
		$db->query("SELECT * FROM fb_deposites WHERE deposit_status = '0'");
		$listdeposit = $db->fetch_object();
		foreach($listdeposit as $deposit)
		{
			echo $deposit->deposit_code."<br>";
			$param = array(
				'api_key' => ZPAY_API_KEY,
				'api_secrect' => ZPAY_API_SECRECT,
				'checkingcode' => $deposit->deposit_code
			);
			$url = 'http://api.dovebay.com/service/checkrequest';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, count($param));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param); 
			$result = curl_exec($ch);
			curl_close($ch);
			$response = json_decode($result,true);
			if($response['status'] == "200")
			{
				if($response['order_status'] == "2")
				{
					$db->query("INSERT INTO fb_transactions(trans_code,trans_from,trans_uid,trans_amount,trans_hash,trans_note,trans_type,trans_method,trans_date,trans_status) VALUES('".$response['order']."', '1', '".$deposit->uid."', '".floatval($response['amount'])."', '".bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM))."','Nạp tiền tự động cho giao dịch số: ".$response['order']."','1','3','".date("Y-m-d H:i:s")."',1)");
					$db->query("UPDATE fb_users SET user_balance = user_balance + ".floatval($response['amount'])." WHERE id = '".$deposit->uid."'");
					$db->query("UPDATE fb_deposites SET deposit_status = '2', deposit_amount = '".floatval($response['amount'])."' WHERE id = '".$deposit->id."'");
				}
			}
			else
			{
				//var_dump($response);
			}
		}
	}
	public function updatepass()
	{
		$old = $_POST['oldpass'];
		$new = $_POST['newpass'];
		$renew = $_POST['renewpass'];
		if($new == $renew)
		{
			global $db;
			$db->query("SELECT user_password FROM fb_users WHERE id = '".$_SESSION['uid']."'");
			if($db->fetch_object(true)->user_password == md5($old))
			{
				$db->query("UPDATE fb_users SET user_password = '".md5($new)."' WHERE id = '".$_SESSION['uid']."'");
				echo "Đổi mật khẩu thành công!";
			}
			else
			{
				echo "Mật khẩu cũ không chính xác!";
			}
		}
		else
		{
			echo "Xác nhận mật khẩu không trùng khớp!";
		}
	}
	public function buyfb()
	{
		echo "Xin lỗi, hệ thống đang tạm ngưng để bảo trì. Xin vui lòng quay lại sau ít phút. Xin cảm ơn!";
		/*
		$id = $_POST['aid'];
		$uid = $_SESSION['uid'];
		global $db;
		$db->query("SELECT * FROM fb_users WHERE id = '".$uid."'");
		$user = $db->fetch_object(true);
		$db->query("SELECT * FROM fb_accounts WHERE id = '".$id."' AND account_status = '0'");
		$a = $db->fetch_object(true);
		$price = $a->account_price;
		if($user->user_balance < $price)
		{
			echo '100';
		}
		else
		{
			$db->query("UPDATE fb_accounts SET account_status = '1', account_buyer = '".$uid."', account_buydate = '".date("Y-m-d H:i:s")."' WHERE id = '".$id."'");
			$code = general::getInstance()->generateid("transaction");
			$db->query("INSERT INTO fb_transactions(trans_code,trans_from,trans_uid,trans_amount,trans_hash,trans_note,trans_type,trans_method,trans_date,trans_status) VALUES('".$code."', '".$_SESSION['uid']."', '".$_SESSION['uid']."', '".$price."', '".bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM))."','Mua link ".$id."','2','3','".date("Y-m-d H:i:s")."',1)");
			//$db->query("INSERT INTO fb_transactions(trans_type,trans_code,trans_date,trans_uid,trans_amount,trans_method,trans_status) VALUES('2','CODE','".date("Y-m-d H:i:s")."','".$uid."','".$price."','3','1')");
			$db->query("UPDATE fb_users SET user_balance = user_balance - ".$price." WHERE id = '".$uid."'");
			echo "200";
		}
		*/
		
	}
	public function deletetype()
	{
		global $db;
		$db->query("DELETE FROM fb_account_type WHERE id = '".$_POST['typeid']."'");
	}
	public function addtype()
	{
		global $db;
		if(isset($_POST['actiontype']) && $_POST['actiontype'] == "new")
		{
			$db->query("INSERT INTO fb_account_type(type_name,type_order,type_display) VALUES('".$_POST['typename']."','".$_POST['order']."','".$_POST['display']."')");
			echo "Đã thêm thành công loại: ".$_POST['typename'];
		}
		else
		{
			$db->query("UPDATE fb_account_type SET type_name = '".$_POST['typename']."', type_order = '".$_POST['order']."', type_display = '".$_POST['display']."' WHERE id = '".$_POST['typeid']."'");
			echo "Đã sửa thành công loại: ".$_POST['typename'];
		}
	}
	public function checklink()
	{
		$link = $_POST['link'];
		global $db;
		$db->query("SELECT id FROM fb_accounts WHERE account_link = '".$link."'");
		if($db->num_row())
		{
			echo "403";
		}
		else
		{
			echo "200";
		}
	}
	public function addlink()
	{
		$link = $_POST['link'];
		$bid = $_POST['businessid'];
		$type = $_POST['linktype'];
		$price = $_POST['price'];
		global $db;
		$sql = "INSERT INTO fb_accounts(account_link, account_businessid, account_type, account_addby,account_price,account_status) VALUES('".$link."','".$bid."','".$type."','".$_SESSION['uid']."','".$price."','0')";
		$db->query($sql);
		echo "Đã thêm thành công link: ".$link;
	}
	public function addfund()
	{
		global $db;
		$db->query("INSERT INTO fb_transactions(trans_code,trans_from,trans_uid,trans_amount,trans_hash,trans_note,trans_type,trans_method,trans_date,trans_status) VALUES('".$_POST['code']."', '".$_SESSION['uid']."', '".$_POST['uid']."', '".$_POST['amount']."', '".$_POST['hash']."','Admin nạp tiền','1','3','".date("Y-m-d H:i:s")."',1)");
		$db->query("UPDATE fb_users SET user_balance = user_balance + ".$_POST['amount']." WHERE id = '".$_POST['uid']."'");
		echo "200";
	}
	public function newpass()
	{
		if(isset($_POST['uid']) && $_POST['uid'] != "")
		{
			$newpass = general::getInstance()->generatepassword(8);
			global $db;
			$db->query("UPDATE fb_users SET user_password = '".md5($newpass)."' WHERE id = '".$_POST['uid']."'");
			echo $newpass;
		}
	}
	public function updatepricetype()
	{
		$typeid = $_POST['typeid'];
		$price = $_POST['price'];
		global $db;
		$db->query("UPDATE fb_accounts SET account_price = '".$price."' WHERE account_type = '".$typeid."'");
	}
	public function deletemylink()
	{
		global $db;
		$db->query("UPDATE fb_accounts SET account_status = '2' WHERE id = '".$_POST['aid']."' AND account_buyer = '".$_SESSION['uid']."'");
	}
	public function reportlink()
	{
		global $db;
		$db->query("INSERT INTO fb_account_reports(aid,uid,report_time) VALUES('".$_POST['aid']."','".$_SESSION['uid']."','".date("Y-m-d H:i:s")."')");
	}
	public function deleteuser()
	{
		if(isset($_POST['uid']) && $_POST['uid'] != "")
		{
			$uid = $_POST['uid'];
			global $db;
			$db->query("SELECT * FROM fb_users WHERE id = '".$uid."'");
			$user = $db->fetch_object(true);
			if($user->user_group == 1)
			{
				echo "Không thể xóa tài khoản của Quản trị, hãy dùng tính năng đổi mật khẩu";
			}
			else
			{
				$db->query("UPDATE fb_users SET user_status = '0' WHERE id = '".$uid."'");
				echo "Đã xóa tài khoản: ".$user->user_phone."!";
			}
		}
	}
	public function livecheck()
	{
		$number = rand(111,999);
		echo "****".$number;
	}
	//Start HR Ajax
	
	public function adduser()
	{
		global $db;
		$now = date("Y-m-d H:i:s");
		$email_token = substr(md5(date("d-m-Y H:i:s")),2,32);
		$sms_token = rand(1111,9999);
		$db->query("INSERT INTO sgt_users(username,password,firstname,lastname,user_birthday,email,user_mobile,user_group,user_team,created_date,user_status,email_token,sms_code) VALUES('".$_POST['username']."','".md5($_POST['password'])."','".$_POST['firstname']."','".$_POST['lastname']."','".date("Y-m-d",strtotime($_POST['user_birthday']))."','".$_POST['email']."','".$_POST['user_mobile']."','".$_POST['group']."','".$_POST['team']."','".$now."',0,'".$email_token."','".$sms_token."')");
		baseMailler::getInstance()->newaccount($_POST['firstname']." ".$_POST['lastname'],$_POST['email'],$_POST['username'],XC_URL."/crm/active/".$email_token);
		sms::getInstance()->sendnewsms($_POST['user_mobile'],"Seagull - Ma kich hoat tai khoan: ".$_POST['username']." cua ban tai Seagull Travel CRM la: ".$sms_token." - LH: 1900 1088",$now,"1");
	}
	public function deletecustomer()
	{
		global $db;
		$db->query("DELETE FROM sgt_customers WHERE id='".$_POST['customerid']."'");
	}
	public function deletecompany()
	{
		global $db;
		$db->query("DELETE FROM sgt_company WHERE id='".$_POST['companyid']."'");
	}
	public function deletemenu()
	{
		global $db;
		$db->query("DELETE FROM sgt_menu WHERE id='".$_POST['menuid']."'");
	}
	public function deleteres()
	{
		global $db;
		$db->query("DELETE FROM sgt_rest WHERE id='".$_POST['resid']."'");
	}
	//END HR Ajax
	
	public function getdistrict()
	{
		global $db;
		$province = $_POST['province'];
		$db->query("SELECT * FROM sgt_district WHERE province = '".$province."'");
		$listd = $db->fetch_object(false);
		echo '<option selected disabled="disabled">Chọn huyện/thị xã</option>';
		foreach($listd as $d)
		{
			echo '<option value="'.$d->id.'">'.$d->district_name.'</option>';
		}
	}
	public function addcompany()
	{
		global $db;
		$bus_name = $_POST['bus_name'];
		$bus_enname = $_POST['bus_enname'];
		$bus_shortname = $_POST['bus_shortname'];
		$bus_date = date("Y-m-d H:i:s",strtotime($_POST['bus_date']));
		$bus_areas = $_POST['bus_areas'];
		$bus_address = $_POST['bus_address'];
		$bus_phone = $_POST['bus_phone'];
		$bus_email = $_POST['bus_email'];
		$bus_taxid = $_POST['bus_taxid'];
		$bus_province = $_POST['bus_province'];
		$bus_district = $_POST['bus_district'];
		echo $db->query("INSERT INTO sgt_company(name,en_name,shortname,anniverday,business_areas,address,province,district,tax_id,phone,email,managed_staff,created_date) VALUES('".$bus_name."','".$bus_enname."','".$bus_shortname."','".$bus_date."','".$bus_areas."','".$bus_address."','".$bus_province."','".$bus_district."','".$bus_taxid."','".$bus_phone."','".$bus_email."','".$_SESSION['xID']."','".date("Y-m-d H:i:s")."')");
	}
	public function addmenu()
	{
		global $db;
		$db->query("INSERT INTO sgt_menu(title,menutype,price) VALUES('".$_POST['menu_name']."','".$_POST['menu_type']."','".$_POST['menu_price']."')");
	}
	public function addres()
	{
		global $db;
		$db->query("INSERT INTO sgt_rest(title,capacity) VALUES('".$_POST['res_name']."','".$_POST['res_capa']."')");
	}
	public function updatemenu()
	{
		global $db;
		$db->query("UPDATE sgt_menu SET title = '".$_POST['menu_name']."',menutype = '".$_POST['menu_type']."',price = '".$_POST['menu_price']."' WHERE id = '".$_POST['menu_id']."'");
	}
	public function updateres()
	{
		global $db;
		$db->query("UPDATE sgt_rest SET title = '".$_POST['res_name']."',capacity = '".$_POST['res_capa']."' WHERE id = '".$_POST['res_id']."'");
	}
	public function addcustomers()
	{
		$starttime = microtime(true);
		
		global $db;
		$title = $_POST['title'];
		$sex = 0;
		if($title == "Ông" || $title == "Anh")
		{
			$sex = 1;
		}
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$birthday = date("Y-m-d H:i:s",strtotime($_POST['birthday']));
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$province = $_POST['province'];
		$district = $_POST['district'];
		$company = $_POST['company'];
		$depart = $_POST['depart'];
		$business_email = $_POST['business_email'];
		$business_phone = $_POST['business_phone'];
		$managed_staff = $_POST['managed_staff'];
		$customer_number = $_POST['customer_number'];
		$sharing = $_POST['sharing'];
		$updated_date = date("Y-m-d H:i:s");
		$created_date = date("Y-m-d H:i:s");
		$customer_resource = $_POST['customer_resource'];
		$db->query("INSERT INTO sgt_customers(customer_number,firstname,lastname,sex,title,birthday,company,company_depart,address,province,district,phone,email,mobile,business_phone,business_email,managed_staff,created_staff,sharing,customer_resource,created_date,updated_date) VALUES('".$customer_number."','".$firstname."','".$lastname."','".$sex."','".$title."','".$birthday."','".$company."','".$depart."','".$address."','".$province."','".$district."','".$phone."','".$email."','".$mobile."','".$business_phone."','".$business_email."','".$managed_staff."','".$_SESSION['xID']."','".$sharing."','".$customer_resource."','".$created_date."','".$updated_date."')");
		$endtime = microtime(true);
		$duration = $endtime - $starttime;
		echo $duration;
	}
	public function quicksearchcustomer()
	{
		global $db;
		$keyword = $_POST['keyword'];
		if(count($keyword) == 0)
		{
			$db->query("SELECT *, c.email as email, m.name as company_name FROM sgt_customers as c 
			INNER JOIN sgt_district as d ON c.district = d.id
			INNER JOIN sgt_province as p ON c.province = p.id
			INNER JOIN sgt_company as m ON c.company = m.id
			ORDER BY c.id DESC LIMIT 30");
		}
		else
		{
			$db->query("SELECT *,c.email as email, m.name as company_name FROM sgt_customers as c 
			INNER JOIN sgt_company as m ON c.company = m.id 
			INNER JOIN sgt_district as d ON c.district = d.id
				INNER JOIN sgt_province as p ON c.province = p.id
			WHERE firstname LIKE '%".$keyword."%' OR lastname LIKE '%".$keyword."%' OR c.email LIKE '%".$keyword."%' OR mobile LIKE '%".$keyword."%' OR m.name LIKE '%".$keyword."%' ORDER BY c.id DESC LIMIT 30");
					}
			$listc = $db->fetch_object(false);
				echo '<tr>
									 <th><i class="icon_menu"></i> No.</th>
									 <th><i class="icon_profile"></i> Họ và tên</th>
									 <th><i class="icon_calendar"></i> Ngày sinh</th>
									 <th><i class="icon_mail_alt"></i> Email</th>
									 <th><i class="icon_pin_alt"></i> Công ty</th>
									 <th><i class="icon_pin_alt"></i> Khu vực</th>
									 <th><i class="icon_mobile"></i> Di động</th>
									 <th><i class="icon_cogs"></i> Thao tác</th>
								  </tr>';
			$i = 1;
			  foreach($listc as $cus)
			  {
				  echo '<tr>
				  <td>'.$i.'</td>
				 <td>'.$cus->firstname.' '.$cus->lastname.'</td>
				 <td>'.date("d-m-Y",strtotime($cus->birthday)).'</td>
				 <td>'.$cus->email.'</td>
				 <td>'.$cus->company_name.'</td>
				 <td>'.$cus->district_name.' - '.$cus->province_name.'</td>
				 <td>'.$cus->mobile.'</td>
				 <td>
				  <div class="btn-group">
					  <a class="btn btn-primary" alt="Xem chi tiết" href="#"><i class="icon-eye-open"></i></a>
					  <a class="btn btn-success" alt="Sửa" href="#"><i class="icon-edit"></i></a>
					  <a class="btn btn-danger" alt="Xóa" href="#"><i class="icon_close_alt2"></i></a>
				  </div>
				  </td>
			  </tr>';
				  $i++;
			  }

	}
	public function quicksearchtask()
	{
		global $db;
		$keyword = $_POST['keyword'];
		if(count($keyword) == 0)
		{
			$db->query("SELECT * FROM sgt_task_assigns as a
			INNER JOIN sgt_tasks as t ON a.taskid = t.id
			WHERE a.assigned_staff = '".$_SESSION['xID']."' AND NOT(t.task_status = 3) LIMIT 20");
		}
		else
		{
			$db->query("SELECT * FROM sgt_task_assigns as a
			INNER JOIN sgt_tasks as t ON a.taskid = t.id
			WHERE (t.name LIKE '%".$keyword."%' OR t.description LIKE '%".$keyword."%') AND a.assigned_staff = '".$_SESSION['xID']."' AND NOT(t.task_status = 3) LIMIT 20");
					}
			$tasks = $db->fetch_object(false);
			$i = 1;
			  foreach($tasks as $task)
			  {
				  echo '<tr>
								  <td>'.$i.'</td>
                                 <td><b>'.$task->name.'</b></td>
                                 <td>'.date("d-m-Y",strtotime($task->start_time)).'</td>
                                 <td>'.date("d-m-Y",strtotime($task->due_time)).'</td>
                                 <td>'.hr::getInstance()->priority($task->priority).'</td>
                                 <td><span class="badge '.hr::getInstance()->typelabel($task->progress).'">'.hr::getInstance()->tasktype($task->task_status).' '.round($task->progress,0).'%</span></td>
                                 <td>'.hr::getInstance()->shorten_name($task->managed_staff).'</td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" alt="Xem chi tiết" href="#"><i class="icon-eye-open"></i></a>
                                      <a class="btn btn-success" alt="Sửa" href="#"><i class="icon-edit"></i></a>
                                      <a class="btn btn-danger" alt="Xóa" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>';
				  $i++;
			  }

	}
	public function quicksearchuser()
	{
		global $db;
		$keyword = $_POST['keyword'];
		if(count($keyword) == 0)
		{
			$db->query("SELECT * FROM sgt_users as u 
			LEFT JOIN sgt_user_groups as g ON u.user_group = g.id
			LEFT JOIN sgt_teams as t ON u.user_team = t.id
			ORDER BY u.id DESC LIMIT 30");
		}
		else
		{
			$db->query("SELECT * FROM sgt_users as u 
			LEFT JOIN sgt_user_groups as g ON u.user_group = g.id
			LEFT JOIN sgt_teams as t ON u.user_team = t.id
			WHERE firstname LIKE '%".$keyword."%' OR lastname LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR user_mobile LIKE '%".$keyword."%' OR team_name LIKE '%".$keyword."%' ORDER BY u.id DESC LIMIT 30");
		}
			$listc = $db->fetch_object(false);
				echo '<tr>
									 <th><i class="icon_menu"></i> No.</th>
                                 <th><i class="icon_profile"></i> Họ và tên</th>
                                 <th><i class="icon_calendar"></i> Ngày sinh</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_pin_alt"></i> Nhóm</th>
                                 <th><i class="icon_pin_alt"></i> Phòng/Ban</th>
                                 <th><i class="icon_mobile"></i> Di động</th>
                                 <th><i class="icon_cogs"></i> Thao tác</th>
								  </tr>';
			$i = 1;
			  foreach($listc as $u)
			  {
				  echo '<tr>
								  <td>'.$i.'</td>
                                 <td>'.$u->firstname." ".$u->lastname.'</td>
                                 <td>'.date("d-m-Y",strtotime($u->user_birthday)).'</td>
                                 <td>'.$u->email.'</td>
                                 <td>'.$u->group_name.'</td>
                                 <td>'.$u->team_name.'</td>
                                 <td>'.$u->user_mobile.'</td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" alt="Xem chi tiết" href="#"><i class="icon-eye-open"></i></a>
                                      <a class="btn btn-success" alt="Sửa" href="#"><i class="icon-edit"></i></a>
                                      <a class="btn btn-danger" alt="Xóa" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>';
				  $i++;
			  }

	}
	public function addcustomer()
	{
		if(isset($_POST['acform']) && $_POST['acform'] != null)
		{
			
		}
		else
		{
			
		}
	}
	private function createfav($favname, $xid)
	{
		global $db;
		$db->query("INSERT INTO xiaob_bst_flat(xid,tenbst) VALUES('".$xid."','".$favname."')");
		$db->query("SELECT id FROM xiaob_bst_flat WHERE xid = '".$xid."' ORDER BY id DESC LIMIT 1");
		return $db->fetch_object(true)->id;
	}
	private function checkinfav($bookid,$favid)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_bst WHERE bookid = '".$bookid."' AND mabst = '".$favid."'");
		$db->fetch_object(false);
		return $db->num_row();
	}
	public function ajaxlike()
	{
		$uid = $_POST['xid'];
		$bookid = $_POST['bookid'];
		$favid = $_POST['favid'];
		if(isset($_POST['favname']) && $_POST['favname'] != "")
		{
			$favid = $this->createfav($_POST['favname'],$uid);
		}
		if($this->checkinfav($bookid,$favid))
		{
			echo "Tài liệu này đã có trong bộ sưu tập của bạn.";
		}
		else
		{
			global $db;
			$db->query("INSERT INTO xiaob_bst(bookid,mabst) VALUES('".$bookid."','".$favid."')");
			echo "Thêm thành công tài liệu vào BST";
		}
	}
	public function deletebook()
	{
		$bookid = $_POST['bookid'];
		global $db;
		$db->query("DELETE FROM xiaob_book WHERE bookid='".$bookid."'");
	}
	public function removelike()
	{
		$bookid = $_POST['bookid'];
		global $db;
		$db->query("DELETE FROM xiaob_yeuthich WHERE bookid='".$bookid."' AND xid = '".$_SESSION['xID']."'");
		
	}
	public function likebook()
	{
		$bookid = $_POST['bookid'];
		global $db;
		$db->query("INSERT INTO xiaob_yeuthich(bookid,xid) VALUES('".$bookid."','".$_SESSION['xID']."')");
	}
	public function subscribe()
	{
		$email = $_POST['email'];
		global $db;
		$db->query("SELECT * FROM xdata_subscribe WHERE xemail = '".$email."'");
		if($db->num_row())
		{
			echo "error";
		}
		else
		{
			$db->query("INSERT INTO xdata_subscribe(xemail,status) VALUES('".$email."',1)");
			echo "success";
		}
	}
	public function ajaxloadfav()
	{
		$xid = $_POST['xid'];
		global $db;
		$db->query("SELECT * FROM xiaob_bst_flat WHERE xid = '".$xid."'");
		$listfav = $db->fetch_object(false);
		foreach($listfav as $f)
		{
			echo '<option value="'.$f->id.'">'.$f->tenbst.'</option>';
		}
	}
	public function checkusername()
	{
		global $db;
		$db->query("SELECT * FROM sgt_users WHERE username = '".$_POST['username']."'");
		if($db->num_row())
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	public function checkemail()
	{
		global $db;
		$db->query("SELECT * FROM sgt_users  WHERE email = '".$_POST['email']."'");
		if($db->num_row())
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	public function ajaxaddfav()
	{
		$xid = $_POST['xid'];
		$bookid = $_POST['bookid'];
		$xid = $_POST['xid'];
	}
	public function filter_by_subject()
	{
		global $db;
		$subject = $_POST['sid'];
		$catid = $_POST['catid'];
        $db->query("SELECT * FROM xiaob_book WHERE bookcat = '".$catid."' AND booksubj = '".$subject."' ORDER BY bookid DESC LIMIT 60");
        $listbook = $db->fetch_object();
			foreach($listbook as $book)
			{
				$e = $i%2;
			?>
					                     <li class="catitem" id="<?php echo $e;?>">
						                        <div class="box_img"><img alt="<?php echo $book->bookname;?>" src="http://thuviengiaoduc.edu.vn/upload/thumb/<?php echo $book->bookimage;?>" onerror='this.src="http://thuviengiaoduc.edu.vn/images/thuviengiaoduc.edu.vn.jpg"'></div>
                        <div class="thongtindetai">
                            <div class="tootip_title_thuvienOnlinePage_Index">
                                <a href="<?php echo general::getInstance()->permalink($book->bookid,'book');?>" class="link_title_thuvienOnlinePage_Index clsCheckUser"><?php echo $book->bookname;?></a>
								<br>
								
                                 
                            </div>                                        
                            <ul class="thongke_news">              
                                <li>Lượt xem: <span><?php echo $book->bookview;?></span></li>
								<li class="line">|</li>
                                <li>Lượt tải: <span><?php echo $book->bookdown;?></span></li>
                                
                            </ul>
                            <a href="<?php echo general::getInstance()->permalink($book->bookid,'book');?>" class="xemtiep clsCheckUser">Xem chi tiết...</a>
                        </div>
                    </li>
					<?php
					}
	}
	public function resendactivecode()
	{
		$token = $_POST['token'];
		global $db;
		$db->query("SELECT * FROM sgt_users WHERE email_token = '".$token."' LIMIT 1");
		$users = $db->fetch_object(true);
		$results = sms::getInstance()->sendnewsms($users->user_mobile,"Ma xac thuc tai khoan cua ban tai SeagullCRM la: ".$users->sms_code."",date("d-m-Y H:i:s"),"1");
		echo $users->user_mobile;
	}
	public function newsms()
	{
		//echo "1";
		$to = $_POST['to'];
		$content = $_POST['content'];
		$senddate = $_POST['senddate'];
		$results = sms::getInstance()->sendnewsms($to,$content,$senddate,"1");
		echo $results;
	}
		public function menu()
	{
		$parent = $_POST['parent'];
		switch($parent)
		{
			case "danhmuc":
			{
				echo '
				<div style="margin-left: 20px;">
                        <a href="'.XC_URL.'/crm/category/menu">Thực đơn</a><span>|</span>
                    </div>
                    <div>
                        <a href="'.XC_URL.'/crm/category/restaurants">Nhà hàng</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/category/loai-tiec">Loại tiệc - Hội nghị</a><span>|</span>
                    </div>
				</div>
				';
				break;
			}
			case "khachhang":
			{
				echo '
				<div style="margin-left: 20px;">
                        <a href="'.XC_URL.'/crm/customers/new">Thêm mới</a><span>|</span>
                    </div>
                    <div>
                        <a href="'.XC_URL.'/crm/customers">Danh sách khách hàng</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/company">Công ty/Đơn vị</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/customers/resource">Nguồn khách hàng</a><span>|</span>
                    </div>
				</div>
				';
				break;
			}
			case "kehoach":
			{
				echo '
				<div style="margin-left: 20px;">
                        <a href="">Kees hoach 1</a><span>|</span>
                    </div>
                    <div>
                        <a href="">Ke hoach 2</a><span>|</span>
                    </div>
				</div>
				';
				break;
			}
			case "banhang":
			{
				echo '
				<div style="margin-left: 20px;">
                        <a href="'.XC_URL.'/crm/">Đặt vé</a><span>|</span>
                    </div>
                    <div>
                        <a href="'.XC_URL.'/crm/">Đặt tour</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/">Đặt xe</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/sales/tiec-cuoi">Đặt tiệc cưới</a><span>|</span>
                    </div>
					<div>
                        <a href="'.XC_URL.'/crm/sales/hoi-nghi">Đặt hội nghị</a><span>|</span>
                    </div>
				</div>
				';
				break;
			}
			default:
			{
				break;
			}
		}
	}
	public function testroom()
	{
		global $db;
		$db->query("SELECT * FROM gt_room_closings WHERE roomid = '2' AND from_date between '2019-07-24' and '2019-07-25'");
		$closing = $db->fetch_object(false);
		//$status = true;
		foreach($closing as $close)
		{
			echo 6 - $close->stock." ".$close->stock."<br>";
		}
	}
}