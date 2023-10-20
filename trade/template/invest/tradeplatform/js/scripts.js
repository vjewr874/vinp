var loading = '<div class="loading"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';

function tozero(numA) {
    return parseInt(numA.text()) < 10 && numA.text(0 + numA.text()), numA.text()
}
$("span.icon-undo").click((function() {
    $(this).parents(".tap-content").append(loading)
}));
var betPatternList = {
        1e5: "100K",
        25e4: "250K",
        5e5: "500K",
        1e6: "1000K",
        2e6: "2000K",
        3e6: "3000K",
        5e6: "5000K",
        1e7: "10M",
        2e7: "20M",
        3e7: "30M",
        5e7: "50M",
        1e8: "100M",
        2e8: "200M",
        3e8: "300M",
        5e8: "500M",
        1e9: "1000M"
    },
    exchangeChart;

function font_s(e, f_zoom) {
    var $this = $(e).parent().parent().parent().parent().find("table"),
        fz = parseInt($this.css("font-size"));
    "add" == f_zoom ? fz++ : fz--, $this.css("font-size", fz + "px")
}

function myrefresh() {
    window.location.reload()
}
$(document).ready((function() {
    $(".list-item").click((function() {
        $(".list-item").removeClass("active"), $(this).addClass("active")
    })), $(".nav-tab>li").click((function() {
        $(this).parent().children().removeClass("active"), $(this).addClass("active");
        var tab_tar = $(this).data("tabs");
        $(this).parent().siblings($(".block")).find($(".tab-pane")).removeClass("active"), $(tab_tar).addClass("active")
    })), $("#Game_form input[type=radio]").bind("click", (function() {
        $thisObj = $(this), 1 == $thisObj.val() ? ($thisObj.prop("checked", !1), $thisObj.val(0)) : ($("#Game_form input[type=radio][name=" + $thisObj.attr("name") + "]").val(0), $thisObj.val(1))
    }));
    var room_id = $.urlParam("game");
    $('.list-item[game="' + room_id + '"]').addClass("active");
    var c_title = $('.list-item[game="' + room_id + '"]').children(".list-item-name").text();
    exchangeChart = new ExchangeChart(c_title);
    let datepickersOpt = {
        autoclose: !0,
        format: "yyyy-mm-dd",
        startDate: "-90d",
        endDate: "0d"
    };
    if ($("#history_form [name=start]").datepicker(datepickersOpt).datepicker("setDate", "today").on("changeDate", (function(e) {
            if (!e.date) return;
            let startDate = e.date,
                endDate;
            new Date($("#history_form [name=end]").val()).getTime() < startDate.getTime() && $("#history_form [name=end]").datepicker("setDate", startDate)
        })), $("#history_form [name=end]").datepicker(datepickersOpt).datepicker("setDate", "today").on("changeDate", (function(e) {
            if (!e.date) return;
            let endDate = e.date,
                startDate = new Date($("#history_form [name=start]").val());
            endDate.getTime() < startDate.getTime() && $("#history_form [name=start]").datepicker("setDate", endDate)
        })), void 0 !== betPatternList) {
        let optionTemplate = new $($("#Game_form select option")[0]);
        $("#Game_form select option").remove(), $("#Game_form select").append(optionTemplate), Object.keys(betPatternList).forEach(key => {
            $("#Game_form select").append("<option value='" + key + "'>" + betPatternList[key] + "</option>")
        })
    }
})), $("#table-arrow").click((function() {
    var $this = $(this).parent().parent().parent().parent().find("table");
    $this.hasClass("mode1") ? $this.removeClass("mode1") : $this.addClass("mode1")
}));
var temp = "";

function lightBox(light1) {
    $(".lightBox").addClass("active"), $(".lightBox-panel").removeClass("active"), $(light1).addClass("active")
}

function lightBoxClose() {
    $(".lightBox , .lightBox-panel").removeClass("active")
}
$(".fullScreen input").click((function() {
    var se = $(this).parents(".section");
    1 == $(this).prop("checked") ? (temp = se.parent().prop("class"), $(".section").addClass("hide"), se.removeClass("hide"), se.parent().prop("class", "col-md-12 full")) : (se.parent().removeClass("full"), $(".section").removeClass("hide"), se.parent().removeClass("col-md-12").addClass(temp))
})), $(".lightBox-close , .lightbox-black").click((function() {
    $(".lightBox-panel.not_auto_close.active").length > 0 || lightBoxClose()
}));
var ExchangeChart = function(c_title) {
    $("#game-name").html(c_title);
    var arr = [];
    this.tmp = {}, this.startTime = 0, this.stopTime = 0, this.gameTime = 0;
    var padding = -9e4,
        nowTime = 0,
        padding = -11e4,
        labelSize = 11,
        labelPad = 29,
        labelPad2 = -44,
        timeFormat = "MM/DD/YYYY HH:mm",
        chart = null,
        ctx = null;
    this.gameLabelText = "";
    var thisObj = this,
        refresh, config = {
            type: "line",
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
                    data: arr
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
                    enabled: !0,
                    mode: "index",
                    animationDuration: 0
                },
                scales: {
                    xAxes: [{
                        type: "realtime",
                        fontColor: "#ffffff",
                        realtime: {
                            duration: 18e4,
                            refresh: 100,
                            delay: -11e4,
                            ttl: 50,
                            onRefresh: function(chart) {
                                onRefresh(chart, thisObj)
                            }
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
                            fontColor: "rgba(199, 199, 199, 1)"
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
                        x: -11e4
                    },
                    onPan: function(e) {
                        arr.length > 0 && (chart.options.pan.rangeMax.x = arr.slice(-1)[0].x - arr[0].x - 11e4)
                    }
                },
                zoom: {
                    enabled: !1,
					drag: !1,
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

    function onRefresh(chart, thisObj) {
        if (nowTime = 1e3 * Math.floor(Date.now() / 1e3), filter(chart, thisObj), arr.length > 0) {
            var meta = chart.getDatasetMeta(0),
                metaY = meta.data[meta.data.length - 1]._model;
            $(".now-data").css("top", metaY.y + 10);
            var last = arr[arr.length - 1].y;
            $(".now-data b").text(last.slice(0, -2)), $(".now-data i").text(last.slice(-2))
        } else $(".now-data").css("top", "-100%");
        var endLabel = chart.config.options.annotation.annotations[2].value,
            t = (thisObj.startTime - nowTime) / 1e3;
        t = 60 === t ? 0 : t;
        var cd = (thisObj.gameTime - nowTime) / 1e3;
        cd = cd < 0 ? 0 : cd, nowTime >= endLabel && addLabel(thisObj);
        var gameLabel = chart.config.options.annotation.annotations[3].value;
        $("#time").text(t), config.options.annotation.annotations[1].label.content = MessageType.getText("countdown") + thisObj.lastSeconds + " " + MessageType.getText("sec")
    }

    function addLabel(ec) {
        var length = config.options.annotation.annotations.length,
            startObj = {
                type: "line",
                drawTime: "afterDraw",
                mode: "vertical",
                scaleID: "x-axis-0",
                value: ec.startTime,
                borderColor: "rgba(116, 116, 116, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(0, 0, 0, 0.6)",
                    content: MessageType.getText("end_of_purchase"),
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
                value: ec.stopTime,
                borderColor: "rgba(136, 136, 136, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(0, 0, 0, 0.6)",
                    content: MessageType.getText("countdown"),
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
                xMin: ec.startTime + 50,
                xMax: ec.stopTime - 50,
                backgroundColor: "rgba(33, 95, 158, 0.1)",
                borderWidth: 0
            },
            gameObj = {
                type: "line",
                drawTime: "afterDraw",
                mode: "vertical",
                scaleID: "x-axis-0",
                value: ec.gameTime,
                borderColor: "rgba(116, 116, 116, 1)",
                borderWidth: 2,
                label: {
                    backgroundColor: "rgba(40, 145, 189, 0.5)",
                    content: ec.gameLabelText,
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
        }), 1e4)
    }
    this.setStartTime = function(time) {
        this.startTime = time, addLabel(this)
    }, this.setStopTime = function(time) {
        this.stopTime = time, addLabel(this)
    }, this.setGameTime = function(time) {
        this.gameTime = time, addLabel(this)
    }, this.setGameLabel = function(str) {
        this.gameLabelText = str, config.options.annotation.annotations[3].label.content = str
    };
    var gradientFill = function(canvas, height) {
        var bgc = canvas.createLinearGradient(0, 0, 0, height - 50);
        bgc.addColorStop(0, "rgba(39, 144, 210, 0.5)"), bgc.addColorStop(.8, "rgba(39, 144, 210, 0.1)"), bgc.addColorStop(.95, "rgba(39, 144, 210, 0.025)"), bgc.addColorStop(1, "rgba(39, 144, 210, 0)"), config.data.datasets[0].backgroundColor = bgc
    };
    ctx = $("#chart-views").get(0).getContext("2d"), chart = new Chart(ctx, config), addLabel(this), $(window).on("resize", (function() {
        var h = $("#chart-views").height();
        gradientFill(ctx, h)
    })).resize()
};
ExchangeChart.prototype.init = function(datas) {
    console.log(datas);
    for (var i = 0; i < datas.length; i++) this.addNewData(datas[i])
}, ExchangeChart.prototype.resize = function() {}, ExchangeChart.prototype.chart_scale = function(e) {}, ExchangeChart.prototype.addBuyValue = function(value) {
    var item = {
        yAxis: value,
        label: {
            show: !0,
            position: "end",
            rotate: 180,
            color: "red",
            fontSize: 14,
            padding: 5
        },
        lineStyle: {
            type: "dashed",
            color: "red"
        }
    };
    this.markline_data.push(item)
}, ExchangeChart.prototype.addNewData = function(data, force = !1) {
    timestamp = 1e3 * moment(data.time).format("X"), !force && this.tmp[timestamp] || (this.tmp[timestamp] = data.value)
}, ExchangeChart.prototype.setLastSeconds = function(lastSeconds) {
    this.lastSeconds = lastSeconds
};