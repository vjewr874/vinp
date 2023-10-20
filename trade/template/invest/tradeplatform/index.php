<?php include "config.php";
$gameID = $_GET['symbol'];
$symbolname = "";
?>

<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Binary Option</title>
	<link href="/lobby/img/favicon_stock_k.ico" rel="icon" type="image/x-icon">
	<link href="<?php echo $template_path; ?>/trading/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $template_path; ?>/trading/css/bootstrap-datepicker.min.css" rel="stylesheet">


	<script src="<?php echo $template_path; ?>/trading/js/version.js"></script>
	<link rel="stylesheet" href="<?php echo $template_path; ?>/trading/css/font.css">

	<link rel="stylesheet" href="<?php echo $template_path; ?>/tradeplatform/css/style.css">
	<link rel="stylesheet" href="<?php echo $template_path; ?>/trading/css/pocket.css">
	<script src="<?php echo $template_path; ?>/trading/js/moment.min.js"></script>
	<script src="<?php echo $template_path; ?>/trading/js/chart.js"></script>
	
	<script src="<?php echo $template_path; ?>/trading/js/hammer.js"></script>
	<script src="<?php echo $template_path; ?>/trading/js/chartjs-plugin-annotation.min.js"></script>
	<script src="<?php echo $template_path; ?>/trading/js/chartjs-plugin-streaming.js"></script>
	<script src="<?php echo $template_path; ?>/trading/js/chartjs-plugin-zoom.js"></script>
	<script src="<?php echo $template_path; ?>/assets/js/jquery-3.3.1.min.js"></script>
	
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
		$(document).ready(function() {
			/*
			Swal.fire(
			  'Lỗi',
			  'Chân thành xin lỗi, dữ liệu đang được cập nhật, xin vui lòng quay lại sau ít phút! Xin cảm ơn!',
			  'error'
			)
			*/
			$("#bettingrecorddata").on("click",function()
			{
				var room = $("#history_roomList").val();
				var start = $("#search_start").val();
				var end = $("#search_end").val();
				var draw_id = $("#draw_id").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL; ?>/api/searchlistbet",
					data: {room: room, draw_id: draw_id, start: start, end: end},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						$("#bet_history_table").html(data.data);
					}
				});
				return false;
			});
			
			
			
		})
		</script>
</head>

<body>
	<input type="hidden" id="_ckey" value="<?php echo $_GET['_ckey'];?>">
	<nav class="nav justify-content-between">
		<div class="logo"><img src="<?php echo $template_path; ?>/trading/images/loading.gif"><a><b> Thời gian:</b> <span id="now_datetime"></span></a></div>
		<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
	  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
		class="icon-bars"></span></button> -->
		<div id="navbarSupportedContent">
			<ul class="nav-btnGroup">

				<li>
					<button onclick="lightBox('#lightBoxRule')">Quy tắc</button>
				</li>
				<li>
					<button id="openbettingrecord" onclick="lightBox('#lightBoxTime')">Ghi lại</button>
				</li>
				<button onclick="myrefresh()" class="refresh-btn">
					<div><span class="icon-undo"></span></div>
				</button>
			</ul>
		</div>
	</nav>

	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		<div class="tradingview-widget-container__widget"></div>
		<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
			async>
			{
				"symbols": [{
						"proName": "FOREXCOM:SPXUSD",
						"title": "S&P 500"
					},
					{
						"proName": "FOREXCOM:NSXUSD",
						"title": "Nasdaq 100"
					},
					{
						"description": "BIT/JPY",
						"proName": "BITFINEX:BTCJPY"
					},
					{
						"description": "ASXGOLD",
						"proName": "ASX:GOLD"
					},
					{
						"description": "AUDSILVER",
						"proName": "FX_IDC:XAGAUD"
					}
				],
				"showSymbolLogo": true,
				"colorTheme": "dark",
				"isTransparent": true,
				"displayMode": "adaptive",
				"locale": "uk"
			}
		</script>
	</div>
	<!-- TradingView Widget END -->



	<div class="master-frame">
		<div class="container-fluid">
			<!-- CHOOSE PRODUCTS -->
			<div class="choice-list">
			
				<div class="frame-title"><img src="<?php echo $template_path; ?>/trading/images/online.gif"> Tiền tệ</div>
				<div class="choice-section">
					<?php foreach($symbols as $symbol)
					{
						if($symbol->symbol_id == $_GET['symbol'])
						{
							$symbolname = $symbol->symbol_code;
						}
					?>
					<div data-id="<?php echo $symbol->symbol_id;?>" data-name="<?php echo $symbol->symbol_code;?>" class="choices item">
						<div class="list-item <?php echo ($symbol->symbol_id == $_GET['symbol'])? "active" : "";?> change_<?php echo $symbol->symbol_id;?>" id="choices_<?php echo $symbol->symbol_id;?>">
							<div class="list-item-name"><?php echo $symbol->symbol_code;?></div>
							<div class="item-section2">
								<div class="list-item-price">
									<div class="price" ><span id="price_<?php echo $symbol->symbol_id;?>">--------</span><span class="l" id="l_<?php echo $symbol->symbol_id;?>"></span></div>
								</div>
								<div class="list-item-updown change_<?php echo $symbol->symbol_id;?> up">
									<div class="number num_change_<?php echo $symbol->symbol_id;?>">--%</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					<input type="hidden" id="set_game_id" value="<?php echo $_GET['symbol'];?>">
				</div>

				
				<!-- <div class="frame-title mobile-hide">未來開放</div>
				<div class="choice-section3 mobile-hide">
				<div class="choices item">
					<div class="list-item">
					<div class="list-item-name">--/--</div>
					<div class="item-section2">
						<div class="list-item-price">
						<div class="price">--------<span class="l"></span></div>
						</div>
						<div class="list-item-updown up">
						<div class="number">--%</div>
						</div>
					</div>
					</div>
				</div>
				</div> -->

			</div>

			<!-- Choice End -->
			<div class="game_cover" style="display:none">Đóng cửa ...</div>
			<div class="row">
				<div class="canvas-run">
					<div class="section-trend">
						<!--<div class="canvas" id="main" style="border: solid #495057 1px; border-radius: 10px;"></div>-->
						<div class="game-body canvas">
							<div class="game-box">
								<div class="chartjs-size-monitor">
									<div class="chartjs-size-monitor-expand">
										<div class=""></div>
									</div>
									<div class="chartjs-size-monitor-shrink">
										<div class=""></div>
									</div>
								</div>
								<canvas id="chart-view"
									style="display: block; touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); "
									class="chartjs-render-monitor"></canvas>
								<button id="resetZoom"><i class="fa fa-angle-right fa-1x"></i></button>
								<span id="game-name" class="game-name" unselectable="on"><?php echo $symbolname;?></span>
								<span class="now-data" style="top: 102.265px;"><b>1.10758</b><i>17</i></span>
							</div>
						</div>
						<div class="bet-area1">
							<!-- <div class="mobile-fund">
								可用資金： </span><span id="wallet" ckt-name="balance">180000
							</div> -->
							<section class="section section-binary">
								<div class="block">
									<div class="tap-content">
										<div class="tab-pane active" id="binaryBox">
											<div class="tab-infomation"
												style="width: 100%;text-align: center;margin-bottom: 20px;">
												<div class="tab-type">
													<p>Thị trường:</p>
													<select id="right_roomList" style="max-width: unset;">
														<?php foreach($symbols as $symbol)
														{
														?>
														<option <?php echo ($symbol->symbol_id == $_GET['symbol'])? "selected" : ""; ?> value="<?php echo $symbol->symbol_id;?>"><?php echo $symbol->symbol_code;?></option>
														<?php
														}
														?>
														<!-- <option>英鎊/美金</option>
														<option>美金/瑞士法郎</option>
														<option>美金/日元</option>
														<option>比特幣/美金</option>
														<option>以太幣/美金</option> -->
													</select>
												</div>
												<div class="tab-current sub-title2">
													<div class="name">ID: <span id="gameid"
															ckt-name="now_period">201911040158</span></div>
															<input type="hidden" id="current_draw_game" value="">
													<div class="countdown-area">Đếm ngược.:
														<div class="countdown" id="countdown"></div> <img
															src="<?php echo $template_path; ?>/trading/images/count.gif">
													</div>
												</div>
											</div>
											<div class="wrapup">
												<form id="Game_form" class="bet-2"
													onsubmit="lightBox('#lightBoxConfirm');return false;">
													<div class="bet-infoleft">
														<div class="wallet-frame">
															<span class="icon-user"></span><span id="user-accounts"
																class="id"><?php echo $cus->acc_number;?></span>
														</div>
														<div>
															<div class="radio-group">
																<div class="choose-radio radio-buyup">
																	<input id="binary_playType_A"
																		name="binary_playType_big_or_small" type="radio"
																		bet_value="45_1" bet_rate="90">
																	<label for="binary_playType_A"
																		style="border-radius: 10px 0 0 10px;">Mua vào<br><span
																			class="bet1">90%</span></label>
																</div>
																<div class="choose-radio radio-buydown">
																	<input id="binary_playType_B"
																		name="binary_playType_big_or_small" type="radio"
																		bet_value="45_2" bet_rate="90">
																	<label for="binary_playType_B"
																		style="border-radius: 0 10px 10px 0;">Bán ra<br><span
																			class="bet1">90%</span></label>
																</div>
																<div class="choose-radio odd_even_color" style="display: none;">
																	<input id="binary_playType_C"
																		name="binary_playType_single_or_double"
																		type="radio" bet_value="46_1">
																	<label for="binary_playType_C"
																		style="border-radius: 10px 0 0 10px;">Đơn<br><span
																			class="bet1">90%</span></label>
																</div>
																<div class="choose-radio odd_even_color" style="display: none;">
																	<input id="binary_playType_D"
																		name="binary_playType_single_or_double"
																		type="radio" bet_value="46_2">
																	<label for="binary_playType_D"
																		style="border-radius: 0 10px 10px 0;">Đôi<br><span
																			class="bet1">90%</span></label>
																</div>
															</div>
														</div>
													</div>
													<div class="bet-inforight">
														<div class="wallet-frame">
															Ví tiền: <span id="wallets" ckt-name="balance"><?php echo number_format($cus->cus_balance,0);?></span>
														</div>
														<div class="sub-content">
															<div class="amount-select" style="display:flex">
																<p>Số tiền</p>
																<select id="bet_amount"
																	onchange="document.getElementById('amount-input').value= this.value;">
																	
																	<option value="0">Tuỳ chọn số tiền</option>
																	<?php foreach($listamounts as $amount)
																	{
																		?>
																	<option value="<?php echo $amount->amount_value;?>"><?php echo $amount->amount_display;?></option>
																	<?php 
																	}
																	?>
																</select>
															</div>
															<div class="amount-input" style="display:flex">
																<input id="amount-input" name="amount-input"
																	type="hidden">
															</div>
														</div>

														<button type="submit" class="btn-buy">XÁC NHẬN</button>

													</div>
												</form>
											</div> <!-- wrapup -->
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>


					<!-- ONLINE USER LIST -->
					<div class="user-list">
						<!-- 交易紀錄：客人交易紀錄 -->
						<div class="record-half">
							<div class="frame-title"><img src="<?php echo $template_path; ?>/trading/images/traffic.gif"> Giao dịch của tôi</div>
							<div id="listbet">
							
							</div>
						</div>

						<!-- 本日交易：現場客人交易紀錄 -->
						<div class="record-half2 now">
							<div class="frame-title" style="margin-top:20px"><img src="<?php echo $template_path; ?>/trading/images/traffic.gif">
								Giao dịch trực tiếp.
							</div>
							<div id="log-draw">
								<div class="side-log-item">
									<div class="list-bet">
										<div class="list-bet-time">
											<span class="bet-time">Tên</span>
										</div>
										<div class="list-bet-stat">
											<div class="list-bet-type">
												<div class="bet-type">Giá</div>
											</div>
											<div class="list-bet-updown">
												<div class="bet-number">Trạng thái</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
					<!-- ONLINE USER LIST End -->

				</div>
			</div>
		</div>

		<section class="lightBox">
			<div class="lightbox-black"></div>
			<div class="lightBox-body">
				<!--彈跳光箱-確認交易-->
				<div class="lightBox-panel" id="lightBoxConfirm">
					<div class="lightBox-header">Xác nhận giao dịch
						<div class="lightBox-close" style="position:absolute;
				text-align:right;
				position: absolute;
				top: -5px;
				right: 18px;">
							<span class="icon-times"></span>
						</div>
					</div>

					<div class="lightBox-content">
						<table class="lightBox-table">
							<tr>
								<td>Tên sản phẩm</td>
								<td id="lightBoxConfirm_game"><?php echo $symbolname;?></td>
							</tr>
							<tr>
								<td>Loại đầu tư</td>
								<td id="lightBoxConfirm_bet_patterns"></td>
							</tr>
							<tr>
								<td>Hoàn lại vốn đầu tư</td>
								<td id="lightBoxConfirm_bet_rates"></td>
							</tr>
							<tr>
								<td>Giá sản phẩm</td>
								<td id="lightBoxConfirm_price"></td>
							</tr>
							<tr>
								<td>Số tiền giao dịch</td>
								<td><span class="money" id="lightBoxConfirm_bet_balance"></span></td>
							</tr>
						</table>
						<div class="btn-group">
							<button class="btn-cancel" onclick="lightBoxClose()"> Hủy bỏ</button>
							<button class="btn-confirm" id="btn-confirm-bet">Xác nhận</button>
						</div>
					</div>
				</div>
				<!--彈跳光箱-交易成功-->
				<div class="lightBox-panel" id="lightBoxSuccess">
					<div class="lightBox-icon"><span class="icon-check"></span></div>
					<div class="lightBox-title" style="position:inherit">Giao dịch thành công</div>
					<div class="lightBox-content">
						<p>Sau đây là thông tin giao dịch của bạn</p>
						<table class="lightBox-table">
							<tr>
								<td>Tên sản phẩm</td>
								<td id="lightBoxSuccess_game"><?php echo $symbolname;?></td>
							</tr>
							<tr>
								<td>Loại đầu tư </td>
								<td id="lightBoxSuccess_bet_patterns"></td>
							</tr>
							<tr>
								<td>Số tiền giao dịch </td>
								<td><span class="money" id="lightBoxSuccess_bet_balance"></span></td>
							</tr>
						</table>
						<div class="btn-group">
							<button class="btn-confirm" onclick="lightBoxClose()">OK</button>
						</div>
					</div>
				</div>
				<!--彈跳光箱-交易失敗-->
				<div class="lightBox-panel" id="lightBoxError">
					<div class="lightBox-icon"> <span class="icon-times"></span></div>
					<div class="lightBox-title">giao dịch không thành công</div>
					<div class="lightBox-content">
						<p>Lý do</p>
						<div class="btn-group">
							<button class="btn-confirm" onclick="lightBoxClose()">OK</button>
						</div>
					</div>
				</div>
				<div class="lightBox-panel" id="boxNotice">
					<div class="lightBox-icon"> <span class="icon-times"></span></div>
					<div class="lightBox-title">Thông báo bảo trì cặp chỉ số</div>
					<div class="lightBox-content">
						<p>Chúng tôi đang tiến hành cập nhật dữ liệu thị trường vào theo thay đổi của phiên giao dịch mùa đông. Một số cập nhật sẽ được thông báo đến Quý Khách khi hoàn tất. Cặp tiền tệ: BTC/USD vẫn giao dịch bình thường trong thời gian này. Xin cảm ơn!</p>
						<div class="btn-group">
							<button class="btn-confirm" onclick="lightBoxClose()">OK</button>
						</div>
					</div>
				</div>
				<!--彈跳光箱-提示訊息-->
				<div class="lightBox-panel not_auto_close" id="lightBoxAlert">
					<div class="lightBox-header">Prompt message</div>
					<div class="lightBox-content">
						<div class="lightBox-message">System Messages</div>
						<div class="btn-group">
							<button class="btn-confirm" onclick="lightBoxClose()">OK</button>
						</div>
					</div>
				</div>

				<!--彈跳光箱-交易規則-->
				<div class="lightBox-panel introductions" id="lightBoxRule">
					<div class="lightBox-header">Quy tắc
						<div class="lightBox-close" style="position:absolute; text-align:right; position: absolute; top: -5px; right: 18px;">
							<span class="icon-times"></span>
						</div>
					</div>
					<div class="lightBox-content introductions">
						<table class="lightBox-table">
						  <tr>
							<td colspan="3">
							  <h5>Giới thiệu</h5>
							</td>
							<td></td>
						  </tr>
						  <tr>
							<td>Mô tả</td>
							<td>Giao dịch này là một sản phẩm phái sinh tài chính và bạn có thể đoán một trong hai kết quả có thể xảy ra. <br>
								Nếu dự đoán của bạn là chính xác, bạn sẽ nhận được những lợi ích theo lịch trình.Nếu không, bạn mất tài sản đầu tư của bạn.
							</td>
						</tr>
						 <tr>
							<td>Qui định</td>
							<td>Sau thời gian giao dịch cố định, những thay đổi về giá của tài sản cơ bản và giá thực thi được chia thành các tùy chọn gọi hoặc đặt và chỉ có hai kết quả có thể xảy ra, cả trong và ngoài giá, khi chúng hết hạn. <br>
							Theo xu hướng của cơ sở (giá cổ phiếu, giá hối đoái hoặc giá hàng hóa hoặc chỉ số thị trường chứng khoán) khi đáo hạn phù hợp với dự báo để xác định có lợi nhuận hay không, khi dự đoán chính xác hướng của giá tài sản hoặc chỉ số cơ bản trongMột thời gian nhất định, nó nằm trong giá, bạn có thể nhận được lãi suất xác định và số tiền đầu tư ban đầu, nếu không, nó nằm ngoài giá và số tiền đầu tư ban đầu sẽ bằng 0.Hoặc chỉ phục hồi một tỷ lệ khá nhỏ
							</td>
						</tr>
						<tr>
							<td>Đóng cửa</td>
							<td>The market is closed from<br>
							00:00 Mỗi thứ bảy đến 12:00 mỗi thứ Hai khác <br>
							Tiền ảo không bị ảnh hưởng</td>
						</tr>
						<tr>
							<td colspan="3">
							  <h5>Loại đầu tư</h5>
							</td>
							<td></td>
						  </tr>
						  <tr>
							<td>Mua vào/Bán ra</td>
							<td>Kích thước của giao dịch này được tính theo tỷ giá hối đoái hiện tại và số chữ số được xác định là mã cuối cùng.<br>
							Khoảng mã cuối cùng 0 ~ 9 <br>
							Mua vào: 0 ~ 4, Bán ra: 5 ~ 9 <br>
							Ví dụ: Tỷ giá hối đoái hiện tại là 1.1152339 <br>
							Sân cuối cùng là 9 để tăng, mua tăng vì lợi nhuận, nếu không thì bán ra để thu về lợi nhuận</td>
						</tr>
						
							<tr >
							<td>Tiền tệ giao dịch</td>
							<td>Cặp chỉ số XAU/VND</td>
						</tr>
						</table>
					</div>
				</div>
				<!--彈跳光箱-交易紀錄-->
				<div class="lightBox-panel introductions" id="lightBoxTime">
					<section class="section section-binary">
						<div class="tap-content">
							<div class="tab-pane active" id="betInquiry">
								<div class="tab-header">
									<div class="lightBox-header" style="position: absolute;
						  font-size: 18px;
						  color: #fff;">History</div>
									<ul class="tab-tool">
										<!-- <ul class="tab-tool">
										<li>
											<button><span class="icon-undo"></span></button>
										</li>
										</ul> -->
										<ul class="tab-tool" style="margin-left:10px">
											<li class="lightBox-close">
												<span class="icon-times"></span>
											</li>
										</ul>
									</ul>
									<div id="history_form" class="filter">
										<div>Choose a type:<br>
											<select id="history_roomList">
												<?php foreach($symbols as $symbol)
												{
													?>
													<option <?php echo ($symbol->symbol_id == $_GET['symbol'])? "selected" : ""; ?> value="<?php echo $symbol->symbol_id;?>"><?php echo $symbol->symbol_code;?></option>
												<?php 
												}
												?>
											</select>
										</div>
										<div>No.:<br>
											<input name="stock-number" id="draw_id" type="text">
										</div>
										<div>Ngày bắt đầu:<br>
											<input name="start" id="search_start" type="text">
										</div>
										<div>Ngày cuối:<br>
											<input name="end" id="search_end" type="text">
										</div>
										<button id="bettingrecorddata" class="btn btn-danger">Tìm kiếm</button>
									</div>
									<div id="bet_history_table" class="result-list">
										
									</div>
									<div class="pagination" id="bet_history_pages"></div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</section>
		<div class="loading" style="display: none;">
			<div style="text-align:center"><img src="<?php echo $template_path; ?>/trading/images/loading.gif"></div>
		</div>
	</div>





</body>
<script src="<?php echo $template_path; ?>/trading/js/jquery.min.js"></script>
<script src="<?php echo $template_path; ?>/trading/js/jquery.base64.js"></script>
<script src="<?php echo $template_path; ?>/trading/js/bootstrap.min.js"></script>
<script src="<?php echo $template_path; ?>/trading/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $template_path; ?>/trading/js/simplePagination.js"></script>
<script src="<?php echo $template_path; ?>/trading/js/MessageType.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo $template_path; ?>/tradeplatform/js/hitrading.js"></script>
<script src="<?php echo $template_path; ?>/tradeplatform/js/gameData.js"></script>


<script type="text/javascript">
	var stopTime = 0;
	//讀取畫面
	$(document).ready(function () {
		$("#btn-confirm-betsss").on("click",function(){
			var game = $("#lightBoxConfirm_game").html();
			alert(game);
		});
		//$('.loading').fadeOut(1000); // after get rooms

		//設定結束購買時間
		//exchangeChart.setStartTime(Math.floor(Date.now()/1000 + 120)*1000);
		//設定周到期滿時間
		//exchangeChart.setStopTime(Math.floor(Date.now()/1000 + 150)*1000);  
	});
	// $('span.icon-undo').click(function () {
	//   setTimeout(function () {
	//	 $('.loading').fadeOut(1000);
	//   }, 1000);
	//   setTimeout(function () {
	//	 $('.loading').remove();
	//   }, 2000);

	// });

	//假資料-進階報價-漲跌
	setInterval(function () {
		$(".list-item").removeClass("up down");
		setTimeout(function () {
			$(".list-item").each(function () {
				var c = Math.round(Math.random() * 2);
				if (c == 0)
					$(this).addClass("down");
				else
					$(this).addClass("up");
			});
		}, 100)
	}, 2000);



	var datas = [];

	//走勢圖-虛擬資料產生
	var now = +new Date();
	var secN = +new Date("2019/4/13 22:3:50");
	var valueA = 1000;

	function getRandom(x) {
		return Math.floor(Math.random() * x);
	};
	var n_data = 600; //顯示600筆資料

	function randomData(time_shift) {
		secN = Math.floor(Date.now() / 1000 - time_shift) * 1000;

		return {
			'time': new Date(secN).format("yyyy/MM/dd HH:mm:ss"),
			'value': 1 + (getRandom(99999)) / 100000
		}
	}
	$(document).ready(function () {
		
		
		initLangOption();
	});
	function initLangOption() {
		if (typeof lang == "undefined") {
			$('#lang_switch').remove();
			return;
		}
		$('#lang_switch').prepend("<option value='" + nowLang + "'>" + lang[nowLang] + "</option>");

		Object.keys(lang).forEach(key => {
			if (window.location.href.indexOf(key.toString()) <= 0) {
				$('#lang_switch').append("<option value='" + key + "'>" + lang[key] + "</option>");
			}
		});
		// binding lang_switch event
		$('#lang_switch').bind("change", function (e) {
			// console.log('url = +' + '../' + this.value + window.location.href.substring(window.location.href.indexOf(nowLang+'/')+nowLang.length));
			window.location = '../' + this.value + window.location.href.substring(window.location.href.indexOf(
				nowLang + '/') + nowLang.length);
		});
	}
	$("#history_form [name=start]").datepicker("setDate", "today");
    $("#history_form [name=end]").datepicker("setDate", "today");
	$(".fullScreen input").click(function () {
		//exchangeChart.resize();

	})
	//lightBox("#boxNotice");
</script>

</html>