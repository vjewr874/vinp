var lang = {
	'zh_TW': '正體中文',
	'en_US': 'English(US)',
	'vi_VN': 'Tiếng Việt',
};
var roomNameList = {
	'zh_TW': {
		'700': "比特幣/美金",
		'701': "以太幣/美金",
		'702': "英鎊/美金",
		'703': "歐元/美金",
		'704': "美金/日圓",
		'705': "美金/瑞士法郎",
		'706': "美金/盧布",
		'710': "黃金",
		'711': "白銀",
		'712': "鉑",
		'713': "鎳",
		'714': "錫",
		'715': "銅",
		'716': "鋁",
		'717': "鋅"
	},
	'en_US': {
		'700': "BTC/USD",
		'701': "ETH/USD",
		'702': "GBP/USD",
		'703': "EUR/USD",
		'704': "USD/JPY",
		'705': "USD/CHF",
		'706': "USD/RUB",
		'710': "Gold",
		'711': "Silver",
		'712': "Platinum",
		'713': "Nickel",
		'714': "Tin",
		'715': "Copper",
		'716': "Aluminum",
		'717': "Zinc"
	},
	'vi_VN': {
		'700': "BTC/USD",
		'701': "ETH/USD",
		'702': "GBP/USD",
		'703': "EUR/USD",
		'704': "USD/JPY",
		'705': "USD/CHF",
		'706': "USD/RUB",
		'710': "Gold",
		'711': "Silver",
		'712': "Platinum",
		'713': "Nickel",
		'714': "Tin",
		'715': "Copper",
		'716': "Aluminum",
		'717': "Zinc"
	},
};
var nowLang = "";
if (typeof lang != "undefined") {
	Object.keys(lang).forEach(key => {
		// console.log(key, lang[key]);
		// console.log(window.location.href.indexOf(key.toString()));
		if (window.location.href.indexOf(key.toString()) > 0) {
			// console.log(window.location.href.indexOf(key.toString()));
			nowLang = key;
		}
	});
}
if(nowLang == ""){
	nowLang = "vi_VN";
}