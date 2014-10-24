<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author shyama
 */
class Api_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
      
    }
    
    function getAccessToken()
    {
        $api_config = $this->config->config['OAuth'];
        return $this->makeOAuthRequest('http://192.168.33.10/oauth/access_token/', $api_config, 'POST');
    }
    function getUserRole($token,$email)
    {
        return $this->makeOAuthRequest('http://192.168.33.10/get-user-role', array('access_token'=>$token,'email'=>$email), 'GET');
    }

    function makeOAuthRequest($url, $config, $type = 'GET') {
        ob_start();
        $data = '';
        foreach ($config as $key => $value) {
            $data .="{$key}={$value}&";
        }
        $data = rtrim($data, '&');

        $ch = curl_init();
        $header[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($type != 'GET') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($data));
        }

        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }

}
