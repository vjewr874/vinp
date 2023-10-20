var myUser = new MyUser, initGame, reTryLoginTimes = 0, GROUP_ID = 5;
var site_url = "https://investpro.asia"
function webSocket(auth) {
    var webUser = new WebUser
      , isLoginFail = !1;
    webUser.onMessage = function(e) {
        switch (e.GetClassName) {
        case "LoginResponse":
        case "GameLoginResponse":
            if (e.is_success) {
                reTryLoginTimes = 0,
                $("#user-account").text(e.account),
                myUser.setBalance(e.balance),
                $("#wallet").text(myUser.getViewBalance()),
                initGame.setWebUser(webUser);
                var request = new GetUserRoomDataListRequest;
                request.group_id = GROUP_ID,
                webUser.send(request)
            } else
                //isLoginFail = !0,
                //showReLoginWindow();
            break;
        case "UpdateUserBalanceResponse":
            myUser.setBalance(e.balance),
            $("#wallet").text(myUser.getViewBalance());
            break;
        case "GetUserRoomDataListResponse":
            let template = $(".choices")[0].outerHTML;
            $topList = $(".choice-section"),
            $topList.children(":visible").remove(),
            $rightList = $("#right_roomList"),
            $rightList.empty(),
            $historyList = $("#history_roomList"),
            $historyList.empty(),
            $rightList.change((function() {
                let room_id = $(this).val();
                location.replace("?auth=" + auth + "&game=" + room_id)
            }
            ));
            for (let i = 0; i < e.room_data_list.length; i++) {
                const data = e.room_data_list[i];
                let gotoFun = function() {
                    initGame.game != data.room_id && location.replace("?auth=" + auth + "&game=" + data.room_id)
                };
                $newChoice = $(template),
                $list_item = $newChoice.children(".list-item"),
                $list_item.attr("id", "choices_" + data.room_id),
                $list_item.attr("game", data.room_id),
                $list_item.click(gotoFun),
                $list_item.children(".list-item-name").text(getLangRoomName(data.room_id, data.room_name)),
                data.room_id == initGame.game && $list_item.addClass("active"),
                $newChoice.show(),
                $topList.append($newChoice),
                $list_item = $("<option value='" + data.room_id + "'>" + getLangRoomName(data.room_id, data.room_name) + "</option>"),
                data.room_id == initGame.game && $list_item.attr("selected", !0),
                $rightList.append($list_item),
                $list_item = $("<option value='" + data.room_id + "'>" + getLangRoomName(data.room_id, data.room_name) + "</option>"),
                $historyList.append($list_item),
                data.room_id == initGame.game && initGame.afterGetRoomData(data)
            }
            $topList2 = $(".choice-section2"),
            $topList2.children(":visible").remove(),
            $topList.children().each((function(index) {
                $(this).children().attr("game") >= 710 && ($topList2.append(this),
                $topList.remove(this))
            }
            )),
            $(".loading").fadeOut(1e3);
            break;
        case "OutOfConnectCountLimitResponse":
            isLoginFail = !0,
            showOutOfConnectCountWindow();
            break;
        default:
            initGame.onMessage(e)
        }
    }
    ,
    webUser.onClose = function(e) {
        myUser.isJoinRoom = !1,
        console.log("Disconnected " + reTryLoginTimes),
        isLoginFail || (reTryLoginTimes < 5 ? setTimeout((function() {
            webSocket(auth)
        }
        ), 3e3) : showReLoginWindow(),
        reTryLoginTimes++)
    }
    ;
    var request = new LoginRequest;
    return request.login_type_id = 3,
    request.msg_params = [auth],
    webUser.open(cf_game_url, request),
    webUser.onOpen = function() {
        console.log("Connected")
    }
    ,
    webUser
}
$((function() {
    var room_id = $.urlParam("game");
    initGame = new init_game(room_id);
    var auth = $.urlParam("auth");
    auth && webSocket(auth),
    setTimeout((function() {
        $("#history_roomList option").each((function() {
            $thisObj = $(this),
            $thisObj.val() == initGame.game ? $thisObj.attr("selected", !0) : $thisObj.attr("selected", !1)
        }
        )),
        $("#history_form [name=stock-number]").val(""),
        $("#history_form [name=start]").datepicker("setDate", "today"),
        $("#history_form [name=end]").datepicker("setDate", "today"),
        $("#bettingrecord").click()
    }
    ), 1e3),
    setInterval("$('#bettingrecord').click();", 3e4)
}
));
var sideLogTemplate = $(".side-log-item")[0].outerHTML
  , getAllTradeBySelf = function(roomName) {
    if (appearRate = .1,
    maxCount = 3,
    minCount = 1,
    betBase = 1e5,
    maxBet = 50,
    minBet = 1,
    $(".record-half2").length && appearRate >= Math.random()) {
        let count = Math.floor(Math.random() * (maxCount - minCount)) + minCount;
        for (i = 1; i <= count; i++) {
            let bet = (Math.floor(Math.random() * (maxBet - minBet)) + minBet) * betBase
              , type = Math.floor(4 * Math.random()) + 1;
            var today = new Date;
            today.setDate(today.getSeconds() - 5);
            var obj = new Object;
            obj.time = today,
            obj.roomName = roomName,
            obj.type = type,
            obj.bet = bet,
            appendLogForStock_k($(".record-half2"), obj)
        }
    }
}
  , appendLogForStock_k = function(target, obj) {
    resultText = [MessageType.getText("rise"), MessageType.getText("fall"), MessageType.getText("odd"), MessageType.getText("even")],
    resultList = ["result_up", "result_down", "result_odd", "result_even", "result_no_even"];
    var time = new Date(obj.time);
    if (timeStr = time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds(),
    $newBet = new $(sideLogTemplate),
    $newBet.children(".list-bet").children(".list-bet-time").children(".bet-time").html(timeStr),
    $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-type").children(".bet-type").html(getLangRoomName(obj.roomName, obj.roomName)),
    $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").html(resultText[obj.type - 1]),
    $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").addClass(resultList[obj.type - 1]),
    $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-price").children(".bet-price").html(Number(obj.bet)),
    $(target).append($newBet),
    nowLength = $(target).children().length,
    nowLength > 10)
        for (j = 1; j <= nowLength - 10; j++)
            $(target).children()[1].remove()
}
  , showReLoginWindow = function() {
	  /*
    showMessageBox(MessageType.getText("relogin_message"), "", {
        showCancel: !1
    }, (function() {
        setTimeout((function() {
            //showReLoginWindow()
        }
        ), 500)
    }
    ))
	*/
}
  , showOutOfConnectCountWindow = function() {
    showMessageBox(MessageType.getText("exceed_max_connetion"), "", {
        showCancel: !1
    }, (function() {
        setTimeout((function() {
            window.close()
        }
        ), 500)
    }
    ))
}
  , showInvalidWindow = function(msg) {
    showMessageBox(msg, "", {
        showCancel: !1
    })
}
  , setBetButtonEnable = function(isEnable) {
    isEnable ? $(".btn-buy").removeAttr("disabled") : $(".btn-buy").attr("disabled", !0)
}
  , showWaitWindow = function() {
    showMessageBox(MessageType.getText("betting"), "", {
        showConfirm: !1,
        showCancel: !1
    })
};
function showMessageBox(title="", content="", param, confirmCallback=null, cancelCallback=null) {
    var o = $.extend({
        showConfirm: !0,
        showCancel: !0,
        afterConfirmHide: !0
    }, param || {});
    o.showConfirm ? $("#lightBoxAlert .btn-confirm").off().click((function() {
        o.afterConfirmHide && hideMessageBox(),
        confirmCallback && confirmCallback()
    }
    )).show() : $("#lightBoxAlert .btn-confirm").hide(),
    $("#lightBoxAlert .lightBox-header").text(title),
    $("#lightBoxAlert .lightBox-message").html("<p>" + content + "</p>"),
    lightBox("#lightBoxAlert")
}
function hideMessageBox() {
    lightBoxClose()
}
var init_game = function(game) {
    game = parseInt(game),
    this.game = game,
    msgBuffTime = 2,
    this.buffSeconds = 999999,
    this.preDrawTime = 0,
    this.nextDrawTime = 0,
    this.initDrawContent,
    this.closeTime = 0,
    this.lastSeconds = 0,
    isPriceInfoInit = !1,
    prePriceArray = {};
    var roomsIsOpen = {}, isOpen = 0, webUser, currentDrawLotteryId,currentDrawLotteryNo, betPatternDataList;
    this.setWebUser = function(u) {
        webUser = u;
        var request = new JoinRoomRequest;
        request.room_id = game,
        webUser.send(request)
    }
    ;
    var invalidMsg = "";
    function afterJoinRoom() {
        $("#Game_form input[type=radio]").each((function() {
            let bet = $(this).attr("bet_value").split("_")
              , payRate = betPatternDataList.getPayRate(bet[0], -1);
            payRate *= 100,
            $input = $(this),
            $input.parent().children("[for=" + $input.attr("id") + "]").children(".bet1").text(payRate + "%")
        }
        ))
    }
    function getBetMoney() {
        let bet_money = $("#amount-input").val();
        return bet_money = parseInt(bet_money),
        (!bet_money || bet_money < 0) && (bet_money = 0),
        bet_money
    }
    this.onMessage = function(e) {
		//console.log(e);
        if ("UpdateUserBalanceResponse" == e.GetClassName)
            myUser.setBalance(e.balance),
            $("#wallet").text(myUser.getViewBalance());
        else if ("GetRoomInfoResponse" == e.GetClassName || "JoinRoomResponse" == e.GetClassName) {
            if ("JoinRoomResponse" == e.GetClassName)
                myUser.isJoinRoom = !0,
                betPatternDataList = new BetPatternDataList(e.bet_pattern_data_list),
                this.buffSeconds = e.buffer_seconds,
                this.preDrawTime = 1e3 * Math.floor(e.before_draw_lottery_server_time / 1e3),
                this.initDrawContent = e.before_draw_lottery_content,
                afterJoinRoom();
            else {
                if (e.is_wait_draw_lottery)
                    0 == isOpen && (isOpen = -2,
                    isPriceInfoInit = !0);
                else {
                    if (0 == isOpen) {
                        var request = new GetBinaryPriceInfoRequest;
                        request.room_id = initGame.game,
                        request.count = 60,
                        webUser.send(request)
                    }
                    isOpen = 1
                }
                if (e.other_room_state_list)
                    for (var i = 0; i < e.other_room_state_list.length; i++) {
                        var room_state = e.other_room_state_list[i];
                        roomsIsOpen[room_state.room_id] = !room_state.is_wait_draw_lottery
                    }
            }
            void 0 === e.invalid || null == e.invalid || "" == e.invalid ? invalidMsg.length > 0 && (invalidMsg = "",
            setBetButtonEnable(!0)) : 0 == invalidMsg.length && (invalidMsg = e.invalid,
            showInvalidWindow(invalidMsg),
            setBetButtonEnable(!1)),
            currentDrawLotteryId = e.draw_lottery_id,
            currentDrawLotteryNo = e.draw_lottery_num,
            $("#gameid").text(e.draw_lottery_num);
            let last_seconds = parseInt(e.last_seconds) - this.buffSeconds;
            var s = last_seconds
              , ss = s % 60
              , mm = (s = Math.floor(s / 60)) % 60
              , hh = Math.floor(s / 60);
            ss = ss > 9 ? ss : "0" + ss,
            mm = mm > 9 ? mm : "0" + mm,
            hh = hh > 9 ? hh : "0" + hh,
            $("#countdown").text(hh + ":" + mm + ":" + ss),
            $("#countdown").attr("last_seconds", last_seconds);
            let server_time = new Date(e.server_time);
            if ($("#now_datetime").text(server_time.format("yyyy/MM/dd HH:mm:ss")),
            -2 == isOpen ? $(".game_cover").fadeIn().show() : $(".game_cover").fadeOut(1e3, (function() {
                $(this).hide()
            }
            )),
            "GetRoomInfoResponse" == e.GetClassName && exchangeChart) {
                if (1 == isOpen) {
                    var serverTime, stopTime = (serverTime = Math.floor(e.server_time / 1e3)) + e.last_seconds + msgBuffTime, startTime = stopTime - this.buffSeconds, startTimestamp;
                    1e3 * startTime > exchangeChart.startTime && (exchangeChart.setStopTime(1e3 * stopTime),
                    exchangeChart.setStartTime(1e3 * startTime))
                } else
                    -1 == isOpen && (exchangeChart.setStopTime(0),
                    exchangeChart.setStartTime(0));
                if (-2 == isOpen)
                    ;
                else if (e.wait_draw_lottery_list) {
                    e.is_wait_draw_lottery && (isOpen = -1);
                    var drawTime = Math.max.apply(Math, e.wait_draw_lottery_list.map((function(d) {
                        return d.last_draw_lottery_seconds
                    }
                    ))), drawTimestamp = 0, now;
                    (drawTimestamp = 1e3 * (Math.floor(e.server_time / 1e3) + drawTime)) >= exchangeChart.gameTime - 1e3 && drawTimestamp <= exchangeChart.gameTime + 1e3 && (drawTimestamp = exchangeChart.gameTime),
                    drawTimestamp != exchangeChart.gameTime && (exchangeChart.setGameTime(drawTimestamp),
                    this.nextDrawTime = drawTimestamp),
                    exchangeChart.setGameLabel(MessageType.getText("current_settlement") + drawTime + MessageType.getText("sec"))
                }
                exchangeChart.setLastSeconds(e.last_seconds)
            }
        } else if ("GetBinaryPriceInfoResponse" == e.GetClassName) {
            for (var serverTime = Math.floor(e.server_time / 1e3), i = 0; i < e.room_binary_price_list.length; i++) {
                var room_id = e.room_binary_price_list[i].room_id
                  , price_list = e.room_binary_price_list[i].binary_price_list;
                if (room_id == game && price_list)
                    for (var j = 0; j < price_list.length; j++) {
						var timestamp = 1e3 * (serverTime - j);
						var newvalue;
                        if(j == 59)
						{
							$.ajax({
								type: "POST",
								url: site_url + "/api/getlastgameresult",
								data: {game: 700},
								dataType: "json",
								cache: false,
								success: function(data)
								{
									price = data.value;
								}
							});
						}
						else
						{
							price = price_list[j];
						}
						  
						 //exchangeChart.setGameLabel(MessageType.getText("current_settlement") + this.initDrawContent),
                        this.initDrawContent && timestamp == this.preDrawTime && (0 == exchangeChart.gameTime && (
                        exchangeChart.setGameTime(this.preDrawTime)),
                        price = this.initDrawContent,
                        this.initDrawContent = null),
                        -2 == isOpen || -1 == isOpen && timestamp > exchangeChart.gameTime || exchangeChart.addNewData({
                            time: timestamp,
                            value: price
                        }),
                        $("#lightBoxConfirm_price").text(price_list[j])
                    }
                var rs = roomsIsOpen[room_id];
                if (null != rs)
                    if (rs) {
                        if (e.room_binary_price_list[i].binary_price_list && e.room_binary_price_list[i].binary_price_list[0]) {
                            switchRoom(room_id, !0);
                            var prePrice = prePriceArray[room_id] ? prePriceArray[room_id] : 0, price, price_end = (price = e.room_binary_price_list[i].binary_price_list[0]).slice(-2), price_front = price.substr(0, price.length - 2), endObj = $("#choices_" + room_id + " .list-item-price span.l").html(price_end).prop("outerHTML");
                            $("#choices_" + room_id + " .list-item-price .price").html(price_front + endObj);
                            var diffPercent = 0;
                            prePrice > 0 && (diff = price - prePrice,
                            diffPercent = (100 * diff).toFixed(4),
                            $("#choices_" + room_id + " .list-item-updown").removeClass("up").removeClass("down").addClass(diff < 0 ? "down" : "up"),
                            $("#choices_" + room_id + " .list-item-updown .number").html(diffPercent + "%")),
                            prePriceArray[room_id] = price,
                            getAllTradeBySelf(room_id)
                        }
                    } else
                        switchRoom(room_id, !1)
            }
            isPriceInfoInit = !0
        } else if ("DrawLotteryResponse" == e.GetClassName)
		{
			var drawresult;
			$.ajax({
				type: "POST",
				url: site_url + "/api/getgameresult",
				data: {game: e.draw_lottery_num},
				dataType: "json",
				cache: false,
				success: function(data)
				{
					drawresult = data.result;
					cacheTodayBetHistoryList = null,
					exchangeChart.addNewData({
						time: this.nextDrawTime,
						value: drawresult
					}, !0),
					exchangeChart.setGameLabel(MessageType.getText("current_settlement") + drawresult),
					-1 == isOpen && (isOpen = -2);
				}
			});
			
            
			/*
			$.ajax({
				type: "POST",
				url: site_url + "/api/updategamedata",
				data: {game: e.draw_lottery_num, result: e.draw_lottery_content},
				dataType: "json",
				cache: false,
				success: function(data)
				{
					console.log(data);
				}
			});
			*/
		}
        else if ("UserBetResponse" == e.GetClassName)
            if (myUser.setBalance(e.balance),
            $("#wallet").text(myUser.getViewBalance()),
            e.is_success) {
                if (lightBox("#lightBoxSuccess"),
                $("form").trigger("reset"),
                cacheTodayBetHistoryList)
                    for (let index = 0; index < cacheTodayBetHistoryList.length; index++) {
                        const element = cacheTodayBetHistoryList[index];
                        if (element.room_id == game) {
                            cacheTodayBetHistoryList[index] = null;
                            break
                        }
                    }
            } else {
                var text = String.format(ErrorType.getText(e.error_id), e.error_param);
                showMessageBox(MessageType.getText("bet_failed"), text, {
                    showCancel: !1
                })
            }
        else
            "GetDrawLotteryHistoryResponse" == e.GetClassName || "GetBetHistoryResponse" == e.GetClassName && onDownloadBetHistoryResponse(e)
    }
    ,
    setInterval((function() {
        var request, request;
        myUser.isJoinRoom && ((request = new GetRoomInfoRequest).room_id = game,
        webUser.send(request),
        isPriceInfoInit && ((request = new GetBinaryPriceInfoRequest).group_id = GROUP_ID,
        request.count = 1,
        webUser.send(request)))
    }
    ), 1e3),
    this.afterGetRoomData = function(room) {
        $("#lightBoxConfirm_game").text(getLangRoomName(room.room_id, room.room_name)),
        $("#lightBoxSuccess_game").text(getLangRoomName(room.room_id, room.room_name))
    }
    ,
    $("#lightBoxConfirm .btn-cancel").bind("click", (function() {
        $("#Game_form").trigger("reset")
    }
    )),
    $("#lightBoxConfirm .btn-confirms").bind("click", (function() {
        let bet_money = getBetMoney()
          , bet_data_list = [];
        if ($("#Game_form input[type=radio]:checked").each((function() {
            let bet = $(this).attr("bet_value").split("_")
              , betData = new BetData;
            betData.bet_pattern_id = parseInt(bet[0]),
            betData.bet_balance = bet_money,
            betData.bet_pattern_content = bet[1],
            bet_data_list.push(betData)
        }
        )),
        checkBetFormSumit(bet_data_list)) {
            var request = new UserBetRequest;
            request.room_id = game,
            request.draw_lottery_id = currentDrawLotteryId,
            request.bet_data_list = bet_data_list,
            webUser.send(request),
            showWaitWindow()
        }
    }
    )),
	function placebet(request)
	{
		
	}
	$("#btn-confirm-bet").on("click", function(){
		let bet_money = getBetMoney()
          , bet_data_list = [];
        if ($("#Game_form input[type=radio]:checked").each((function() {
            let bet = $(this).attr("bet_value").split("_")
              , betData = new BetData;
            betData.bet_pattern_id = parseInt(bet[0]),
            betData.bet_balance = bet_money,
            betData.bet_pattern_content = bet[1],
            bet_data_list.push(betData)
        }
        )),
        checkBetFormSumit(bet_data_list)) {
            var request = new UserBetRequest;
            request.room_id = game,
            request.draw_lottery_id = currentDrawLotteryId,
            request.bet_data_list = bet_data_list;
			var amount = request.bet_data_list.bet_balance;
			var pattern1 = $("input[name=binary_playType_big_or_small]:checked").attr("bet_value");
			var pattern2 = $("input[name=binary_playType_single_or_double]:checked").attr("bet_value");
			$.ajax({
				type: "POST",
				url: site_url + "/api/placebet",
				data: {amount: bet_money, game: game,draw_lottery_id: currentDrawLotteryNo, pattern1: pattern1, pattern2: pattern2},
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
        }
	})
	,
    $("#Game_form").submit((function(event, src) {
        let bet_patterns = ""
          , bet_rates = ""
          , bet_count = 0;
        return $("#Game_form input[type=radio]:checked").each((function() {
            bet_patterns.length > 0 && (bet_patterns += ","),
            bet_rates.length > 0 && (bet_rates += ",");
            let content = getBetText(this.id, null, null);
            bet_patterns += content[0],
            bet_rates += content[1],
            bet_count++
        }
        )),
        $("#lightBoxConfirm_bet_patterns").text(bet_patterns),
        $("#lightBoxConfirm_bet_rates").text(bet_rates),
        $("#lightBoxConfirm_bet_balance").text(getBetMoney()),
        $("#lightBoxSuccess_bet_patterns").text(bet_patterns),
        $("#lightBoxSuccess_bet_balance").text(getBetMoney() * bet_count),
        lightBox("#lightBoxConfirm"),
        !1
    }
    )),
    $("#Game_form").on("reset", (function() {
        $("#Game_form input[type=radio]").val(0)
    }
    ));
    var cacheTodayBetHistoryList = null;
    function cleanBetHistoryPage() {
        $("#bet_history_table").html(""),
        $("#bet_history_pages").html("")
    }
    function getBetHistoryCache(room_id, draw_lottery_num, startDay, endDay) {
        let currentCache = null;
        for (let index = 0; index < cacheTodayBetHistoryList.length; index++) {
            const element = cacheTodayBetHistoryList[index];
            if (cacheTodayBetHistoryList[index] && element.room_id == room_id)
                if (draw_lottery_num) {
                    if (element.draw_lottery_num && element.draw_lottery_num == draw_lottery_num) {
                        currentCache = element;
                        break
                    }
                } else if (element.start == startDay && element.end == endDay) {
                    currentCache = element;
                    break
                }
        }
        return currentCache
    }
    function downloadBetHistory(room_id, page, draw_lottery_num, start, end) {
		/*
        if (Number.isInteger(start) && Number.isInteger(end)) {
            if (room_id = parseInt(room_id),
            cleanBetHistoryPage(),
            cacheTodayBetHistoryList) {
                let startDay, endDay, currentCache = getBetHistoryCache(room_id, draw_lottery_num, new Date(start).format("yyyy-MM-dd"), new Date(end).format("yyyy-MM-dd"));
                if (currentCache && currentCache.cache[page])
                    return void onDownloadBetHistoryResponse(currentCache.cache[page])
            }
            var request = new GetBetHistoryRequest;
            request.room_id = room_id,
            request.page = page,
            request.draw_lottery_num = draw_lottery_num,
            request.from_date = start,
            request.to_date = end,
            (request.draw_lottery_num || request.from_date && request.to_date) && webUser.send(request)
        }
		*/
    }
    function onDownloadBetHistoryResponse(e) {
        if (!e.is_success)
            return;
        e.page <= 0 && (e.page = 1);
        let room_id = $("#history_roomList").val()
          , draw_lottery_num = e.draw_lottery_num
          , start = new Date(e.from_date).format("yyyy-MM-dd")
          , end = new Date(e.to_date).format("yyyy-MM-dd");
        cacheTodayBetHistoryList || (cacheTodayBetHistoryList = []);
        let currentCache = getBetHistoryCache(room_id, draw_lottery_num, start, end);
        if (currentCache || (currentCache = {
            room_id: room_id,
            cache: []
        },
        draw_lottery_num ? currentCache.draw_lottery_num = draw_lottery_num : (currentCache.start = start,
        currentCache.end = end),
        cacheTodayBetHistoryList.push(currentCache)),
        currentCache.cache[e.page] = e,
        !e.bet_log_data_list)
            return void $("#bet_history_table").html(MessageType.getText("no_data"));
        let table_body = "";
        $(".record-half").length && $(".record-half .list-bet").remove();
        for (let i = 0; i < e.bet_log_data_list.length; i++) {
            const element = e.bet_log_data_list[i]
              , bet_log_row = element.bet_log_row;
            let bet_time = new Date(bet_log_row.bet_time).format("yyyy-MM-dd HH:mm:ss")
              , bet_content = bet_log_row.bet_pattern_content.split(";")
              , payout_ratio = bet_log_row.payout_ratio.split(";")
              , result = bet_log_row.result ? bet_log_row.result.split(";") : null
              , note = bet_log_row.note ? JSON.parse(bet_log_row.note) : null
              , binary_price = note ? note[0] ? note[0].binary_price : note.binary_price : "--"
              , result_text = note && note.length > 1 ? note[1].draw_lottery_content : "--";
            var invalid = null == note || null == note[1] || void 0 === note[1].event || null == note[1].event || "" == note[1].event ? "" : "DrawLottery Invalid" == note[1].event ? "&emsp;&emsp;無效" : "";
            for (let j = element.from_index; j < element.from_index + element.get_count; j++) {
                let bet_c_text = getBetText(null, bet_log_row.bet_pattern_id, bet_content[j])
                  , bet_result_class = result ? parseInt(result[j]) > 0 ? "bet_result_plus" : "bet_result_minus" : "bet_result_none";
                if (table_body += '<table class="table-bet mode1">\t\t\t\t\t\t\t\t<thead><tr><th>' + MessageType.getText("bet_num") + "</th><th>" + bet_log_row.bet_num + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("trade_time") + "</th><th>" + bet_time + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("draw_lottery_num") + "</th><th>" + bet_log_row.draw_lottery_num + invalid + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("content") + "</th><th>" + bet_c_text[0] + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("pay_rate") + "</th><th>" + payout_ratio[j] + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("rate") + "</th><th>" + binary_price + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("result") + "</th><th>" + result_text + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("amount") + "</th><th>" + bet_log_row.bet_balance + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("my_result") + '</th><th class="' + bet_result_class + '">' + (result ? result[j] : "--") + "</th></tr></thead>\t\t\t\t\t\t\t\t</table>",
                $(".record-half").length) {
                    var obj = new Object;
                    switch (obj.time = bet_time,
                    obj.roomName = e.room_id,
                    bet_contentz = bet_content[j].split(","),
                    bet_log_row.bet_pattern_id) {
                    case 44:
                        1 == bet_contentz[0] ? obj.type = 5 : 4 == bet_contentz[0] ? obj.type = 7 : obj.type = 6;
                        break;
                    case 45:
                        1 == bet_contentz[0] ? obj.type = 1 : obj.type = 2;
                        break;
                    case 46:
                        1 == bet_contentz[0] ? obj.type = 3 : obj.type = 4
                    }
                    obj.bet = result,
                    appendLogForStock_k($(".record-half"), obj)
                }
            }
        }
        $("#bet_history_table").html($(table_body)),
        $("#bet_history_pages").pagination({
            items: e.total_page,
            itemsOnPage: 1,
            prevText: "«",
            nextText: "»",
            ellipsePageSet: !1,
            currentPage: e.page,
            listStyle: "pagination",
            hrefTextPrefix: "javascript:void(",
            hrefTextSuffix: ")",
            onPageClick: function(pageNumber, event) {
                event && "click" == event.type && downloadBetHistory(room_id, pageNumber, e.draw_lottery_num, e.from_date, e.to_date)
            }
        })
    }
    function checkBetFormSumit(bet_data_list) {
        var msg;
        myUser.isJoinRoom || (msg = MessageType.getText("network_fail"));
        var last_seconds = $("#countdown").attr("last_seconds");
        !msg && last_seconds <= 0 && (msg = ErrorType.getText(30003));
        var bet_count = bet_data_list.length;
        if (msg || 0 != bet_count || (msg = ErrorType.getText(30007)),
        !msg) {
            var all_bet_money = 0;
            for (let i = 0; i < bet_data_list.length; i++) {
                const betData = bet_data_list[i];
                var betBalanceLimit = betPatternDataList.getBetBalanceLimit(betData.bet_pattern_id);
                if (betBalanceLimit.min >= 0 && betData.bet_balance < betBalanceLimit.min ? msg = ErrorType.getText(30100) : betBalanceLimit.max >= 0 && betData.bet_balance > betBalanceLimit.min && (msg = ErrorType.getText(30101)),
                msg)
                    break;
                all_bet_money += betData.bet_balance
            }
            !msg && all_bet_money <= 0 && (msg = ErrorType.getText(30006))
            //!msg && all_bet_money > myUser.getBalance() && (msg = ErrorType.getText(30004))
        }
        return !msg || (setTimeout((function() {
            $("#lightBoxError .lightBox-content > p").text(msg),
            lightBox("#lightBoxError")
        }
        ), 300),
        !1)
    }
    $("#openbettingrecord").bind("click", (function() {
        $("#history_roomList option").each((function() {
            $thisObj = $(this),
            $thisObj.val() == game ? $thisObj.attr("selected", !0) : $thisObj.attr("selected", !1)
        }
        )),
        $("#history_form [name=stock-number]").val(""),
        $("#history_form [name=start]").datepicker("setDate", "today"),
        $("#history_form [name=end]").datepicker("setDate", "today"),
        cleanBetHistoryPage()
    }
    )),
    $("#bettingrecord").bind("click", (function() {
        let room_id, draw_lottery_num, start, end;
        downloadBetHistory($("#history_roomList").val(), 1, $("#history_form [name=stock-number]").val(), new Date($("#history_form [name=start]").val() + "T00:00:00").getTime(), new Date($("#history_form [name=end]").val() + "T23:59:59").getTime())
    }
    ))
};
function getBetText(id, bet_pattern_id, bet_content) {
    id ? $input = $("#" + id) : (bet_content = bet_content.split(","),
    $input = $("#Game_form [bet_value=" + bet_pattern_id + "_" + bet_content[0] + "]")),
    $label = $input.parent().children("[for=" + $input.attr("id") + "]");
    let rate = $label.children(".bet1").text(), content;
    return [$label.text().replace(rate, ""), rate]
}
function switchRoom(room_id, is_open) {
    is_open ? ($("#choices_" + room_id + " .list-item-price").show(),
    $("#choices_" + room_id + " .list-item-updown").show(),
    $("#choices_" + room_id + " .list-item-close").hide()) : ($("#choices_" + room_id + " .list-item-price").hide(),
    $("#choices_" + room_id + " .list-item-updown").hide(),
    $("#choices_" + room_id + " .list-item-close").show())
}
function getLangRoomName(room_id, original_name) {
    return "undefined" == typeof lang ? original_name : "undefined" == typeof roomNameList ? original_name : void 0 === roomNameList[nowLang] ? original_name : void 0 === roomNameList[nowLang][room_id] ? original_name : roomNameList[nowLang][room_id]
}
