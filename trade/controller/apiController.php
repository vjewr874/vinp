<?php
/**
 * Project: thuvien.
 * File: tourController.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 09:54 - 07/10/2016
 * Website: www.xiao.vn
 */
Class apiController extends baseController
{
    public function index()
    {
		
    }
	public function joingame()
	{
		global $db;
		$gameID = $_GET['gameid'];
		$sql = "SELECT * FROM game_datas WHERE game_time < '".date("Y-m-d H:i:s")."' AND game_id = '".$gameID."' ORDER BY game_time DESC LIMIT 60";
		$db->query($sql);
		$rs = $db->fetch_object();
		$result = array();
		$lastStartTime = "";
		$lastendTime = "";
		$lastgameTime = "";
		$drawprice = 0;
		$data = array();
		$lasttime = "";
		foreach($rs as $r)
		{
			$sub = array();
			$sub["nowtime"] = date("m/d/Y H:i:s");
			if(date("s",strtotime($r->game_time)) == 0)
			{
				$sub["newdraw"] = true;
			}
			else
			{
				$sub["newdraw"] = false;
			}
			if(date("s",strtotime($r->game_time)) == 59)
			{
				$sub["game_result"] = true;
				$drawprice = $r->game_data;
			}
			$time = strtotime($r->game_time);
			$sub["time"] = date("m/d/Y H:i:s",$time);
			$sub["price"] = $r->game_data;
			$lasttime = $r->game_time;
			$lastStartTime = date("m/d/Y H:i:50",strtotime($r->game_time));
			$lastendTime = date("m/d/Y H:i:59",strtotime($r->game_time));
			$lastgameTime = date("m/d/Y H:i:00",strtotime($r->game_time));
			
			array_push($data,$sub);
		}
		$data = array_reverse($data);
		$result["data"] = $data;
		$result["drawprice"] = $drawprice;
		$gametime = date("s",strtotime($lastStartTime));
		if(strtotime($lasttime) > strtotime($lastgameTime))
		{
			$result["startTime"] = date("m/d/Y H:i:50",strtotime($lastStartTime."+ 1 minutes"));
			$result["endTime"] = date("m/d/Y H:i:59",strtotime($lastendTime."+ 1 minutes"));
		}
		else
		{
			$result["startTime"] = $lastStartTime;
			$result["endTime"] = $lastendTime;
			
		}
		$result["gameTime"] = $lastgameTime;
		$result["lasttime"] = $lasttime;
		echo json_encode($result);
	}
	public function pricedata()
	{
		global $db;
		$gameID = $_GET['gameid'];
		$sql = "SELECT * FROM game_datas WHERE game_time = '".date("Y-m-d H:i:s")."' AND game_id = '".$gameID."' ORDER BY id DESC LIMIT 1";
		$db->query($sql);
		$r = $db->fetch_object(true);
		$result = array();
		$drawid = $r->draw_id;
		
		$result["nowtime"] = date("d/m/Y H:i:s");
		$rd = rand(2230009,3994442);
		$rd = $rd/100000;
		$rnum = rand(1,20);
		
		if(date("s",strtotime($r->game_time)) == 0)
		{
			$result["newdraw"] = true;
		}
		else
		{
			$result["newdraw"] = false;
		}
		if(date("s",strtotime($r->game_time)) == 59)
		{
			$result["game_result"] = true;
		}
		if(date("s",strtotime($r->game_time)) == 50)
		{
			$timmer = strtotime($r->game_time)+60;
			//YYYY/MM/DD hh:mm:ss
			$result["countdown"] = true;
			$result["timer"] = date("Y/m/d H:i:s",$timmer);
			
			
		}
		$s = date("s",strtotime($r->game_time));
		if($s <=50 )
		{
			$c = str_pad((60- ($s+10)), 2, '0', STR_PAD_LEFT);
			$result["countdowntime"] = "00:00:".$c;
		}
		else
		{
			$c = str_pad((120- ($s+10)), 2, '0', STR_PAD_LEFT);
			$result["countdowntime"] = "00:00:".$c;
		}
		if(date("s",strtotime($r->game_time)) >= 50)
		{
			$drawid = $r->draw_id+1;
		}
		$db->query("SELECT * FROM game_datas WHERE id = '".($r->id - 1)."'");
		$lastgame = $db->fetch_object(true);
		$result["change"] = ($r->game_data < $lastgame->game_data)? "-".round(rand(20,4200)/100,2) : "+".round(rand(20,4200)/100,2);
		$result["changeflag"] = ($r->game_data < $lastgame->game_data)? "down" : "up";
		$result["lastSeconds"] = 60 - date("s",strtotime($r->game_time));
		$endtime = strtotime(date("Y-m-d H:i:59",strtotime($r->game_time)));
		$startTime = $endtime - 10;
		$result["startTime"] = date("m/d/Y H:i:50",strtotime($r->game_time));
		$result["endTime"] = date("m/d/Y H:i:59",strtotime($r->game_time));
		$result["gameTime"] = date("m/d/Y H:i:00",strtotime($r->game_time));
		$time = strtotime($r->game_time);
		$result["time"] = date("m/d/Y H:i:s",$time);
		$result["price"] = $r->game_data;
		$result["draw_id"] = $drawid;
		$result["status"] = 200;
		echo json_encode($result);
	}
	public function drawdata()
	{
		global $db;
		$result = array();
		$db->query("SELECT * FROM bet_games WHERE game_id = '710' AND draw_time <= '".date("Y-m-d H:i:s")."' ORDER BY id DESC LIMIT 10");
		$draws = $db->fetch_object();
		$v = '';
		foreach($draws as $draw)
		{
			$price = $draw->draw_result;
			$p = substr($price,-1);
			$t = ($p < 5)? "Mua vào" : "Bán ra";
			$u = ($p < 5)? "up" : "down";
			$v .= '<div class="side-log-item">
								<div class="list-bet">
									<div class="list-bet-time">
										<span class="bet-time">'.substr($draw->draw_id,-4).'</span>
									</div>
									<div class="list-bet-stat">
										<div class="list-bet-type">
											<div class="bet-type">'.substr($draw->draw_result,-5).'</div>
										</div>
										<div class="list-bet-updown">
											<div class="bet-number result_'.$u.'">'.$t.'</div>
										</div>
										
									</div>
								</div>
							</div>';
		}
		$result["data"] = $v;
		echo json_encode($result);
	}
	public function symboldata()
	{
		global $db;
		$result = array();
		$db->query("SELECT * FROM system_symbols");
		$symbols = $db->fetch_object();
		$sym = array();
		foreach($symbols as $symbol)
		{
			$sub = array();
			$sub["symbol"] = $symbol->symbol_id;
			$sub["name"] = $symbol->symbol_code;
			$data = array();
			$db->query("SELECT * FROM game_datas WHERE game_time = '".date("Y-m-d H:i:s")."' AND game_id = '".$symbol->symbol_id."' ORDER BY id DESC LIMIT 1");
			$r = $db->fetch_object(true);
			$arrupd = rand(0,1);
			
			$data["price"] = $price = $r->game_data;
			$data["change"] = $change = ($arrupd)? "+".round(rand(5,20)/100,2) : "-".round(rand(5,20)/100,2);
			$data["changeflag"] = ($arrupd)? "down" : "up";
			if(date("s",strtotime($r->game_time)) == "59")
			{
				$time = strtotime($r->game_time)+1;
				$data["drawtime"] = date("H:i:s",$time);
				$data["drawdata"] = true;
				$pr = substr($r->game_data,-1);
				if($pr < 5)
				{
					$data["rsa"] = 1;
					$data["rss"] = "Mua vào";
					$data["rsu"] = "result_up";
				}
				else
				{
					$data["rsa"] = 2;
					$data["rss"] = "Bán ra";
					$data["rsu"] = "result_down";
				}
			}
			else
			{
				$data["drawdata"] = false;
			}
			$sub["data"] = $data;
			array_push($sym,$sub);
		}
		$result["symbols"] = $sym;
		echo json_encode($result);
	}
	public function randdata2()
	{
		$result = array();
		$data = array();
		$result["time"] = time();
		$result["price"] = rand(203,288);
		$result["status"] = 200;
		//$result["data"] = $data;
		echo json_encode($result);
	}
	public function stafflogin()
	{
		$result = array();
		$email = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
		global $db;
		$db->query("SELECT * FROM crm_users WHERE user_email = '".$email."' AND user_password = '".$password."' ORDER BY id DESC LIMIT 1");
		if($db->num_row())
		{
			$user = $db->fetch_object(true);
			$_SESSION['staff']['id'] = $user->id;
			$_SESSION['staff']['fullname'] = $user->user_firstname." ".$user->user_lastname;
			$result["status"] = 200;
		}
		else
		{
			$result["status"] = 404;
			$result["message"] = "Không tìm thấy tài khoản";
		}
        echo json_encode($result);
	}
	public function sendotp()
	{
		$uid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		$db->query("SELECT * FROM portal_customers WHERE id = '".$uid."' LIMIT 1");
		$cus = $db->fetch_object(true);
		$otp = general::getInstance()->generate_number(6);
		$randstring = general::getInstance()->generate_string(6);
		$text = "Ma xac thuc cua Quy khach la: ".$otp.". Hieu luc trong 5 phut. ".$randstring;
		$res = sms::getInstance()->sendsms($cus->cus_phone,$text);
		$db->query("INSERT INTO system_otp(otp_code,otp_uid,otp_exp) VALUES('".$otp."','".$uid."','".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." + 5 minutes"))."')");
		if($res == true)
		{
			$result["status"] = "200";
		}
		echo json_encode($result);
	}
	
	private function apisendotp($phone = "")
	{
		$uid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		$db->query("SELECT * FROM portal_customers WHERE id = '".$uid."' LIMIT 1");
		$cus = $db->fetch_object(true);
		$otp = general::getInstance()->generate_number(6);
		$randstring = general::getInstance()->generate_string(6);
		$text = "Ma xac thuc cua Quy khach la: ".$otp.". Hieu luc trong 5 phut. ".$randstring;
		$sentphone = "";
		if($phone != "")
		{
			$sentphone = $phone;
		}
		else
		{
			$sentphone = $cus->cus_phone;
		}
		$res = sms::getInstance()->sendsms($sentphone,$text);
		$db->query("INSERT INTO system_otp(otp_code,otp_uid,otp_exp) VALUES('".$otp."','".$uid."','".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." + 5 minutes"))."')");
		return $res;
	}
	public function checktoken()
	{
		$result = array();
		$token = $_POST['token'];
		$result["data"] = $_POST;
		$auth = $this->config->_config("auth");
		if($token != $auth)
		{
			$result["status"] = 500;
			$result["url"] = XC_URL."/trading?game=700&auth=".$auth."&token=".$_SESSION['token'];
		}
		else
		{
			$result["status"] = 200;
		}
		echo json_encode($result);
	}
	private function verifyotp($otp,$uid)
	{
		global $db;
		$result = array();
		$db->query("SELECT * FROM system_otp WHERE otp_uid = '".$uid."' AND otp_code = '".$otp."' ORDER BY otp_exp DESC LIMIT 1");
		if($db->num_row())
		{
			$otpdata = $db->fetch_object(true);
			$now  = strtotime(date("Y-m-d H:i:s"));
			if($now < strtotime($otpdata->otp_exp))
			{
				$result["status"] = 200;
			}
			else
			{
				$result["status"] = 500;
				$result["message"] = "Mã xác thực đã hết hạn";
			}
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Mã xác thực không đúng!";
		}
		return $result;
	}
	public function updateprofile()
	{
		global $db;
		$fullname = mysql_real_escape_string($_POST['fullname']);
		$address = mysql_real_escape_string($_POST['address']);
		$db->query("UPDATE portal_customers SET cus_fullname = '".$fullname."', cus_address = '".$address."' WHERE id = '".$_SESSION['user']['id']."' ORDER BY id DESC LIMIT 1");
		$result = array();
		$result["status"] = 200;
		echo json_encode($result);
	}
	public function changepassword()
	{
		$result = array();
		$old_password = $_POST['password'];
		$new_password = $_POST['newpassword'];
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."' and cus_password = '".md5($old_password)."'");
		if($db->num_row())
		{
			$db->query("UPDATE portal_customers SET cus_password = '".md5($new_password)."' WHERE id = '".$_SESSION['user']['id']."'");
			$result["status"] = 200;
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Mật khẩu cũ không chính xác!";
		}
		echo json_encode($result);
	}
	public function searchlistbet()
	{
		$result = array();
		
		$start = $_POST['start'];
		$end = $_POST['end'];
		$game = $_POST['room'];
		$drawid = $_POST['draw_id'];
		/*
		$start = "2021-05-01";
		$end = "2021-05-18";
		$game = "700";
		*/
		$result["post"] = $_POST;
		global $db;
		if(!(isset($_POST['draw_id']) && $_POST['draw_id'] != ""))
		{
			$result["sql"] = "SELECT * FROM bet_game_bets as b
			LEFT JOIn bet_games as g ON b.draw_id = g.draw_id
			WHERE uid = '".$_SESSION['user']['id']."' AND b.game_id = '".$game."' AND (DATE(bet_time) BETWEEN '".date("Y-m-d",strtotime($start))."' AND  '".date("Y-m-d",strtotime($end))."') ORDER BY bet_time DESC";
			$db->query("SELECT * FROM bet_game_bets as b
			LEFT JOIn bet_games as g ON b.draw_id = g.draw_id
			WHERE uid = '".$_SESSION['user']['id']."' AND b.game_id = '".$game."' AND g.game_id = '".$game."' AND (DATE(bet_time) BETWEEN '".date("Y-m-d",strtotime($start))."' AND  '".date("Y-m-d",strtotime($end))."') ORDER BY bet_time DESC");
		}
		else
		{
			$drawid = $_POST['draw_id'];
			$result["sql"] = "SELECT * FROM bet_game_bets as b
			LEFT JOIn bet_games as g ON b.draw_id = g.draw_id WHERE uid = '".$_SESSION['user']['id']."' AND b.draw_id = '".$drawid."' AND b.game_id = '".$game."' AND (DATE(bet_time) BETWEEN '".date("Y-m-d",strtotime($start))."' AND  '".date("Y-m-d",strtotime($end))."') ORDER BY bet_time DESC";
			$db->query("SELECT * FROM bet_game_bets as b
			LEFT JOIn bet_games as g ON b.draw_id = g.draw_id WHERE uid = '".$_SESSION['user']['id']."' AND b.draw_id = '".$drawid."' AND b.game_id = '".$game."' AND g.game_id = '".$game."' AND (DATE(bet_time) BETWEEN '".date("Y-m-d",strtotime($start))."' AND  '".date("Y-m-d",strtotime($end))."') ORDER BY bet_time DESC");
			
		}
		$tb = '';
		if($db->num_row())
		{
			$betlist = $db->fetch_object();
		
			
			
			foreach($betlist as $bet)
			{
				$pt = array();
					$countbet = 0;
					if($bet->pattern_1)
					{
						($bet->pattern_1 == 1)? array_push($pt,"Mua vào") : array_push($pt,"Bán ra");
						$countbet++;
					}
					if($bet->pattern_2)
					{
						($bet->pattern_2 == 1)? array_push($pt,"Đơn") : array_push($pt,"Đôi");
						$countbet++;
					}
					$oods = ($countbet > 1)? "0.9/0.9": "0.9";
					$pattern = implode("/",$pt);
					$payout = '';
					if($bet->bet_status == 0)
					{
						$payout = '';
					}
					elseif($bet->bet_status == 2)
					{
						$payout = number_format($bet->bet_paid_out,0);
					}
					elseif($bet->bet_status == 3)
					{
						$payout = "-".number_format($bet->bet_amount,0);
					}
					
				$tb .= '<table class="table-bet mode1">
					   <thead>
						  <tr>
							 <th>Số sê-ri</th>
							 <th>'.$bet->draw_id.'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Thời gian</th>
							 <th>'.date("Y-m-d H:i:s",strtotime($bet->bet_time)).'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Không.</th>
							 <th>'.$bet->draw_id.'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Nội dung</th>
							 <th>'.$pattern.'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Odds </th>
							 <th>'.$oods.'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Kết quả</th>
							 <th>'.$bet->draw_result.'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Số tiền</th>
							 <th>'.number_format($bet->bet_amount,0).'</th>
						  </tr>
					   </thead>
					   <thead>
						  <tr>
							 <th>Kết quả của tôi</th>
							 <th class="bet_result_plus">'.$payout.'</th>
						  </tr>
					   </thead>
					</table>';
			}
		}
		else
		{
			$tb = 'Không có dữ liệu!';
		}
		
		
		$result["data"] = $tb;
		echo json_encode($result);
	}
	public function getlistbet()
	{
		//AND date(bet_time) = '".date("Y-m-d")."' 
		global $db;
		$db->query("SELECT * FROM bet_game_bets WHERE uid = '".$_SESSION['user']['id']."' ORDER BY bet_time DESC LIMIT 10");
		$listbet = $db->fetch_object();
		$rs = '';
		foreach($listbet as $bet)
		{
			$statuslb = "";
			$title = "";
			if($bet->bet_status == 0)
			{
				$statuslb = "result_odd";
				$title = "Chờ";
			}
			elseif($bet->bet_status == 2)
			{
				$statuslb = "result_up";
				$title = "Thắng";
			}
			else
			{
				$statuslb = "result_down";
				$title = "Thua";
			}
			$rs .= '<div class="list-bet">
									<div class="list-bet-time">
										<span class="bet-time">'.date("H:i:s",strtotime($bet->bet_time)).'</span>
									</div>
									<div class="list-bet-stat">
										<div class="list-bet-type">
											<div class="bet-type">'.$bet->draw_id.'</div>
										</div>
										<div class="list-bet-updown">
											<div class="bet-number '.$statuslb.'">'.$title.'</div>
										</div>
										<div class="list-bet-price">
											<div class="bet-price">'.number_format($bet->bet_amount,0).'</div>
										</div>
									</div>
								</div>';
		}
		$result = array();
		$result["data"] = $rs;
		$db->query("SELECT * FROM portal_customers as c 
		LEFT JOIN system_referals as r ON c.cus_referal = r.referal_id
		WHERE c.id = '".$_SESSION['user']['id']."'");
		$acc = $db->fetch_object(true);
		if(strtotime(date("Y-m-d H:i:s")) > strtotime(date("Y-m-d H:i:s",strtotime($acc->c_key_exp))))
		{
			$result["relogin"] = true;
			$redirect_url = "";
			$home = $this->helper->_config("home_url");
			$home_url = str_replace("https://","",$home);
			if($acc->referal_sub != "")
			{
				$redirect_url = "https://".$acc->referal_sub.".".$home_url;
			}
			else
			{
				$redirect_url = $home;
			}
			$result["login_url"] = $redirect_url."/logout";
		}
		
		$result["balance"] = number_format($acc->cus_balance,0);
		echo json_encode($result);
	}
	public function placebet()
	{
		$result = array();
		$result["data"] = $_POST;
		global $db;
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$user = $db->fetch_object(true);
			$db->query("SELECT * FROM portal_customers WHERE id = '".$user->id."' LIMIT 1");
			$account = $db->fetch_object(true);
			if($account->cus_balance >= $_POST['amount'])
			{
				$pattern1 = ($_POST['pattern1'])? explode("_",$_POST['pattern1'])[1]: 0;
				$pattern2 = ($_POST['pattern2'])? explode("_",$_POST['pattern2'])[1]: 0;
				$betcode = general::getInstance()->generateid("bet");
				
				
				
				$pt = array();
				$countbet = 0;
				if($_POST['pattern1'])
				{
					($pattern1 == 1)? array_push($pt,"Lên") : array_push($pt,"Xuống");
					$countbet++;
				}
				if($_POST['pattern2'])
				{
					($pattern2 == 1)? array_push($pt,"Đơn") : array_push($pt,"Đôi");
					$countbet++;
				}
				if($countbet > 0)
				{
					$db->query("UPDATE portal_customers SET cus_balance = cus_balance - ".$_POST['amount']." WHERE id = '".$user->id."'");
					$db->query("INSERT INTO bet_game_bets(bet_code,game_id,uid, draw_id,pattern_1, pattern_2,bet_amount, bet_status) VALUES('".$betcode."','".$_POST['game']."','".$_SESSION['user']['id']."','".$_POST['draw_lottery_id']."','".$pattern1."','".$pattern2."','".$_POST['amount']."',0)");
					$transcode = general::getInstance()->generateid("transaction");
					$result["newbalance"] = number_format($account->cus_balance - $_POST['amount'],0);
					$hashdata = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
					$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$user->id."','".$transcode."','5','99','1','".$_POST['amount']."','".$hashdata."','2','Đặt lệnh: ".$_POST['draw_lottery_id']."')");
					$result["pattern"] = implode("/",$pt);
					$result["betamount"] = $countbet*$_POST['amount'];
					$result["status"] =200;
				}
				else
				{
					$result["status"] = 400;
					$result["message"] = "Vui lòng chọn loại lệnh phù hợp!";
				}
				
			}
			else
			{
				$result["status"] = 400;
					$result["message"] = "Tài khoản của Quý Khách không đủ để đặt lệnh!";
			}
		}
		echo json_encode($result);
	}
	public function updategamedata()
	{
		$result = array();
		global $db;
		$db->query("UPDATE bet_games SET draw_result = '".$_POST['result']."' WHERE draw_id = '".$_POST['game']."'");
		$result["status"] = 200;
		echo json_encode($result);
	}
	public function getgameresult()
	{
		$result = array();
		global $db;
		$db->query("SELECT * FROM bet_games WHERE draw_id = '".$_POST['game']."' ORDER BY draw_time DESC LIMIT 1");
		$game = $db->fetch_object(true);
		$result["data"] = $_POST;
		$result["result"] = $game->draw_result;
		echo json_encode($result);
	}
	public function getlastgameresult()
	{
		$result = array();
		global $db;
		$db->query("SELECT * FROM bet_games WHERE game_id = '700' AND draw_time < '".date("Y-m-d H:i:s")."' ORDER BY draw_time DESC LIMIT 1");
		$game = $db->fetch_object(true);
		$result["data"] = $_POST;
		$result["value"] = $game->draw_result;
		echo json_encode($result);
	}
	public function payout()
	{
		
		global $db;
		$db->query("SELECT * FROM bet_game_bets WHERE bet_time < '".date("Y-m-d H:i:s")."' AND bet_status = 0");
		$bets = $db->fetch_object();
		foreach($bets as $bet)
		{
			echo $bet->game_id." - ".$bet->uid." - ".$bet->draw_id." - ".$bet->pattern_1." - ".$bet->pattern_2." - ".$bet->bet_amount;
			echo "<hr>";
			$gamedata = $this->getgamedata($bet->game_id,$bet->draw_id);
			var_dump($gamedata);
			echo "<hr>";
			$payoutrate = 0.9;
			$payout = 0;
			if($bet->pattern_1 != 0 && $bet->pattern_2 != 0)
			{
				//Bet parlay
				if($bet->pattern_1 == $gamedata["pattern_1"] && $bet->pattern_2 == $gamedat["pattern_2"])
				{
					//Win
					
					$payout = $bet->bet_amount*0.9 + $bet->bet_amount;
					echo "Win game, payout: ".$payout."<br>";
					$db->query("UPDATE bet_game_bets SET bet_status = 2, bet_paid_out = '".$payout."', bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
					$transcode = general::getInstance()->generateid("transaction");
					$hashdata = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
					$db->query("UPDATE portal_customers SET cus_balance = cus_balance + ".$payout." WHERE id = '".$bet->uid."'");
					$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$bet->uid."','".$transcode."','4','99','1','".$payout."','".$hashdata."','2','Trả thưởng lệnh: ".$bet->draw_id."')");
				}
				else
				{
					echo "Lose game<br>";
					$db->query("UPDATE bet_game_bets SET bet_status = 3, bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
				}
			}
			else
			{
				if($bet->pattern_1 != 0 && $bet->pattern_2 == 0)
				{
					if($bet->pattern_1 == $gamedata["pattern_1"])
					{
						$payout = $bet->bet_amount*0.9 + $bet->bet_amount;
						echo "Win game, payout: ".$payout."<br>";
						$db->query("UPDATE bet_game_bets SET bet_status = 2, bet_paid_out = '".$payout."', bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
						$transcode = general::getInstance()->generateid("transaction");
						$hashdata = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
						$db->query("UPDATE portal_customers SET cus_balance = cus_balance + ".$payout." WHERE id = '".$bet->uid."' ");
						$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$bet->uid."','".$transcode."','4','99','1','".$payout."','".$hashdata."','2','Trả thưởng lệnh: ".$bet->draw_id."')");
					}
					else
					{
						echo "Lose game<br>";
						$db->query("UPDATE bet_game_bets SET bet_status = 3, bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
					}
				}
				else
				{
					if($bet->pattern_2 == $gamedata["pattern_2"])
					{
						$payout = $bet->bet_amount*0.9 + $bet->bet_amount;
						echo "Win game, payout: ".$payout."<br>";
						$db->query("UPDATE bet_game_bets SET bet_status = 2, bet_paid_out = '".$payout."', bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
						$transcode = general::getInstance()->generateid("transaction");
						$hashdata = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
						$db->query("UPDATE portal_customers SET cus_balance = cus_balance + ".$payout." WHERE id = '".$bet->uid."'");
						$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$bet->uid."','".$transcode."','4','99','1','".$payout."','".$hashdata."','2','Trả thưởng lệnh: ".$bet->draw_id."')");
					}
					else
					{
						echo "Lose game<br>";
						$db->query("UPDATE bet_game_bets SET bet_status = 3, bet_result = '".$gamedata["result"]."' WHERE id = '".$bet->id."'");
					}
				}
			}
			echo "<hr>";
		}
	}
	public function getgamedata2()
	{
		$gameid = "700";
		$draw_id = "202105177000859";
		global $db;
		$db->query("SELECT * FROM bet_games WHERE game_id = '".$gameid."' AND draw_id = '".$draw_id."' LIMIT 1");
		$game = $db->fetch_object(true);
		echo $result = $game->draw_result;
		echo "<br>";
		echo $char = substr($result,-1);
		echo "<br>";
		$rs = array();
		$rs["pattern_1"] = ($char < 5)? 1 : 2;
		$rs["pattern_2"] = ($char % 2 == 0)? 2 : 1;
		var_dump($rs);
	}
	public function getgamedata($gameid,$draw_id)
	{
		global $db;
		$db->query("SELECT * FROM bet_games WHERE game_id = '".$gameid."' AND draw_id = '".$draw_id."' LIMIT 1");
		$game = $db->fetch_object(true);
		$result = $game->draw_result;
		$char = substr($result,-1);
		$rs = array();
		$rs["result"] = $result;
		$rs["pattern_1"] = ($char < 5)? 1 : 2;
		$rs["pattern_2"] = ($char % 2 == 0)? 2 : 1;
		return $rs;
	}
	public function createdrawgame()
	{
		global $db;
		$db->query("SELECT * FROM bet_games ORDER BY draw_time DESC LIMIT 1");
		$lastgame = $db->fetch_object(true);
		$lastid = $lastgame->draw_id;
		//202105167000086
		//$firstid = substr($lastid,-7); 
		$lastresult = $lastgame->draw_result;
		
		
		$now = date("Y-m-d H:i:s",strtotime($lastgame->draw_time));
		$now = date("Y-m-d H:i:s",strtotime($now." +1 minute"));
		if(date("H:i:s",strtotime($now)) == "23:00:00")
		{
			$prefix = date("Ymd",strtotime($now." + 1day"));
			$id = $prefix."7000001";
		}
		else
		{
			$newid = $lastid + 1;
			$id = $newid;		
		}
		
			$rand = rand(230968894,370968899);
			$rs = $rand/1000000;
			$newresult = 36200 + $rs;
			$db->query("INSERT INTO bet_games(game_id,draw_id,draw_time,draw_result) VALUES('700','".$id."','".$now."','".$newresult."')");
		$this->payout();
		echo "sss";
	}
	//=============== ACCOUNT FUNCTION ===================//
	public function CheckWalletBalance()
	{
		$walletid = $_POST['walletid'];
		global $db;
		$result = array();
		if($walletid == 1)
		{
			$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
			$user = $db->fetch_object(true);
			$result["status"] = 200;
			$result["balance"] = number_format($user->cus_balance,0)." VNĐ";
			$result["balance_number"] = $user->cus_balance;
		}
		else
		{
			$db->query("SELECT * FROM portal_customer_accounts WHERE cid = '".$_SESSION['user']['id']."' AND acc_type = '1' LIMIT 1");
			$wallet = $db->fetch_object(true);
			$result["status"] = 200;
			$result["balance"] = number_format($wallet->acc_balance,0)." VNĐ";
			$result["balance_number"] = $wallet->acc_balance;
		}
		echo json_encode($result);
	}
	//=============== BANK FUNCTION ======================//
	public function transfer()
	{
		$result = array();
		global $db;
		$amount = $_POST['amount'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$hash = $_POST['hash'];
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$user = $db->fetch_object(true);
			if($from == 1)
			{
				if($user->cus_balance >= $amount)
				{
					$uid = $_SESSION['user']['id'];
					$transcode = general::getInstance()->generateid("transaction");
					$db->query("UPDATE portal_customers SET cus_balance = cus_balance - ".$amount." WHERE id = '".$user->id."'");
					$db->query("UPDATE portal_customer_accounts SET acc_balance = acc_balance + ".$amount." WHERE cid = '".$user->id."' AND acc_type = 1");
					$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$uid."','".$transcode."','3','".$to."','1','".$amount."','".$hashdata."','2','Chuyển tiền vào tài khoản BO')");
					$result["status"] = 200;
				}
				else
				{
					$result["status"] = 500;
					$result["message"] = "Tài khoản của Quý Khách không đủ để thực hiện giao dịch này!";
				}
			}
			else
			{
				$db->query("SELECT * FROM portal_customer_accounts WHERE cid = '".$_SESSION['user']['id']."' AND acc_type = '1' LIMIT 1");
				$wallet = $db->fetch_object(true);
				if($wallet->acc_balance >= $amount)
				{
					$uid = $_SESSION['user']['id'];
					$transcode = general::getInstance()->generateid("transaction");
					$db->query("UPDATE portal_customer_accounts SET acc_balance = acc_balance - ".$amount." WHERE cid = '".$uid."' AND acc_type = 1");
					$db->query("UPDATE portal_customers SET cus_balance = cus_balance + ".$amount." WHERE id = '".$uid."'");
					$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note) VALUES('".$uid."','".$transcode."','3','".$to."','1','".$amount."','".$hashdata."','2','Chuyển tiền vào tài khoản chính')");
					$result["status"] = 200;
				}
				else
				{
					$result["status"] = 500;
					$result["message"] = "Tài khoản của Quý Khách không đủ để thực hiện giao dịch này!";
				}
			}
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Không thể xác thực";
		}
		echo json_encode($result);
	}
	public function checkwithdraw()
	{
		global $db;
		$result = array();
		$db->query("SELECT * FROM portal_customers WHERE id = '".$_SESSION['user']['id']."'");
		$user = $db->fetch_object(true);
		if($_POST['amount'] < 1000000)
		{
			$result["status"] = 500;
			$result["message"] = "Số tiền rút tối thiểu là: 1.000.000đ";
		}
		elseif($user->cus_balance >= $_POST['amount'])
		{
			if($this->apisendotp())
			{
				$result["status"] = 200;
				$result["phone"] = $user->cus_phone;
			}
			else
			{
				$result["status"] = 500;
				$result["message"] = "Không thể gửi mã xác nhận, vui lòng liên hệ nhân viên hỗ trợ!";
			}
			
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Tài khoản của Quý Khách không đủ để thực hiện giao dịch này!";
		}
		echo json_encode($result);
	}
	public function withdraw()
	{
		//$otp = $_POST['otp'];
		$cid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		//$otpverify = $this->verifyotp($otp,$cid);
		$hash = $_POST['hash'];
		$db->query("SELECT * FROM portal_transactions WHERE trans_hash = '".$hash."'");
		if($db->num_row())
		{
			$result["status"] = 500;
			$result["message"] = "Đã tồn tại giao dịch!";
		}
		else
		{
			$uid = $_SESSION['user']['id'];
			$transcode = general::getInstance()->generateid("transaction");
			$amount = $_POST['amount'];
			$bank = $_POST['bankid'];
			$db->query("SELECT * FROM portal_customers WHERE id = '".$uid."' ORDER BY id DESC LIMIT 1");
			$user = $db->fetch_object(true);
			if($user->cus_balance >= $amount)
			{
				$fee = $this->config->_config("withdraw_fee")/100;
				$uid = $user->id;
				$total = $amount + $amount*$fee;
				$db->query("UPDATE portal_customers SET cus_balance = cus_balance - ".$amount." WHERE id = '".$user->id."'");
				$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount, trans_fee,trans_hash,trans_status,trans_note) VALUES('".$uid."','".$transcode."','2','".$bank."','1','".$amount."','".($amount*$fee)."','".$hashdata."','1','Rút tiền từ tài khoản chính')");
				$result["message"] = "Giao dịch rút tiền của Quý Khách đã được xác nhận. Trung tâm đối soát thanh toán của Invest Pro Co. sẽ thực hiện kiểm tra hợp lệ và chuyển tiền cho Quý Khách trong thời gian sớm nhất. Xin lưu ý, quá trình này có thể cần từ 04 đến 24 giờ làm việc! Xin cảm ơn!";
				$result["status"] = 200;
			}
			else
			{
				$result["status"] = 503;
				$result["message"] = "Tài khoản của Quý Khách không đủ để thực hiện giao dịch này!";
			}
		}
		
		echo json_encode($result);
	}
	public function withdrawbk()
	{
		$otp = $_POST['otp'];
		$cid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		$otpverify = $this->verifyotp($otp,$cid);
		if($otpverify["status"] == 200)
		{
			$hash = $_POST['hash'];
			$db->query("SELECT * FROM portal_transactions WHERE trans_hash = '".$hash."'");
			if($db->num_row())
			{
				$result["status"] = 500;
				$result["message"] = "Đã tồn tại giao dịch!";
			}
			else
			{
				$uid = $_SESSION['user']['id'];
				$transcode = general::getInstance()->generateid("transaction");
				$amount = $_POST['amount'];
				$bank = $_POST['bankid'];
				$db->query("SELECT * FROM portal_customers WHERE id = '".$uid."' ORDER BY id DESC LIMIT 1");
				$user = $db->fetch_object(true);
				if($user->cus_balance >= $amount)
				{
					$fee = $this->config->_config("withdraw_fee")/100;
					$uid = $user->id;
					$total = $amount + $amount*$fee;
					$db->query("UPDATE portal_customers SET cus_balance = cus_balance - ".$amount." WHERE id = '".$user->id."'");
					$db->query("INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount, trans_fee,trans_hash,trans_status,trans_note) VALUES('".$uid."','".$transcode."','2','".$bank."','1','".$amount."','".($amount*$fee)."','".$hashdata."','1','Rút tiền từ tài khoản chính')");
					$result["message"] = "Giao dịch rút tiền của Quý Khách đã được xác nhận. Trung tâm đối soát thanh toán của Lightning999 sẽ thực hiện kiểm tra hợp lệ và chuyển tiền cho Quý Khách trong thời gian sớm nhất! Xin cảm ơn!";
					$result["status"] = 200;
				}
				else
				{
					$result["status"] = 503;
					$result["message"] = "Tài khoản của Quý Khách không đủ để thực hiện giao dịch này!";
				}
			}
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = $otpverify["message"];
		}
		
		echo json_encode($result);
	}
	public function deposite()
	{
		global $db;
		$result = array();
		$hashdata = $_POST['hash'];
		
		$db->query("SELECT * FROM portal_transactions WHERE trans_hash = '".$hashdata."'");
		$result["data"] = $_POST;
		if($db->num_row())
		{
			$result["status"] = 500;
			$result["message"] = "Đã tồn tại giao dịch!";
		}
		else
		{
			$amount = $_POST['amount'];
			if($amount > 350000)
			{
				$uid = $_SESSION['user']['id'];
				$transcode = general::getInstance()->generateid("transaction");
				$note = "Nạp tiền vào tài khoản";
				$transdata = "IN".$transcode;
				$method = $_POST['method'];
				$sql = "INSERT INTO portal_transactions(uid,trans_code,trans_type,trans_bank,trans_method,trans_amount,trans_hash,trans_status,trans_note,trans_data) VALUES('".$uid."','".$transcode."','1','1','".$method."','".$amount."','".$hashdata."','1','".$note."','".$transdata."')";
				$db->query($sql);
				$db->query("SELECT *, db.id as dbid FROM hicrm_deposit_banks as db
				LEFT JOIN system_banks as b ON db.bankid = b.id
				WHERE db.id = '".$method."'
				");
				$bankdata = $db->fetch_object(true);
				$result["amount"] = number_format($amount,0);
				$result["bankname"] = $bankdata->bank_name." - ".$bankdata->bank_code;
				$result["bank_account"] = $bankdata->bank_account;
				$result["bank_holder"] = $bankdata->bank_holder;
				$result["code"] = $transcode;
				$result["depositecode"] = $transdata;
				$result["status"] = 200;
			}
			else
			{
				$result["status"] = 500;
				$result["message"] = "Số tiền nạp tối thiểu là 350.000 VNĐ!";
			}
		}
		echo json_encode($result);
	}
	public function deletebank()
	{
		$bankid = $_POST['bankid'];
		global $db;
		$result = array();
		$db->query("SELECT * FROM portal_customer_banks WHERE id = '".$bankid."' AND cid = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$db->query("DELETE FROM portal_customer_banks WHERE id = '".$bankid."'");
			$result["status"] = 200;
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Không tìm thấy tài khoản";
		}
		echo json_encode($result);
	}
	public function viewbank()
	{
		$bankid = $_POST['bankid'];
		global $db;
		$result = array();
		$db->query("SELECT * FROM portal_customer_banks as cb LEFT JOIN system_banks as b ON cb.bank_id = b.id WHERE cb.id = '".$bankid."'");
		if($db->num_row())
		{
			$bankdata = $db->fetch_object(true);
			$result["status"] = 200;
			$result["message"] = "Success";
			$result["bank_name"] = $bankdata->bank_name;
			$result["bank_logo"] = $bankdata->bank_logo;
			$result["bank_account"] = $bankdata->bank_account;
			$result["bank_holder"] = $bankdata->bank_holder;
			$result["bank_branch"] = $bankdata->bank_branch;
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Tài khoản không tồn tại!";
		}
		echo json_encode($result);
		
	}
	public function updatebank()
	{
		$result = array();
		global $db;
		$bank = $_POST['bank'];
		$branch = $_POST['bank_branch'];
		$acc = $_POST['bank_account'];
		$holder = $_POST['bank_holder'];
		$db->query("SELECT * FROM portal_customer_banks WHERE cid = '".$_SESSION['user']['id']."' ORDER BY id DESC LIMIT 1");
		if($db->num_row())
		{
			
			//Update
			$db->query("UPDATE portal_customer_banks SET bank_id = '".$bank."', bank_account = '".$acc."',bank_holder = '".$holder."',bank_branch = '".$branch."' WHERE cid = '".$_SESSION['user']['id']."' ORDER BY id DESC LIMIT 1");
			$result["status"] = 200;
		}
		else
		{
			//Insert
			$db->query("INSERT INTO portal_customer_banks(cid,bank_id,bank_account,bank_holder,bank_branch,bank_status) VALUES('".$_SESSION['user']['id']."','".$bank."','".$acc."','".$holder."','".$branch."',1)");
			$result["status"] = 200;
		}
		echo json_encode($result);
	}
	public function addbank()
	{
		$result = array();
		$bank = $_POST['bank'];
		$branch = $_POST['bank_branch'];
		$acc = $_POST['bank_account'];
		$holder = $_POST['bank_holder'];
		$FinalFilenameFront = "";
		if(!$branch || !$acc || !$holder)
		{
			$result["status"] = 500;
			$result["message"] = "Thông tin không hợp lệ!";
		}
		else
		{
			global $db;
			
			if(isset($_FILES['bank_file']))
			{
				$errors= array();
				$file_name = $_FILES['bank_file']['name'];
				$file_size =$_FILES['bank_file']['size'];
				$file_tmp =$_FILES['bank_file']['tmp_name'];
				$file_type=$_FILES['bank_file']['type'];
				$file_ext=strtolower(end(explode('.',$_FILES['bank_file']['name'])));
				$OriginalFilename = $FinalFilename = preg_replace('`[^a-z0-9-_.]`i','',$_FILES['bank_file']['name']); 
				$FinalFilenameFront = md5(time())."-".$FinalFilename;
				if(in_array($file_ext,$expensions)=== false){
					$errors[]="Extension not allowed, please choose a .png, .jpg file.";
				}
				if($file_size > 5242880){
					$errors[]='File size must be max 2Mb';
				}
				if(empty($errors)==true){
					move_uploaded_file($file_tmp,"./uploads/users/".$FinalFilenameFront);
					
				}else
				{
					$result["status"] = 500;
				}
				
			}
			
			$db->query("SELECT * FROM portal_customer_banks WHERE cid = '".$_SESSION['user']['id']."' AND bank_id = '".$bank."' AND bank_account = '".$acc."'");
			if($db->num_row())
			{
				$result["status"] = 500;
				$result["message"] = "Tài khoản đã tồn tại trong hệ thống!";
			}
			else
			{
				$db->query("INSERT INTO portal_customer_banks(cid,bank_id,bank_account,bank_holder,bank_branch,bank_status,bank_file) VALUES('".$_SESSION['user']['id']."','".$bank."','".$acc."','".$holder."','".$branch."',0,'".$FinalFilenameFront."')");
				$result["status"] = 200;
			}
		}
		echo json_encode($result);
	}
	public function verifybank()
	{
		$cbid = $_POST['bankid'];
		$cid = $_SESSION['user']['id'];
		$result = array();
		global $db;
		$sql = "SELECT * FROM portal_customer_banks WHERE bank_status = 0 AND id = '".$cbid."' AND cid = '".$cid."'";
		$db->query($sql);
		if($db->num_row())
		{
			if($this->apisendotp())
			{
				$result["status"] = 200;
			}
			else
			{
				$result["status"] = 500;
				$result["message"] = "Không thể gửi mã xác nhận, vui lòng liên hệ nhân viên hỗ trợ!";
			}
			
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = "Tài khoản không tồn tại hoặc đã được xác minh!";
		}
		echo json_encode($result);
	}
	public function verifybankbyotp()
	{
		$otp = $_POST['otp'];
		$cbid = $_POST['bankid'];
		$cid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		$otpverify = $this->verifyotp($otp,$cid);
		if($otpverify["status"] == 200)
		{
			$db->query("UPDATE portal_customer_banks SET bank_status = 1 WHERE id = '".$cbid."'");
			$result["status"] = 200;
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = $otpverify["message"];
		}
		echo json_encode($result);
	}
	//===================== END BANK FUNCTION =======================//
	
	//===================== CONTACT FUNCTION =======================//
	private function validatephone($phone)
	{
		if(  preg_match( '/((09|03|07|08|05)+([0-9]{8})\b)/', $phone,  $matches ) )
		{
			//$result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
			return true;
		}
		else
		{
			return false;
		}
	}
	public function addnewphone()
	{
		$newphone = $_POST['newphone'];
		if($this->validatephone($newphone))
		{
			$cid = $_SESSION['user']['id'];
			global $db;
			$result = array();
			$db->query("SELECT * FROM portal_customer_contacts WHERE cid = '".$cid."' AND contact_type = '1' AND contact_value = '".$newphone."'");
			if($db->num_row())
			{
				$result["status"] = 500;
				$result["message"] = "Số điện thoại này đã được sử dụng";
			}
			else
			{
				$db->query("SELECT * FROM portal_customer_contacts WHERE contact_type = '1' AND contact_value = '".$newphone."'");
				if($db->num_row())
				{
					$result["status"] = 500;
					$result["message"] = "Số điện thoại này đã được sử dụng cho một tài khoản khác";
				}
				else
				{
					$db->query("INSERT INTO portal_customer_contacts(cid,contact_type,contact_value,contact_status) VALUES('".$cid."','1','".$newphone."',0)");
					if($this->apisendotp($newphone))
					{
						$result["status"] = 200;
					}
					else
					{
						$result["status"] = 500;
						$result["message"] = "Đã thêm số điện thoại nhưng chưa thể xác thực";
					}
					//
				}
			}
		}
		else
		{
			$result["status"] = 503;
			$result["message"] = "Số điện thoại không hợp lệ";
		}
		echo json_encode($result);
	}
	//===================== END CONTACT FUNCTION =======================//
	public function verifyotpapp()
	{
		$otp = $_POST['otp'];
		$dataid = $_POST['dataid'];
		$cid = $_SESSION['user']['id'];
		$type = $_POST['verifytype'];
		global $db;
		$result = array();
		$otpverify = $this->verifyotp($otp,$cid);
		if($otpverify["status"] == 200)
		{
			switch($type)
			{
				case "phone":
				{
					$sql = "UPDATE portal_customer_contacts SET contact_status = 1 WHERE contact_value = '".$dataid."'";
					$db->query($sql);
					break;
				}
				default:
					break;
			}
			
			$result["status"] = 200;
			$result["sql"] = $sql;
		}
		else
		{
			$result["status"] = 500;
			$result["message"] = $otpverify["message"];
		}
		echo json_encode($result);
	}
	public function resendotp()
	{
		$uid = $_SESSION['user']['id'];
		global $db;
		$result = array();
		$db->query("SELECT * FROM system_otp WHERE otp_uid = '".$uid."' ORDER BY otp_exp DESC LIMIT 1");
		if(!$db->num_row())
		{
			if($this->apisendotp())
			{
				$result["status"] = 200;
			}
			else
			{
				$result["status"] = 500;
				$result["message"] = "Không thể gửi mã xác nhận, vui lòng liên hệ nhân viên hỗ trợ!";
			}
		}
		else
		{
			$otpdata = $db->fetch_object(true);
			$now  = strtotime(date("Y-m-d H:i:s"));
			if($now < strtotime($otpdata->otp_exp))
			{
				$time = strtotime($otpdata->otp_exp) - $now;
				$result["status"] = 500;
				$result["message"] = "Vui lòng gửi lại sau: ".$time." giây!";
			}
			else
			{
				if($this->apisendotp())
				{
					$result["status"] = 200;
				}
				else
				{
					$result["status"] = 500;
					$result["message"] = "Không thể gửi mã xác nhận, vui lòng liên hệ nhân viên hỗ trợ!";
				}
			}
		}
		echo json_encode($result);
	}
	
	public function getproducts()
	{
		$result = array();
		$data = array();
		global $db;
		$db->query("SELECT * FROM data_products WHERE product_status = '1' AND product_flag = '1' ORDER BY product_order DESC");
		$this->view->data["products"] = $db->fetch_object();
	}
	public function register()
	{
		$result = array();
		global $db;
		$phone = mysql_real_escape_string($_POST['phone']);
		$name = mysql_real_escape_string($_POST['name']);
		$username = mysql_real_escape_string($_POST['username']);
		$password = md5(mysql_real_escape_string($_POST['password']));
		$db->query("SELECT * FROM portal_customers WHERE cus_phone = '".$phone."' OR cus_username = '".$username."'");
		if($db->num_row())
		{
			$result["status"] = 500;
			$result["message"] = "Số điện thoại hoặc tài khoản đã tồn tại!";
		}
		else
		{
			$code = general::getInstance()->generateid("customer");
			$account = general::getInstance()->generateid("wallet");
			$db->query("INSERT INTO portal_customers(cus_code,cus_username,cus_password,cus_fullname,cus_phone,cus_registed_date) VALUES('".$code."','".$username."','".$password."','".$name."','".$phone."','".date("Y-m-d H:i:s")."')");
			$db->query("SELECT id FROM portal_customers WHERE cus_phone = '".$phone."' ORDER BY id DESC LIMIT 1");
			$cid = $db->fetch_object(true)->id;
			$db->query("INSERT INTO portal_customer_accounts(cid,acc_type,acc_number,acc_currency) VALUES ('".$cid."','1','".$account."',1)");
			$result["status"] = 200;
			$result["code"] = $code;
			$result["acc"] = $account;
		}
		echo json_encode($result);
		
	}
	public function login()
	{
		$result = array();
		$username = mysql_real_escape_string($_POST["username"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
        $member_login = $this->model->get('memberloginModel')->user_login($username,$password);
		if($member_login)
		{
			$result["status"] = "200";
			$token =  bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
			$_SESSION['token'] = $token;
			$result["name"] = $_SESSION['user']['fullname'];
			//echo $_SESSION['user']['id'];
		}
		else
		{
			$result["status"] = "500";
			//echo "error";
		}
		echo json_encode($result);
	}
	public function salechartbystaff()
	{
		$result = array();
		$result["status"] = "200";
		echo json_encode($result);
	}
	public function listcustomer()
	{
		global $db;
		if($_SESSION['user']['id'] == "1")
		{
			$db->query("SELECT *,c.id as cid, u.id as uid, (SELECT COUNT(*) FROM crm_customer_notes WHERE cid = c.id) as countnote, (SELECT note_time FROM crm_customer_notes WHERE cid = c.id ORDER BY note_time DESC LIMIT 1) as lastnote
			FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			LEFT JOIN crm_users as u ON c.cus_assigned_to = u.id
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."'
			ORDER BY lastnote DESC
			LIMIT 100
			");
		}
		else
		{
			$db->query("SELECT *,c.id as cid, u.id as uid, (SELECT COUNT(*) FROM crm_customer_notes WHERE cid = c.id) as countnote, (SELECT note_time FROM crm_customer_notes WHERE cid = c.id ORDER BY note_time DESC LIMIT 1) as lastnote
			FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			LEFT JOIN crm_users as u ON c.cus_assigned_to = u.id
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."'
			ORDER BY lastnote DESC
			");
			/*
			$db->query("SELECT *,c.id as cid FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."'
			ORDER BY id DESC
			");
			*/
		}
		$totalrow = $db->num_row();
		$listcustomer = $db->fetch_object();
		$result = array();
		$meta = array();
		$meta["page"] = 1;
		$meta["pages"] = 1;
		$meta["perpage"] = -1;
		$meta["total"] = $totalrow;
		$meta["sort"] = "asc";
		$meta["field"] = "id";
		$result["meta"] = $meta;
		$data = array();
		foreach($listcustomer as $cus)
		{
			$subcus = array();
			$subcus["ID"] = $cus->cid;
			$subcus["Name"] = $cus->cus_firstname." ".$cus->cus_lastname;
            $subcus["Phone"] = $cus->cus_phone;
            $subcus["Address1"] = $cus->cus_address;
            $subcus["Address2"] = "";
            $subcus["LastNote"] = $cus->lastnote;
			$subcus["CusFlag"] = $cus->cus_flag;
            $subcus["AssignTo"] = $cus->user_username;
            $subcus["AssignToUID"] = $cus->uid;
            $subcus["Postcode"] = "6711";
            $subcus["CountNote"] = $cus->countnote;
            $subcus["Type"] = 1;
			$subcus["Level"] = $cus->cus_level;
			$subcus["TypeTitle"] = "";
			$subcus["Status"] = $cus->cus_status;
			$subcus["Source"] = $cus->cus_source;
            $subcus["DateCreated"] = date("d/m/Y",strtotime($cus->cus_addtime));
            $subcus["DateAssigned"] = date("d/m/Y",strtotime($cus->cus_assigned_time));
            $subcus["DateModified"] = date("d/m/Y",strtotime($cus->cus_lastupdate));
            $subcus["Position"] = 4;
            $subcus["ClientState"] = 3;
			array_push($data,$subcus);
		}
		$result["data"] = $data;
		echo json_encode($result);
	}
	public function listpotentialcustomer()
	{
		global $db;
		if($_SESSION['user']['id'] == "1")
		{
			$db->query("SELECT *,c.id as cid, u.id as uid, (SELECT COUNT(*) FROM crm_customer_notes WHERE cid = c.id) as countnote, (SELECT note_time FROM crm_customer_notes WHERE cid = c.id ORDER BY note_time DESC LIMIT 1) as lastnote
			FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			LEFT JOIN crm_users as u ON c.cus_assigned_to = u.id
			LEFT JOIN crm_customer_logs as log ON log.cid = c.id
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."' AND log.log_key = 'UPCUSTOMERLEVEL'
			GROUP BY c.id
			ORDER BY lastnote DESC
			LIMIT 100
			");
		}
		else
		{
			$db->query("SELECT *,c.id as cid, u.id as uid, (SELECT COUNT(*) FROM crm_customer_notes WHERE cid = c.id) as countnote, (SELECT note_time FROM crm_customer_notes WHERE cid = c.id ORDER BY note_time DESC LIMIT 1) as lastnote
			FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			LEFT JOIN crm_users as u ON c.cus_assigned_to = u.id
			LEFT JOIN crm_customer_logs as log ON log.cid = c.id
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."' AND log.log_key = 'UPCUSTOMERLEVEL'
			ORDER BY lastnote DESC
			");
			/*
			$db->query("SELECT *,c.id as cid FROM crm_customers as c
			LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
			WHERE cus_assigned_to = '".$_SESSION['user']['id']."'
			ORDER BY id DESC
			");
			*/
		}
		$totalrow = $db->num_row();
		$listcustomer = $db->fetch_object();
		$result = array();
		$meta = array();
		$meta["page"] = 1;
		$meta["pages"] = 1;
		$meta["perpage"] = -1;
		$meta["total"] = $totalrow;
		$meta["sort"] = "asc";
		$meta["field"] = "id";
		$result["meta"] = $meta;
		$data = array();
		foreach($listcustomer as $cus)
		{
			$subcus = array();
			$subcus["ID"] = $cus->cid;
			$subcus["Name"] = $cus->cus_firstname." ".$cus->cus_lastname;
            $subcus["Phone"] = $cus->cus_phone;
            $subcus["Address1"] = $cus->cus_address;
            $subcus["Address2"] = "";
            $subcus["LastNote"] = $cus->lastnote;
			$subcus["CusFlag"] = $cus->cus_flag;
            $subcus["AssignTo"] = $cus->user_username;
            $subcus["AssignToUID"] = $cus->uid;
            $subcus["Postcode"] = "6711";
            $subcus["CountNote"] = $cus->countnote;
            $subcus["Type"] = 1;
			$subcus["Level"] = $cus->cus_level;
			$subcus["TypeTitle"] = "";
			$subcus["Status"] = $cus->cus_status;
			$subcus["Source"] = $cus->cus_source;
            $subcus["DateCreated"] = date("d/m/Y",strtotime($cus->cus_addtime));
            $subcus["DateAssigned"] = date("d/m/Y",strtotime($cus->cus_assigned_time));
            $subcus["DateModified"] = date("d/m/Y",strtotime($cus->cus_lastupdate));
            $subcus["Position"] = 4;
            $subcus["ClientState"] = 3;
			array_push($data,$subcus);
		}
		$result["data"] = $data;
		echo json_encode($result);
	}
	public function leads()
	{
		global $db;
		$db->query("SELECT * FROM crm_customers as c
		LEFT JOIN crm_provinces as p ON c.cus_province = p.matp
		WHERE cus_level <= 5 AND (cus_status = 0 OR cus_status = 1)
		ORDER BY RAND()
		LIMIT 200
		");
		$totalrow = $db->num_row();
		$listcustomer = $db->fetch_object();
		$result = array();
		$meta = array();
		$meta["page"] = 1;
		$meta["pages"] = 1;
		$meta["perpage"] = 100;
		$meta["total"] = $totalrow;
		$meta["sort"] = "asc";
		$meta["field"] = "id";
		$result["meta"] = $meta;
		$data = array();
		foreach($listcustomer as $cus)
		{
			$subcus = array();
			$subcus["ID"] = $cus->id;
			$subcus["Code"] = $cus->cus_code;
			$subcus["Name"] = $cus->cus_firstname." ".$cus->cus_lastname;
            $subcus["Phone"] = $cus->cus_phone;
            //$subcus["Address1"] = $cus->cus_address;
            $subcus["City"] = $cus->tentp;
            //$subcus["AssignTo"] = "Sang Thai Dinh";
            //$subcus["Postcode"] = "6711";
            $subcus["Type"] = 1;
            $subcus["Source"] = $cus->cus_source;
			$subcus["TypeTitle"] = "";
			$subcus["Level"] = $cus->cus_level;
			$subcus["Status"] = $cus->cus_status;
            $subcus["DateCreated"] = date("d/m/Y",strtotime($cus->cus_addtime));
            $subcus["DateModified"] = date("d/m/Y",strtotime($cus->cus_lastupdate));
            $subcus["Position"] = 4;
            $subcus["ClientState"] = 3;
			array_push($data,$subcus);
		}
		$result["data"] = $data;
		echo json_encode($result);
	}
	public function getlead()
	{
		global $db;
		$result = array();
		if(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == "17" || $_SESSION['user']['id'] == "1"))
		{
			$db->query("SELECT * FROM crm_users WHERE id = '".$_SESSION['user']['id']."'");
			$user = $db->fetch_object(true);
			$user_point = $user->user_point;
			if($user_point <= 0)
			{
				$result["status"] = "300";
				$result["message"] = "Bạn không còn điểm để nhận lead này!";
			}
			else
			{
				$cid = $_POST['cid'];
				$uid = $_SESSION['user']['id'];
				$db->query("UPDATE crm_users SET user_point = user_point - 1 WHERE id = '".$_SESSION['user']['id']."'");
				$sql = "UPDATE crm_customers SET cus_status = '2', 	cus_assigned_to = '".$_SESSION['user']['id']."', cus_assigned_by = '1', cus_assigned_time = '".date("Y-m-d H:i:s")."' WHERE id = '".$cid."'";
				$db->query($sql);
				$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$uid."','ASSIGNTOUSER')");
				$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','GETLEADS')");
				$result["status"] = '200';
				$result["message"] = "Lead đã được chuyển sang khách hàng! Xin cảm ơn!";
				//$result["message"] = $sql;
			}
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function assignlead()
	{
		if(!(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != "1"))
		{
			global $db;
			$db->query("SELECT * FROM crm_customers WHERE cus_code = '".$_POST['code']."'");
			if($db->num_row())
			{
				$cus = $db->fetch_object(true);
				if($cus->cus_status == "2")
				{
					$result["status"] = "404";
					$result["message"] = "Khách hàng không tồn tại";
				}
				elseif($cus->cus_status == "1")
				{
					$sql = "UPDATE crm_customers SET cus_status = '2', 	cus_assigned_to = '".$_POST['uid']."', cus_assigned_by = '1', cus_assigned_time = '".date("Y-m-d H:i:s")."' WHERE id = '".$cus->id."'";
					$db->query($sql);
					$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cus->id."','".$_POST['uid']."','ASSIGNTOUSER')");
					$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$_POST['uid']."','GETLEADS')");
					$result["status"] = '200';
					$result["message"] = "Khách hàng ".$cus->cus_firstname." ".$cus->cus_lastname." đã được điều chuyển!";
				}
			}
			else
			{
				$result["status"] = "404";
				$result["message"] = "Khách hàng không tồn tại";
			}
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function calendar()
	{
		global $db;
		if($_SESSION['user']['id'] == '1' || $_SESSION['user']['id'] == '13' || $_SESSION['user']['id'] == '17')
		{
			$db->query("SELECT * FROM crm_calendar_list as cal
			LEFT JOIN crm_customers as c ON c.id = cal.cid");
		}
		else
		{
			$db->query("SELECT * FROM crm_calendar_list as cal
			LEFT JOIN crm_customers as c ON c.id = cal.cid
			WHERE uid = '".$_SESSION['user']['id']."'");
		}
		
		$datalist = $db->fetch_object();
		$result = array();
		foreach($datalist as $data)
		{
			$calendar = array();
			$calendar["title"] = $data->event_title;
			$calendar["start"] = $data->event_time;
			$calendar["url"] = XC_URL."/crm/customers/detail/".$data->cid;
			$calendar["className"] = "fc-event-light fc-event-solid-primary";
			//$calendar["end"] = date("Y-m-d H:i:s",strtotime($data->event_time." + 5 minutes"));
			array_push($result,$calendar);
		}
		echo json_encode($result);
	}
	public function addevent()
	{
		$result = array();
		global $db;
		$uid = $_SESSION['user']['id'];
		$cid = $_POST['cid'];
		$sql = "SELECT * FROM crm_calendar_list WHERE uid = '".$uid."' AND cid = '".$cid."' AND event_time = '".date("Y-m-d H:i:s",strtotime($_POST['eventdate']))."'"; 
		$db->query($sql);
		
		if($db->num_row())
		{
			$result["status"] = "302";
			$result["message"] = "Lịch hẹn với khách hàng trong thời gian này đã có, bạn có chắc muốn thêm mới?";
		}
		else
		{
			if($_POST['title'] != "")
			{
				$db->query("INSERT INTO crm_calendar_list(uid,cid,event_time,event_title,event_type) VALUES('".$uid."','".$cid."','".date("Y-m-d H:i:s",strtotime($_POST['eventdate']))."','".$_POST['title']."','1')");
				$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."' LIMIT 1");
				$cus = $db->fetch_object(true);
				$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$uid."','".$cid."','Đặt lịch hẹn vào lúc ".date("H:i d/m/Y",strtotime($_POST['eventdate']))."','1','3')");
				if($_SESSION['user']['id'] != $cus->cus_assigned_to)
				{
					$content = $_SESSION['user']['fullname']." vừa thêm cuộc hẹn mới cho khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn!";
					$url = XC_URL."/crm/customers/detail/".$cid;
					crm::getInstance()->CreateNotification($cus->cus_assigned_to,$content,$url);
				}
				
				$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$uid."','HASSCHEDULEEVENT')");
				$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','SETSCHEDULEEVENT')");
				$result["status"] = "200";
				$result["message"] = "Đã thêm lịch hẹn";
			}
			else
			{
				$result["status"] = "503";
				$result["message"] = "Nội dung hẹn không hợp lệ!";
			}
		}
		echo json_encode($result);
	}
	public function transleads()
	{
		$result = array();
		if(isset($_SESSION['user']['id']))
		{
			global $db;
			$cid = $_POST['cid'];
			$transto = $_POST['transto'];
			$transfrom = $_POST['transfrom'];
			$transnote = $_POST['transnote'];
			if($transnote != "")
			{
				$db->query("SELECT * FROM crm_users WHERE id = '".$transto."'");
				$user = $db->fetch_object(true);
				$db->query("SELECT * FROM crm_users WHERE id = '".$transfrom."'");
				$user2 = $db->fetch_object(true);
				$db->query("UPDATE crm_customers SET cus_assigned_to = '".$transto."', cus_status = '2' WHERE id = '".$cid."'");
				$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','1','TRANSLEADS')");
				$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$transfrom."','USERTRANSLEADS')");
				$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$transto."','USERRECEIVELEADS')");
				$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$_SESSION['user']['id']."','".$cid."','Đã chuyển lead cho ".$user->user_firstname." ".$user->user_lastname." với nội dung: ".$transnote."','5','3')");
				$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."' LIMIT 1");
				$cus = $db->fetch_object(true);
				$content = "Khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn đã được điều chuyển đến ".$user->user_firstname." ".$user->user_lastname."!";
				$url = XC_URL."/crm/customers/detail/".$cid;
				$content2 = "Bạn đã nhận Khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của ".$user2->user_firstname." ".$user2->user_lastname."!";
				crm::getInstance()->CreateNotification($transfrom,$content,$url);
				crm::getInstance()->CreateNotification($transto,$content2,$url);
				$result["status"] = '200';
				$result["message"] = "Đã thực hiện yêu cầu!";
			}
			else
			{
				$result['status'] = "400";
				$result["message"] = "Lý do không hợp lệ!";
			}
			
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function transcustomer()
	{
		$result = array();
		if(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == "1" || $_SESSION['user']['id'] == "17"))
		{
			global $db;
			$cid = $_POST['cid'];
			$uid = $_POST['uid'];
			$db->query("UPDATE crm_customers SET cus_assigned_to = '1', cus_status = '2' WHERE id = '".$cid."'");
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','1','BACKTOLEADS')");
			$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','LEADFAIL')");
			$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$_SESSION['user']['id']."','".$cid."','Đã chuyển leads về kho','6','3')");
			$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."' LIMIT 1");
			$cus = $db->fetch_object(true);
			$content = "Khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn đã được thu hồi!";
			$url = XC_URL."/crm/leads";
			crm::getInstance()->CreateNotification($uid,$content,$url);
			$result["status"] = '200';
			$result["message"] = "Đã thu hồi lead";
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function addpoint()
	{
		$result = array();
		if(isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] != "1" || $_SESSION['user']['id'] != "17"))
		{
			global $db;
			$uid = $_POST['uid'];
			$point = $_POST['point'];
			$db->query("UPDATE crm_users SET user_point = user_point + ".$point." WHERE id = '".$uid."'");
			$db->query("SELECT * FROM crm_users WHERE id = '".$uid."' LIMIT 1");
			$cus = $db->fetch_object(true);
			$content = $_SESSION['user']['fullname']." đã cộng: ".$point." điểm vào tài khoản của bạn!";
			$url = XC_URL;
			crm::getInstance()->CreateNotification($uid,$content,$url);
			$result["status"] = '200';
			$result["message"] = "Đã thực hiện yêu cầu!";
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function suggestion()
	{
		$keyword = $_POST['text'];
		if(strlen($keyword) > 10)
		{
			global $db;
			$db->query("SELECT * FROM crm_suggestions WHERE sugg_keyword LIKE '%".$keyword."%'");
			if($db->num_row())
			{
				$listsugg = $db->fetch_object();
				$result = array();
				$result["status"] = "200";
				$data = '<ul>
					<li><a href="#" id="">Gợi ý 1</a></li>
				</ul>
				';
				$result["data"] = $data;
			}
		}
		
		echo json_encode($result);
	}
	public function uplevelcustomer()
	{
		$result = array();
		if(isset($_SESSION['user']['id']) && $_SESSION['user']['group'] == "1" )
		{
			global $db;
			$cid = $_POST['cid'];
			$uid = $_POST['uid'];
			$db->query("UPDATE crm_customers SET cus_level = cus_level + 1 WHERE id = '".$cid."'");
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$_SESSION['user']['id']."','UPCUSTOMERLEVEL')");
			$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$_SESSION['user']['id']."','".$cid."','".$_SESSION['user']['fullname']." đã nâng level của khách hàng','1','3')");
			$db->query("INSERT INTO crm_user_logs(uid,log_key) VALUES('".$uid."','SUCCESSLEVELLEAD')");
			$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."' LIMIT 1");
			$cus = $db->fetch_object(true);
			$content = $_SESSION['user']['fullname']." đã nâng level khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn!";
			$url = XC_URL."/crm/customers/detail/".$cid;
			crm::getInstance()->CreateNotification($uid,$content,$url);
			$result["status"] = '200';
			$result["message"] = "Đã thực hiện yêu cầu!";
		}
		else
		{
			$result['status'] = "403";
			$result["message"] = "Bạn không có quyền truy cập vào tính năng này, hãy liên hệ với quản trị viên!";
		}
		echo json_encode($result);
	}
	public function createcustomer()
	{
		global $db;
		$result = array();
		$db->query("SELECT * FROM crm_customers WHERE cus_phone = '".$_POST['phone']."' AND cus_owner = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$result["status"] = "302";
			$result["message"] = "Số điện thoại/Email đã tồn tại trong hệ thống";
		}
		else
		{
			$customercode = general::getInstance()->generateid("customer");
			$db->query("INSERT INTO crm_customers(cus_code,cus_firstname,cus_lastname,cus_phone,cus_email,cus_owner,cus_assigned_to,cus_assigned_time,cus_status) VALUES('".$customercode."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['phone']."','".$_POST['email']."','".$_SESSION['user']['id']."','".$_SESSION['user']['id']."','".date("Y-m-d H:i:s")."','2')");
			$db->query("SELECT id FROM crm_customers WHERE cus_code = '".$customercode."' ORDER BY id DESC LIMIT 1");
			$cid = $db->fetch_object(true)->id;
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$_SESSION['user']['id']."','CREATE_CUSTOMER')");
			$result['status'] = "200";
			$result["message"] = "Đã tạo khách hàng ".$_POST["firstname"]." ".$_POST["lastname"];
		}
		echo json_encode($result);
	}
	public function createcustomerbytext()
	{
		$text = '
41498386|VŨ THỊ |HOA|||ẤP 2 - ĐỊNH THÀNH - BẾN CÁT - SÔNG BÉ|1|1|8|1
41017579|VŨ THỊ HOA |DUNG|||88/41 PHAN SÀO NAM, P.11, Q.TÂN BÌNH, TP.HCM|1|1|2|1
41290003|VŨ THỊ HOÀI |NHUNG|||12 LÔ C, NỘI THƯƠNG ĐÔNG BẮC, MÁY CHAI, HẢI PHÒNG|1|1|4|1
41325707|VŨ THỊ HOÀI |TRANG|||E78 XUÂN HỒNG, P.12, Q.TB, TP.HCM|1|1|6|1
41069186|VŨ THỊ |KHIÊM|||16 TRẦN HƯNG ĐẠO, HOÀN KIẾM, HÀ NỘI|1|1|8|1
41104512|VŨ THỊ KIM |HOA|||TRUNG HƯNG - MỸ THỜI - LONG XUYÊN - AN GIANG|1|1|2|1
41119622|VŨ THỊ KIM |LIÊN|||32 PHAN CHU TRINH, P.2, Q.BÌNH THẠNH|1|1|4|1
41359313|VŨ THỊ KIM |OANH|||KHU 2 THỊ TRẤN TIỀN HẢI-THÁI BÌNH|1|1|7|1
41281211|VŨ THỊ KIM |THƯ|||SỐ 11/325 TÔ HIỆU, LÊ CHÂN, HẢI PHÒNG|1|1|8|1
41290928|VŨ THỊ |MAI|||SỐ 04 NGUYỄN BIỂU, P.1, Q.5, TP.HCM|1|1|8|1
41507201|VŨ THỊ |MAI|||22/1/508 LÊ THÁNH TÔNG, HẢI PHÒNG|1|1|2|1
41234169|VŨ THỊ MINH |LÝ|||25B TÚ XƯƠNG , P.7, Q.3 , TP.HCM|1|1|7|1
41463449|VŨ THỊ NGỌC |LAN|||SỐ 67 TT XÂY DỰNG, CẦU TRE, NGÔ QUYỀN, HẢI PHÒNG|1|1|1|1
41160298|VŨ THỊ |NGUYỆT|||LÔ 58 KHU DÂN CƯ HỒ NAM, LÊ CHÂN, HẢI PHÒNG|1|1|2|1
41442239|VŨ THỊ NHƯ |BÌNH|||HẢI ĐÌNH-ĐỒNG HỚI-QUẢNG BÌNH|1|1|4|1
41227636|VŨ THỊ PHƯƠNG |HIỀN|||VŨ KIM TRUNG KIÊN, PHÒNG TÀI CHÍNH KẾ TOÁN, CẢNG HẢI|1|1|1|1
41311670|VŨ THỊ |THÁI|||71/56/3 ĐIỆN BIÊN PHỦ - P.15 - BÌNH THẠNH - TP.HCM|1|1|8|1
41358767|VŨ THỊ THÁI |HÀ|||108/44H TRẦN QUANG DIỆU, P.14, Q.3, TP.HCM|1|1|8|1
41331075|VŨ THỊ |THANH|||SỐ 150 ĐÌNH ĐÔNG - HẢI PHÒNG.|1|1|7|1
41365505|VŨ THỊ THANH |HÀ|||844 TRẦN HƯNG ĐẠO - P.7 - Q.5 - TP.HCM|1|1|7|1
41383128|VŨ THỊ THANH |HOA|||25A1-7 MỸ VIÊN, PHÚ MỸ HƯNG, Q.7|1|1|3|1
41155242|VŨ THỊ THANH |HƯƠNG|||99 LÔ 3 NGÕ 1 CẤM - NGÔ QUYỀN - HẢI PHÒNG|1|1|1|1
41464945|VŨ THỊ THANH |HƯỜNG|||SỐ 2 - ĐOÀN THỊ ĐIỂM - HÀ NỘI|1|1|6|1
41360465|VŨ THỊ THANH |LOAN|||263 BÀU CÁT, P12, Q.TÂN BÌNH, TP.HCM.|1|1|8|1
41129361|VŨ THỊ |THE|||42-44 MÃ LỘ-P.TÂN ĐỊNH-Q1|1|1|1|1
41485531|VŨ THỊ THU |HÀ|||P1 - NHÀ 17 - PHƯỜNG BÁCH KHOA - HÀ NỘI|1|1|3|1
41057179|VŨ THỊ THU |HẰNG|||175 BẾN VÂN ĐỒN, P.6, Q.4, TP.HCM|1|1|6|1
41329717|VŨ THỊ THU |HOÀI|||SỐ 41/170 HAI BÀ TRƯNG, LÊ CHÂN, HẢI PHÒNG|1|1|4|1
41483391|VŨ THỊ THU |HƯƠNG|||41 NH KHU PHỐ 5, P.TÂN THUẬN TÂY, Q.7, TP.HCM|1|1|8|1
41229562|VŨ THỊ THU |HƯƠNG|||SỐ 78/89 AN ĐÀ, ĐẰNG GIANG, NGÔ QUYỀN, HẢI PHÒNG|1|1|7|1
41221058|VŨ THỊ THU |TRANG|||9D4 CHU VĂN AN,P.26, Q.BÌNH THẠNH, TP.HCM|1|1|2|1
41416838|VŨ THỊ |THUÝ|||SỐ 258 ĐƯỜNG ĐÀ NẴNG - CẦU TRE - NGÔ QUYỀN - HẢI PHO|1|1|3|1
41508247|VŨ THỊ THÚY |HÀO|||11B1+2, NGUYỄN DU, P. BẾN NGHÉ, Q.1, TP.HCM|1|1|8|1
41446458|VŨ THỊ |TÔN|||SỐ 368 PHAN ĐĂNG LƯU - KIẾN AN - HẢI PHÒNG|1|1|4|1
41100472|VŨ THỊ |TRANG|||109/15/35 TÂN CHÁNH HIỆP 13, KP.4, TÂN  CHÁNH HIỆP, Q.|1|1|5|1
41236268|VŨ THỊ |TUYẾT|||LÔ 56 B69 KHU D1 CÁT BI, HẢI PHÒNG|1|1|1|1
41263662|VŨ THIỆN |PHONG|||4A TĂNG BẠT HỔ, P.11, Q.BÌNH THẠNH, TP.HCM|1|1|3|1
41280831|VŨ THÔNG |ĐỨC|||109D/40/25, BẾN VÂN ĐỒN, P.8, Q.4, TP.HCM|1|1|7|1
41163911|VŨ THU |THẢO|||71/56/3 ĐIỆN BIÊN PHỦ - P.15 - BÌNH THẠNH - TP.HCM|1|1|8|1
41192494|VŨ THU |TRANG|||149/5 BIS, LÊ THỊ RIÊNG, Q.1, TP.HCM|1|1|6|1
41168373|VŨ THỤY HOÀNG |VY|||F14 ĐƯỜNG 18, P. HIỆP BÌNH CHÁNH, Q. THỦ ĐỨC, TP. HCM|1|1|7|1
41157604|VŨ THÙY NGUYÊN |HƯƠNG|||194 E PASTEUR, P.6, Q.3, TP.HCM|1|1|8|1
41134022|VŨ THỤY |VY|||56/12 THÍCH QUÃNG ĐỨC - F.5 - Q. PHÚ NHUẬN - TP.HCM|1|1|2|1
41245786|VŨ THỦY |YÊN|||66/2 NGUYỄN VĂN TRỖI - P.8 - Q.PN|1|1|4|1
41273330|VŨ TIẾN |QUỲNH|||209 LÔ A, CC TÂY THẠNH, P.TÂY THẠNH, Q.TÂN PHÚ, TP.HC|1|1|2|1
41372334|VŨ TRỌNG |CHINH|||PHÒNG 2 FLOOR 3, 90A NGUYỄN THỊ MINH KHAI, Q.3|1|1|2|1
41310178|VŨ TRỌNG |CƯỜNG|||SỐ 2 HOÀNG DIỆU, MINH KHAI, HẢI PHÒNG|1|1|2|1
41324969|VŨ TUẤN |ANH|||SỐ 7C NGÕ 155/37/19 CẦU GIẤY - HÀ NỘI|1|1|4|1
41295845|VŨ TUẤN |ANH|||SỐ 8/36 LƯƠNG KHÁNH THIỆN, HẢI PHÒNG|1|1|4|1
41123332|VŨ TUẤN |HIẾU|||SỐ 1 - LÊ PHỤNG HIỂU - HÀ NỘI|1|1|4|1
41234917|VŨ VĂN |ANH|||DƯ HÀNG KÊNH, AN HẢI, HẢI PHÒNG|1|1|8|1
41269868|VŨ VĂN |ĐẠT|||26/2 AN DƯƠNG VƯƠNG - PHÚ THƯỢNG - TÂY HỒ HÀ NỘI|1|1|7|1
41193138|VŨ VĂN |DUẨN|||TIÊN MINH, TIÊN LÃNG. HẢI PHÒNG|1|1|2|1
41462045|VŨ VĂN |HƯỜNG|||16/72 A NGUYỄN THIỆN THUẬT - P 2 - Q 3  - HCM|1|1|7|1
41468046|VŨ VĂN |KHÁNH|||69 ĐẶNG KIM NỞ, CÁT DÀI, HẢI PHÒNG|1|1|1|1
41299158|VŨ VĂN |NGỌC|||67 ĐƯỜNG SỐ 5, CƯ XÁ BÌNH THỚI, P.8, Q.11, TP.HCM|1|1|5|1
41396114|VŨ VĂN |PHỐ|||PHÚ TÂN, AN PHÚ, BÌNH LONG, BÌNH PHƯỚC|1|1|3|1
41289938|Vũ Văn |Phong|||06 Trường Sơn Phường Hoà Thọ Tây Quận Cẩm Lệ Thành phố Đà Nẵn|1|1|4|1
41047310|VŨ VĂN |SƠN|||TT LIÊN ĐOÀN ĐCTV - ĐCCT BIỂN BẮC - TỪ LIÊM - HÀ NỘI|1|1|1|1
41203558|Vũ Văn |Thắng|||95 Hoàng BícSơn, Phường n Hải Bắc, Quận Sơn Trà, Thànphố Đà Nẵng|1|1|7|1
41072809|Vũ Văn |Thới|||507 Núi Thành, Phường Hò Cường Nm, Quận Hải Châu, Thànphố Đà Nẵng|1|1|4|1
41359385|VŨ VĂN |TIẾN|||SỐ 23 NGÕ 304 LÊ DUẨN - HÀ NỘI|1|1|3|1
41299940|VŨ VIỆT |TIẾN|||147 TRẦN HỮU TRANG P.10 - Q.PHÚ NHUẬN - HCM|1|1|8|1
41322866|VŨ XUÂN |CHÂU|||SỐ 245 LỰC HÀNH - ĐẰNG LÂM - HẢI AN  - HẢI PHÒNG|1|1|8|1
41432010|VŨ XUÂN |MINH|||SỐ 63/681 NGÔ GIA TỰ - HẢI AN - HẢI PHÒNG|1|1|2|1
41137912|VŨ XUÂN THÙY |DƯƠNG|||KP3 - TAM HÒA - BIÊN HÒA - ĐỒNG NAI|1|1|4|1
41461641|VƯƠNG  THỊ KIM |CÚC|||839 TÂN KỲ TÂN QUÝ, BÌNH HƯNG HÒA A, Q.BÌNH TÂN, TP.HO|1|1|3|1
41457773|VƯƠNG ANH |TUẤN|||SỐ 2/86 CHỢ CON, TRẠI CAU, LÊ CHÂN, HẢI PHÒNG|1|1|5|1
41193059|VƯƠNG HẠNH |PHÚC|||258 HÒA HƯNG  - P.13 - Q.10|1|1|5|1
41488931|VƯƠNG HUỆ |NGHI|||183/151 TÂN HÒA ĐÔNG, P.14, Q.6, TP.HCM|1|1|5|1
41129552|VƯƠNG MINH |HOÀNG|||260/10 BÌNH THỚI - P.10 - Q.11|1|1|5|1
41292068|VƯƠNG QUỐC |SÂM|||198 ĐỀ THÁM, P.CẦU ÔNG LÃNH, Q.1, TP HCM|1|1|5|1
41206283|VƯƠNG THỊ HỒNG |VÂN|||242/25 AN DƯƠNG VƯƠNG - P.16 - Q.8|1|1|5|1
41458074|VƯƠNG THỊ MỸ |HÀ|||327/22 NGUYỄN ĐÌNH CHIỂU, P.5, Q.3, TP.HCM|1|1|6|1
41428200|VƯƠNG THỊ NGỌC |BÍCH|||20/20 KHÓM CHÂU LONG 1- PHƯỜNG VĨNH MỸ- TX CHÂU ĐỐC|1|1|5|1
41189292|VƯƠNG THỊ PHƯƠNG |QUYÊN|||281/50/11 LÊ VĂN SỸ, P.1, Q.TÂN BÌNH, TP.HCM|1|1|5|1
41131158|VƯƠNG XUÂN |TIẾN|||SỐ 7 NGÕ 2 MÊ LINH, LÊ CHÂN, HẢI PHÒNG|1|1|7|1
41368841|VƯU TUẤN |NGHĨA|||208/6/20 BÀ HOM, P.13, Q.6, TP.HCM|1|1|4|1
';
	$list = explode("\n",$text);
	//var_dump($list);
	foreach($list as $lead)
	{
		
		$lead = explode("|",$lead);
		var_dump($lead);
		global $db;
		$result = array();
		$db->query("SELECT * FROM crm_customers WHERE cus_phone = '".$lead[4]."' AND cus_owner = '1'");
		if($db->num_row())
		{
			echo "Số điện thoại/Email đã tồn tại trong hệ thống";
		}
		else
		{
			$level = rand(1,2);
			$source = rand(2,4);
			$customercode = general::getInstance()->generateid("customer");
			$db->query("INSERT INTO crm_customers(cus_code,cus_firstname,cus_lastname,cus_phone,cus_owner,cus_status,cus_description,cus_level,cus_source) VALUES('".$customercode."','".$lead[1]."','".$lead[2]."','".$lead[4]."','1','1','".$lead[5]."','".$level."','".$source."')");
			$db->query("SELECT id FROM crm_customers WHERE cus_code = '".$customercode."' ORDER BY id DESC LIMIT 1");
			$cid = $db->fetch_object(true)->id;
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','1','CREATE_CUSTOMER')");
			$result['status'] = "200";
			echo "Đã tạo khách hàng ".$lead[1]." ".$lead[2];
		
			echo "ok nè";
		}
		echo "<br>";
	}
	/*
		global $db;
		$result = array();
		$db->query("SELECT * FROM crm_customers WHERE cus_phone = '".$_POST['phone']."' AND cus_owner = '".$_SESSION['user']['id']."'");
		if($db->num_row())
		{
			$result["status"] = "302";
			$result["message"] = "Số điện thoại/Email đã tồn tại trong hệ thống";
		}
		else
		{
			$customercode = general::getInstance()->generateid("customer");
			$db->query("INSERT INTO crm_customers(cus_code,cus_firstname,cus_lastname,cus_phone,cus_email,cus_owner,cus_status) VALUES('".$customercode."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['phone']."','".$_POST['email']."','".$_SESSION['user']['id']."','1')");
			$db->query("SELECT id FROM crm_customers WHERE cus_code = '".$customercode."' ORDER BY id DESC LIMIT 1");
			$cid = $db->fetch_object(true)->id;
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$_SESSION['user']['id']."','CREATE_CUSTOMER')");
			$result['status'] = "200";
			$result["message"] = "Đã tạo khách hàng ".$_POST["firstname"]." ".$_POST["lastname"];
		}
		echo json_encode($result);
		*/
	}
	public function updatefail()
	{
		global $db;
		$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$_POST['cid']."','".$_SESSION['user']['id']."','FAIL_CUSTOMER')");
		$result = array();
		$result["status"] = "200";
		echo json_encode($result);
	}
	public function setcusflag()
	{
		global $db;
		$db->query("UPDATE crm_customers SET cus_flag = '1' WHERE id = '".$_POST['cid']."'");
		$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$_POST['cid']."','".$_SESSION['user']['id']."','UPDATE_CUSTOMER_FLAG')");
		$result = array();
		$result["status"] = "200";
		echo json_encode($result);
	}
	public function apicreatecustomer()
	{
		global $db;
		for($i = 0;$i < 800;$i++)
		{
			$customercode = general::getInstance()->generateid("customer");
			$db->query("INSERT INTO crm_customers(cus_code,cus_firstname,cus_lastname,cus_phone,cus_email,cus_owner,cus_status) VALUES('".$customercode."','Private Data','Private Data','Private Data','Private Data','1','1')");
			$db->query("SELECT id FROM crm_customers WHERE cus_code = '".$customercode."' ORDER BY id DESC LIMIT 1");
			$cid = $db->fetch_object(true)->id;
			$db->query("INSERT INTO crm_customer_logs(cid,uid,log_key) VALUES('".$cid."','".$_SESSION['user']['id']."','CREATE_CUSTOMER')");
			$result['status'] = "200";
			echo  "Đã tạo khách hàng Private Data";
		}
	}
	public function addnote()
	{
		global $db;
		$cid = $_POST['cid'];
		$result = array();
		if($_POST['content'] != "")
		{
			$db->query("INSERT INTO crm_customer_notes(uid,cid,note_description,note_method,note_result) VALUES('".$_SESSION['user']['id']."','".$cid."','".$_POST['content']."','".$_POST['method']."','".$_POST['result']."')");
			$db->query("SELECT * FROM crm_customers WHERE id = '".$cid."'");
			$cus = $db->fetch_object(true);
			if($_SESSION['user']['id'] != $cus->cus_assigned_to)
			{
				$content = $_SESSION['user']['fullname']." vừa thêm ghi chú mới cho khách hàng: ".$cus->cus_firstname." ".$cus->cus_lastname." của bạn!";
				$url = XC_URL."/crm/customers/detail/".$cid;
				crm::getInstance()->CreateNotification($cus->cus_assigned_to,$content,$url);
			}
			//$db->query("UPDATE crm_customers SET cus_status = '2' WHERE id = '".$cid."'");
			$result["status"] = "200";
		}
		else
		{
			$result["status"] = "302";
			$result["message"] = "Không thực hiện được yêu cầu do nội dung không hợp lệ!";
		}
		
		echo json_encode($result);
	}
}