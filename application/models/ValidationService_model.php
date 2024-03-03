<?php
require_once('properties/CustomErrorMessage.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class ValidationService_model extends CI_Model {
    public function __construct() {
        $this->load->model('RepoUsers_model', 'userRepo');
        $this->load->model('RepoRegistration_model', 'registerRepo');
        $this->load->model('Utilities_model', 'utilities');
    }

	public function ValidateLogin($email, $password) {
        $accountInformation = $this->userRepo->GetUserByEmail($email);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0001);

        if ($accountInformation->status != 1)
            throw new Exception(ValidationErrorMessage::VLD0004);

        if (!empty($accountInformation->sid)) {
            $getLatestLoginTime = $this->userRepo->GetLatestLoginTimeByUserIdSID($accountInformation->Id, $accountInformation->sid);
            if (!empty($getLatestLoginTime)) {
                $interval = round(abs(strtotime("now") - strtotime($getLatestLoginTime->logAt)) / 60);
                if ($interval < "20")
                    throw new Exception(ValidationErrorMessage::VLD0005);
            }
        }
    }

    public function ValidateCreateAccount($model) {
        $accountInformation = $this->userRepo->CheckEmailExist($model["email"]);
        if ($accountInformation)
            throw new Exception(ValidationErrorMessage::VLD0006);
    }

    public function ValidateChangePassword($model) {
        $accountInformation = $this->userRepo->GetUserByUserId($model["UserId"]);
        $get_key 			= $this->utilities->generate_key($model["OldPw"]);
        $model["OldPw"]   = $this->utilities->generate_key($model["OldPw"]);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0007);

        if ($model["ConfirmPw"] != $model["NewPw"])
            throw new Exception(ValidationErrorMessage::VLD0008);
        
        if (!password_verify($model["OldPw"], $accountInformation->password))
            throw new Exception(ValidationErrorMessage::VLD0003);

        if ($accountInformation->status == 0)
            throw new Exception(ValidationErrorMessage::VLD0009);
    }

    public function ValidateResetAccount($model) {
        $accountInformation = $this->userRepo->GetUserByUserId($model["RequestId"]);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0007);

        if ($model["RequestId"] == $model["UserId"])
            throw new Exception(ValidationErrorMessage::VLD0010);

        if ($accountInformation->status == 0)
            throw new Exception(ValidationErrorMessage::VLD0009);
    }

    public function ValidateChangeAccountStatus($model) {
        $accountInformation = $this->userRepo->GetUserByUserId($model["RequestId"]);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0007);

        if ($model["RequestId"] == $model["UserId"])
            throw new Exception(ValidationErrorMessage::VLD0010);

        if ($accountInformation->status == $model["model"]["status"])
            throw new Exception(ValidationErrorMessage::VLD0011);
    }

    public function ValidateRegistration($model) {
        if (!$this->ValidateDOB($model["dob"]))
            throw new Exception(ValidationErrorMessage::VLD0012);

        $checkInfoKey = $this->registerRepo->CheckRegistrationInfo($model["infoKey"]);
        if ($checkInfoKey)
            throw new Exception(ValidationErrorMessage::VLD0013);

        $mobileKey = $this->utilities->generate_key($model["mobile"]);
        $checkMobile = $this->registerRepo->CheckRegistrationMobile($mobileKey);
        if ($checkMobile)
            throw new Exception(ValidationErrorMessage::VLD0014);

        $emailKey = $this->utilities->generate_key($model["email"]);
        $checkEmail = $this->registerRepo->CheckRegistrationEmail($emailKey);
        if ($checkEmail)
            throw new Exception(ValidationErrorMessage::VLD0015);
    }

    public function ValidateRejectRegistration($model, $reference) {
        $accountInformation = $this->registerRepo->GetRegistrationInfoStgByReference($reference);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0019);

        if ($accountInformation->status == 2)
            throw new Exception(ValidationErrorMessage::VLD0020);

        if ($accountInformation->status == 1)
            throw new Exception(ValidationErrorMessage::VLD0021);
    }

    public function ValidateApproveRegistration($model, $reference) {
        $accountInformation = $this->registerRepo->GetRegistrationInfoStgByReference($reference);
        if (empty($accountInformation))
            throw new Exception(ValidationErrorMessage::VLD0019);

        if ($accountInformation->status == 2)
            throw new Exception(ValidationErrorMessage::VLD0020);

        if ($accountInformation->status == 1)
            throw new Exception(ValidationErrorMessage::VLD0021);

        if ($this->registerRepo->CheckRegistrationInfo($accountInformation->infoKey))
            throw new Exception(ValidationErrorMessage::VLD0013);
        
        $mobileKey = $this->utilities->generate_key($accountInformation->mobile);
        if ($this->registerRepo->CheckRegistrationMobile($accountInformation->mobile))
            throw new Exception(ValidationErrorMessage::VLD0014);

        $emailKey = $this->utilities->generate_key($accountInformation->email);
        if ($this->registerRepo->CheckRegistrationEmail($accountInformation->email))
            throw new Exception(ValidationErrorMessage::VLD0015);

        $linkKey = $this->utilities->generate_key($accountInformation->Link);
        if ($this->registerRepo->CheckRegistrationEntry($accountInformation->Link))
            throw new Exception(ValidationErrorMessage::VLD0022);
    }

    private function ValidateDOB($dob) {
        $dob = strtotime($dob);

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if(time() - $dob < ELIGIBLE_AGE * 31536000)
            return false;

        return true;
    }
}