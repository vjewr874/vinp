<?php
/**
 * Project: thuvien.
 * File: general.class.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 08:50 - 07/10/2013
 * Website: www.xiao.vn
 */
Class general{


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
            self::$instance = new general();
        }
        return self::$instance;
    }
	//General Data
	public function _config($key)
	{
		global $db;
		$db->query("SELECT * FROM hicrm_configs WHERE config_key = '".$key."' LIMIT 1");
		if($db->num_row())
		{
			return $db->fetch_object(true)->config_value;
		}
		else
		{
			return "";
		}
	}
	public function banks()
	{
		global $db;
		$db->query("SELECT * FROM system_banks");
		return $db->fetch_object();
	}
	public function contacts($cid,$type = 1)
	{
		global $db;
		$db->query("SELECT * FROM portal_customer_contacts WHERE cid = '".$cid."' AND contact_type = '".$type."'");
		return $db->fetch_object();
	}
	public function testpdf()
	{
		
	}
	public function get_user_last_login($uid)
	{
		global $db;
		$db->query("SELECT log_time FROM crm_user_logs  WHERE uid = '".$uid."' AND log_key = 'LOGGEDIN' ORDER BY log_time DESC");
		return $db->fetch_object(true)->log_time;
	}
	public function generate_string($length = 10) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
			return $randomString;
	}
	public function generate_number($length = 10) 
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
			return $randomString;
	}
	public function get_last_user_activity($uid,$limit = "10",$type)
	{
		global $db;
		$db->query("SELECT * FROM crm_user_logs as l LEFT JOIN crm_log_type as t ON l.log_key = t.type_key WHERE l.uid = '".$uid."' AND t.type_category = '".$type."' ORDER BY log_time DESC LIMIT ".$limit);
		return $db->fetch_object();
	}
	
	
	public function get_config($key)
	{
		global $db;
		$db->query("SELECT config_value FROM fb_configs WHERE config_key = '".$key."' LIMIT 1");
		return $db->fetch_object(true)->config_value;
	}
	public function get_user_info($uid,$info)
	{
		global $db;
		$db->query("SELECT * FROM fb_users WHERE id= '".$uid."'");
		return $db->fetch_object(true)->$info;
	}
	public function create_avatar($file)
	{
		$file = "http://mualinkfb.com/uploads/users/mualinkfb-49eb8b2da41e67fe71f3c0fb60224262-1.jpg";
			$img_r = imagecreatefromjpeg($file);
		  $dst_r = ImageCreateTrueColor( 70, 70 );
		 
		  imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, 70, 70, 70,70);
		  
		  header('Content-type: image/jpeg');
		  imagejpeg($dst_r);
		  exit;
	}
	public function upload_avatar()
	{
		include_once "Images.class.php";
		$img  = "http://mualinkfb.com/uploads/users/mualinkfb-49eb8b2da41e67fe71f3c0fb60224262-1.jpg";
		$thumb50 = 'sau_khi_crop.jpg';
		$imageThumb = new Image($img);
		// ví dụ crop ảnh thì bạn gọi hàm như sau
		//$imageThumb->createThumb($thumb50,50,50);
		// ví dụ resize ảnh thì bạn gọi hàm như sau
		$imageThumb->createThumb($thumb50,50,50,'fit');
		// hien thi ảnh sau khi crop hoặc resize
		$imageThumb->display();
	}
	public function resize_image_crop($image,$width = 70 ,$height = 70) {
		$imgSrc = $image;

		//getting the image dimensions
		list($width, $height) = getimagesize($imgSrc);

		//saving the image into memory (for manipulation with GD Library)
		$myImage = imagecreatefromjpeg($imgSrc);

		// calculating the part of the image to use for thumbnail
		if ($width > $height) {
		  $y = 0;
		  $x = ($width - $height) / 2;
		  $smallestSide = $height;
		} else {
		  $x = 0;
		  $y = ($height - $width) / 2;
		  $smallestSide = $width;
		}

		// copying the part into thumbnail
		$thumbSize = 100;
		$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
		imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

		//final output
		header('Content-type: image/jpeg');
		imagejpeg($thumb);
	}
	public function count_buy($uid)
	{
		global $db;
		$db->query("SELECT count(*) as counts FROM fb_accounts WHERE account_buyer = '".$uid."'");
		return $db->fetch_object(true)->counts;
	}
	public function sum_buy_by_user($uid)
	{
		global $db;
		$db->query("SELECT sum(account_price) as sum FROM fb_accounts WHERE account_buyer = '".$uid."'");
		return $db->fetch_object(true)->sum;
	}
	public function generatepassword($length = 8) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function count_all_link()
	{
		global $db;
		$db->query("SELECT count(id) as c FROM fb_accounts");
		return $db->fetch_object(true)->c;
	}
	public function count_sold_link()
	{
		global $db;
		$db->query("SELECT count(id) as c FROM fb_accounts WHERE account_status = '1'");
		return $db->fetch_object(true)->c;
	}
	public function count_sold_amount()
	{
		global $db;
		$db->query("SELECT sum(account_price) as c FROM fb_accounts WHERE account_status = '1'");
		return $db->fetch_object(true)->c;
	}
	public function count_deposit_amount()
	{
		global $db;
		$db->query("SELECT sum(trans_amount) as c FROM fb_transactions WHERE trans_type = '1'");
		return $db->fetch_object(true)->c;
	}
	public function get_top_user()
	{
		global $db;
		$db->query("SELECT trans_uid as uid, sum(trans_amount) as sumc FROM fb_transactions WHERE trans_type = '2' GROUP BY trans_uid ORDER BY sumc DESC LIMIT 5");
		return $db->fetch_object();
	}
	public function exportexcel($type)
	{
		include_once 'Classes/PHPExcel.php';
		
		$objPHPExcel	=	new	PHPExcel();
		
		global $db;
		$db->query("SELECT *,a.id as aid FROM fb_accounts as a
		LEFT JOIN fb_account_type as t ON a.account_type = t.id
		WHERE account_buyer = '".$_SESSION['uid']."' AND account_type = '".$type."'
		ORDER BY account_addtime DESC
		");
		$listlink = $db->fetch_object();

		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'STT');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Link');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Business ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Ngày mua');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Giá');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Loại');

		$objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);

		$rowCount	=	2;
		$i = 1;
		foreach($listlink as $link)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $i);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $link->account_link);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $link->account_businessid);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, date("d/m/Y",strtotime($link->account_buydate)));
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $link->account_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $link->type_name);
			$rowCount++;
			$i++;
		}

		//$objWriter	=	new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="mualinkfb-mylink.xls"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		
		$objWriter->save('php://output');
		
		//return "acd";
	}
	public function exportuser()
	{
		include_once 'Classes/PHPExcel.php';
		
		$objPHPExcel	=	new	PHPExcel();
		
		global $db;
		$db->query("SELECT * FROM fb_users WHERE user_group = '2' AND user_status = '1' ORDER BY user_register_date DESC");
		$listuser = $db->fetch_object();

		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'STT');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Số điện thoại');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Ngày đăng ký');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Số dư');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Số lần mua');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Tổng tiền mua');

		$objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);

		$rowCount	=	2;
		$i = 1;
		foreach($listuser as $user)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $i);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $user->user_phone);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, date("d/m/Y",strtotime($user->user_register_date)));
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, number_format($user->user_balance,0));
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $this->count_buy($user->id));
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $this->sum_buy_by_user($user->id));
			$rowCount++;
			$i++;
		}

		//$objWriter	=	new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="mualinkfb-listuser.xls"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		
		$objWriter->save('php://output');
		
		//return "acd";
	}
	//End General Data
	
    public function getid($strings)
    {
        $ids = explode("-", $strings);
        $id = $ids[0];
        return $id;
    }
	
	
    public function checkid($id,$table,$idfield)
    {
        global $db;
        $db->query("SELECT * FROM ".$table." WHERE ".$idfield." = '".$id."'");
        if($db->num_row())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function get_category($catid)
    {
        if($catid != "")
        {
            global $db;
            $blog = $db->query("SELECT * FROM xiaob_cat WHERE catid=".$catid);
            $me = $db->fetch_object($first_row = true);
            return $me->catname;
        }
        else return "";
    }
	public function get_payment_history($xid)
	{
		global $db;
		$db->query("SELECT * FROM xdata_payment WHERE xid = '".$xid."' ORDER BY paytime DESC");
		return $db->fetch_object(false);
	}
    public function get_grade($gradeid)
    {
        if($gradeid != "")
        {
            global $db;
            $blog = $db->query("SELECT * FROM xdata_khoilop WHERE khoilop=".$gradeid);
            $me = $db->fetch_object($first_row = true);
            return $me->tenkhoilop;
        }
        else return "";
    }
    public function get_subject($subjid)
    {
        if($subjid != "")
        {
            global $db;
            $blog = $db->query("SELECT * FROM xdata_monhoc WHERE mamon=".$subjid);
            $me = $db->fetch_object($first_row = true);
            return $me->tenmon;
        }
        else return "";
    }
	public function get_monhoc($mamon)
    {
        if($mamon != "")
        {
            global $db;
            $blog = $db->query("SELECT * FROM xdata_monhoc WHERE mamon='".$mamon."'");
            $me = $db->fetch_object(true);
            return $me->tenmon;
        }
        else return ""; 
    }
    public function get_mem_account($xid,$info)
    {
        if(isset($xid) && $xid != "" && isset($info) && $info != "")
        {
            global $db;
            $db->query("SELECT ".$info." FROM xdata_account WHERE xid = ".$xid);
            $acc = $db->fetch_object($first_row = true);
            return $acc->$info;
        }
        else
        {
            return "";
        }
    }
	public function price_mask($price)
	{
		return "";
	}
    public function get_mem_info($xid,$info)
    {
        if(isset($xid) && $xid != "" && isset($info) && $info != "")
        {
            global $db;
            $db->query("SELECT ".$info." FROM xdata_info WHERE xid = ".$xid);
            $acc = $db->fetch_object($first_row = true);
            return $acc->$info;
        }
        else
        {
            return "";
        }
    }
    public function bodau($title) {
        $title = preg_replace('/(")/','',$title);
        $url_pattern = array('` &(amp;|"| |"|#)?[a-z0-9]+;`i', '`[^a-z0-9]`i');

        $title = htmlentities($title, ENT_COMPAT, 'utf-8');
        $title = preg_replace( '`&([a-z]+)(acute|uml|circ|quot|grave|ring|cedil|slash|tilde|caron|lig);`i', "\\1", $title );
        $title = preg_replace('`\[.*\]`U','',$title);
        $title = strtolower(trim($title, '-'));

        $title = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ả|Ã|Ạ|Ằ|Ắ|Ẳ|Ẵ|Ặ|Ầ|Ấ|Ẩ|Ẫ|Ậ)/", 'a', $title);
        $title = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ể|Ễ|Ệ)/", 'e', $title);
        $title = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $title);
        $title = preg_replace("/(-)/", '', $title);
        $title = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ồ|Ố|Ổ|Ỗ|Ộ|Ờ|Ớ|Ở|Ỡ|Ợ)/", 'o', $title);
        $title = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ủ|Ũ|Ụ|Ừ|Ứ|Ử|Ữ|Ự)/", 'u', $title);
        $title = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỷ|Ỹ|Ỵ)/", 'y', $title);
        $title = preg_replace("/(đ)/", 'd', $title);
        $title = preg_replace("/(Đ)/", 'd', $title);
        $title = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $title);
        $title = preg_replace($url_pattern , '-', $title);
        $title = preg_replace("/(--)/",'-',$title);
        return $title;
    }

	public function bodau_ten($title) {
        $title = preg_replace('/(")/','',$title);
        $url_pattern = array('` &(amp;|"| |"|#)?[a-z0-9]+;`i', '`[^a-z0-9]`i');

        $title = htmlentities($title, ENT_COMPAT, 'utf-8');
        $title = preg_replace( '`&([a-z]+)(acute|uml|circ|quot|grave|ring|cedil|slash|tilde|caron|lig);`i', "\\1", $title );
        $title = preg_replace('`\[.*\]`U','',$title);

        $title = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $title);
        $title = preg_replace("/(À|Á|Ả|Ã|Ạ|Ằ|Ắ|Ẳ|Ẵ|Ặ|Ầ|Ấ|Ẩ|Ẫ|Ậ)/", 'A', $title);
        $title = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $title);
        $title = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ể|Ễ|Ệ)/", 'E', $title);
        $title = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $title);
        $title = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $title);
        $title = preg_replace("/(-)/", '', $title);
        $title = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $title);
        $title = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ở|Ờ|Ớ|Ở|Ỡ|Ợ)/", 'O', $title);
        $title = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $title);
        $title = preg_replace("/(Ù|Ú|Ủ|Ũ|Ụ|Ừ|Ứ|Ử|Ữ|Ự)/", 'U', $title);
        $title = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $title);
        $title = preg_replace("/(Ỳ|Ý|Ỷ|Ỹ|Ỵ)/", 'Y', $title);
        $title = preg_replace("/(đ)/", 'd', $title);
        $title = preg_replace("/(Đ)/", 'D', $title);
        $title = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $title);
        $title = preg_replace($url_pattern , '-', $title);
        $title = preg_replace("/(--)/",'-',$title);
        return $title;
    }
	public function bodau_keyword($title) {
        $unicode = array(
           'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
           'd'=>'đ',
           'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
           'i'=>'í|ì|ỉ|ĩ|ị',
           'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
           'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
           'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
           'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
           'D'=>'Đ',
           'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
           'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
           'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
           'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
           'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
       );
	  foreach($unicode as $nonUnicode=>$uni){
		   $title = preg_replace("/($uni)/i", $nonUnicode, $title);
	  }

        return $title;
    }
	
    public function permalink($id,$type)
    {
        global $db;
        $fs = "";
        switch($type)
        {
			case "tour":
			{
				$db->query("SELECT * FROM sgt_tours WHERE tourid = '".$id."'");
				$bl = $db->fetch_object(true);
				$fs = XC_URL."/tour/".$bl->tourid."-".$this->bodau($bl->tour_title).".html";
				break;
			}
			case "hotel":
			{
				$db->query("SELECT * FROM gt_hotels WHERE hid = '".$id."'");
				$bl = $db->fetch_object(true);
				$fs = XC_URL."/khach-san/".$bl->hid."-".$this->bodau($bl->hotel_name." ".$this->get_place_name($bl->hotel_place)).".html";
				break;
			}
			case "place":
			{
				$fs = XC_URL."/diem-den/".$id."-".$this->bodau($this->get_place_name($id)).".html";
				break;
			}
            case "subject":
            {
                $db->query("SELECT * FROM xdata_monhoc WHERE mamon = '".$id."'");
                $bl = $db->fetch_object($first_row = true);
                $fs = XC_URL."/subject/".$id."-".$this->bodau($bl->tenmon);
                break;
            }
			case "publisher":
            {
                $db->query("SELECT username FROM xdata_account WHERE xid = '".$id."'");
                $bl = $db->fetch_object($first_row = true);
                $fs = XC_URL."/user/".$this->bodau($bl->username);
                break;
            }
            case "cat":
            {
                $db->query("SELECT * FROM sgt_category WHERE catid = ".$id."");
                $bl = $db->fetch_object($first_row = true);
                $fs = XC_URL."/chuyen-muc/".$id."-".$this->bodau($bl->cat_title);
                break;
            }
			case "post":
            {
                $db->query("SELECT * FROM sgt_post WHERE id = ".$id."");
                $bl = $db->fetch_object($first_row = true);
                $fs = XC_URL."/bai-viet/".$id."-".$this->bodau($bl->title).".html";
                break;
            }
            case "bst":
            {
                $db->query("SELECT * FROM xiaob_bst_flat WHERE id = ".$id);
                $bst = $db->fetch_object($first_row = true);
                $fs = $id."-".$this->bodau($bst->tenbst);
                break;
            }
            case "schoollevel":
            {
                $db->query("SELECT * FROM xiaob_school_level WHERE id = ".$id);
                $bst = $db->fetch_object($first_row = true);
                $fs = $id."-".$this->bodau($bst->levelname);
                break;
            }
            case "grade":
            {
                $db->query("SELECT * FROM xiaob_grade WHERE id = ".$id);
                $bst = $db->fetch_object($first_row = true);
                $fs = $id."-".$this->bodau($bst->gradename);
                break;
            }
            default:
                break;
        }
        return $fs;
    }
	public function get_ds_khoilop($caphoc)
	{
		global $db;
		if($caphoc == "*")
		{
			$db->query("SELECT * FROM xdata_khoilop ORDER BY khoilop");
			return $db->fetch_object(false);
		}
		else
		{
			$db->query("SELECT * FROM xdata_khoilop WHERE caphoc = '".$caphoc."' ORDER BY khoilop");
			return $db->fetch_object(false);
		}
	}
    public function get_bst($xid)
    {
        if(isset($xid) && $xid != "")
        {
            global $db;
            $db->query("SELECT * FROM xiaob_bst_flat WHERE xid = '".$xid."'");
            return $db->fetch_object();
        }
        else
        {
            return null;
        }
    }
	public function count_bst($bstid)
	{
		global $db;
		$db->query("SELECT count(bookid) as c FROM xiaob_bst WHERE mabst = '".$bstid."'");
		return $db->fetch_object(true)->c;
	}
    private function URNR($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
    public function random_bst()
    {
        global $db;
        $db->query("SELECT * FROM xiaob_bst_flat ORDER BY xview DESC");
        $c = $db->num_row();
        $b = $this->URNR(1,$c,3);
        return $b;

    }
    public function get_bst_list($bstid)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_bst WHERE mabst = ".$bstid." ORDER BY bookid DESC LIMIT 4");
        return $db->fetch_object();
    }
    public function bst_info($id)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_bst_flat WHERE id = ".$id);
        return $db->fetch_object($first_row = true);
    }
    public function get_top_post($num)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_memlog ORDER BY upload DESC LIMIT ".$num);
        return $db->fetch_object();
    }
    public function get_subject_list()
    {
        global $db;
        $db->query("SELECT * FROM xdata_monhoc WHERE mamon != '8258378' ORDER BY tenmon");
        return $db->fetch_object();
    }
	public function get_category_list()
    {
        global $db;
        $db->query("SELECT * FROM xiaob_cat ORDER BY catid");
        return $db->fetch_object();
    }
	public function get_book_by_member($xid,$limit = 3)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE bookpuber = ".$xid." ORDER BY bookid DESC LIMIT ".$limit);
        return $db->fetch_object();
    }
	public function get_activity($xid,$limit = 3)
    {
        global $db;
        $db->query("SELECT * FROM xdata_activity WHERE xid = ".$xid." AND apptype = '2345999' ORDER BY time DESC LIMIT ".$limit);
        return $db->fetch_object();
    }
	public function activyname($actid)
	{
		global $db;
		$db->query("SELECT acti_name FROM xdata_activity_flat WHERE acti_id = '".$actid."' LIMIT 1");
		return $db->fetch_object(true)->acti_name;
	}
	public function get_lop($khoilop)
	{
		global $db;
		$db->query("SELECT * FROM xdata_khoilop WHERE khoilop = '".$khoilop."' LIMIT 1");
		return $db->fetch_object(true)->tenkhoilop."";
	}
	public function get_book_member_like($xid,$limit = 3)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_yeuthich WHERE xid = '".$xid."' ORDER BY id DESC LIMIT ".$limit);
        if($db->num_row())
		{
			$listbook = $db->fetch_object();
			$arr = array();
			foreach($listbook as $book)
			{
				array_push($arr,$book->bookid);
			}
		}
		else
		{
			$arr = array(0);
		}
		$a = implode(",",$arr);
		$db->query("SELECT * FROM xiaob_book WHERE bookid IN ($a)");
		return $db->fetch_object(false);
    }
	public function checkliked($xid,$bookid)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_yeuthich WHERE xid ='".$xid."' AND bookid = '".$bookid."'");
		if($db->num_row())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function countbook($by,$id)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_book WHERE ".$by." = '".$id."'");
		return $db->num_row();
	}
	public function countbst($xid)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_bst_flat WHERE xid = '".$xid."'");
		return $db->num_row();
	}
	public function count_view_by_member($xid)
	{
		global $db;
		$db->query("SELECT SUM(bookview) as total FROM xiaob_book WHERE bookpuber = '".$xid."'");
		return ($db->fetch_object(true)->total)+0;
	}
	public function count_download_by_member($xid)
	{
		global $db;
		$db->query("SELECT SUM(bookdown) as total FROM xiaob_book WHERE bookpuber = '".$xid."'");
		return ($db->fetch_object(true)->total)+0;
	}
    public function get_book_by_subject($subjectid,$limit = 3)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE booksubj = ".$subjectid." ORDER BY bookid DESC LIMIT ".$limit);
        return $db->fetch_object();
    }
	public function generateRandomString($length = 10) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
			return $randomString;
	}
    public function get_newest_book_by_subject($subjectid)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE booksubj = ".$subjectid." ORDER BY bookid DESC");
        return $db->fetch_object($first_row = true);
    }
	public function get_book_by_category($catid,$orderby = "bookid",$limit = 20)
	{
		global $db;
        $db->query("SELECT * FROM xiaob_book WHERE bookcat = ".$catid." ORDER BY ".$orderby." DESC LIMIT ".$limit);
        return $db->fetch_object();
	}
	public function get_top_view_book($limit = 5)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_book ORDER BY bookview DESC LIMIT ".$limit);
		return $db->fetch_object(false);
	}
	public function get_top_download_book($limit = 5)
	{
		global $db;
		$db->query("SELECT * FROM xiaob_book ORDER BY bookdown DESC LIMIT ".$limit);
		return $db->fetch_object(false);
	}
    public function get_top_book_by_category($catid,$limit = 3)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE bookcat = ".$catid." ORDER BY bookid DESC LIMIT ".$limit);
        return $db->fetch_object();
    }
    public function get_grade_by_level($levelid)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_level_grade WHERE levelid = ".$levelid);
        return $db->fetch_object();
    }
    public function get_top_member_by_score($top = 5)
    {
        global $db;
        $db->query("SELECT * FROM xdata_score WHERE appid = '8317808' ORDER BY score DESC LIMIT ".$top);
        return $db->fetch_object();
    }
    public function get_event_info($eventid)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_event WHERE id = ".$eventid);
        return $db->fetch_object($first_row = true);
    }
    public function bookcount($w)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE ".$w);
        return $db->num_row();
    }
    public function analytic_page($str)
    {
        $ids = explode("-", $str);
        return $ids[1];
    }
    public function get_bst_info($mabst,$info)
    {
        global $db;
        $db->query("SELECT ".$info." FROM xiaob_bst_flat WHERE id = ".$mabst);
        $s = $db->fetch_object($first_row = true);
        return $s->$info;
    }
    public function get_list_tinhthanh()
    {
        global $db;
        $db->query("SELECT * FROM xdata_tinhthanh ORDER BY tentinh DESC");
        return $db->fetch_object();
    }
	function time_ago($timestamp)
	{
		
		$time_ago = strtotime($timestamp);
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60 );
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400 );
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640 );
		$years      = round($time_elapsed / 31207680 );
		//return $cur_time;
		if($seconds <= 60){
			return "$seconds giây trước";
		}else if($minutes <=60){
			if($minutes==1){
				return "một phút trước";
			}else{
				return "$minutes phút trước";
			}
		}else if($hours <=24){
			if($hours==1){
				return "một giờ trước";
			}else{
				return "$hours giờ trước";
			}
		}else if($days <= 7){
			if($days==1){
				return "Hôm qua";
			}else{
				return "$days ngày trước";
			}
		}else if($weeks <= 4.3){
			if($weeks==1){
				return "một tuần trước";
			}else{
				return "$weeks tuần trước";
			}
		}else if($months <=12){
			if($months==1){
				return "một tháng trước";
			}else{
				return "$months tháng trước";
			}
		}else{
			if($years==1){
				return "một năm trước";
			}else{
				return "$years năm trước";
			}
		}
	}
	public function apilogin($provider)
	{
		include('hybridauth/config.php');
        include('hybridauth/Hybrid/Auth.php');
		try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
	        	echo "<b>Name</b> :".$user_profile->displayName."<br>";
	        	echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
	        	echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
	        	echo "<img src='".$user_profile->photoURL."'/><br>";
	        	echo "<b>Email</b> :".$user_profile->email."<br>";	        		        		        	
	        	echo "<br> <a href='logout.php'>Logout</a>";
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
	}
	
	
	/*
	*Author: TuyenHH 
	*/
	// START
	 public function checkaccount($type,$value)
    {
        global $db;
        $db->query("SELECT * FROM xdata_account WHERE ".$type."= '".$value."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	//END
	
	public function checkxid($id)
    {
        global $db;
        $db->query("SELECT * FROM fb_transactions WHERE trans_code = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function checkcusid($id)
    {
        global $db;
        $db->query("SELECT * FROM portal_customers WHERE cus_code = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function checkpostid($id)
    {
        global $db;
        $db->query("SELECT * FROM raovat_ad WHERE postid = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	public function checkcatid($id)
    {
        global $db;
        $db->query("SELECT * FROM raovat_category WHERE catid = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	public function createid()
    {
        $id = "ln60";
        $rdc = rand(10000,79999);
        $id = $id."".$rdc."9";
        return $id;
    }
	public function createcusid()
    {
		//0089135555
        $id = "0089";
        $rdc = rand(10000,79999);
        $id = $id."".$rdc."5";
        return $id;
    }
    public function createpostid()
    {
        $id = "";
        $rdc = rand(1000000,9999999);
        $id = $id."".$rdc;
        return $id;
    }
	public function createcatid()
    {
        $id = "";
        $rdc = rand(2200000,2299999);
        $id = $id."".$rdc;
        return $id;
    }
	public function create_transaction_id()
    {
        $id = "";
        $rdc = rand(5200000,5699999);
        $id = $id."".$rdc;
        return $id;
    }
	public function create_wallet_id()
    {
        $id = "LN60";
        $rdc = rand(5200000,5699999);
        $id = $id."".$rdc;
        return $id;
    }
	public function check_transaction_id($id)
    {
        global $db;
        $db->query("SELECT * FROM portal_transactions WHERE trans_code = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	public function check_wallet_id($id)
    {
        global $db;
        $db->query("SELECT * FROM portal_customer_accounts WHERE acc_number = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	public function create_bet_id()
	{
		$id = "";
        $rdc = rand(210000000,990000000);
        $id = $id."".$rdc;
        return $id;
	}
	public function check_bet_id($id)
	{
		global $db;
        $db->query("SELECT * FROM bet_game_bets WHERE bet_code = '".$id."'");
        if($db->num_row())
        {
            return false;
        }
        else
        {
            return true;
        }
	}
    public function generateid($type)
    {
        $id = "";
        switch($type)
        {
			case "transaction":
            {
                $id = $this->create_transaction_id();
                do
                {
                    $id = $this->create_transaction_id();
                }
                while(!$this->check_transaction_id($id));
                break;
            }
			case "bet":
			{
				$id = $this->create_bet_id();
                do
                {
                    $id = $this->create_bet_id();
                }
                while(!$this->check_bet_id($id));
                break;
			}
			case "customer":
            {
                $id = $this->createcusid();
                do
                {
                    $id = $this->createcusid();
                }
                while(!$this->checkcusid($id));
                break;
            }
			case "wallet":
			{
				$id = $this->create_wallet_id();
                do
                {
                    $id = $this->create_wallet_id();
                }
                while(!$this->check_wallet_id($id));
                break;
			}
			case "account":
            {
                $id = $this->createid();
                do
                {
                    $id = $this->createid();
                }
                while(!$this->checkxid($id));
                break;
            }
            case "post":
            {
                $id = $this->createpostid();
                do
                {
                    $id = $this->createpostid();
                }
                while(!$this->checkpostid($id));
                break;
            }
			case "cat":
			{
				$id = $this->createcatid();
                do
                {
                    $id = $this->createcatid();
                }
                while(!$this->checkpostid($id));
                break;
			}
            default:
                break;
        }
        return $id;
    }
	public function get_day_name($timestamp) 
	{
		$today = new DateTime(); // This object represents current date/time
		$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

		$match_date = DateTime::createFromFormat( "Y.m.d\\TH:i", $timestamp );
		$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

		$diff = $today->diff( $match_date );
		$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
		$name = "";
		switch( $diffDays ) {
			case 0:
				$name = "Hôm nay";
				break;
			case -1:
				$name =  "Hôm qua";
				break;
			case +1:
				$name = "Ngày mai";
				break;
			default:
				$name = date("d/m/Y",strtotime($timestamp));
				break;
		}
		return $name;
	}
	function relative_date($time) {
 
		$today = strtotime(date('M j'));
		 
		$reldays = ($time - $today)/86400;
		 
		if ($reldays >= 0 && $reldays < 1) {
		 
		return 'Hôm nay';
		 
		} else if ($reldays >= 1 && $reldays < 2) {
		 
		return 'Ngày mai';
		 
		} else if ($reldays >= -1 && $reldays < 0) {
		 
		return 'Hôm qua';
		 
		}
		 
		if (abs($reldays) < 7) {
		 
		if ($reldays > 0) {
		 
		$reldays = floor($reldays);
		 
		return  $reldays . ' ngày nữa' . ($reldays != 1 ? '' : '');
		 
		} else {
		 
		$reldays = abs(floor($reldays));
		 
		return $reldays . ' ngày trước' . ($reldays != 1 ? '' : '') ;
		 
		}
		 
		}
		 
		if (abs($reldays) < 182) {
		 
		return date('d/m',$time ? $time : time());
		 
		} else {
		 
		return date('d/m',$time ? $time : time());
		 
		}
 
	}
	
}