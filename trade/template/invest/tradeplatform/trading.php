<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Red+Hat+Text:400,500&display=swap" rel="stylesheet">
    <title>Issa Chart!</title>
	<style>
		///  Fonts  ///
h1 {
    font-size: 1.5em;
}

h2 {
    font-size: 1.25em;
}

h1, 
h2, 
p {
    font-family: 'Red Hat Text', sans-serif;
    color: #303030;
}

/// Card Container ///
.container {
    display: flex;
    justify-content: center;
}


/// Cards ///
cards {
    width: 90%;
    display: inline-flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
    padding-top: 30px;
    padding-bottom: 30px;
}

.btc,
.cosmos,
.ethereum {
    display: grid;
    max-width: 300px;
    min-width: 250px;
    grid-template-columns: 1fr;
    grid-template-rows: minmax(50px, 60px) 1fr;
    grid-template: 
        "info"
        "chart";
    border-radius: 30px;
}

.btc {
    box-shadow: 10px 10px 20px 1px rgba(247,147,26,.15);
}

.cosmos {
    box-shadow: 10px 10px 20px 1px rgba(46,49,72,.15);
}

.ethereum {
    box-shadow: 10px 10px 20px 1px rgba(78,56,216,.15);
}

.asset-info {
    grid-area: info;
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5% 0 5%;
}

.title {
    display: inline-flex;
}

card h1 {
    margin-left: 10px;
}


/// Charts ///
#btcChart,
#cosmosChart,
#ethereumChart {
    grid-area: chart;
    border-radius: 0px 0px 30px 30px;
    margin-top: auto;
}

	</style>
</head>
<body>
  <container class="container">
    <cards class="cards">
        <bitcoin style="width: 30%" class="btc">
            <card class="asset-info">
                <div class="title">
                    <img src="https://s3.us-east-2.amazonaws.com/nomics-api/static/images/currencies/btc.svg" width="15%"> 
                    <h1>Bitcoin</h1>
                </div>
                <div class="details">
                    <h2 class="asset-price" id="btcPrice"></h2>
                </div>
            </card>
            <canvas id="btcChart"></canvas>
        </bitcoin>

        
    </cards>
  </container>
</body>
<script src="<?php echo $template_path; ?>/tradeplatform/js/trade.js"></script>
</html>