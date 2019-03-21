<?php
date_default_timezone_set("Asia/Jakarta");

// ---[ FUNCTIONS ]-----------------------------------------------------

function login() {
    die("<pre align=center><form method=post>Password: <input type=password name=pass><input type=submit value='login'></form></pre>");
    exit();
}

function getUserIP(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
return $ip;
}

function createImg($img, $name){
    $data = base64_decode(str_replace(' ', '+',str_replace('data:image/png;base64,', '', $img)));
    $file = "screenshot/" . $name . '.png';
    file_put_contents($file, $data);
}

function getPage($arr, $perPage, $pageNumber){
    return array_chunk(array_filter(array_reverse($arr)), $perPage)[$pageNumber-1];
}

function rand_str($l=15){
    $c = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = '';
    for ($i = 0; $i < $l; $i++){
        $str .= $c[rand(0, strlen($c) - 1)];
    }
    return $str;
}

function rand_color(){
    $a = array("primary","success","danger","warning","secondary");
    return $a[array_rand($a)];
}


function sendEmail($to, $subject, $message) {
     $head = "Content-type:text/plain;charset=UTF-8\r\n";
     $head .= "From: cXss <xsscaptured@cxss.id>" . "\r\n";
     mail($to,$subject,$message,$head);
}

function sendTelegram($t, $id, $m){
    $url = "https://api.telegram.org/bot" . $t . "/sendMessage";
    $data = [
                'chat_id'    => $id,
                'parse_mode' => 'markdown',
                'text'       => $m
            ];
      return req("POST", $url, $data, array("Content-Type:multipart/form-data"));
}

// -----------------------------------------------------------------------

/*
    https://github.com/vsec7/Simple-CRUD-with-jsonstore.io
*/

function insert($jsonDb, $key, $jsonData){
    return req("POST", $jsonDb."/".$key, $jsonData, array('Content-Type: application/json'));
}

function get($jsonDb, $key){
    return req("GET", $jsonDb."/".$key);
}

function getAll($jsonDb){
    return req("GET", $jsonDb);
}

function update($jsonDb, $key, $jsonData){
    return req("PUT", $jsonDb."/".$key, $jsonData, array('Content-Type: application/json'));
}

function delete($jsonDb, $key){
    return req("DELETE", $jsonDb."/".$key);
}

function countDb($jsonDb){
    return count(json_decode(getAll($jsonDb))->result);
}


function req($method, $url, $post=null, $header=null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    switch ($method) {
        case "GET":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "POST":
            if($post != null){
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				}
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            break;
        case "PUT":
            if($post != null){
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				}
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "DELETE":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");             
            break;
    }
    if($header != null){
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
return curl_exec($ch); 	
}

