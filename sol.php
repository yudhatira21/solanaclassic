<?php  
include 'function.php';


function save_address($bsc, $referral) {
	echo "\n[#] Try to get bsc address\n";
	echo "[!] Address : ".$bsc."\n";
	$solana = get('https://www.solanaclassic.com/sales?ref='.$referral);
	preg_match('/<input type="hidden" name="_token" value="(.*?)">/s', $solana, $token);

	$cookies = getcookies($solana);


	$headers = [
		'Host: www.solanaclassic.com',
		'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0',
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		'Cookie: XSRF-TOKEN='.$cookies['XSRF-TOKEN'].'; solana_classic_session='.$cookies['solana_classic_session'],
		'Content-Type: application/x-www-form-urlencoded',
		'Connection: keep-alive'
	];


	$save_address = post('https://www.solanaclassic.com/save-address', '_token='.$token[1].'&address='.$bsc.'&ref='.$referral.'&check=1', $headers);

	if (stripos($save_address, 'Redirecting to')) {
		echo "[!] Success | ".$bsc."\n";
	} else {
		echo "[!] Failed to register address\n";
	}
}


echo "Referral code: ";
$referral = trim(fgets(STDIN));

echo "Name file bcs address (Ex: bsc.txt): ";

$namefile = trim(fgets(STDIN));
if ($namefile == "") {
	die ("Address cannot be blank!\n");
}

$file = file_get_contents($namefile) or die ("File not found!\n");
$bsc = explode("\r\n",$file);
$total = count($bsc);
echo "Total address: ".$total."\n";

foreach ($bsc as $value) {
	save_address($value, $referral);
}