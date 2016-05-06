<?php

$dcrurl = "https://bittrex.com/api/v1.1/public/getmarketsummary?market=btc-dcr";
$usdurl = "https://bitpay.com/api/rates";

$dcrjson = file_get_contents($dcrurl);
$dcrdata = json_decode($dcrjson, TRUE);

$usdjson = file_get_contents($usdurl);
$usddata = json_decode($usdjson, TRUE);

$DCRrate = $dcrdata['result'][0]['Last'];    
$USDrate = $usddata[1]["rate"]; 

$DCRtoUSD = round( $DCRrate * $USDrate , 8 );
?>

<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Awesome input focus effects using css3 - usingcss3</title>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

<!-- CSS includes -->
<link rel="stylesheet" type="text/css" href="css/input-style.css">
<!-- CSS includes end -->
</head>
<body>
<div class="row">
    <div class="container">
        <div class="col input-effect">
        	<input class="dcrIn" type="text" placeholder="" id="dcr">
            <label>DCR</label>
            <span class="focus-border">
            	<i></i>
            </span>
        </div>
        <div class="col input-effect">
        	<input class="usdIn" type="text" placeholder="" id="usd">
            <label>USD</label>
            <span class="focus-border">
            	<i></i>
            </span>
        </div>
    </div>
</div>

<!-- Script here -->
<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script>
// JavaScript for label effects only
	$(window).load(function(){
		$(".col input").val("");
		
		$(".input-effect").focusout(function(){
			if($(this).val() == ""){
				$(this).removeClass("has-content");
			}
		});
	});
	
// JS for calculations


var USD = "<?php echo $USDrate; ?>";
var DCR = "<?php echo $DCRrate; ?>";
var DCRtoUSD = "<?php echo $DCRtoUSD; ?>";

var lastdcr = "";
var lastusd = "";

$('#dcr').keyup(function(event) {
   if($('#dcr').val() != lastdcr) {       
	 var d = $('#dcr').val()*DCRtoUSD;
	 if (d == 0){
        $('#usd').val("");
		$('.dcrIn').removeClass("has-content");
		$('.usdIn').removeClass("has-content");
	}
	else{
	    $('#usd').val(d);
		$('.dcrIn').addClass("has-content");
		$('.usdIn').addClass("has-content");
	}
   }
   lastdcr = $('#dcr').val()
});
$('#usd').keyup(function(event) {
   if($('#usd').val() != lastusd) {  
     var d = $('#usd').val()/DCRtoUSD;
	 if (d == 0){
        $('#dcr').val("");
		$('.dcrIn').removeClass("has-content");
		$('.usdIn').removeClass("has-content");
	 }
	 else{
		$('#dcr').val(d);
		$('.dcrIn').addClass("has-content");
		$('.usdIn').addClass("has-content");
	}
   }
   lastusd = $('#usd').val()
});


</script>
</body>
</html>
