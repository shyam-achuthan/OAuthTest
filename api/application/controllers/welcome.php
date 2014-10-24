<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model', 'api');
        session_start();
    }

    public function index() {
        
        
        if(isset($_GET['access_token']))
        {
            $access_token=$_GET['access_token'];
            $user=$this->api->makeOAuthRequest('http://192.168.33.10/get-user', array('access_token'=>$access_token), 'GET');
            if(isset($user->email))
            {
                echo "Api Authorised via token<br>"; 
                $this->db->where('email', $user->email);
                $res = $this->db->get('api_detail');
                if($res->num_rows())
                {
                    echo "Api Details :".json_encode((array)$res->row());
                }
                else
                {
                    echo "No Api user found<br>";
                }
                
            }
            else
            {
                die("not authorised");
            }
            exit(0);
        }
        
        
        
        if (!isset($_GET['api_key']) || !isset($_GET['api_secret']))
            die(json_encode(array('status' => 403, 'error' => 'forbidden', 'message' => 'You should provide api key and api secret')));

        $this->db->where('api_key', $_GET['api_key']);
        $this->db->where('api_secret', $_GET['api_secret']);
        $res = $this->db->get('api_detail');

        if ($res->num_rows() > 0) {
            
            $token = $this->api->getAccessToken();
            
            if(!isset($token->access_token))
            {
                die(json_encode(array('status' => 403, 'error' => 'forbidden', 'message' => 'No Token')));
            }
            echo "<pre>";
            echo "Api user Id : " . $res->row()->Id . '<br>';
            echo "Api user email : " . $res->row()->email . '<br><br>';

            echo "Got access to the OAuth server via token : <i>" . $token->access_token . '</i> with scope for api <br>';
            echo "requesting the current api users role from Auth server via  <i>get-user-role</i> action <br><br><br>";
            $_SESSION['token'] = $token->access_token;



            $user_role = $this->api->getUserRole($_SESSION['token'], $res->row()->email);




            if (isset($user_role->role))
                echo "This user has a role of " . $user_role->role;
            else
                echo 'cant retrieve user role';

            return;
        }
        die(json_encode(array('status' => 403, 'error' => 'forbidden', 'message' => 'Invalid api key and api secret')));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */