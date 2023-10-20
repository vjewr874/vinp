<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xiao
 * Date: 10/7/16
 * Time: 8:37 AM
 * To change this template use File | Settings | File Templates.
 */
Class companyModel extends baseModel
{
	public function get_companys_list()
	{
		global $db;
		$db->query("SELECT *, c.id as cid, c.email as email, c.name as company_name FROM sgt_company as c 
			INNER JOIN sgt_district as d ON c.district = d.id
			INNER JOIN sgt_province as p ON c.province = p.id
			ORDER BY c.id DESC");
		return $db->fetch_object(false);
	}
}