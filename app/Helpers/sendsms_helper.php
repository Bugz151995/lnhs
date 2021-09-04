<?php
function sendsms($mobileno, $message_body, $return = '0') {
	
	$sender = 'SEDEMO'; 
	$smsGatewayUrl = 'https://instantalerts.co';
	$apikey = '62659c5asfu4zvd7898g1kj013e77it8v';  // Place API key here

	$textmessage = urlencode($message_body);
	$api_element = '/api/web/send/';
	$api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$mobileno.'&message='.$textmessage;
	$smsgatewaydata = $smsGatewayUrl.$api_params;
	$url = $smsgatewaydata;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$output = curl_exec($ch);
	curl_close($ch);
	if(!$output){ $output = file_get_contents($smsgatewaydata); }
	
	if($return == '1'){ return $output; }
}