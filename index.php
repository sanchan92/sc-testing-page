<?php 
//calculating Page Execution Time
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$time_start = microtime_float(); //start the timer
//check webserver software is nginx
function is_nginx() {
	if (strpos($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false) {
		return true;
	}else{
		return false;
	};
};
//checking visitor is using HTTPS or SSL connection
function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
};
//checking server ip and name
if ($_SERVER["SERVER_ADDR"] =="fill it in the blank") {
		$ser="You are in Server CW1";
	}elseif ($_SERVER["SERVER_ADDR"] =="fill it in the blank") {
		$ser="You are in Server CM1";
	}else{
	$ser="Not hosted on SanChan Network";
	};
//checking visitor ip.
//supported cloudflear on ngix and appach
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
	$IP=$_SERVER["HTTP_CF_CONNECTING_IP"];
	}else{
	$IP=$_SERVER["REMOTE_ADDR"];
};
//Checking visitor using IPv6
function is_ipv6($ip) {
	if (!preg_match("/^([0-9a-f\.\/:]+)$/",strtolower($ip))) { return false; }
	if (substr_count($ip,":") < 2) { return false; }
	$part = preg_split("/[:\/]/",$ip);
	foreach ($part as $i) { if (strlen($i) > 4) { return false; } }
	return true;
};
?>
<!doctype html>
<html ⚡>
  <head>
    <meta charset="utf-8">
    <link rel="canonical" href="hello-world.html" >
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
	<title>SC Network</title>
		<style amp-custom>
		.heading {
			margin: 1px 2px;
			position: relative;
			/*top: 15px;*/
			left: 50px;
			width: 80%;
			top: 25px;
		}
		.content {
			margin: 1px 2px;
			position: relative;
			left: 50px;
			width: 80%;
			top: 150px;
		}
		.footer {
			margin: 1px 2px;
			position: relative;
			left: 50px;
			width: 80%;
			top: 300px;
		}
		</style>
		
	</head>
  
  
  <body>
  
	<div class="heading">Welcome!  You are visiting <?php echo $_SERVER['SERVER_NAME'];?>'s testing page.</div>
  
	<div class="content">
		Your current connection type : <?php if (is_ssl() == true) { echo "SSL";} elseif(is_ssl() == false) {echo "non-SSL";};?><br />
		Your 
		<?php 
			if (is_ipv6($IP)){echo "IPv6 ";}else{echo "IPv4 ";};
			echo "is: ". $IP;
			$details = json_decode(file_get_contents("http://ipinfo.io/{$IP}/json"));
			echo " (". $details->city;
			echo ", ". $details->country .")";
		?>
		<br />
		
		<?PHP if (is_ssl() == false) {  ?>
			<p>
				<center>
					We Highly-Recommend you use HTTPS(SSL) connection to enjoy your secure network life.
				</center>
			</p>
		<?PHP };?>
	</div> 
 
	<div class="footer"><hr>
		<center>Copyright © 2014- <?php echo date(Y);?> <a href="https://scser.net">SanChan Network</a> All Rights Reserved<br />
			<?php 
				echo 'Page Execution Time:'.(microtime_float() - $time_start).' sec ';
				if ($_SERVER['HTTP_ACCEPT_ENCODING'] == "gzip") {
					echo "GZIP is ON"; 
				} else {
					echo "GZIP is OFF";
				};
			?>
		</center>
	</div>

  </body>
</html>