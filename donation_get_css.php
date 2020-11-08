<html>
<body onload="ethereum.enable()">

<?php
// define variables for donation amount and set to the values 'posted' by main/index page
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


<?php
//test to see if donation equal $0 (an if so load download links) or if >$0 generate prompt to confirm donation 
if($donations == 0){
//$0: Load the dowload links
$free = <<<EOT
<div id="status" width="800">

<div>ako_westbabylon.exe</div>

<br>
<a href="https://linebreakrecords.com/assets/ako_westbabylon_download/dl/rterdtc876787399kjbadjbhkbkj345/ako%20-%20West%20Babylon%20(MP3).zip" target="blank"><input type="button" value="• Download mp3 (320Kbps)"></a>
<br>
<br>
<a href="https://linebreakrecords.com/assets/ako_westbabylon_download/dl/rterdtc876787399kjbadjbhkbkj345/ako%20-%20West%20Babylon%20(wav).zip" target="blank"><input type="button" value="• Download wav"></a>
<br>
<br>
<a href="https://linebreakrecords.com/" target="blank"><input type="button" value="powered by Linebreak"></a>
<br>
<br>

	</ul>
</div>
EOT;
echo $free;
}else {
//this is loaded if donation is >$0, first it gathers logged in wallet address then sets up transaction when use confirms donation. Once the user has confirmed the transaction in their wallet the download links are loaded
$paid = <<<EOT
<div id="status" width="800" >
<script>
function dlclick() {
document.getElementById("status3").innerHTML = '<br><a href="https://linebreakrecords.com/assets/ako_westbabylon_download/dl/rterdtc876787399kjbadjbhkbkj345/ako%20-%20West%20Babylon%20(MP3).zip" target="blank"><input type="button" value="• Download mp3 (320Kbps)"></a><br><br><a href="https://linebreakrecords.com/assets/ako_westbabylon_download/dl/rterdtc876787399kjbadjbhkbkj345/ako%20-%20West%20Babylon%20(wav).zip" target="blank"><input type="button" value="• Download wav"></a><br><br><a href="https://linebreakrecords.com/" target="blank"><input type="button" value="powered by Linebreak" ></a><br><br>';}
</script>
<script>
//Checks user is logged in and gathers address
function metaMask() {
  if (typeof web3 === 'undefined') {
    return alert('You need to install web3 wallet to use this feature.')
  }
  var user_address = web3.eth.accounts[0];
  if (typeof user_address === 'undefined') {
    return alert('You need to log in wallet to use this feature.')
  }
  
 //sets up transaction in users wallet when the user clicks 'buy', value is set against exchange rate, in the same fashion as the usdConvert() function (below), gass value is also set as twice default to make sure enough gas is included to complete the transaction successfully
 var donationamount = $ethamount; 	
  web3.eth.sendTransaction({
    to: "0x445b5f277D463122a2Aaeac8B77d8f60865156Dc", 
    from: user_address,
    value: web3.toWei(donationamount, 'ether'),
	//gas: 46000, 
  }, function (err, transactionHash) {
    if (err) return alert(':(');
    alert('Thanks');
	dlclick();
  })
}

</script>

<div>ako_westbabylon.exe</div>

<br>
<button onclick="metaMask()">confirm donation</button>

<div><i>(confirm donation and download links will appear below)</i><br>

<br>
download links:<div id="status3"><br><br><br><br><br><br><br></div>

</div>
<br>
<br>
EOT;
echo $paid;

}

?>

</body>
</html>