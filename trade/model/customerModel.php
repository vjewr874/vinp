<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xiao
 * Date: 10/7/16
 * Time: 8:37 AM
 * To change this template use File | Settings | File Templates.
 */
Class customerModel extends baseModel
{
	public function get_customers_list()
	{
		global $db;
		$db->query("SELECT *, c.id as cid, c.address as paddress, c.email as email, m.name as company_name, m.shortname as sname FROM sgt_customers as c 
			INNER JOIN sgt_district as d ON c.district = d.id
			INNER JOIN sgt_province as p ON c.province = p.id
			INNER JOIN sgt_company as m ON c.company = m.id
			ORDER BY c.id DESC");
		return $db->fetch_object(false);
	}
	public function get_customer_detail($cid)
	{
		global $db;
		$db->query("SELECT *, c.id as cid, c.address as paddress, CONCAT_WS(' ', c.firstname, c.lastname) as fullname ,c.email as email, m.name as company_name FROM sgt_customers as c 
			INNER JOIN sgt_district as d ON c.district = d.id
			INNER JOIN sgt_province as p ON c.province = p.id
			INNER JOIN sgt_company as m ON c.company = m.id
			WHERE c.id = '".$cid."'
			ORDER BY c.id DESC");
		return $db->fetch_object(true);
	}
}