MessageType = {
	getText: function (a) {
		switch (a) {
			case 'relogin_message':
				return "Xin vui lòng đăng nhập"; //請返回平台重新登人
			case 'exceed_max_connetion':
				return "Tiếp cận kết nối Max."; //已超出最大連線數
			case 'betting':
				return "Đặt lệnh ..."; //下注中...
			case 'current_settlement':
				return "Giải quyết hiện tại"; //本期結算
			case 'sec':
				return "Chia ra"; //秒
			case 'bet_failed':
				return "Đặt lệnh thất bại"; //投注失敗
			case 'no_data':
				return "Không kết quả"; //找不到資料
			case 'bet_num':
				return "Số sê-ri"; //交易編號
			case 'trade_time':
				return "Thời gian"; //交易時間
			case 'draw_lottery_num':
				return "Không."; //期號
			case 'content':
				return "Nội dung"; //內容
			case 'pay_rate':
				return "Odds "; //賠率
			case 'rate':
				return "Tỷ giá"; //匯率
			case 'result':
				return "Kết quả"; //結果
			case 'amount':
				return "Số tiền"; //交易金額
			case 'my_result':
				return "Kết quả của tôi"; //交易結果
			case 'network_fail':
				return "Mạng thất bại"; //網路錯誤
			case 'end_of_purchase':
				return "Kết thúc mua hàng"; //結束購買
			case 'countdown':
				return "Đếm ngược."; //本期倒數
			case 'rise':
				return "Mua vào"; //高標
			case 'fall':
				return "Bán ra"; //低標
			case 'odd':
				return "Đơn"; //奇數
			case 'even':
				return "Đôi"; //偶數
			case 'up':
				return "Mua vào"; //漲
			case 'down':
				return "Bán ra"; //跌
			case 'not_same':
				return "Không giống"; //非平盤
		}
		return a
	},
	getRoomNameList: function() {
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
};