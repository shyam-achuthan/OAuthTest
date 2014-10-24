<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
             parent::__construct();     
             $this->load->model('login_model','login');
             $this->load->helper('language');
             $this->lang->load('messages', 'english');
             
             if($this->router->fetch_method()!='index')
             $this->login->checkUserLogin();
            
        }
	public function index()
	{
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $this->login->processLogin($_POST);
            }            
            $this->load->view('login');
	}
        
        public function dashboard()
        {
            $data['user_profile']=$this->login->getUserProfile();
            $this->load->view('dashboard',$data);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */