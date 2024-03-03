<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeRegistration extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if (!$this->CheckIfInRange(date("Y-m-d"))) {
            //show_404();
            $start_ts = strtotime(REG_STARTDATE);
            $end_ts = strtotime(REG_ENDDATE);
            $user_ts = strtotime(date("Y-m-d"));
            if ($user_ts < $start_ts)
                show_404();
            else
                redirect(base_url()."end","refresh");
        }
    }

    public function index() {
        $this->load->library('user_agent');
        if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/home");
    }

    public function Privacy() {
        if (!APP_ACTIVE)
			show_404();
        
        $this->load->view("home/privacy");
    }

    public function Terms() {
        if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/terms");
    }

	public function Register()
	{
		if (!APP_ACTIVE)
			show_404();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('Name', 'Name', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('DOB', 'Date of Birth', 'trim|required|callback_ValidateDOB');
        $this->form_validation->set_rules('Address', 'Home Address', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('Mobile', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|callback_ValidateMobile');
        $this->form_validation->set_rules('SchoolName', 'Name of School', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('SchoolAddress', 'Address of School', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('SchoolRep', 'Name of School Representative', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('SchoolEmail', 'EMAIL ADDRESS OF SCHOOL MENTOR / REPRESENTATIVE', 'trim|required|min_length[2]|max_length[150]|valid_email');
        $this->form_validation->set_rules('SchoolRepContact', 'School Representative Contact Number', 'trim|min_length[8]|max_length[13]');
        $this->form_validation->set_rules('Email', 'Email Address', 'trim|required|min_length[2]|max_length[150]|valid_email|is_unique[registration.email]');
        $this->form_validation->set_rules('Story', 'STORY BEHIND YOUR COCKTAIL', 'trim|required');
        $this->form_validation->set_rules('Ingredients', 'INGREDIENTS USED', 'trim|required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('Link', 'VIDEO LINK', 'trim|required');
        if (empty($_FILES['SchoolID']['name']))
            $this->form_validation->set_rules('SchoolID', 'YOUR SCHOOL ID / PROOF OF ENROLLMENT', 'required');
        else
            $this->form_validation->set_rules('SchoolID', 'YOUR SCHOOL ID / PROOF OF ENROLLMENT', 'callback_checkSID');

        if (empty($_FILES['GovID']['name']))
            $this->form_validation->set_rules('GovID', 'GOVERNMENT-ISSUED ID', 'required');
        else
            $this->form_validation->set_rules('GovID', 'GOVERNMENT-ISSUED ID', 'callback_checkGID');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("home/register");
        } else {
            try {
                $this->load->model('Registration_model', 'registerModel');
                $result = $this->registerModel->Register();
                if (!empty($result)) {
                    $message = "?type=1&reference=".$result;
                    redirect(base_url()."confirm", "refresh");
                }
                else {
                    log_message("error", "Registration issue: Operation completed but returned no reference.");
                    redirect(base_url()."type=1&reference=Complete", "refresh");
                }
            } catch (Exception $ex) {
                log_message("error", "Exception: ".$ex->getMessage());
                $this->session->set_flashdata("error", $ex->getMessage());
                redirect(base_url()."register","refresh");
            }
        }
	}

    public function Confirm()
	{
		if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/confirm");
	}

    public function Product()
	{
		if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/product");
	}

    public function How()
	{
		if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/how");
	}

    public function FAQ()
	{
		if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/faq");
	}

    public function ValidateMobile($mobile) {
        $this->load->model('RepoRegistration_model', 'registerRepo');
        $check = $this->registerRepo->CountMobile($mobile);
        if ($check > 0) {
            $this->form_validation->set_message('ValidateMobile', 'Mobile number already exist.');
            return false;
        }

        return true;
    }

    public function ValidateDOB($dob) {
        $dob = strtotime($dob);

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if(time() - $dob < ELIGIBLE_AGE * 31536000)  {
            $this->form_validation->set_message('ValidateDOB', 'You must be '.ELIGIBLE_AGE.' to register.');
            return false;
        }

        return true;
    }

    public function checkSID($obj) {
        if($_FILES['SchoolID']['size'] > 5242880) { //5 MB (size is also in bytes)
            $this->form_validation->set_message('checkSID', 'The uploaded file is too large. 5MB is maximum size allowed.');
            return false;
        }

        $imgExtArr = ['image/jpg', 'image/jpeg', 'image/png'];
        log_message("error", $_FILES['SchoolID']['type']);
        if(!in_array(strtolower($_FILES['SchoolID']['type']), $imgExtArr)) {
            $this->form_validation->set_message('checkSID', 'The uploaded file is not with the supported image type. (jpg, jpeg, png)');
            return false;
        }

        return true;
    }

    public function checkGID($obj) {
        if($_FILES['GovID']['size'] > 5242880) { //5 MB (size is also in bytes)
            $this->form_validation->set_message('checkGID', 'The uploaded file is too large. 5MB is maximum size allowed.');
            return false;
        }

        $imgExtArr = ['image/jpg', 'image/jpeg', 'image/png'];
        if(!in_array(strtolower($_FILES['GovID']['type']), $imgExtArr)) {
            $this->form_validation->set_message('checkGID', 'The uploaded file is not with the supported image type. (jpg, jpeg, png)');
            return false;
        }

        return true;
    }

    private function CheckIfInRange($date) {
        $start_ts = strtotime(REG_STARTDATE);
        $end_ts = strtotime(REG_ENDDATE);
        $user_ts = strtotime($date);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
}