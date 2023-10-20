<?php
/**
 * Project: thuvien.
 * File: tourController.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 09:54 - 07/10/2016
 * Website: www.xiao.vn
 */
Class listController extends baseController
{
    public function index()
    {
		header("Location: ".XC_URL."/list/listlink");
    }
	public function listlink($para)
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM fb_account_type WHERE type_display = '1' ORDER BY type_order LIMIT 1");
		$typeid = $db->fetch_object(true)->id;
		if(isset($para[1]) && $para[1] != "")
		{
			$typeid = $para[1];
		}
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		
		$db->query("SELECT *,a.id as aid FROM fb_accounts as a
		LEFT JOIN fb_account_type as t ON a.account_type = t.id
		WHERE account_status = 0 AND account_type = '".$typeid."'
		ORDER BY account_addtime DESC
		");
		$this->view->data["list"] = $db->fetch_object();
		$db->query("SELECT * FROM fb_account_type WHERE type_display = '1' ORDER BY type_order ");
		$this->view->data["linktype"] = $db->fetch_object();
		$this->view->data["typeid"] = $typeid;
		$this->view->show("list");
	}
	public function mylink($para)
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		$typeid = 1;
		if(isset($para[1]) && $para[1] != "")
		{
			$typeid = $para[1];
		}
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT *,a.id as aid FROM fb_accounts as a
		LEFT JOIN fb_account_type as t ON a.account_type = t.id
		WHERE account_buyer = '".$_SESSION['uid']."' AND account_type = '".$typeid."' AND account_status = '1'
		ORDER BY account_addtime DESC
		");
		$this->view->data["list"] = $db->fetch_object();
		$db->query("SELECT * FROM fb_account_type");
		$this->view->data["linktype"] = $db->fetch_object();
		$this->view->data["typeid"] = $typeid;
		$this->view->show("mylink");
	}
	public function adminmylink($para)
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		$typeid = 1;
		if(isset($para[1]) && $para[1] != "")
		{
			$typeid = $para[1];
		}
		//if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		$uid = '664';
		global $db;
		$db->query("SELECT *,a.id as aid FROM fb_accounts as a
		LEFT JOIN fb_account_type as t ON a.account_type = t.id
		WHERE account_buyer = '".$uid."' AND account_type = '".$typeid."' AND account_status = '1'
		ORDER BY account_addtime DESC
		");
		$this->view->data["list"] = $db->fetch_object();
		$db->query("SELECT * FROM fb_account_type");
		$this->view->data["linktype"] = $db->fetch_object();
		$this->view->data["typeid"] = $typeid;
		$this->view->show("mylink");
	}
	public function add()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM fb_account_type WHERE type_display = '1' ORDER BY type_order");
		$this->view->data["linktype"] = $db->fetch_object();
		$this->view->show("add-link");
	}
	public function importlink()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		
		if(isset($_POST['listlink']) && $_POST['listlink'] != "")
		{
			$countrow = 0;
			$countsuccess = 0;
			$counterror = 0;
			$type = $_POST['linktype'];
			$price = $_POST['linkprice'];
			$links = explode("\r\n",$_POST['listlink']);
			$countrow = count($links);
			for($i = 0;$i <count($links);$i++)
			{
				$linkdata = explode("|",$links[$i]);
				if($linkdata[0] != "")
				{
					$db->query("SELECT id FROM fb_accounts WHERE account_link = '".$linkdata[0]."'");
					if(!$db->num_row())
					{
						$sql = "INSERT INTO fb_accounts(account_link, account_type, account_addby,account_price,account_status) VALUES('".$linkdata[0]."','".$type."','".$_SESSION['uid']."','".$price."','0')";
						$db->query($sql);
						$countsuccess ++;
					}
					else
					{
						$counterror++;
					}
					echo $linkdata[0];
				}
				else
				{
					$counterror++;
				}
			}
			$this->view->data["result"] = "Đã xử lý: ".$countrow.", thành công: ".$countsuccess.", thất bại: ".$counterror.".";
			header("Location: ".XC_URL."/list/importlink");
			//$this->view->show("add-multi-link");
		}
		else
		{
			$db->query("SELECT * FROM fb_account_type");
			$this->view->data["linktype"] = $db->fetch_object();
			$this->view->show("add-multi-link");
		}
	}
	public function type()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM fb_account_type ORDER BY type_order");
		$this->view->data["linktype"] = $db->fetch_object();
		$this->view->show("link-type");
	}
	public function users($para)
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		if(isset($para[1]) && $para[1] != "")
		{
			global $db;
			//echo $para[1];
			$uid = $para[1];
			$this->view->data["userid"] = $uid;
			$db->query("SELECT * FROM fb_transactions WHERE trans_uid = '".$uid."' ORDER BY trans_date DESC");
			$this->view->data['transactions'] = $db->fetch_object();
			$this->view->show("user-history");
		}
		else
		{

			global $db;
			$db->query("SELECT * FROM crm_users");
			$this->view->data["users"] = $db->fetch_object();
			$this->view->show("users");
		}
	}
	public function test()
	{
		//general::getInstance()->upload_avatar();
		//echo general::getInstance()->resize_image_crop("http://mualinkfb.com/uploads/users/mualinkfb-49eb8b2da41e67fe71f3c0fb60224262-1.jpg");
	}
}