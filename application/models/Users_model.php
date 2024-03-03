<?php
require_once('properties/CustomErrorMessage.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model {
	public function __construct() {
        $this->load->model('Utilities_model', 'utilities');
        $this->load->model('ValidationService_model', 'validationModel');
        $this->load->model('RepoUsers_model', 'userRepo');
	}

	public function CreateAccount() {
		$user_id    = $this->session->userdata("LoginData")["LoginId"];
        $name      	= $this->utilities->title_string($this->input->post("Name", true));
        $email      = $this->input->post("Email", true);
        $password   = DEFAULT_PW;
        $pass_key   = $this->utilities->generate_key($password);
        $new_pw     = password_hash($pass_key, PASSWORD_BCRYPT);

        $model = array(
        	"email" 	=> $email,
        	"name" 		=> $name,
        	"status" 	=> '1',
        	"create_by" => "System",
        	"password" 	=> $new_pw
        );

        $this->validationModel->ValidateCreateAccount($model);
        $this->db->trans_start();
        try {
        	$result = $this->userRepo->CreateAccount($model);
        	if ($result) {
        		$logModel = array(
        			"UserId" 		=> $user_id,
        			"Category" 		=> "User Management",
        			"Description" 	=> "Create user: ".$email,
        			"SID" 			=> $this->session->userdata("LoginData")["SessionId"]
        		);
        		$logResult = $this->utilities->InsertActivityLog($logModel);
        		if ($logResult)
        			$this->db->trans_commit();
        		else {
        			$this->db->trans_rollback();
        			throw new Exception(OperationalErrorMessage::OPS0003);
        		}
        	} else {
        		$this->db->trans_rollback();
        		throw new Exception(OperationalErrorMessage::OPS0003);
        	}
        } catch (Exception $ex) {
        	$this->db->trans_rollback();
        	log_message("error", "Error on inserting. ".$ex->Message);
        	throw new Exception(OperationalErrorMessage::OPS0003);
        }
	}

	public function ChangePassword($type, $RequestId = 0) {
		$allowed_type 	= array("Change", "Reset");
		$user_id    	= $this->session->userdata("LoginData")["LoginId"];
		if (in_array($type, $allowed_type)) {
			$process = false;
			$model = array(
				"retry" 	=> 0,
				"status" 	=> 1,
				"update_by" => "System",
				"password" 	=> null
			);
			$requestId = null;
			switch($type) {
				case "Change":
					$validationModel = array(
						"OldPw" 	=> $this->input->post("OldPw", true),
						"NewPw" 	=> $this->input->post("Password", true),
						"ConfirmPw" => $this->input->post("ConfirmPassword", true),
						"UserId" 	=> $user_id
					);
					$this->validationModel->ValidateChangePassword($validationModel);
					$get_key 			= $this->utilities->generate_key($validationModel["NewPw"]);
                	$model["password"] 	= password_hash($get_key, PASSWORD_BCRYPT);
                	$process 			= true;
                	$requestId 			= $user_id;
					break;

				case "Reset":
					$requestId = $RequestId;
					$validationModel = array(
						"RequestId" => $requestId,
						"UserId" 	=> $user_id
					);
					$this->validationModel->ValidateResetAccount($validationModel);

					$get_key 			= $this->utilities->generate_key(DEFAULT_PW);
                	$model["password"] 	= password_hash($get_key, PASSWORD_BCRYPT);
                	$process 			= true;
					break;
			}

			if ($process && !empty($model["password"])) {
				$this->db->trans_start();
				$result = $this->userRepo->UpdatePassword($model, $requestId);
				if ($result) {
					$logModel = array(
	        			"UserId" 		=> $user_id,
	        			"Category" 		=> "User Management",
	        			"Description" 	=> $type." password.",
	        			"SID" 			=> $this->session->userdata("LoginData")["SessionId"]
	        		);
	        		$logResult = $this->utilities->InsertActivityLog($logModel);
	        		if ($logResult)
	        			$this->db->trans_commit();
	        		else {
	        			$this->db->trans_rollback();
	        			throw new Exception(OperationalErrorMessage::OPS0003);
	        		}
				} else {
					$this->db->trans_rollback();
        			throw new Exception(OperationalErrorMessage::OPS0001);
				}
			} else
				throw new Exception(OperationalErrorMessage::OPS0001);
		} else {
			log_message("error", "Change Password type is invalid: ".$type);
			throw new Exception(OperationalErrorMessage::OPS0001);
		}
	}

	public function ChangeStatus($RequestId, $Status) {
		$allowed_type 	= array("disable", "enable");
		$user_id    	= $this->session->userdata("LoginData")["LoginId"];
		if (in_array($Status, $allowed_type)) {
			$process = false;
			$model = array(
				"retry" 	=> $Status == "enable" ? "0" : "5",
				"status" 	=> $Status == "enable" ? "1" : "0",
				"update_by" => "System"
			);

			$validationModel = array(
				"model" 	=> $model,
				"UserId" 	=> $user_id,
				"RequestId" => $RequestId
			);
			$this->validationModel->ValidateChangeAccountStatus($validationModel);

			$this->db->trans_start();
			$result = $this->userRepo->UpdateAccountStatus($model, $RequestId);
			if ($result) {
				$logModel = array(
	        		"UserId" 		=> $user_id,
	        		"Category" 		=> "User Management",
	        		"Description" 	=> ucfirst($Status)." account ID: ".$RequestId.".",
	        		"SID" 			=> $this->session->userdata("LoginData")["SessionId"]
	        	);
	        	$logResult = $this->utilities->InsertActivityLog($logModel);
	        	if ($logResult)
	        		$this->db->trans_commit();
	        	else {
	        		$this->db->trans_rollback();
	        		throw new Exception(OperationalErrorMessage::OPS0003);
	        	}
			} else {
				$this->db->trans_rollback();
        		throw new Exception(OperationalErrorMessage::OPS0001);
			}
		} else {
			log_message("error", "Change Password type is invalid: ".$type);
			throw new Exception(OperationalErrorMessage::OPS0001);
		}
	}
}