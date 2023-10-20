var $jscomp = $jscomp || {};
var site_url = "https://investpro.asia"
$jscomp.scope = {};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.SIMPLE_FROUND_POLYFILL = !1;
$jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function(b, c, e) {
    b != Array.prototype && b != Object.prototype && (b[c] = e.value)
};
$jscomp.getGlobal = function(b) {
    return "undefined" != typeof window && window === b ? b : "undefined" != typeof global && null != global ? global : b
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(b, c, e, k) {
    if (c) {
        e = $jscomp.global;
        b = b.split(".");
        for (k = 0; k < b.length - 1; k++) {
            var m = b[k];
            m in e || (e[m] = {});
            e = e[m]
        }
        b = b[b.length - 1];
        k = e[b];
        c = c(k);
        c != k && null != c && $jscomp.defineProperty(e, b, {
            configurable: !0,
            writable: !0,
            value: c
        })
    }
};
$jscomp.polyfill("Number.isFinite", function(b) {
    return b ? b : function(b) {
        return "number" !== typeof b ? !1 : !isNaN(b) && Infinity !== b && -Infinity !== b
    }
}, "es6", "es3");
$jscomp.polyfill("Number.isInteger", function(b) {
    return b ? b : function(b) {
        return Number.isFinite(b) ? b === Math.floor(b) : !1
    }
}, "es6", "es3");
var myUser = new MyUser,
    initGame, reTryLoginTimes = 0,
    GROUP_ID = 5,
    roomNameList = MessageType.getRoomNameList();

function webSocket(b) {
    var c = new WebUser,
        e = !1;
    c.onMessage = function(m) {
        switch (m.GetClassName) {
            case "LoginResponse":
            case "GameLoginResponse":
                if (m.is_success) {
                    reTryLoginTimes = 0;
                    var k = "undefined" == typeof m.nick_name || null == m.nick_name || 0 == m.nick_name.length ? m.account : m.nick_name;
                    $("#user-account").text(k);
                    myUser.setBalance(m.balance);
                    $("#wallet").text(myUser.getViewBalance());
                    initGame.setWebUser(c);
                    m = new GetUserRoomDataListRequest;
                    m.group_id = GROUP_ID;
                    c.send(m)
                } else e = !0, showReLoginWindow();
                break;
            case "UpdateUserBalanceResponse":
                myUser.setBalance(m.balance);
                $("#wallet").text(myUser.getViewBalance());
                break;
            case "GetUserRoomDataListResponse":
                k = $(".choices")[0].outerHTML;
                $topList = $(".choice-section");
                $topList.children(":visible").remove();
                $rightList = $("#right_roomList");
                $rightList.empty();
                $historyList = $("#history_roomList");
                $historyList.empty();
                $rightList.change(function() {
                    var c = $(this).val();
                    location.replace("?auth=" + b + "&game=" + c)
                });
                for (var n = {}, w = 0; w < m.room_data_list.length; n = {
                        $jscomp$loop$prop$data$5: n.$jscomp$loop$prop$data$5
                    }, w++) {
                    n.$jscomp$loop$prop$data$5 =
                        m.room_data_list[w];
                    var z = function(c) {
                        return function() {
                            initGame.game != c.$jscomp$loop$prop$data$5.room_id && location.replace("?auth=" + b + "&game=" + c.$jscomp$loop$prop$data$5.room_id)
                        }
                    }(n);
                    $newChoice = $(k);
                    $list_item = $newChoice.children(".list-item");
                    $list_item.attr("id", "choices_" + n.$jscomp$loop$prop$data$5.room_id);
                    $list_item.attr("game", n.$jscomp$loop$prop$data$5.room_id);
                    $list_item.click(z);
                    $list_item.children(".list-item-name").text(getLangRoomName(n.$jscomp$loop$prop$data$5.room_id, n.$jscomp$loop$prop$data$5.room_name));
                    n.$jscomp$loop$prop$data$5.room_id == initGame.game && $list_item.addClass("active");
                    $newChoice.show();
                    $topList.append($newChoice);
                    $list_item = $("<option value='" + n.$jscomp$loop$prop$data$5.room_id + "'>" + getLangRoomName(n.$jscomp$loop$prop$data$5.room_id, n.$jscomp$loop$prop$data$5.room_name) + "</option>");
                    n.$jscomp$loop$prop$data$5.room_id == initGame.game && $list_item.attr("selected", !0);
                    $rightList.append($list_item);
                    $list_item = $("<option value='" + n.$jscomp$loop$prop$data$5.room_id + "'>" + getLangRoomName(n.$jscomp$loop$prop$data$5.room_id,
                        n.$jscomp$loop$prop$data$5.room_name) + "</option>");
                    $historyList.append($list_item);
                    n.$jscomp$loop$prop$data$5.room_id == initGame.game && initGame.afterGetRoomData(n.$jscomp$loop$prop$data$5)
                }
                $topList2 = $(".choice-section2");
                $topList2.children(":visible").remove();
                $topList.children().each(function(b) {
                    710 <= $(this).children().attr("game") && ($topList2.append(this), $topList.remove(this))
                });
                $(".loading").fadeOut(1E3);
                break;
            case "OutOfConnectCountLimitResponse":
                e = !0;
                showOutOfConnectCountWindow();
                break;
            default:
                initGame.onMessage(m)
        }
    };
    c.onClose = function(c) {
        myUser.isJoinRoom = !1;
        console.log("Disconnected " + reTryLoginTimes);
        e || (5 > reTryLoginTimes ? setTimeout(function() {
            webSocket(b)
        }, 3E3) : showReLoginWindow(), reTryLoginTimes++)
    };
    var k = new LoginRequest;
    k.login_type_id = 3;
    k.msg_params = [b];
    c.open(cf_game_url, k);
    c.onOpen = function() {
        console.log("Connected")
    };
    return c
}
$(function() {
    var b = $.urlParam("game");
    initGame = new init_game(b);
    (b = $.urlParam("auth")) && webSocket(b);
    setTimeout(function() {
        $("#history_roomList option").each(function() {
            $thisObj = $(this);
            $thisObj.val() == initGame.game ? $thisObj.attr("selected", !0) : $thisObj.attr("selected", !1)
        });
        $("#history_form [name=stock-number]").val("");
        $("#history_form [name=start]").datepicker("setDate", "today");
        $("#history_form [name=end]").datepicker("setDate", "today");
        $("#bettingrecord").click()
    }, 1E3);
    setInterval("$('#bettingrecord').click();",
        3E4)
});
var sideLogTemplate = $(".side-log-item")[0].outerHTML,
    getAllTradeBySelf = function(b) {
        appearRate = .1;
        maxCount = 3;
        minCount = 1;
        betBase = 100;
        maxBet = 50;
        minBet = 1;
        if ($(".record-half2").length && appearRate >= Math.random()) {
            var c = Math.floor(Math.random() * (maxCount - minCount)) + minCount;
            for (i = 1; i <= c; i++) {
                var e = (Math.floor(Math.random() * (maxBet - minBet)) + minBet) * betBase,
                    k = Math.floor(4 * Math.random()) + 1,
                    m = new Date;
                m.setDate(m.getSeconds() - 5);
                var t = {};
                t.time = m;
                t.roomName = b;
                t.type = k;
                t.bet = e;
                appendLogForStock_k($(".record-half2"), t)
            }
        }
    },
    appendLogForStock_k = function(b, c) {
        resultText = [MessageType.getText("odd"), MessageType.getText("even"), MessageType.getText("up"), MessageType.getText("down")];
        resultList = ["result_odd", "result_even", "result_up", "result_down"];
        var e = new Date(c.time);
        timeStr = e.getHours() + ":" + e.getMinutes() + ":" + e.getSeconds();
        $newBet = new $(sideLogTemplate);
        $newBet.children(".list-bet").children(".list-bet-time").children(".bet-time").html(timeStr);
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-type").children(".bet-type").html(getLangRoomName(c.roomName,
            c.roomName));
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").html(resultText[c.type - 1]);
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").addClass(resultList[c.type - 1]);
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-price").children(".bet-price").html(Number(c.bet));
        $(b).append($newBet);
        nowLength = $(b).children().length;
        if (10 < nowLength)
            for (j = 1; j <= nowLength -
                10; j++) $(b).children()[1].remove()
    },
    showReLoginWindow = function() {
        showMessageBox(MessageType.getText("relogin_message"), "", {
            showCancel: !1
        }, function() {
            setTimeout(function() {
                showReLoginWindow()
            }, 500)
        })
    },
    showOutOfConnectCountWindow = function() {
        showMessageBox(MessageType.getText("exceed_max_connetion"), "", {
            showCancel: !1
        }, function() {
            setTimeout(function() {
                window.close()
            }, 500)
        })
    },
    showInvalidWindow = function(b) {
        showMessageBox(b, "", {
            showCancel: !1
        })
    },
    setBetButtonEnable = function(b) {
        b ? $(".btn-buy").removeAttr("disabled") :
            $(".btn-buy").attr("disabled", !0)
    },
    showWaitWindow = function() {
        showMessageBox(MessageType.getText("betting"), "", {
            showConfirm: !1,
            showCancel: !1
        })
    };

function showMessageBox(b, c, e, k, m) {
    b = void 0 === b ? "" : b;
    c = void 0 === c ? "" : c;
    k = void 0 === k ? null : k;
    var t = $.extend({
        showConfirm: !0,
        showCancel: !0,
        afterConfirmHide: !0
    }, e || {});
    t.showConfirm ? $("#lightBoxAlert .btn-confirm").off().click(function() {
        t.afterConfirmHide && hideMessageBox();
        k && k()
    }).show() : $("#lightBoxAlert .btn-confirm").hide();
    $("#lightBoxAlert .lightBox-header").text(b);
    $("#lightBoxAlert .lightBox-message").html("<p>" + c + "</p>");
    lightBox("#lightBoxAlert")
}

function hideMessageBox() {
    lightBoxClose()
}
var init_game = function(b) {
    function c() {
        $("#Game_form input[type=radio]").each(function() {
            var a = $(this).attr("bet_value").split("_");
            a = A.getPayRate(a[0], -1);
            a *= 100;
            $input = $(this);
            $input.parent().children("[for=" + $input.attr("id") + "]").children(".bet1").text(90 + "%")
        })
    }

    function e() {
        var a = $("#amount-input").val();
        a = parseInt(a);
        if (!a || 0 > a) a = 0;
        return a
    }

    function k() {
        $("#bet_history_table").html("");
        $("#bet_history_pages").html("")
    }

    function m(a, b, l, f) {
        for (var d = null, h = 0; h < r.length; h++) {
            var c = r[h];
            if (r[h] &&
                c.room_id == a)
                if (b) {
                    if (c.draw_lottery_num && c.draw_lottery_num == b) {
                        d = c;
                        break
                    }
                } else if (c.start == l && c.end == f) {
                d = c;
                break
            }
        }
        return d
    }

    function t(a, b, l, c, g) {
        if (Number.isInteger(c) && Number.isInteger(g)) {
            a = parseInt(a);
            k();
            if (r) {
                var d = (new Date(c)).format("yyyy-MM-dd"),
                    f = (new Date(g)).format("yyyy-MM-dd");
                if ((d = m(a, l, d, f)) && d.cache[b]) {
                    n(d.cache[b]);
                    return
                }
            }
            d = new GetBetHistoryRequest;
            d.room_id = a;
            d.page = b;
            d.draw_lottery_num = l;
            d.from_date = c;
            d.to_date = g;
            (d.draw_lottery_num || d.from_date && d.to_date) && v.send(d)
        }
    }

    function n(a) {
        if (a.is_success) {
            0 >=
                a.page && (a.page = 1);
            var b = $("#history_roomList").val(),
                c = a.draw_lottery_num,
                f = (new Date(a.from_date)).format("yyyy-MM-dd"),
                g = (new Date(a.to_date)).format("yyyy-MM-dd");
            r || (r = []);
            var h = m(b, c, f, g);
            h || (h = {
                room_id: b,
                cache: []
            }, c ? h.draw_lottery_num = c : (h.start = f, h.end = g), r.push(h));
            h.cache[a.page] = a;
            if (a.bet_log_data_list) {
                c = "";
                $(".record-half").length && $(".record-half .list-bet").remove();
                for (f = 0; f < a.bet_log_data_list.length; f++) {
                    g = a.bet_log_data_list[f];
                    h = g.bet_log_row;
                    var e = (new Date(h.bet_time)).format("yyyy-MM-dd HH:mm:ss"),
                        k = h.bet_pattern_content.split(";"),
                        n = h.payout_ratio.split(";"),
                        p = h.result ? h.result.split(";") : null,
                        q = h.note ? JSON.parse(h.note) : null,
                        v = q ? q[0] ? q[0].binary_price : q.binary_price : "--",
                        w = q && 1 < q.length ? q[1].draw_lottery_content : "--";
                    q = null == q || null == q[1] || "undefined" == typeof q[1].event || null == q[1].event || "" == q[1].event ? "" : "DrawLottery Invalid" == q[1].event ? "&emsp;&emsp;" + MessageType.getText("invalid") : "";
                    for (var x = g.from_index; x < g.from_index + g.get_count; x++) {
                        var u = getBetText(null, h.bet_pattern_id, k[x]),
                            y =
                            p ? 0 < parseInt(p[x]) ? "bet_result_plus" : "bet_result_minus" : "bet_result_none";
                        c += '<table class="table-bet mode1">\t\t\t\t\t\t\t\t<thead><tr><th>' + MessageType.getText("bet_num") + "</th><th>" + h.bet_num + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("trade_time") + "</th><th>" + e + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("draw_lottery_num") + "</th><th>" + h.draw_lottery_num + q + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("content") +
                            "</th><th>" + u[0] + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("pay_rate") + "</th><th>" + n[x] + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("rate") + "</th><th>" + v + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("result") + "</th><th>" + w + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("amount") + "</th><th>" + h.bet_balance + "</th></tr></thead>\t\t\t\t\t\t\t\t<thead><tr><th>" + MessageType.getText("my_result") +
                            '</th><th class="' + y + '">' + (p ? p[x] : "--") + "</th></tr></thead>\t\t\t\t\t\t\t\t</table>";
                        if ($(".record-half").length) {
                            u = {};
                            u.time = e;
                            u.roomName = a.room_id;
                            bet_contentz = k[x].split(",");
                            switch (h.bet_pattern_id) {
                                case 44:
                                    u.type = 1 == bet_contentz[0] ? 5 : 6;
                                    break;
                                case 45:
                                    u.type = 1 == bet_contentz[0] ? 1 : 2;
                                    break;
                                case 46:
                                    u.type = 1 == bet_contentz[0] ? 3 : 4;
                                    break;
                                case 47:
                                    u.type = 7
                            }
                            u.bet = p;
                            appendLogForStock_k($(".record-half"), u)
                        }
                    }
                }
                $("#bet_history_table").html($(c));
                $("#bet_history_pages").pagination({
                    items: a.total_page,
                    itemsOnPage: 1,
                    prevText: "\u00ab",
                    nextText: "\u00bb",
                    ellipsePageSet: !1,
                    currentPage: a.page,
                    listStyle: "pagination",
                    hrefTextPrefix: "javascript:void(",
                    hrefTextSuffix: ")",
                    onPageClick: function(d, c) {
                        c && "click" == c.type && t(b, d, a.draw_lottery_num, a.from_date, a.to_date)
                    }
                })
            } else $("#bet_history_table").html(MessageType.getText("no_data"))
        }
    }

    function w(a) {
        var b;
        myUser.isJoinRoom || (b = MessageType.getText("network_fail"));
        var c = $("#countdown").attr("last_seconds");
        !b && 0 >= c && (b = ErrorType.getText(30003));
        c = a.length;
        b || 0 != c || (b = ErrorType.getText(30007));
        if (!b) {
            for (var f = c = 0; f < a.length; f++) {
                var g = a[f],
                    h = A.getBetBalanceLimit(g.bet_pattern_id);
                0 <= h.min && g.bet_balance < h.min ? b = ErrorType.getText(30100) : 0 <= h.max && g.bet_balance > h.min && (b = ErrorType.getText(30101));
                if (b) break;
                c += g.bet_balance
            }!b && 0 >= c && (b = ErrorType.getText(30006));
            !b && c > myUser.getBalance() && (b = ErrorType.getText(30004))
        }
        return b ? (setTimeout(function() {
            $("#lightBoxError .lightBox-content > p").text(b);
            lightBox("#lightBoxError")
        }, 300), !1) : !0
    }
    this.game = b = parseInt(b);
    msgBuffTime = 2;
    this.buffSeconds =
        999999;
    this.nextDrawTime = this.preDrawTime = 0;
    this.initDrawContent;
    this.lastSeconds = this.closeTime = 0;
    isPriceInfoInit = !1;
    prePriceArray = {};
    var z = {},
        p = 0,
        v;
    this.setWebUser = function(a) {
        v = a;
        a = new JoinRoomRequest;
        a.room_id = b;
        v.send(a)
    };
    var B,INdraw_lottery_num, A, y = "";
	
    this.onMessage = function(a) {
		console.log(a);
        if ("UpdateUserBalanceResponse" == a.GetClassName) myUser.setBalance(a.balance), $("#wallet").text(myUser.getViewBalance());
        else if ("GetRoomInfoResponse" == a.GetClassName || "JoinRoomResponse" == a.GetClassName) {
            if ("JoinRoomResponse" == a.GetClassName) myUser.isJoinRoom = !0, A = new BetPatternDataList(a.bet_pattern_data_list), this.buffSeconds = a.buffer_seconds, this.preDrawTime = 1E3 * Math.floor(a.before_draw_lottery_server_time / 1E3), this.initDrawContent = a.before_draw_lottery_content, c();
            else {
                if (a.is_wait_draw_lottery) 0 == p && (p = -2, isPriceInfoInit = !0);
                else {
                    if (0 == p) {
                        var d = new GetBinaryPriceInfoRequest;
                        d.room_id = initGame.game;
                        d.count = 60;
                        v.send(d)
                    }
                    p = 1
                }
                if (a.other_room_state_list)
                    for (d = 0; d < a.other_room_state_list.length; d++) {
                        var l = a.other_room_state_list[d];
                        z[l.room_id] = !l.is_wait_draw_lottery
                    }
            }
            "undefined" ==
            typeof a.invalid || null == a.invalid || "" == a.invalid ? 0 < y.length && (y = "", setBetButtonEnable(!0)) : 0 == y.length && (y = a.invalid, showInvalidWindow(y), setBetButtonEnable(!1));
            B = a.draw_lottery_id;
			INdraw_lottery_num = a.draw_lottery_num;
            $("#gameid").text(a.draw_lottery_num);
            var f = d = parseInt(a.last_seconds) - this.buffSeconds;
            l = f % 60;
            f = Math.floor(f / 60);
            var g = f % 60;
            f = Math.floor(f / 60);
            l = 9 < l ? l : "0" + l;
            g = 9 < g ? g : "0" + g;
            f = 9 < f ? f : "0" + f;
            $("#countdown").text(f + ":" + g + ":" + l);
            $("#countdown").attr("last_seconds", d);
            d = new Date(a.server_time);
            $("#now_datetime").text(d.format("yyyy/MM/dd HH:mm:ss")); -
            2 == p ? $(".game_cover").fadeIn().show() : $(".game_cover").fadeOut(1E3, function() {
                $(this).hide()
            });
            "GetRoomInfoResponse" == a.GetClassName && exchangeChart && (1 == p ? (l = Math.floor(a.server_time / 1E3), d = l + a.last_seconds + msgBuffTime, l = d - this.buffSeconds, 1E3 * l > exchangeChart.startTime && (exchangeChart.setStopTime(1E3 * d), exchangeChart.setStartTime(1E3 * l))) : -1 == p && (exchangeChart.setStopTime(0), exchangeChart.setStartTime(0)), -2 != p && a.wait_draw_lottery_list && (a.is_wait_draw_lottery && (p = -1), d = Math.max.apply(Math, a.wait_draw_lottery_list.map(function(a) {
                    return a.last_draw_lottery_seconds
                })),
                l = 0, l = 1E3 * (Math.floor(a.server_time / 1E3) + d), l >= exchangeChart.gameTime - 1E3 && l <= exchangeChart.gameTime + 1E3 && (l = exchangeChart.gameTime), l != exchangeChart.gameTime && (exchangeChart.setGameTime(l), this.nextDrawTime = l), exchangeChart.setGameLabel(MessageType.getText("current_settlement") + d + MessageType.getText("sec"))), exchangeChart.setLastSeconds(a.last_seconds))
        } else if ("GetBinaryPriceInfoResponse" == a.GetClassName) {
            l = Math.floor(a.server_time / 1E3);
            for (d = 0; d < a.room_binary_price_list.length; d++) {
                g = a.room_binary_price_list[d].room_id;
                var h = a.room_binary_price_list[d].binary_price_list;
				
                if (g == b && h)
				{
					
                    for (var e = 0; e < h.length; e++) {
                        var k = 1E3 * (l - e);
						
                        f = h[e];
						
                        this.initDrawContent && k == this.preDrawTime && (0 == exchangeChart.gameTime && (exchangeChart.setGameLabel(MessageType.getText("current_settlement") + this.initDrawContent), exchangeChart.setGameTime(this.preDrawTime)), f = this.initDrawContent, this.initDrawContent = null); - 2 == p || -1 == p && k > exchangeChart.gameTime || exchangeChart.addNewData({
                            time: k,
                            value: f
                        });
						
                        $("#lightBoxConfirm_price").text(h[e])
                    }
				}
                f = z[g];
				
				
                null != f && (f ? a.room_binary_price_list[d].binary_price_list && a.room_binary_price_list[d].binary_price_list[0] && (switchRoom(g, !0), h = prePriceArray[g] ? prePriceArray[g] : 0, f = a.room_binary_price_list[d].binary_price_list[0], k = f.slice(-2), e = f.substr(0, f.length - 2), k = $("#choices_" + g + " .list-item-price span.l").html(k).prop("outerHTML"), $("#choices_" + g + " .list-item-price .price").html(e + k), e = 0, 0 < h && (diff = f - h, e = (100 * diff).toFixed(4), $("#choices_" + g + " .list-item-updown").removeClass("up").removeClass("down").addClass(0 >
                    diff ? "down" : "up"), $("#choices_" + g + " .list-item-updown .number").html(e + "%")), prePriceArray[g] = f, getAllTradeBySelf(g)) : switchRoom(g, !1))
            }
            isPriceInfoInit = !0
        } else if("DrawLotteryResponse" == a.GetClassName)
		{	
			var drawresult;
			$.ajax({
				type: "POST",
				url: site_url + "/api/getgameresult",
				data: {game: a.draw_lottery_num},
				dataType: "json",
				cache: false,
				success: function(data)
				{
					console.log(data.result);
					drawresult = data.result;
						exchangeChart.addNewData({
					time: this.nextDrawTime,
					value: drawresult
				}, !0);
				exchangeChart.setGameLabel(MessageType.getText("current_settlement") + drawresult);
					
				}
			});
			
			r = null,  -1 == p && (p = -2);
		}
        else if ("UserBetResponse" == a.GetClassName)
            if (myUser.setBalance(a.balance), $("#wallet").text(myUser.getViewBalance()),
                a.is_success) {
                if (lightBox("#lightBoxSuccess"), $("form").trigger("reset"), r)
                    for (a = 0; a < r.length; a++)
                        if (r[a].room_id == b) {
                            r[a] = null;
                            break
                        }
            } else a = String.format(ErrorType.getText(a.error_id), a.error_param), showMessageBox(MessageType.getText("bet_failed"), a, {
                showCancel: !1
            });
        else "GetDrawLotteryHistoryResponse" != a.GetClassName && "GetBetHistoryResponse" == a.GetClassName && n(a)
    };
    setInterval(function() {
        if (myUser.isJoinRoom) {
            var a = new GetRoomInfoRequest;
            a.room_id = b;
            v.send(a);
            isPriceInfoInit && (a = new GetBinaryPriceInfoRequest,
                a.group_id = GROUP_ID, a.count = 1, v.send(a))
        }
    }, 1E3);
    this.afterGetRoomData = function(a) {
        $("#lightBoxConfirm_game").text(getLangRoomName(a.room_id, a.room_name));
        $("#lightBoxSuccess_game").text(getLangRoomName(a.room_id, a.room_name))
    };
    $("#lightBoxConfirm .btn-cancel").bind("click", function() {
        $("#Game_form").trigger("reset")
    });
    $("#lightBoxConfirm .btn-confirmss").bind("click", function() {
        var a = e(),
            c = [];
        $("#Game_form input[type=radio]:checked").each(function() {
            var b = $(this).attr("bet_value").split("_"),
                d = new BetData;
            d.bet_pattern_id = parseInt(b[0]);
            d.bet_balance = a;
            d.bet_pattern_content = b[1];
            c.push(d)
        });
		
        if (w(c)) {
            var l = new UserBetRequest;
            l.room_id = b;
            l.draw_lottery_id = B;
            l.bet_data_list = c;
            v.send(l);
			var amount = l.bet_data_list.bet_balance;
			var currentDrawLotteryNo = l.draw_lottery_id;
			var pattern1 = $("input[name=binary_playType_big_or_small]:checked").attr("bet_value");
			var pattern2 = $("input[name=binary_playType_single_or_double]:checked").attr("bet_value");
			$.ajax({
				type: "POST",
				url: site_url + "/api/placebet",
				data: {amount: bet_money, game: 700,draw_lottery_id: currentDrawLotteryNo, pattern1: pattern1, pattern2: pattern2},
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
            showWaitWindow()
        }
    });
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
	$("#btn-confirm-bet").on("click", function(){
		//let bet_money = getBetMoney()
		var a = e(),
            c = [];
         let bet_data_list = [];
        if ($("#Game_form input[type=radio]:checked").each((function() {
            let bet = $(this).attr("bet_value").split("_")
              , betData = new BetData;
            betData.bet_pattern_id = parseInt(bet[0]),
            betData.bet_balance = a,
            betData.bet_pattern_content = bet[1],
            bet_data_list.push(betData)
        }
        ))) {
            
            
			var amount = a;
			var pattern1 = $("input[name=binary_playType_big_or_small]:checked").attr("bet_value");
			var pattern2 = $("input[name=binary_playType_single_or_double]:checked").attr("bet_value");
			$.ajax({
				type: "POST",
				url: site_url + "/api/placebet",
				data: {amount: amount, game: 700,draw_lottery_id: INdraw_lottery_num, pattern1: pattern1, pattern2: pattern2},
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
	});
    $("#Game_form").submit(function(a, b) {
        var c = "",
            d = "",
            g = 0;
        $("#Game_form input[type=radio]:checked").each(function() {
            0 < c.length && (c += ",");
            0 < d.length && (d += ",");
            var a = getBetText(this.id, null, null);
            c += a[0];
            d += a[1];
            g++
        });
        $("#lightBoxConfirm_bet_patterns").text(c);
        $("#lightBoxConfirm_bet_rates").text(d);
        $("#lightBoxConfirm_bet_balance").text(e());
        $("#lightBoxSuccess_bet_patterns").text(c);
        $("#lightBoxSuccess_bet_balance").text(e() * g);
        lightBox("#lightBoxConfirm");
        return !1
    });
    $("#Game_form").on("reset", function() {
        $("#Game_form input[type=radio]").val(0)
    });
    var r = null;
    $("#openbettingrecord").bind("click", function() {
        $("#history_roomList option").each(function() {
            $thisObj = $(this);
            $thisObj.val() == b ? $thisObj.attr("selected", !0) : $thisObj.attr("selected", !1)
        });
        $("#history_form [name=stock-number]").val("");
        $("#history_form [name=start]").datepicker("setDate",
            "today");
        $("#history_form [name=end]").datepicker("setDate", "today");
        k()
    });
    $("#bettingrecord").bind("click", function() {
        var a = $("#history_roomList").val(),
            b = $("#history_form [name=stock-number]").val(),
            c = (new Date($("#history_form [name=start]").val() + "T00:00:00")).getTime(),
            e = (new Date($("#history_form [name=end]").val() + "T23:59:59")).getTime();
        t(a, 1, b, c, e)
    })
};

function getBetText(b, c, e) {
    b ? $input = $("#" + b) : 47 == c ? $input = $("#Game_form [bet_value=" + c + "_0]") : (e = e.split(","), $input = $("#Game_form [bet_value=" + c + "_" + e[0] + "]"));
    $label = $input.parent().children("[for=" + $input.attr("id") + "]");
    b = $label.children(".bet1").text();
    return [$label.text().replace(b, ""), b]
}

function switchRoom(b, c) {
    c ? ($("#choices_" + b + " .list-item-price").show(), $("#choices_" + b + " .list-item-updown").show(), $("#choices_" + b + " .list-item-close").hide()) : ($("#choices_" + b + " .list-item-price").text("--------"), $("#choices_" + b + " .list-item-updown").hide(), $("#choices_" + b + " .list-item-close").show())
}

function getLangRoomName(b, c) {
    return "undefined" == typeof lang || "undefined" == typeof roomNameList[b] ? c : roomNameList[b]
};