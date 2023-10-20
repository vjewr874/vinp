<?php
Class dataController extends baseController
{
	public function index()
	{
	}
	public function getHeader($header) {
		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				if (str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($name, 5)))) == $header)
					return $value;
			}
		}
		
		return false;
	}
	private function count_decimals($x){
	   return  strlen(substr(strrchr($x+"", "."), 1));
	}
	
	private function random($min, $max){
	   $decimals = max($this->count_decimals($min), $this->count_decimals($max));
	   $factor = pow(10, $decimals);
	   return rand($min*$factor, $max*$factor) / $factor;
	}
	private function randdata($symbol)
	{
		global $db;
		$db->query("SELECT * FROM game_datas WHERE game_id = '".$symbol->symbol_id."' ORDER BY id DESC LIMIT 1");
		if($db->num_row())
		{
			$data = $db->fetch_object(true);
			$oldcode = substr($data->draw_id,-4);
			$drawid = "";
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
			echo $drawid."<br>";
			$n = array();
			$game = array();
			$prices = array();
			$nowtime = date("Y-m-d H:i:s");
			$time = strtotime(date("Y-m-d H:i:00",strtotime($data->game_time."+ 10 seconds")));
			$nprice = $data->game_data;
			echo $symbol->symbol_base." - ".$symbol->symbol_max." - ".$symbol->symbol_min." - ".$symbol->symbol_change."<hr>";
			$nprice = $symbol->symbol_base;
			for($i = 0; $i < 60;$i++)
			{
				if($symbol->symbol_base > 0)
				{
					
					$rnum = rand(1,30);
					echo $changer = $this->random($symbol->symbol_change/100,$symbol->symbol_change_max/100);
					echo "<br>";
					//echo $nprice = $nprice + $symbol->symbol_base*$changer;
					
					if($nprice > $symbol->symbol_max)
					{
						$nprice = $nprice - $symbol->symbol_base*$changer;
					}
					elseif($nprice < $symbol->symbol_min)
					{
						$nprice = $nprice + $symbol->symbol_base*$changer;
					}
					elseif($rnum == 1 || $rnum == 5 || $rnum == 10 || $rnum == 15 || $rnum == 20)
					{
						$nprice = $nprice;
					}
					elseif($rnum % 2 == 0)
					{
						$nprice = $nprice + $symbol->symbol_base*$changer;
					}
					else
					{
						$nprice = $nprice - $symbol->symbol_base*$changer;
					}
					
				}
				else
				{
					$rrand = $this->random(20.0916261,50.6760838);
					$rnum = rand(1,20);
					if($nprice > 150025)
					{
						$nprice = $nprice - ($nprice - 150025) - $rrand;
					}
					elseif($rnum == 1 || $rnum == 5 ||$rnum == 10)
					{
						$nprice = $nprice;
					}
					elseif($rnum %2 == 0)
					{
						$nprice = $nprice + $rrand;
					}
					else
					{
						$nprice = $nprice - $rrand;
					}
				}
				//$rrand = rand(3,11);
				echo "<br>".date("Y-m-d H:i:s",$time);
				//echo $nprice;
				$db->query("INSERT INTO game_datas(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."','".$symbol->symbol_id."','".$nprice."')");
				if($i == 59)
				{
					$db->query("INSERT INTO bet_games(game_id,draw_id,draw_time,draw_result) VALUES('".$symbol->symbol_id."','".$drawid."','".date("Y-m-d H:i:s",$time)."','".$nprice."')");
				}
				$time = $time+1;
				echo "<br>";
				//$nowtime = date("Y-m-d H:i:s",strtotime($nowtime."+1 second"));
			}
			/*
			for($i = 0; $i < 60;$i++)
			{
				$time = $time+1;
				$r = rand(0,1);
				$nprice = ($r == 0)? $nprice + $this->random(13.091626,92.676046) : $nprice - $this->random(13.091626,92.676046);
				
				echo $sql = "INSERT INTO game_datas2(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."','".$symbol."','".$nprice."')";
				echo "<br>";
				$db->query($sql);
				
			}
			*/
		}
		else
		{
			$now =  strtotime(date("Y-m-d H:i"));
			$start = strtotime(date("Y-m-d 00:00"));
			$diff = $now - $start;
			$code = $diff/60;
			$newid = str_pad($code+1, 4, '0', STR_PAD_LEFT);
			$drawid = date("Ymd").$newid;
			$nprice = $this->random(50525.234567,120025.999999);
			$time = strtotime(date("Y-m-d H:i:00"));
			for($i = 0; $i < 60;$i++)
			{
				$time = $time+1;
				$r = rand(0,1);
				$nprice = ($r == 0)? $nprice + $this->random(13.091626,92.676046) : $nprice - $this->random(13.091626,92.676046);
				
				echo $sql = "INSERT INTO game_datas(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."','".$symbol."','".$nprice."')";
				echo "<br>";
				$db->query($sql);
				
			}
		}
		
	}
	public function price()
	{
		global $db;
		$db->query("SELECT * FROM system_symbols");
		$symbols = $db->fetch_object();
		foreach($symbols as $sym)
		{
			echo $sym->symbol_id." - ".$sym->symbol_code;
			echo "<br>";
			$this->randdata($sym);
			echo "<hr>";
		}
	}
	public function testdata()
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
			echo $nprice = $price + (rand(-2230009,3994442))/100000;
			$db->query("INSERT INTO game_datas(game_time,draw_id,game_id,game_data) VALUES('".date("Y-m-d H:i:s",$time)."','".$drawid."',700,'".$nprice."')");
			//$nowtime = date("Y-m-d H:i:s",strtotime($nowtime."+1 second"));
			echo "<br>";
		}
	}
	public function products()
	{
		$this->view->show("products");
	}
	public function update($para)
	{
		global $db;
		$db->query("UPDATE hicrm_configs SET config_value = '".$para[1]."' WHERE config_key = 'auth'");
		echo $para[1];
	}
	
	public function test()
	{
		/*
		$token = '6u5N6mx4ZOOklN4VsYmBPTeXrhNIluX3pG8xZ7ueLduUjyI31f';

		$thueapiToken = $this->getHeader('X-THUEAPI');

		if ($token !== $thueapiToken) {
			echo 'Token mismatch !';
			return;
		}
		echo $token;
		*/
		echo $date = date("Y-m-d H:i:s");
		echo "<br>";
		echo $last = date("Y-m-d H:i:s",strtotime($date." - 2 minutes"));
		echo "<br>";
		echo strtotime($last);
		echo "<br>";
		echo strtotime($last) - strtotime($date);
		
	}
}