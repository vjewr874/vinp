<?php
/**
 * Project: thuvien.
 * File: tourController.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 09:54 - 07/10/2016
 * Website: www.xiao.vn
 */
Class gameController extends baseController
{
    public function index()
    {
		
    }
	public function data()
	{
		$sub = array();
		$sub["timestamp"] = time();
		$v = rand(2300,3600);
		$sub["payloadString"] = $v;
		//array_push($packets,$sub);
		echo json_encode($sub);
		
	}
}