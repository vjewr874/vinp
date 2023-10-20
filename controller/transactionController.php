<?php

Class transactionController Extends baseController
{
	public function index()
    {
		
	}
	public function submitfund()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		$uid = $_POST['trans_to'];
		if(!$uid)
		{
			echo "404";
		}
		else
		{
			global $db;
			$db->query("INSERT INTO fb_transactions(trans_code,trans_from,trans_uid,trans_amount,trans_hash,trans_note,trans_type,trans_method,trans_date,trans_status) VALUES('".$_POST['trans_code']."', '".$_SESSION['uid']."', '".$uid."', '".$_POST['trans_amount']."', '".$_POST['trans_hash']."','".$_POST['trans_note']."','1','3','".date("Y-m-d H:i:s")."',1)");
			$db->query("UPDATE fb_users SET user_balance = user_balance + ".$_POST['trans_amount']." WHERE id = '".$uid."'");
			echo "200";
		}
	}
	public function all()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM fb_transactions ORDER BY trans_date DESC LIMIT 100");
		$this->view->data['transactions'] = $db->fetch_object();
		$this->view->show("transaction-all");
	}
	public function addfund()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM fb_transactions WHERE trans_type = '1' ORDER BY trans_date DESC");
		$this->view->data['transactions'] = $db->fetch_object();
		$db->query("SELECT * FROM fb_users WHERE NOT(id IN(".$_SESSION['uid']."))");
		$this->view->data['users'] = $db->fetch_object();
		$this->view->show("transactions");
	}
	public function history()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM portal_transactions WHERE trans_uid = '".$_SESSION['uid']."' ORDER BY trans_date DESC");
		$this->view->data['transactions'] = $db->fetch_object();
		$this->view->show("transaction-history");
	}
	public function order()
	{
		if(!(isset($_SESSION['uid']) && $_SESSION['uid'] != "")){ header("Location: ".XC_URL."/login"); }
		global $db;
		$db->query("SELECT * FROM xdata_transactions WHERE trans_from = '".$_SESSION['uid']."' AND trans_type='2' ORDER BY trans_time DESC");
		$this->view->data['transactions'] = $db->fetch_object();
		$this->view->show("transaction-order");
	}
}

?>
