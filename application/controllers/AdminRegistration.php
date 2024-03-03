<?php         
defined('BASEPATH') OR exit('No direct script access allowed');
        
class AdminRegistration extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index($status) {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
        	redirect(base_url()."./login","refresh");
        }

        try {
            $pageDetails = array(
                'Title'     => "Registration - ".ucwords($status),
                'Function'  => "Admin",
                'Page'      => ucwords($status)
            );
    
            $user_data = array(
                "Information"   => $this->session->userdata("LoginData")
            );
    
            $pageData = array(
                "TileData"  => array("FinishCashIn" => 100, "CashOutRequestComplete" => 103, "CashOutAmountComplete" => 200, "ActiveUsers" => 1),
                "ChartData" => array()
            );
    
            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => $user_data,
                "PageData"      => $pageData
            );
    
            $this->load->view("templates/admin_header", $data);
            $this->load->view("portal/registration/".$status, $data);
            $this->load->view("templates/admin_footer", $data);
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/registration/".$status,"refresh");
        }
    }

    public function View($reference, $isApprove = false) {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
        	redirect(base_url()."./login","refresh");
        }

        try {
            $pageDetails = array(
                'Title'     => "View Registration - ".$reference,
                'Function'  => "Admin",
                'Page'      => "View"
            );
    
            $user_data = array(
                "Information"   => $this->session->userdata("LoginData")
            );
            
            $this->load->model('Registration_model', 'registerModel');
            $getRegistrationInfo = $this->registerModel->GetRegistrationInfoStg($reference);
            if (empty($getRegistrationInfo))
                throw new Exception("Reference not found.");

            $pageData = array(
                "RegisterData"  => $getRegistrationInfo
            );
    
            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => $user_data,
                "PageData"      => $pageData
            );
    
            $this->load->view("templates/admin_header", $data);
            $this->load->view("portal/registration/view", $data);
            $this->load->view("templates/admin_footer", $data);
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/registration/view/".$reference,"refresh");
        }
    }

    public function Reject() {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
        	redirect(base_url()."./login","refresh");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('specifyReason', 'Specify Reason', 'trim');
        $this->form_validation->set_rules('Reference', 'Reason', 'trim|required');

        try {
            if ($this->form_validation->run() == FALSE) {
                $errorMessage = null;
                $errors = $this->form_validation->error_array();
                if (count($errors) > 1)
                    $errorMessage = implode("<li>", $errors);
                else
                    $errorMessage = $errors;

                $this->session->set_flashdata("error", $errors);
                redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
            } else {
                $this->load->model('Registration_model', 'registerModel');
                $result = $this->registerModel->RejectRegistration();
                $this->session->set_flashdata("success", "Reject registration: ".$this->input->post("Reference", true));
                redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
            }
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
        }
    }

    public function Approve() {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ");
        	redirect(base_url()."./login","refresh");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('Reference', 'Reason', 'trim|required');

        try {
            if ($this->form_validation->run() == FALSE) {
                $errorMessage = null;
                $errors = $this->form_validation->error_array();
                if (count($errors) > 1)
                    $errorMessage = implode("<li>", $errors);
                else
                    $errorMessage = $errors;

                $this->session->set_flashdata("error", $errors);
                redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
            } else {
                $this->load->model('Registration_model', 'registerModel');
                $result = $this->registerModel->ApproveRegistration();
                $this->session->set_flashdata("success", "Approve registration: ".$this->input->post("Reference", true));
                redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
            }
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/registration/view/".$this->input->post("Reference", true), "refresh");
        }
    }

    public function ApproveRegistration() {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page.");
        	redirect(base_url()."./login","refresh");
        }

        try {
            $pageDetails = array(
                'Title'     => "Registration - Approved",
                'Function'  => "Admin",
                'Page'      => "Approve"
            );
    
            $user_data = array(
                "Information"   => $this->session->userdata("LoginData")
            );
    
            $data["data"] = array(
                "PageDetails"   => $pageDetails,
                "UserData"      => $user_data
            );
    
            $this->load->view("templates/admin_header", $data);
            $this->load->view("portal/registration/approve", $data);
            $this->load->view("templates/admin_footer", $data);
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/registration/".$status,"refresh");
        }
    }

    public function Resend($reference, $action) {
        if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page.");
        	redirect(base_url()."./login","refresh");
        }

        $redirectUrl = base_url()."admin/registration/view/";
        if ($action == "approve")
            $redirectUrl = $redirectUrl."approve/".$reference;
        else
            $redirectUrl = $redirectUrl."/".$reference;

        try {
            $this->load->model('Registration_model', 'registerModel');
            $result = $this->registerModel->ResendEmail($reference, $action);
            $this->session->set_flashdata("success", "Email resent for reference: ".$reference);
            redirect($redirectUrl, "refresh");
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect($redirectUrl, "refresh");
        }
    }
}