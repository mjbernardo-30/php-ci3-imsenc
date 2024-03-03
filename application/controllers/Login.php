<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		if (!APP_ACTIVE)
			show_404();

		if ($this->session->has_userdata("LoginData")) {
            $user_id = $this->session->userdata("LoginData")["LoginId"];
            if (!empty($user_id))
                redirect(base_url()."admin/dashboard");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('Email', 'Email Address', 'trim|required|min_length[2]|max_length[150]');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
            $pageDetails = array(
                'Title'     => "Admin Login",
                'Function'  => "Admin",
                'Page'      => "Login"
            );

            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => array(),
                "PageData"      => array()
            );
    
            $this->load->view("templates/admin_header", $data);
            $this->load->view("login/login", $data);
            $this->load->view("templates/admin_footer", $data);
        } else {
        	try {
        		$this->load->model('Login_model', 'loginModel');
	            $result = $this->loginModel->verify_login();
	            if (!empty($result)) {
	            	$sessionData = $result;
	            	if ($this->session->has_userdata('LoginData'))
	                	$this->session->unset_userdata("LoginData");

	                $this->session->set_userdata("LoginData", $sessionData);
	                redirect(base_url()."admin/dashboard");
	            } else {
	            	log_message("error", "No exception error detected but user data is not set.");
	            	$this->session->set_flashdata("error", "Login failed. Please try again later.");
	            	redirect(base_url()."login","refresh");
	            }
        	} catch (Exception $ex) {
        		log_message("error", "Exception: ".$ex->getMessage());
        		$this->session->set_flashdata("error", $ex->getMessage());
        		redirect(base_url()."login","refresh");
        		//redirect(base_url()."login?Type=Error&Message=".$ex->getMessage());
        	}
        }
	}

	public function logout() {
        if ($this->session->has_userdata("LoginData")) {
        	$this->load->model('Login_model', 'loginModel');
        	$this->loginModel->logout($this->session->userdata("LoginData")["LoginId"], $this->session->userdata("LoginData")["SessionId"]);
            $this->session->unset_userdata("LoginData");
        }

        redirect(base_url()."login");
    }
}