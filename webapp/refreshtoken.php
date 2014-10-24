<?php

/* 
 * grant_type=refresh_token&
refresh_token=the_refresh_token&
client_id=the_client_id&
client_secret=the_client_secret&
state=123456789
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 
 
error_reporting(E_ALL);

$config['grant_type'] = 'refresh_token';
$config['client_id'] = 'newid';
$config['client_secret'] = 'shyam1';
$config['refresh_token'] = $_GET['refresh_token']; 
$config['redirect_uri'] = 'http://testserver.co/index.php';

 

 

function makePostRequest($url, $config) {
    
    ob_start();
    $data='';
    foreach ($config as $key => $value) {
        $data .="{$key}={$value}&";
    }
    $data = rtrim($data, '&'); 
    
    $ch = curl_init();
    $header[] = 'Content-Type: application/x-www-form-urlencoded'; 
    curl_setopt($ch, CURLOPT_URL, $url.'?'.$data);
     
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($data));    
    $output = curl_exec($ch);
    curl_close($ch);
//    var_dump($output);
//    echo curl_getinfo($ch) . '<br/>';
//    echo 'error:' . curl_error($ch);
    echo $output;
    return ob_get_clean();
}

echo makePostRequest('http://192.168.33.10/oauth/access_token/', $config);
