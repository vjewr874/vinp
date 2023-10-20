var BetPatternDataList = function(d) {
    this.bet_pattern_data_list = d;
    this.getPayRate = function(d, b, e) {
        e = void 0 === e ? 2 : e;
        for (var a = 0; a < this.bet_pattern_data_list.length; a++) {
            var f = this.bet_pattern_data_list[a];
			
            if (f.bet_pattern_id == d)
                for (var h = 0; h < f.pay_table_data_list.length; h++) {
                    var c = f.pay_table_data_list[h];
                    if (!(0 <= c.pay_value || 0 <= b) || c.pay_value == b)
                        return parseFloat(c.pay_rate).toFixed(e)
                }
        }
        return 0
    }
    ;
    this.getBetNumberLimit = function(d) {
        for (var b = 0; b < this.bet_pattern_data_list.length; b++) {
            var e = this.bet_pattern_data_list[b];
            if (e.bet_pattern_id == d)
                return [parseInt(e.limit_rank_count_min), parseInt(e.limit_rank_count_max), parseInt(e.limit_rank_number_count_min), parseInt(e.limit_rank_number_count_max)]
        }
        return [-1, -1, -1, -1]
    }
    ;
    this.getBetBalanceLimit = function(d) {
        for (var b = 0; b < this.bet_pattern_data_list.length; b++) {
            var e = this.bet_pattern_data_list[b];
            if (e.bet_pattern_id == d)
                return {
                    min: parseInt(e.limit_bet_balance_min),
                    max: parseInt(e.limit_bet_balance_max)
                }
        }
        return {
            min: -1,
            max: -1
        }
    }
}
  , DrawLotteryHistoryList = function(d, h) {
    this.getBigSmallValue = function(g, a) {
        return g > a ? 1 : 2
    }
    ;
    this.getOddEvenValue = function(g) {
        return 0 == g % 2 ? 2 : 1
    }
    ;
    var b = $.extend({
        max_rank: 10,
        min_select_num: 0,
        max_select_num: 9,
        miss_count_limits: [100],
        get_bigSmall_fun: this.getBigSmallValue,
        get_oddEven_fun: this.getOddEvenValue,
        closer_num_count: null,
        closer_compareLo_fun: function(g) {
            return [g.lottery - b.min_select_num]
        }
    }, h || {});
    b.closer_num_count || (b.closer_num_count = b.max_select_num - b.min_select_num);
    var e = this
      , a = Math.floor(b.max_select_num / 2)
      , f = function(g) {
        this.lottery = g;
        this.bigSmall = b.get_bigSmall_fun(g, a);
        this.oddEven = b.get_oddEven_fun(g)
    }
      , k = function(g) {
        var a = g.draw_lottery_content.split(",");
        g.lotteryList = [];
        for (var b = 0; b < a.length; b++)
            g.lotteryList[b] = new f(a[b]);
        g.isInit = !0;
        return g
    };
    this.getHistoryListCount = function() {
        return d.length
    }
    ;
    this.getHistory = function(g) {
        if (d.length <= g)
            return null;
        var a = d[g];
        a && !a.isInit && (a = k(a),
        d[g] = a);
        return a
    }
    ;
    this.addHistory = function(g, a) {
        g = {
            draw_lottery_content: g,
            draw_lottery_num: a
        };
        return 0 < d.length && d[0].draw_lottery_num != a ? (g = k(g),
        d.unshift(g),
        q(g),
        r(),
        g) : null
    }
    ;
    var c = null
      , l = null
      , m = function() {
        c = [];
        for (var a = 0; a < b.max_rank; a++)
            c.push([]);
        l = [];
        for (a = e.getHistoryListCount() - 1; 0 <= a; a--) {
            var d = e.getHistory(a);
            q(d)
        }
    }
      , q = function(a) {
        if (c) {
            for (var g = 0; g < a.lotteryList.length; g++)
                c[g].push(a.lotteryList[g]);
            l.push(a.draw_lottery_num)
        }
    };
    this.getHistoryRankArray = function() {
        c || m();
        return c
    }
    ;
    this.getDrawLotteryNumList = function() {
        c || m();
        return l
    }
    ;
    this.getHistoryArrayByRank = function(a) {
        c || m();
        return c.length <= a ? null : c[a]
    }
    ;
    var n = null
      , p = null
      , r = function() {
        n = [];
        p = [];
        for (var a = 0; a < b.miss_count_limits.length; a++) {
            var d = b.miss_count_limits[a];
            n[a] = {
                limit_count: d,
                valueArray: []
            };
            p[a] = {
                limit_count: d,
                valueArray: []
            };
            d = [];
            for (var c = 0; c < b.max_rank; c++) {
                n[a].valueArray[c] = [];
                p[a].valueArray[c] = [];
                d[c] = [];
                for (var f = 0; f <= b.closer_num_count; f++)
                    n[a].valueArray[c].push(0),
                    p[a].valueArray[c].push(0),
                    d[c].push(0)
            }
        }
        for (a = 0; a < e.getHistoryListCount(); a++)
            for (c = e.getHistory(a),
            f = 0; f < c.lotteryList.length; f++) {
                for (var h = b.closer_compareLo_fun(c.lotteryList[f]), k = 0; k < b.miss_count_limits.length; k++)
                    if (a < p[k].limit_count)
                        for (var l = 0; l < h.length; l++)
                            p[k].valueArray[f][h[l]]++;
                for (k = 0; k < d[f].length; k++)
                    if (!d[f][k])
                        for (l = 0; l < h.length; l++)
                            if (k != h[l])
                                for (var m = 0; m < b.miss_count_limits.length; m++)
                                    a < n[m].limit_count && n[m].valueArray[f][k]++;
                            else
                                d[f][k] = 1
            }
    };
    this.getMissCountArray = function(a) {
        a = void 0 === a ? 100 : a;
        n || r();
        for (var c = 0; c < b.miss_count_limits.length; c++)
            if (a == p[c].limit_count)
                return {
                    closer: p[c].valueArray,
                    missCount: n[c].valueArray
                };
        return null
    }
};
AnalysisCell = {
    detailAnalysisCell: function(d, h, b, e, a, f, k, c) {
        var l = h[d];
        if (0 < d && f(l, h[d - 1]))
            if (0 <= a.LastColIdx)
                a.ColIdx++;
            else {
                a.RowIdx++;
                h = !1;
                if (a.RowIdx < c && e.length > a.RowIdx)
                    for (f = 0; f < e[a.RowIdx].length; f++)
                        if (e[a.RowIdx][f].col == a.ColIdx) {
                            h = !0;
                            break
                        }
                if (h || a.RowIdx >= c)
                    0 > a.LastColIdx && (a.LastColIdx = a.ColIdx),
                    a.RowIdx--,
                    a.ColIdx++
            }
        else
            0 <= a.LastColIdx && (0 < a.RowIdx && (a.ColIdx = a.LastColIdx),
            a.LastColIdx = -1),
            a.RowIdx = 0,
            a.ColIdx++;
        for (h = e.length; h < c; h++)
            e.push([]);
        d = {
            col: a.ColIdx,
            lo: l,
            getViewFun: k,
            draw_lottery_num: b[d],
            group: 0 <= a.LastColIdx ? a.LastColIdx : a.ColIdx
        };
        e[a.RowIdx].push(d);
        a.MaxColIdx < a.ColIdx && (a.MaxColIdx = a.ColIdx);
        return d
    },
    analysisCell: function(d, h, b, e) {
        b || (b = {
            checkEqualFun: [function(a, b) {
                return a.lottery == b.lottery
            }
            ],
            getViewFun: [function(a) {
                return a.lottery.toString()
            }
            ]
        });
        for (var a = new cAnalysisCell(b,e), f = 0; f < b.checkEqualFun.length; f++)
            a.resultArray[f] = [];
        for (f = 0; f < d.length; f++)
            for (var k = d[f], c = 0; c < b.checkEqualFun.length; c++) {
                var l = {
                    RowIdx: 0,
                    ColIdx: -1,
                    LastColIdx: -1,
                    MaxColIdx: -1
                };
                a.resultArray[c][f] = {
                    analysis: [],
                    cellObj: l
                };
                for (var m = 0; m < k.length; m++)
                    AnalysisCell.detailAnalysisCell(m, k, h, a.resultArray[c][f].analysis, l, b.checkEqualFun[c], b.getViewFun[c], e)
            }
        return a
    }
};
var cAnalysisCell = function(d, h) {
    this.resultArray = [];
    this.convertToFuns = d;
    this.cell_max_row = h;
    this.addAnalysisCell = function(b, d) {
        for (var a = 0; a < this.resultArray.length; a++)
            for (var f = this.resultArray[a], e = 0; e < b.length; e++) {
                var c = f[e].cellObj
                  , h = f[e].analysis[c.RowIdx];
                AnalysisCell.detailAnalysisCell(1, [h[h.length - 1].lo, b[e]], ["", d], this.resultArray[a][e].analysis, c, this.convertToFuns.checkEqualFun[a], this.convertToFuns.getViewFun[a], this.cell_max_row)
            }
    }
};
