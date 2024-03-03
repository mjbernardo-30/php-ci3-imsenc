<?php
require_once('properties/CustomErrorMessage.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct() {
        $this->load->library('user_agent');
        $this->load->model('Utilities_model', 'utilities');
        $this->load->model('ValidationService_model', 'validationModel');
        $this->load->model('RepoUsers_model', 'userRepo');
	}

	public function verify_login() {
        $statusCode = 0;
        $description = null;
        $content = "string";

        $email      = $this->input->post("Email", true);
        $password   = $this->input->post("Password", true);
        $password   = $this->utilities->generate_key($password);

        $this->validationModel->ValidateLogin($email, $password);
        $accountInformation = $this->userRepo->GetUserByEmail($email);
        if (!password_verify($password, $accountInformation->password)) {
            $this->userRepo->IncorrectPassword($email);
            throw new Exception(ValidationErrorMessage::VLD0003);
        }

        $sid = substr(sha1($this->session->session_id), 0, 30);
        $setSID = $this->userRepo->UpdateUserSID($accountInformation->Id, $sid, "Login");
        if ($setSID) {
            $this->login_logs($accountInformation->Id, $sid);
            if ($accountInformation->retry > 0)
                $this->userRepo->UpdateUserRetry($accountInformation->Id);

            return array(
                "LoginId"   => $accountInformation->Id,
                "LoginTime" => date('Y-m-d H:i:s'),
                "UserEmail" => $accountInformation->email,
                "UserName"  => $accountInformation->name,
                "SessionId" => $sid
            );
        } else
            throw new Exception(OperationalErrorMessage::OPS0002);
    }

    private function login_logs($user_id, $sid) {
        $browser    = $this->agent->browser()." ".$this->agent->version();
        $uagent     = $this->agent->agent_string();
        $platform   = $this->agent->platform();
        $ipaddress  = $this->input->ip_address();
        $model = array(
            'UserId'   => $user_id,
            'browser'   => $browser,
            'platform'  => $platform,
            'ip'        => $ipaddress,
            'uagent'    => $uagent,
            'sid'       => $sid
        );
        $insertLog = $this->userRepo->InsertLoginLog($model);
        if (!$insertLog)
            throw new Exception(OperationalErrorMessage::OPS0002);
    }

    public function logout($userId, $sid) {
        $this->userRepo->UpdateUserSID($userId, $sid, "Logout");
    }
}