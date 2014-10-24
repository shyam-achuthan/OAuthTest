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
class Login_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        session_start();

        if (isset($_GET['logout'])) {
            session_destroy();
            redirect(site_url());
        }
    }

    function processLogin($credentials) {
        $api_config = $this->config->config['OAuth'];

        $api_config['username'] = $credentials['username'];
        $api_config['password'] = $credentials['password'];


        $response = $this->makeOAuthRequest('http://192.168.33.10/oauth/access_token/', $api_config, 'POST');

        if (isset($response->access_token)) {
            $userdetail = $this->makeOAuthRequest('http://192.168.33.10/get-user', array('access_token' => $response->access_token), 'GET');
            $this->db->where('email', $userdetail->email);
            $result = $this->db->get('user_details');
            if ($result->num_rows() > 0) {
                $user = $result->row();
                $_SESSION['user_id'] = $user->Id;
                $_SESSION['access_token'] = $response->access_token;
                $_SESSION['user_role'] = $userdetail->user_role;  
                redirect(site_url('welcome/dashboard'));
            } else {
               $this->session->set_flashdata('login_error', 'Couldnt find the user on application');
               redirect(site_url(),'refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('login_error', 'Invalid Credentials');
            redirect(site_url(),'refresh');
        }
    }

    function getUserProfile() {
        $this->db->where('Id', $_SESSION['user_id']);
        $result = $this->db->get('user_details');
        if ($result->num_rows() > 0) {

            return $result->row();
        }
        return false;
    }

    function checkUserLogin() {
        if (!isset($_SESSION['user_id']))
            redirect(base_url());
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
