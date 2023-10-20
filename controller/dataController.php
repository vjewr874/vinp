<?php
Class dataController extends baseController
{
	public function index()
	{
	}
	public function getHeader($header) {
		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				if (str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($name, 5)))) == $header)
					return $value;
			}
		}
		
		return false;
	}
	public function products()
	{
		$this->view->show("products");
	}
	public function update($para)
	{
		global $db;
		$db->query("UPDATE hicrm_configs SET config_value = '".$para[1]."' WHERE config_key = 'auth'");
		echo $para[1];
	}
	
	public function test()
	{
		$token = '6u5N6mx4ZOOklN4VsYmBPTeXrhNIluX3pG8xZ7ueLduUjyI31f';

		$thueapiToken = $this->getHeader('X-THUEAPI');

		if ($token !== $thueapiToken) {
			echo 'Token mismatch !';
			return;
		}
		echo $token;
	}
}