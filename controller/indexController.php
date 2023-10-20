<?php

Class indexController Extends baseController
{
	public function index()
    {
		if(!(isset($_SESSION['testid']) && $_SESSION['testid'] != ""))
		{
			$_SESSION['testid'] = $_GET['testid'];
		}
		/*
        if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		if($_SESSION['isAdmin'] == 1)
		{
			//header("Location: ".XC_URL."/crm/ranking");
		}
		else
		{
			//header("Location: ".XC_URL."/crm/ranking");
		}
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["cus"] = $db->fetch_object(true);
		*/
		//echo $_SESSION['testid'];
		$this->view->show('index');
	}
	
	public function dashboard()
	{
		//if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		if(!(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")){ header("Location: ".XC_URL."/login"); }
		if($_SESSION['isAdmin'] == 1)
		{
			//header("Location: ".XC_URL."/crm/ranking");
		}
		else
		{
			//header("Location: ".XC_URL."/crm/ranking");
		}
		$this->view->data["usdrate"] = $this->config->_config("USD_VND_RATE");
		global $db;
		$db->query("SELECT *, c.id as cid FROM portal_customers as c 
		LEFT JOIN portal_customer_accounts as ca ON c.id = ca.cid
		WHERE c.id = '".$_SESSION['user']['id']."' AND ca.acc_type = 1");
		$this->view->data["cus"] = $user = $db->fetch_object(true);
		$db->query("SELECT * FROM portal_transactions WHERE uid = '".$user->cid."' ORDER BY trans_time DESC LIMIT 5");
		$this->view->data["transactions"] = $db->fetch_object();
		$this->view->data["page"]["key"] = "dashboard";
		$this->view->data["page"]["title"] = "Trung tâm Hội viên";
		$this->view->show('dashboard');
	}
	
}

?>
