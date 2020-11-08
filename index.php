<!DOCTYPE html>
<?php 
//gets exchange rate of ETH to USD
$url2= "https://api.coinbase.com/v2/prices/ETH-USD/spot";
$fileGet = file_get_contents($url2);
$json = json_decode($fileGet, TRUE);
$jsondata = $json["data"];
?>

<?php
// define variables and set to empty values for donation amount to be posted to form handler
$donations = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $donations = test_input($_POST["donations"]);
  $ethamount = test_input($_POST["ethamount"]);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>

<style>


    </style>

<head> 

<title>ako - West Babylon - Linebreak Records - Crytocurreny Record Label </title>
	
</head>
<!--enable/connect to wallet--> 
<body onload="ethereum.enable()">  

                
<div>

<div>ako_westbabylon.exe</div>
<br><br>
Name your price (no minimum)
<br><br>
<form name="donationform" method="post" action="donation_get_css.php" target="_blank">
Enter $0.00 or more to download: <br>$<input type="number" name="donations" id="donation"  onchange="usdConvert()" onkeyup="usdConvert()" min="0" step="any" required>
(ETH:<input type="text" id="eth" name="ethamount" readonly>)
<br><br>
<input type="submit" value="Donate">
</form>

<br><br>

other formats:
<br><br>

<table style="width:100%">

  <tr>
    <th></th>
    <th></th>
    <th></th>
	 <th></th>
  </tr>
  
  <tr style="text-align:center; width:100%">
    <td><a href="https://ako0.bandcamp.com/merch/west-babylon-vhs-cassette" target="blank"><img src="vhs.jpg" width="100%"></a></td>
    <td><a href="https://ako0.bandcamp.com/album/west-babylon" target="blank"><img src="bandcamp.jpg" width="100%"></a></td>
    <td><a href="https://open.spotify.com/artist/7cKvThgUVJGxl6oCTnugXQ" target="blank"><img src="spotify.jpg" width="100%"></a></td>
    <td><a href="https://music.apple.com/us/album/west-babylon/1527098479" target="blank"><img src="apple.jpg" width="100%"></a></td>
  </tr>
  <tr style="text-align:center">
    <td><a href="https://ako0.bandcamp.com/merch/west-babylon-vhs-cassette" target="blank"><input type="button" value="VHS"></a></td>
    <td><a href="https://ako0.bandcamp.com/album/west-babylon" target="blank"><input type="button" value="BandCamp"></a></td>
    <td><a href="https://open.spotify.com/artist/7cKvThgUVJGxl6oCTnugXQ" target="blank"><input type="button" value="Spotify"></a></td>
    <td><a href="https://music.apple.com/us/album/west-babylon/1527098479" target="blank"><input type="button" value="Apple"></a></td>
  </tr>
  
  
  
</table>

<br><br>

<div><em><a href="https://www.linebreakrecords.com" target="_blank">powered by:<a>
<a href="http://linebreakrecords.com" target="blank"><input type="button" value="Linebreak" ></a>
</div>
	</div> 
</div>	

	
<script> 


//grabs exhange rate from PHP
var eth = <?php echo json_encode($jsondata["amount"]);?>  	
var usd = 1;
var usdCalc = 0;


//calculates ethereum value, roughly, based on dollar amount entered by the user
function usdConvert() {
	var mult = document.getElementById("donation").value;	
	var usdCalc = (usd / eth)*mult;
	var usdCalc = usdCalc.toFixed(8);
document.getElementById("eth").value = usdCalc;
}


</script> 

</body>