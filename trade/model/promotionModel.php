<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xiao
 * Date: 10/7/16
 * Time: 8:37 AM
 * To change this template use File | Settings | File Templates.
 */
Class promotionModel extends baseModel
{
	public function get_promotion()
	{
		global $db;
		$db->query("SELECT * FROM sg_cheap ORDER BY price ASC,flightdate ASC LIMIT 20");
		return $db->fetch_object(false);
	}
}