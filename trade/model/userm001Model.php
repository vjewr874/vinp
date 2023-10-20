<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xiao
 * Date: 10/7/16
 * Time: 8:37 AM
 * To change this template use File | Settings | File Templates.
 */
Class userm001Model extends baseModel
{
	public function get_user_lists()
	{
		global $db;
		$db->query("SELECT *, u.id as uid FROM sgt_users as u 
			LEFT JOIN sgt_user_groups as g ON u.user_group = g.id
			LEFT JOIN sgt_teams as t ON u.user_team = t.id
			ORDER BY u.id DESC");
		return $db->fetch_object(false);
	}
}