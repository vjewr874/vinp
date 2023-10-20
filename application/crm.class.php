<?php
/**
 * Project: thuvien.
 * File: general.class.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 08:50 - 07/10/2013
 * Website: www.xiao.vn
 */
Class crm{


    /*
     * @Variables array
     * @access public
     */
    private static $instance;

    /**
     *
     * @constructor
     *
     * @access public
     *
     * @return void
     *
     */
    function __construct() {

    }
	public function CreateNotification($receiver,$content,$url = "")
	{
		global $db;
		$db->query("SELECT * FROM crm_users WHERE id = '".$receiver."'");
		$u_receiver = $db->fetch_object(true);
		$db->query("INSERT INTO crm_notifications(sender,receiver,title,content) VALUES('1','".$receiver."','An Loc CRM','".$content."')");
		$this->SendZaloMessage($u_receiver->user_zalo_id,$content,$url);
	}
	public function SendZaloMessage($uid,$content,$url = "https://manage.anlocgroup.vn/")
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.zalo.me/v2.0/oa/message?access_token=fZZfVTw2yNcbCEDntuBuVACvvNZPdRGe_bN-KkwUbn_3Uj10wPs8C_0ZycUFmvKPiYxQLSx1dXxjFTXZYTAY2AyJyGMMzRrCiIVKIB7KgJ7F5EH-qUYN9VqkaN_vzVSKt3keMShS-bpkBEOpqz-TPTmmssx6wfmhomgQG-RQypVVQBLftAdv4C5EanhViSvd-0-ZFVtckNJh1gS5z-NyPlKEY0w5ivPAhth9EewLc4YjSCCIY9-aI_Oct2_JbPvIypB51ulJt0BnRPzluO6POUrQon1kR4cAAppSdF5s",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>'{
							  "recipient": {
								"user_id": "'.$uid.'"
							  },
							  "message": {
								"attachment": {
									"type": "template",
									"payload": {
										"template_type": "list",
										"elements": [{
											"title": "An Loc Group - CRM",
											"subtitle": "'.$content.'",
											"image_url": "https://anlocgroup.vn/crmbanner.jpg",
											"default_action": {
												"type": "oa.open.url",
												"url": "'.$url.'"
												}
										}]
									}
								}
							  }
							}',
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}
	public function cal_top($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countlead FROM crm_user_logs WHERE uid = '".$uid."' AND log_key = 'GETLEADS'");
		$count_lead = $db->fetch_object(true)->countlead;
		$db->query("SELECT COUNT(*) as countnote FROM crm_customer_notes WHERE uid = '".$uid."'");
		$count_note = $db->fetch_object(true)->countnote;
		$db->query("SELECT COUNT(*) as countlevel FROM crm_user_logs WHERE uid = '".$uid."' AND log_key = 'SUCCESSLEVELLEAD'");
		$count_uplevel = $db->fetch_object(true)->countlevel;
		$db->query("SELECT COUNT(*) as countfail FROM crm_customer_logs WHERE uid = '".$uid."' AND log_key = 'BACKTOLEADS'");
		$count_fail = $db->fetch_object(true)->countfail;
		//$point = ($count_uplevel*5 - $count_fail)/$count_lead;
		//$point = ($count_uplevel*5)/$count_lead;
		$point = $count_note/$count_lead + $count_uplevel*20;
		return $point;
	}
	public function count_note_by_customer($cid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as c FROM crm_customer_notes WHERE cid = '".$cid."'");
		return $db->fetch_object(true)->c;
	}
	public function count_customer_per_week_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countdata FROM crm_customers WHERE cus_assigned_to = '".$uid."' AND DATE(cus_assigned_time) >= '".date("Y-m-d H:i:s",strtotime('last week'))."' AND DATE(cus_assigned_time) <= '".date("Y-m-d",strtotime('this week - 1 day'))."'");
		return $db->fetch_object(true)->countdata;
	}
	public function count_assigned_lead_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countrow FROM crm_customers WHERE cus_assigned_to = '".$uid."'");
		return $db->fetch_object(true)->countrow;
	}
	public function count_noted_customer_by_staff($uid)
	{
		global $db;
		$db->query("SELECT c.id, COUNT(m.id) AS members
FROM crm_customers AS c
LEFT JOIN crm_customer_notes AS m ON c.id = m.cid
WHERE c.cus_assigned_to = '".$uid."'
GROUP BY c.id
HAVING members > 0");
		return $db->num_row();
	}
	public function count_allnote_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countdata FROM crm_customer_notes WHERE uid = '".$uid."'");
		return $db->fetch_object(true)->countdata;
	}
	public function check_potential_by_cid($cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_customer_logs WHERE cid = '".$cid."' AND log_key = 'UPCUSTOMERLEVEL'");
		if($db->num_row())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function count_potential_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countdata FROM crm_user_logs WHERE log_key = 'SUCCESSLEVELLEAD' AND uid = '".$uid."'");
		return $db->fetch_object(true)->countdata;
	}
	public function count_note_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countdata FROM crm_customer_notes WHERE uid = '".$uid."' AND DATE(note_time) >= '".date("Y-m-d H:i:s",strtotime('last week'))."' AND DATE(note_time) <= '".date("Y-m-d",strtotime('this week - 1 day'))."'");
		return $db->fetch_object(true)->countdata;
	}
	public function count_lead($level = 6)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countrow FROM crm_customers WHERE cus_level <= ".$level." AND cus_level <= 5");
		return $db->fetch_object(true)->countrow;
	}
	public function count_deal($level = 10)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countrow FROM crm_customers WHERE cus_level <= ".$level." AND cus_level > 5");
		return $db->fetch_object(true)->countrow;
	}
	public function count_lead_by_staff($uid)
	{
		global $db;
		$db->query("SELECT COUNT(*) as countrow FROM crm_customers WHERE cus_level <= 5 AND cus_assigned_to = '".$uid."'");
		return $db->fetch_object(true)->countrow;
	}
	public function get_user_balance($uid)
	{
		global $db;
		$db->query("SELECT * FROM crm_users WHERE id = '".$uid."'");
		return $db->fetch_object(true)->user_point;
	}
    public static function getInstance() {
        if (!self::$instance)
        {
            self::$instance = new crm();
        }
        return self::$instance;
    }
	public function GetDeptList()
	{
		global $db;
		$db->query("SELECT * FROM crm_departments");
		return $db->fetch_object();
	}
	public function GetTeamList()
	{
		global $db;
		$db->query("SELECT * FROM crm_teams");
		return $db->fetch_object();
	}
	public function GetCustomerListbyUID($uid)
	{
		global $db;
		$db->query("SELECT *,c.id as cid,(SELECT COUNT(*) FROM crm_customer_notes WHERE cid = c.id) as countnote FROM crm_customers as c
		LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
		LEFT JOIN crm_status as st ON c.cus_status = st.statusid
		WHERE c.cus_assigned_to = '".$uid."'
		ORDER BY c.cus_assigned_time DESC
		");
		return $db->fetch_object();
	}
	public function GetListNotification($uid)
	{
		global $db;
		$db->query("SELECT * FROM crm_notifications WHERE receiver = '".$uid."' ORDER BY sent_time DESC LIMIT 30");
		return $db->fetch_object();
	}
	public function GetListEventToday($uid,$cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_calendar_list WHERE uid = '".$uid."' AND cid = '".$cid."' AND DATE(event_time) = '".date("Y-m-d")."'");
		return $db->fetch_object();
	}
	public function GetCustomerLogs($cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_customer_logs as l
		LEFT JOIN crm_users as u ON l.uid = u.id
		LEFT JOIN crm_log_type as lt ON lt.type_key = l.log_key
		WHERE cid = '".$cid."'
		ORDER BY log_time DESC
		");
		return $db->fetch_object();
	}
	public function GetCustomerNotes($cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_customer_notes as n
		LEFT JOIN crm_users as u ON n.uid = u.id
		LEFT JOIN crm_note_methods as nm ON n.note_method = nm.mid
		WHERE cid = '".$cid."'
		ORDER BY note_time DESC
		");
		return $db->fetch_object();
	}
	public function GetCustomerContact($cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_customer_contacts as c
		LEFT JOIN crm_contact_type as t ON c.contact_type = t.id
		WHERE cid = '".$cid."' AND (contact_owner = '".$_SESSION["user"]["id"]."' OR contact_shared = '1')");
		return $db->fetch_object();
	}
	public function GetCustomerContactAdmin($cid)
	{
		global $db;
		$db->query("SELECT * FROM crm_customer_contacts as c LEFT JOIN crm_contact_type as t ON c.contact_type = t.id WHERE cid = '".$cid."'");
		return $db->fetch_object();
	}
	public function GetProvinceList()
	{
		global $db;
		$db->query("SELECT * FROM crm_provinces");
		return $db->fetch_object();
	}
	public function getDistrictList($province)
	{
		global $db;
		$db->query("SELECT * FROM crm_districts WHERE matp = '".$province."'");
		return $db->fetch_object();
	}
	public function getWardList($district)
	{
		global $db;
		$db->query("SELECT * FROM crm_wards WHERE maqh = '".$district."'");
		return $db->fetch_object();
	}
	public function get_wallet_balance($walletid,$cid)
	{
		global $db;
		$db->query("SELECT * FROM portal_customer_accounts WHERE cid = '".$cid."' AND acc_type = '".$walletid."'");
		return $db->fetch_object(true);
	}
}