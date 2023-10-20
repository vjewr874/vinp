var site_url = "https://investpro.asia/trade";
var myChart;
var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
const btcData = async () => {
  const response = await fetch('https://investpro.asia/trade/api/randdata');
  const json = await response.json();
  const data = json.data
  const times = data.map(obj => obj.time)
  const prices = data.map(obj => obj.price)
  return {
    times,
    prices
  }
}
function randomScalingFactor() {
	
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
	//let { times, prices } = await btcData()
	//return prices;
}
function pushdataapi()
{
	var val;
	$.ajax({
				type: "GET",
				url: site_url + "/api/randdata",
				data: {},
				dataType: "json",
				cache: false,
				success: function(data)
				{
					val =  data;
				}
			});
	return val;
}

function onReceive(event) {
	myChart.data.datasets[event.index].data.push({
		x: event.timestamp,
		y: event.value
	});
	myChart.update({
		preservation: true
	});
}

var timeoutIDs = [];
var gameStatus = 0;
function startFeed(index) {
	var rd = randomScalingFactor();
	console.log(rd);
	var receive = function() {
		onReceive({
			index: index,
			timestamp: Date.now(),
			value: rd
		});
		timeoutIDs[index] = setTimeout(receive, Math.random() * 1000 + 500);
	};
	timeoutIDs[index] = setTimeout(receive, Math.random() * 1000 + 500);
}
 function getRoomNameList(roomid) {
        return {
            700: "BTC/USD",
            701: "ETH/USD",
            702: "GBP/USD",
            703: "EUR/USD",
            704: "USD/JPY",
            705: "USD/CHF",
            706: "USD/RUB",
            710: "v\u00e0ng",
            711: "b\u1ea1c",
            712: "b\u1ea1ch kim",
            713: "niken",
            714: "thi\u1ebfc",
            715: "\u0111\u1ed3ng",
            716: "nh\u00f4m",
            717: "K\u1ebdm"
        }
    }
function stopFeed(index) {
	clearTimeout(timeoutIDs[index]);
}
var startTime = 0, stopTime = 0, gameTime = 0;
var gameLabel = "";
var gameID = "700";
var gameName = "BTC/USD";
roomNameList = getRoomNameList();
//$("#lightBoxConfirm_game").html(gameName);
var padding = -9e4,
nowTime = 0,
padding = -11e4,
labelSize = 11,
labelPad = 29,
labelPad2 = -44,
timeFormat = "MM/DD/YYYY HH:mm",
chart = null,
ctx = null;
var color = Chart.helpers.color;
var setStartTime = function(time) {
	startTime = time, addLabel(this)
};
var setStopTime = function(time) {
	stopTime = time, addLabel(this)
};
var setGameTime = function(time) {
	gameTime = time, addLabel(this)
}; 
var setGameLabel = function(str) 
{
	gameLabelText = str, config.options.annotation.annotations[3].label.content = str
};
var pricearr = [];
var config = {
	type: 'line',
	data: {
		datasets: [{
                    label: "chart",
                    backgroundColor: "",
                    borderWidth: 1,
                    borderColor: "rgba(255, 255, 255, 1)",
                    pointRadius: 0,
                    lineTension: .1,
                    fill: !0,
                    cubicInterpolationMode: "monotone",
                    data: []
                }]
	},
	options: {
		title: {
			display: !1
		},
		maintainAspectRatio: !1,
		legend: {
			display: !1
		},
		tooltips: {
			enabled: !1
		},
		hover: {
			intersect: !1,
			enabled: 0,
			mode: "index",
			animationDuration: 0
		},
		scales: {
			xAxes: [
			{
				type: "realtime",
				fontColor: "#ffffff",
				realtime: {
					duration: 18e4,
					refresh: 100,
					pause: false,
					delay: -11e4,
					ttl: 1644463304,
					onRefresh: onRefresh
				},
				time: {
					minUnit: "millisecond",
					displayFormats: {
						millisecond: "HH:mm:ss.SSS",
						second: "HH:mm:ss",
						minute: "HH:mm:ss",
						hour: "hA",
						day: "MMM D",
						week: "ll",
						month: "MMM YYYY",
						quarter: "[Q]Q - YYYY",
						year: "YYYY"
					}
				},
				gridLines: {
					color: "rgba(102, 175, 218, 0.3)",
					zeroLineColor: "rgba(47, 48, 53, 1)",
					drawBorder: !0,
					lineWidth: 1
				},
				ticks: {
					fontColor: "rgba(199, 199, 199, 1)",
					beginAtZero: true
				}
			}],
			yAxes: [{
                        type: "linear",
                        display: !0,
                        position: "right",
                        gridLines: {
                            color: "rgba(102, 175, 218, 0.3)",
                            zeroLineColor: "rgba(47, 48, 53, 1)",
                            drawBorder: !0,
                            lineWidth: 1,
                            offsetGridLines: !0
                        },
                        scaleLabel: {
                            display: !1
                        },
                        ticks: {
                            fontColor: "rgba(199, 199, 199, 1)"
                        }
                    }]
		},
        pan: {
			enabled: !0,
			mode: "x",
			rangeMax: {
				x: 36e5
			},
			rangeMin: {
				x: -1644463304
			},
			onPan: function(e) {
				var times = new Date(pricearr[0].x).getTime();
				var timee = new Date(pricearr.slice(-1)[0].x).getTime();
				
				pricearr.length > 0 && (config.options.pan.rangeMax.x = timee - times - 11e4)
			}
		},
		zoom: {
			enabled: !1
		},
		annotation: {
			events: ["click"],
			dblClickSpeed: 350,
			annotations: []
		}
	}
};
function filter(chart, thisObj) {
        var zone = chart.scales["x-axis-0"].max - chart.scales["x-axis-0"].min;
        arr = [];
        var avg = 200;
        step = 1e3 * (Math.floor(zone / 1e3 / 200) || 1);
        for (var min = Math.floor(chart.scales["x-axis-0"].min / step) * step, i = 0; i <= 200; i++) {
            var key = 1e3 * Math.floor(min / 1e3) + i * step;
            thisObj.tmp[key] && arr.push({
                x: key,
                y: thisObj.tmp[key]
            })
        }
        config.data.datasets[0].data = arr, chart.update({
            duration: 0
        })
    }
	function isDateInArray(needle, haystack) {
	  for (var i = 0; i < haystack.length; i++) {
		if (needle === haystack[i]["x"]) {
		  return true;
		}
	  }
	  return false;
	}
	
	var lastSeconds = 60;
	var counttest = 0;
function onRefresh(chart) {
	var zone = chart.scales["x-axis-0"].max - chart.scales["x-axis-0"].min;
	arr = [];
	var avg = 200;
	step = 1e3 * (Math.floor(zone / 1e3 / 200) || 1);
	
	
	/*
	config.data.datasets[0].data.push({
			x: rdata.time,
			y: rdata.price
		});
		*/
		config.data.datasets[0].data = pricearr;
		chart.update({
		duration: 0
	})
	var meta = myChart.getDatasetMeta(0);
	if(meta.data.length>0)
	{
		
		metaY = meta.data[meta.data.length-1]._model;
		$(".now-data").css("top", metaY.y + 10);
		
		t = (startTime - nowTime) / 1e3;
		t = 60 === t ? 0 : t;
		
		
		/*
		var endLabel = chart.config.options.annotation.annotations[2].value,
		
		var gameLabel = chart.config.options.annotation.annotations[3].value;
		*/
		$("#time").text(t), config.options.annotation.annotations[1].label.content = "Đếm ngược" + lastSeconds + " " + "giây"
	}
    
    
}
function showReLoginWindow(url) {
		showMessageBox(MessageType.getText("relogin_message"), "", {
			showCancel: !1
		}, function() {
			window.location = url;
			setTimeout(function() {
				showReLoginWindow()
			}, 500)
		})
		
	}
function updatecountdown(time)
{
	
	$('#countdown').countdown(time, function(event) {
	  $(this).html(event.strftime('%H:%M:%S'));
	});
}
function updatechart()
{
	setInterval(function () {
		config.data.datasets[0].data = pricearr;
		myChart.update({
						duration: 0
					})
	},100);
}
setInterval(function () {
	$.ajax({
		type: "GET",
		url: site_url + "/api/symboldata",
		data: {},
		dataType: "json",
		cache: false,
		success: function(rdata)
		{
			//console.log(rdata);
			var symbols = rdata.symbols;
			$.each( symbols, function( i, l ){
				var s = l.symbol;
				var n = l.name;
				
				var pricedata = l.data;
				var price = pricedata.price.toString();
				$("#price_" + s).text(price.slice(0, -2));
				$("#l_" + s).text(price.slice(-2));
				$(".num_change_" + s).text(pricedata.change + "%");
				$(".change_" + s).removeClass("up down").addClass(pricedata.changeflag);
				if(pricedata.drawdata == true)
				{
					//getAllTradeBySelf(n,pricedata.rsa,price);
				}
			});
		}
	});
}, 1000);
function drawlog()
{	
	$.ajax({
		type: "POST",
		url: site_url + "/api/drawdata",
		data: {},
		dataType: "json",
		cache: false,
		success: function(data)
		{
			$("#log-draw").html(data.data);
			//$("#wallets").html(data.balance);
			
		}
	});
}
function joingame()
{
	var gameid = $("#set_game_id").val();
	$.ajax({
		type: "GET",
		url: site_url + "/api/joingame",
		data: {gameid : gameid},
		dataType: "json",
		cache: false,
		success: function(rdata)
		{
			//console.log(rdata);
			var prices = rdata.data;
			
			$.each( prices, function( i, l ){
				if (!isDateInArray(l.time, pricearr)) {
					pricearr.push({
						x: l.time,
						y: l.price
					});
				  }
				  var last = l.price.toString();
				 
			});
			config.data.datasets[0].data = pricearr;
			
			gameStatus = 1;
			setStartTime(rdata.startTime);
			stopTime = rdata.endTime;
			gameTime = rdata.gameTime ;
			gameLabel = "Tỷ giá hối đoái hiện tại: " + rdata.drawprice;
			addLabel(startTime,stopTime,gameTime,gameLabel);
		}
	});
}
joingame();
function getlistbet()
{
	
			
		var lastid = $("#lastid").val();
		$.ajax({
			type: "POST",
			url: site_url + "/api/getlistbet",
			data: {},
			dataType: "json",
			cache: false,
			success: function(data)
			{
				
				$("#listbet").html(data.data);
				$("#wallets").html(data.balance);
				if(data.relogin == true)
				{
					
					showReLoginWindow(data.login_url);
				}
			}
		});
	
}
getlistbet();

setInterval(function() {
	getlistbet();
	}, 5 * 1000);

setInterval(function () {
	if(gameStatus == 1)
	{
		var gameid = $("#set_game_id").val();
		$.ajax({
			type: "GET",
			url: site_url + "/api/pricedata",
			data: {gameid : gameid},
			dataType: "json",
			cache: false,
			success: function(rdata)
			{
				//console.log(rdata);
				if (!isDateInArray(rdata.time, pricearr)) {
					pricearr.push({
						x: rdata.time,
						y: rdata.price
					});
				  }
				 var last = rdata.price.toString();
				 
				 if(pricearr.length >= 120)
				 {
					 //pricearr = pricearr.slice(-120);
				 }
				 //console.log(pricearr);
				 $("#lightBoxConfirm_price").html(rdata.price);
				$(".now-data b").text(last.slice(0, -2)), $(".now-data i").text(last.slice(-2));
				//$("#price_700").text(last.slice(0, -2));
				//$("#l_700").text(last.slice(-2));
				$("#gameid").text(rdata.draw_id);
				$("#current_draw_game").val(rdata.draw_id);
				//$(".num_change_700").text(rdata.change + "%");
				//$(".change_700").removeClass("up down").addClass(rdata.changeflag);
				$("#countdown").html(rdata.countdowntime);
				if(rdata.countdown == true)
				{
					
				}
				if(rdata.newdraw == true)
				{
					setStartTime(rdata.startTime);
					stopTime = rdata.endTime;
					//gameLabel = "Giải quyết hiện tại";
					gameTime = rdata.gameTime ;
					addLabel(startTime,stopTime,gameTime,gameLabel);
					
				}
				if(rdata.game_result == true)
				{
					gameLabel = "Tỷ giá hoản đổi hiện hành: " + last.slice(-5);
					addLabel(startTime,stopTime,gameTime,gameLabel);
					drawlog();
					getlistbet();
				}
				nowTime = rdata.nowtime;
				lastSeconds = rdata.lastSeconds;
				$("#now_datetime").text(nowTime);
				var cd = (gameTime - nowTime) / 1e3;
				var endLabel = rdata.stopTime;
				cd = cd < 0 ? 0 : cd, nowTime >= endLabel && addLabel(startTime,stopTime,gameTime,gameLabel);
			}
		});
	}
}, 1000);
function addLabel(st,et,gt,gl) {
        var length = config.options.annotation.annotations.length,
            startObj = {
                type: "line",
                drawTime: "afterDraw",
                mode: "vertical",
                scaleID: "x-axis-0",
                value: st,
                borderColor: "rgba(116, 116, 116, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(0, 0, 0, 0.6)",
                    content: "Kết thúc mua hàng",
                    fontStyle: "normal",
                    fonnColor: "#8ba4c2",
                    fontSize: 11,
                    xAdjust: 29,
                    cornerRadius: 0,
                    position: "top",
                    enabled: !0
                }
            },
            stopObj = {
                type: "line",
                drawTime: "afterDraw",
                mode: "vertical",
                scaleID: "x-axis-0",
                value: et,
                borderColor: "rgba(136, 136, 136, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(0, 0, 0, 0.6)",
                    content: "Đếm ngược",
                    fontStyle: "normal",
                    fonnColor: "#8ba4c2",
                    fontSize: 11,
                    xAdjust: -44,
                    cornerRadius: 0,
                    position: "top",
                    enabled: !0
                }
            },
            boxObj = {
                type: "box",
                drawTime: "afterDraw",
                xScaleID: "x-axis-0",
                xMin: st,
                xMax: et,
                backgroundColor: "rgba(33, 95, 158, 0.1)",
                borderWidth: 0
            },
            gameObj = {
                type: "line",
                drawTime: "afterDraw",
                mode: "vertical",
                scaleID: "x-axis-0",
                value: gt,
                borderColor: "rgba(116, 116, 116, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(40, 145, 189, 0.5)",
                    content: gl,
                    fontStyle: "normal",
                    fonnColor: "#8ba4c2",
                    fontSize: 11,
                    cornerRadius: 0,
                    position: "bottom",
                    enabled: !0
                }
            };
        config.options.annotation.annotations.splice(0, 1, boxObj), config.options.annotation.annotations.splice(1, 1, stopObj), config.options.annotation.annotations.splice(2, 1, startObj), config.options.annotation.annotations.splice(3, 1, gameObj), length > 4 && setTimeout((function() {
            config.options.annotation.annotations.splice(4, length - 4)
        }), 1e4);
	
    }
	
var gradientFill = function(canvas, height) {
        var bgc = canvas.createLinearGradient(0, 0, 0, height - 10);
        bgc.addColorStop(0, "rgba(39, 144, 210, 0.5)"), bgc.addColorStop(.8, "rgba(39, 144, 210, 0.1)"), bgc.addColorStop(.95, "rgba(39, 144, 210, 0.025)"), bgc.addColorStop(1, "rgba(39, 144, 210, 0)"), config.data.datasets[0].backgroundColor = bgc
    };
window.onload = function() {
	
	var ctx = document.getElementById('chart-view').getContext('2d');
	myChart = new Chart(ctx, config);
	addLabel(startTime,stopTime,gameTime,gameLabel);
	updatechart();
	$(window).on("resize", (function() {
        var h = $("#chart-view").height();
        gradientFill(ctx, h)
    })).resize();
	drawlog();
	//startFeed(0);
	//startFeed(1);
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
function lightBox(light1) {
    $(".lightBox").addClass("active"), $(".lightBox-panel").removeClass("active"), $(light1).addClass("active")
}

function lightBoxClose() {
    $(".lightBox , .lightBox-panel").removeClass("active")
}
function hideMessageBox() {
    lightBoxClose()
}
$(".lightBox-close , .lightbox-black").click((function() {
    $(".lightBox-panel.not_auto_close.active").length > 0 || lightBoxClose()
}));
function getLangRoomName(b, c) {
    return "undefined" == typeof lang || "undefined" == typeof roomNameList[b] ? c : roomNameList[b]
};
var colorNames = Object.keys(chartColors);
$(".item").on("click",function(){
	var item = $(this);
	gameID = item.attr("data-id");
	var ckey = $("#_ckey").val();
	//alert(ckey);
	window.location = site_url + "/?_ckey=" + ckey + "&symbol=" + gameID;
	gameName = item.attr("data-name");
	$("#set_game_id").val(gameID);
	$("#right_roomList").val(gameID);
	$(".list-item").removeClass("active");
	$("#choices_" + gameID).addClass("active");
	//$("#lightBoxConfirm_game").html(gameName);
});
var sideLogTemplate = $(".side-log-item")[0].outerHTML,
    getAllTradeBySelf = function(b,k,p) {
		
			
        var appearRate = .1;
        var maxCount = 10;
        var minCount = 1;
        var betBase = 100;
        var maxBet = 50;
        var minBet = 1;
		var e = (Math.floor(Math.random() * (maxBet - minBet)) + minBet) * betBase
			m = new Date;
		var t = {};
			t.price = p;
			t.time = m;
			t.roomName = b;
			t.type = k;
			t.bet = e;
			appendLogForStock_k($(".record-half2"), t)
		
		/*
		for (i = 1; i <= maxCount; i++) {
			
		}
        if ($(".record-half2").length && appearRate >= Math.random()) {
            var c = Math.floor(Math.random() * (maxCount - minCount)) + minCount;
            for (i = 1; i <= maxCount; i++) {
                var e = (Math.floor(Math.random() * (maxBet - minBet)) + minBet) * betBase,
                    k = Math.floor(2 * Math.random()) + 1,
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
		*/
    },
    appendLogForStock_k = function(b, c) {
        resultText = [MessageType.getText("up"), MessageType.getText("down")];
        resultList = ["result_up", "result_down"];
        var e = new Date(c.time);
        timeStr = e.getHours() + ":" + e.getMinutes() + ":" + e.getSeconds();
        $newBet = new $(sideLogTemplate);
        $newBet.children(".list-bet").children(".list-bet-time").children(".bet-time").html(getLangRoomName(c.roomName,
            c.roomName));
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-type").children(".bet-type").html(c.price);
			//resultText[c.type - 1]
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").html(resultText[c.type - 1]);
        $newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-updown").children(".bet-number").addClass(resultList[c.type - 1]);
        //$newBet.children(".list-bet").children(".list-bet-stat").children(".list-bet-price").children(".bet-price").html(Number(c.bet) + "M");
        $(b).append($newBet);
        nowLength = $(b).children().length;
        if (10 < nowLength)
            for (j = 1; j <= nowLength -
                10; j++) $(b).children()[1].remove()
    };