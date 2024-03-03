<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogs extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
        	redirect(base_url()."./login","refresh");
        }

        try {
            $pageDetails = array(
                'Title'     => "Activity Logs",
                'Function'  => "Admin",
                'Page'      => "System Logs"
            );

            $user_data = array(
                "Information"   => $this->session->userdata("LoginData")
            );

            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => $user_data,
                "PageData"      => array()
            );

            $this->load->view("templates/admin_header", $data);
            $this->load->view("portal/logs", $data);
            $this->load->view("templates/admin_footer", $data);
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/users","refresh");
        }
	}
}