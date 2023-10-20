<?php

Class indexController Extends baseController
{
	public function index()
    {
		global $db;
		$symbol = $_GET['symbol'];
		$db->query("SELECT * FROM system_symbols WHERE symbol_id = '".$symbol."'");
		if($db->num_row())
		{
			$db->query("SELECT *,c.id as cid FROM portal_customers as c 
			LEFT JOIN portal_customer_accounts as ca ON c.id = ca.cid
			WHERE c.c_key = '".$_GET['_ckey']."' AND ca.acc_type = 1");
			$this->view->data["cus"] = $cus = $db->fetch_object(true);
			$db->query("SELECT * FROM system_bet_amounts ORDER BY id ASC");
			$this->view->data["listamounts"] = $db->fetch_object();
			$_SESSION['user']['id'] = $cus->cid;
			$db->query("SELECT * FROM system_symbols ORDER BY id ASC");
			$this->view->data["symbols"] = $db->fetch_object();
			$this->view->show("tradeplatform/index");
		}
		else
		{
			$ckey = $_GET['_ckey'];
			header("Location: ".XC_URL."/?_ckey=".$ckey."&symbol=700");
		}
	}
	
}

?>
