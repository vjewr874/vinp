<?php
/**
 * Project: tour.
 * File: m4123Model.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 17:46 - 17/10/2013
 * Website: www.xiao.vn
 */
Class m4123Model extends baseModel
{
	public function get_singel_tour($tourid)
	{
		global $db;
		$db->query("SELECT * FROM sgt_tours WHERE tourid = '".$tourid."' LIMIT 1");
		return $db->fetch_object(true);
	}
}