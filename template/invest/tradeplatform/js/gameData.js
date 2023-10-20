$(document).ready(function () {
	$("input[name=binary_playType_big_or_small]").on("change",function(){
		var playtype = $(this);
		var bettype = playtype.attr("bet_value");
		var betrate = playtype.attr("bet_rate");
		if(bettype == "45_1")
		{
			$("#lightBoxConfirm_bet_patterns").html("Mua vào");
			
		}
		else
		{
			$("#lightBoxConfirm_bet_patterns").html("Bán ra");
		}
		$("#lightBoxConfirm_bet_rates").html(betrate + "%");
	});
	$("#bet_amount").on("change",function(){
		$("#lightBoxConfirm_bet_balance").html($("#bet_amount").val());
	});
	//
	$("#btn-confirm-bet").on("click", function(){
		var amount = $("#bet_amount option:selected").val();
		var pattern1 = $("input[name=binary_playType_big_or_small]:checked").attr("bet_value");
		var pattern2 = $("input[name=binary_playType_single_or_double]:checked").attr("bet_value");
		var draw_id_game = $("#current_draw_game").val();
		
		$.ajax({
			type: "POST",
			url: site_url + "/api/placebet",
			data: {amount: amount, game: 700,draw_lottery_id: draw_id_game, pattern1: pattern1, pattern2: pattern2},
			dataType: "json",
			cache: false,
			success: function(data)
			{
				if(data.status == 200)
				{
					
					$("#wallets").html(data.newbalance);
					$("input[name=binary_playType_big_or_small]:checked").prop('checked', false); 
					$("input[name=binary_playType_single_or_double]:checked").prop('checked', false); 
					$("#bet_amount").val(0);
					
					$("#lightBoxSuccess_bet_patterns").text(data.pattern);
					$("#lightBoxSuccess_bet_balance").text(data.betamount);
					lightBox("#lightBoxSuccess");
				}
				else
				{
					showMessageBox(MessageType.getText("bet_failed"), data.message, {
						showCancel: !1
					})
				}
			}
		});
		//webUser.send(request),
		//placebet(request),
		showWaitWindow()
	});
});