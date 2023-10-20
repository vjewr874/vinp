<?php
Class toolsController extends baseController
{
	public function index()
	{
	}
	public function withdrawal()
	{
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$this->view->data["user"] = $db->fetch_object(true);
		$this->view->show("withdrawal");
	}
	public function checklimit()
	{
		$this->view->show("tool-checklimit");
	}
}