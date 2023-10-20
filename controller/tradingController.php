<?php
Class tradingController extends baseController
{
	public function index()
	{
		global $db;
		$db->query("SELECT * FROM portal_customers as c 
		LEFT JOIN portal_customer_accounts as ca ON c.id = ca.cid
		WHERE c.id = '".$_SESSION['user']['id']."' AND ca.acc_type = 1");
		$this->view->data["cus"] = $db->fetch_object(true);
		$this->view->show("tradeplatform/index");
	}
	public function v2()
	{
		global $db;
		$this->view->show("tradeplatform/index");
	}
	public function v3()
	{
		echo time();
	}
}