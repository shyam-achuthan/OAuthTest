<?php
error_reporting(E_ALL);

$config['grant_type'] = 'client_credentials';
$config['client_id'] = 'newid';
$config['client_secret'] = 'shyam1';
$config['scope'] = 'scope1';
$config['redirect_uri'] = 'http://testserver.co/index.php'; 

function makePostRequest($url, $config)
{
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
    return ob_get_clean();
}

echo makePostRequest('http://192.168.33.10/oauth/access_token/', $config);