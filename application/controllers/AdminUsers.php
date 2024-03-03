<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUsers extends CI_Controller {
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
                'Title'     => "CMS Users",
                'Function'  => "Admin",
                'Page'      => "Users Management"
            );

            $user_data = array(
                "Information"   => $this->session->userdata("LoginData")
            );

            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => $user_data,
                "PageData"      => array()
            );

            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('Email', 'Email Address', 'trim|required|min_length[2]|max_length[150]|valid_email|is_unique[portal_users.email]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view("templates/admin_header", $data);
                $this->load->view("portal/users", $data);
                $this->load->view("templates/admin_footer", $data);
            } else {
                $this->load->model('Users_model', 'userModel');
                $result = $this->userModel->CreateAccount();
                $this->session->set_flashdata("success", "User successfully created.");
                redirect(base_url()."admin/users","refresh");
            }
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/users","refresh");
        }
	}

    public function ChangePassword()
    {
        if (!APP_ACTIVE)
            show_404();

        if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
            redirect(base_url()."./login","refresh");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('OldPw', 'Old Password', 'trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('Password', 'New Password', 'trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('ConfirmPassword', 'Confirm Password', 'trim|required|min_length[6]|max_length[12]|matches[Password]');
        $this->form_validation->set_rules('Url', 'Base URL', 'trim|required');

        try {
            if ($this->form_validation->run() == FALSE) {
                $errorMessage = null;
                $errors = $this->form_validation->error_array();
                if (count($errors) > 1)
                    $errorMessage = implode("<li>", $errors);
                else
                    $errorMessage = $errors;

                $this->session->set_flashdata("error", $errors);
                redirect($this->input->post("Url", true), "refresh");
            } else {
                $this->load->model('Users_model', 'userModel');
                $result = $this->userModel->ChangePassword("Change");
                $this->session->set_flashdata("success", "Password successfully updated.");
                redirect($this->input->post("Url", true), "refresh");
            }
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect($this->input->post("Url", true), "refresh");
        }
    }

    public function ResetPassword($RequestId)
    {
        if (!APP_ACTIVE)
            show_404();

        if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
            redirect(base_url()."./login","refresh");
        }


        try {
            $this->load->model('Users_model', 'userModel');
            $result = $this->userModel->ChangePassword("Reset", $RequestId);
            $this->session->set_flashdata("success", "Account successfully reset.");
            redirect(base_url()."admin/users", "refresh");
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/users", "refresh");
        }
    }

    public function AccountStatus($RequestId, $Status)
    {
        if (!APP_ACTIVE)
            show_404();

        if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
            redirect(base_url()."./login","refresh");
        }


        try {
            $this->load->model('Users_model', 'userModel');
            $result = $this->userModel->ChangeStatus($RequestId, $Status);
            $this->session->set_flashdata("success", "Account successfully ".$Status.".");
            redirect(base_url()."admin/users", "refresh");
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/users", "refresh");
        }
    }
}