<?php
/**
 * Project: thuvien.
 * File: crm.class.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 11:11 - 20/10/2013
 * Website: www.xiao.vn
 */
Class sms{
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
	
    public static function getInstance() {
        if (!self::$instance)
        {
            self::$instance = new sms();
        }
        return self::$instance;
    }
	public function sendsms($phone,$content)
	{
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => ZPAY_API_URL."/service/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => array('api_key' => ZPAY_API_KEY,'phone' => $phone,'message' => $content),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$res = json_decode($response,true);
		if($res["status"] == "200")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function get_list_sms_by_sent($staffid)
	{
		global $db;
		if($staffid == "*")
		{
			$db->query("SELECT * FROM sgt_sms ORDER BY createdate DESC");
		}
		else
		{
			$db->query("SELECT * FROM sgt_sms WHERE sent_staff = '".$staffid."' ORDER BY createdate DESC");
		}
		return $db->fetch_object(false);
	}
	public function checknetwork($mobile)
	{
		global $db;
		if(substr($mobile,0,2) == "09")
		{
			$db->query("SELECT * FROM sgt_sms_networks WHERE prefix = '".substr($mobile,0,3)."' LIMIT 1");
		}
		else
		{
			$db->query("SELECT * FROM sgt_sms_networks WHERE prefix = '".substr($mobile,0,4)."' LIMIT 1");
		}
		return $db->fetch_object(true)->network;

	}	
	
	public function sendnewsms($to,$content,$sendtime,$type)
	{
		$request = "http://api.xiao.vn/sms.php?action=new&api_key=".SMS_API_KEY."&api_secrect=".SMS_API_SECRECT."&to=".$to."&content=".urlencode($content)."&type=".$type."&sendtime=".$sendtime."&data=xml";
		$respone = file_get_contents($request);
		$smscount = round(count($content)/160);
		$network = $this->checknetwork($to);
		if($network == "1")
		{
			$smscost = "200";
		}
		else
		{
			$smscost = "250";
		}
		global $db;
		if($respone == "101")
		{
			$db->query("INSERT INTO sgt_sms(sent_staff,receiver,createdate,sentdate,content,smscount,smstype,smscost,smsfrom,smsstatus) VALUES('".$_SESSION['xID']."','".$to."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s",strtotime($sendtime))."','".$content."','".$smscount."','".$type."','".$smscost."','0972471059','1')");
		}
		else
		{
			$db->query("INSERT INTO sgt_sms(sent_staff,receiver,createdate,sentdate,content,smscount,smstype,smscost,smsfrom,smsstatus) VALUES('".$_SESSION['xID']."','".$to."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s",strtotime($sendtime))."','".$content."','1','".$type."','0','','0')");
		}
		return $request;
	}
}