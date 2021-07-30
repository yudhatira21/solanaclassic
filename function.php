<?php 
function post($url = null, $data = null, $headers = null, $proxy = null) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	if ($data != "") {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}

	if ($headers != "") {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	if ($proxy != "") {
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
	}

	return $result = curl_exec($ch);
	curl_close($ch);
}


function get($url = null, $headers = null, $header = true, $proxy = null) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, $header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	if ($headers != "") {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	if ($proxy != "") {
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);

	}

	return $result = curl_exec($ch);
	curl_close($ch);
}

function getcookies($source) {
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $source, $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
		parse_str($item, $cookie);
		$cookies = array_merge($cookies, $cookie);
	}
	return $cookies;
}


function fetch_value($str, $find_start, $find_end) {
	$start = @strpos($str, $find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str, $start + $length), $find_end);
	return trim(substr($str, $start + $length, $end));
}


function number($length) {
	$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


function random($length) {
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function save_image($inPath,$outPath) {
    $in = fopen($inPath, "rb");
    $out = fopen($outPath, "wb");
    while ($chunk = fread($in,8192)) {
       fwrite($out, $chunk, 8192);
       header('Content-type: image/jpeg');
    }
    fclose($in);
    fclose($out);
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb" ); 
    fwrite($ifp, base64_decode($base64_string)); 
    fclose($ifp); 
    return($output_file); 
}



?>