<?php
Class cronController extends baseController
{
	public function index()
	{
		
	}
	public function test()
	{
		echo $time = strtotime(date("Y-m-d H:i:00"));
		for($i = 0;$i < 60;$i++)
		{
			echo "<br>";
			$time = $time+1;
			echo date("Y-m-d H:i:s",$time);
		}
	}
	public function deleteold()
	{
		global $db;
		$db->query("DELETE FROM game_datas WHERE game_time < '".date("Y-m-d H:i:s",strtotime("-30 minutes"))."'");
	}
	public function creategamedata()
	{
		global $db;
		$game = array();
		$db->query("SELECT * FROM game_datas ORDER BY id DESC LIMIT 1");
		if($db->num_row())
		{
			$data = $db->fetch_object(true);
			$oldcode = substr($data->draw_id,-4);
			if($oldcode < 1440)
			{
				$newid = str_pad($oldcode+1, 4, '0', STR_PAD_LEFT);
			
				$drawid = date("Ymd").$newid;
			}
			else
			{
				//20200204
				$drawid = date("Ymd",strtotime(substr($data->draw_id,0,8)." + 1 days"))."0001";
			}
			$n = array();
			$game = array();
			$prices = array();
			$nowtime = date("Y-m-d H:i:s");
			$time = strtotime(date("Y-m-d H:i:00",strtotime($data->game_time."+ 10 seconds")));
			$nprice = $data->game_data;
			for($i = 0; $i < 60;$i++)
			{
				$rrand = (rand(22300099,39944422))/1000000;
				$rnum = rand(1,20);
				$nprice = ($rnum %2 == 0) ? $nprice + $rrand : $nprice - $rrand;
				$db->query("INSERT INTO game_datas(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."',700,'".$nprice."')");
				if($i == 59)
				{
					$db->query("INSERT INTO bet_games(game_id,draw_id,draw_time,draw_result) VALUES('700','".$drawid."','".date("Y-m-d H:i:s",$time)."','".$nprice."')");
				}
				$time = $time+1;
				//$nowtime = date("Y-m-d H:i:s",strtotime($nowtime."+1 second"));
			}
		}
		else
		{
			$now =  strtotime(date("Y-m-d H:i"));
			$start = strtotime(date("Y-m-d 00:00"));
			$diff = $now - $start;
			$code = $diff/60;
			$newid = str_pad($code+1, 4, '0', STR_PAD_LEFT);
			$drawid = date("Ymd").$newid;
			$n = array();
			$game = array();
			$prices = array();
			$nowtime = strtotime(date("Y-m-d H:i:00"));
			$time = strtotime(date("Y-m-d H:i:00"));
			$price = 38025.617298;
			for($i = 0; $i < 60;$i++)
			{
				$time = $time+1;
				$nprice = $price + (rand(-2230009,3994442))/100000;
				$db->query("INSERT INTO game_datas(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."',700,'".$nprice."')");
				//$nowtime = date("Y-m-d H:i:s",strtotime($nowtime."+1 second"));
			}
			
			
		}
	}
	public function checkcanlendar()
	{
		global $db;
		$db->query("SELECT * 
		FROM crm_calendar_list as cl
		LEFT JOIN crm_users as u ON cl.uid = u.id
		LEFT JOIN crm_customers as c ON cl.cid = c.id
		WHERE event_time >= '".date("Y-m-d H:i:s")."' AND event_time < '".date("Y-m-d H:i:s",strtotime("now + 5 minutes"))."'");
		$list = $db->fetch_object();
		foreach($list as $cal)
		{
			echo $content = "Xin chào ".$cal->user_lastname.", bạn có lịch hẹn với khách hàng ".$cal->cus_firstname." ".$cal->cus_lastname." vào lúc: ".date("H:i d/m/Y",strtotime($cal->event_time)).". Xin lưu ý cuộc hẹn này. Xin cảm ơn!";
			$url = "https://manage.anlocgroup.vn/crm/customers/detail/".$cal->cid;
			//echo $cal->event_time." ".$cal->cus_lastname." ".$cal->user_zalo_id;
			echo crm::getInstance()->SendZaloMessage($cal->user_zalo_id,$content,$url);
		}
		

	}
	public function addpoint()
	{
		//global $db;
		//$db->query("UPDATE ");
	}
}