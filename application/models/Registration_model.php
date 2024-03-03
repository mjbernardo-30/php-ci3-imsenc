<?php
require_once('properties/CustomErrorMessage.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Registration_model extends CI_Model {
	public function __construct() {
        $this->load->model('Utilities_model', 'utilities');
        $this->load->model('ValidationService_model', 'validationModel');
        $this->load->model('RepoRegistration_model', 'registerRepo');
	}

	public function Register() {
		$model = array(
			"name" 			=> $this->utilities->title_string($this->input->post("Name", true)),
			"gender" 		=> $this->input->post("Gender", true),
			"dob" 			=> $this->input->post("DOB", true),
			"address" 		=> $this->input->post("Address", true),
			"mobile" 		=> $this->utilities->GetMobileNumber($this->input->post("Mobile", true)),
			"email" 		=> $this->input->post("Email", true),
			"school" 		=> $this->input->post("SchoolName", true),
			"schoolAddres" 	=> $this->input->post("SchoolAddress", true),
			"schoolRep" 	=> $this->input->post("SchoolRep", true),
			"schoolContact" => $this->input->post("SchoolRepContact", true),
			"reference" 	=> null,
			"sid" 			=> null,
			"gid" 			=> null,
			"status" 		=> 0,
			"infoKey" 		=> null,
			"Story" 		=> $this->input->post("Story", true),
			"Ingredients" 	=> $this->input->post("Ingredients", true),
			"Link" 			=> $this->input->post("Link", true),
			"SchoolEmail" 	=> $this->input->post("SchoolEmail", true),
			"nameKey" 		=> $this->utilities->generate_key($this->input->post("Name", true))
		);

		$model["infoKey"] = $this->utilities->generate_key($model["name"].$model["gender"].$model["dob"]);
		$this->validationModel->ValidateRegistration($model);
		if (empty($_FILES['SchoolID']['name']))
            throw new Exception(ValidationErrorMessage::VLD0017);

        if (empty($_FILES['GovID']['name']))
            throw new Exception(ValidationErrorMessage::VLD0016);
		$this->db->trans_start();
		try {
			$process 	= false;
			$result 	= $this->registerRepo->Register($model);
			if ($result["Result"] && !empty($result["Reference"])) {
				$model["reference"] = "EMR-".$result["Reference"];
				$gidFileName = "G-".date("Ymdi")."-".$model["reference"];
				$sidFileName = "S-".date("Ymdi")."-".$model["reference"];

				if (file_exists("assets/data/stg/".$gidFileName))
					throw new Exception("GID: ".ValidationErrorMessage::VLD0018);

				if (file_exists("assets/data/stg/".$sidFileName))
					throw new Exception("SID: ".ValidationErrorMessage::VLD0018);

				$this->load->library('upload');
				$this->upload->initialize($this->utilities->set_upload_options("reg-stg", $sidFileName));
				if (!$this->upload->do_upload('SchoolID')) {
					$this->db->trans_rollback();
		        	log_message("error", "Registration error when uploading School ID. ".print_r($this->upload->display_errors()));
		        	throw new Exception(OperationalErrorMessage::OPS0004);
                }

                $uploadSID 		= $this->upload->data();
                $model["sid"] 	= base_url()."assets/data/stg/".$uploadSID['file_name'];

				$this->upload->initialize($this->utilities->set_upload_options("reg-stg", $gidFileName));
                if (!$this->upload->do_upload('GovID')) {
					$this->db->trans_rollback();
		        	log_message("error", "Registration error when uploading Government ID. ".print_r($this->upload->display_errors()));
		        	throw new Exception(OperationalErrorMessage::OPS0004);
                }

                $uploadGID 		= $this->upload->data();
                $model["gid"] 	= base_url()."assets/data/stg/".$uploadGID['file_name'];

                $updateInfo = $this->registerRepo->Step2Registration($model, $result["Reference"]);
                if ($updateInfo) {
					$this->db->trans_commit();
					return $model["reference"];
				}
                else {
                	$this->db->trans_rollback();
        			throw new Exception(OperationalErrorMessage::OPS0004);
				}
			} else {
				$this->db->trans_rollback();
	        	log_message("error", "Result or reference is empty. ".print_r($result));
	        	throw new Exception(OperationalErrorMessage::OPS0004);
			}
		} catch (Exception $ex) {
        	$this->db->trans_rollback();
        	log_message("error", "Registration error on inserting. ".$ex->getMessage());
        	throw new Exception(OperationalErrorMessage::OPS0004);
        }
	}

	public function GetRegistrationInfoStg($reference) {
		return $this->registerRepo->GetRegistrationInfoStgByReference($reference);
	}

	public function ResendEmail($reference, $action) {
		$info = $this->registerRepo->GetRegistrationInfoStgByReference($reference);
		if ($info == null)
			throw new Exception("Reference not exist.");

		$emailCategory = null;
		if ($action == "approve")
			$emailCategory = "ApproveRegistration";
		else
			$emailCategory = "RejectRegistration";

		$emailModel = array(
			"Name" 		=> $info->name,
			"Reference" => $info->reference,
			"Email" 	=> $info->email,
			"Remarks" 	=> $info->rejectReason
		);
		$this->utilities->send_email($emailCategory, $emailModel);
	}

	public function RejectRegistration() {
		$user_id = $this->session->userdata("LoginData")["LoginId"];
		$model = array(
			"status" 		=> 2,
			"approverID" 	=> $user_id,
			"rejectReason" 	=> null
		);

		$reason 	= $this->input->post("Reason");
		$specify 	= $this->input->post("specifyReason", true);
		$reference 	= $this->input->post("Reference", true);

		if (array_search("Others",$reason)) {
			$new_remarks = explode(PHP_EOL, $specify);
			for ($i=0; $i < count($new_remarks); $i++) {
				array_push($reason, $new_remarks[$i]);
            }

			unset($reason[array_search("Others",$reason)]);
		}
		
		$reason 	= array_values($reason);
		$lastKey 	= array_key_last($reason);
		$new_reason = null;
		for ($i=0; $i < count($reason); $i++) {
			$number 	= $i + 1;
			$new_reason .= $number.". ".$reason[$i];
			if ($i != $lastKey)
				$new_reason .= "\r\n";
		}

		$model["rejectReason"] = $new_reason;

		$info = $this->registerRepo->GetRegistrationInfoStgByReference($reference);
		$this->validationModel->ValidateRejectRegistration($model, $reference);
		$this->db->trans_start();
		try {
			$result = $this->registerRepo->UpdateRegisterStg($model, $reference);
			if (!$result)
				throw new Exception(OperationalErrorMessage::OPS0001);
			else {
				$logModel = array(
        			"UserId" 		=> $user_id,
        			"Category" 		=> "Registration Management",
        			"Description" 	=> "Reject: ".$reference,
        			"SID" 			=> $this->session->userdata("LoginData")["SessionId"]
        		);
				$logResult = $this->utilities->InsertActivityLog($logModel);
        		if ($logResult) {
					$this->db->trans_commit();
					$emailModel = array(
						"Name" 		=> $info->name,
						"Reference" => $info->reference,
						"Email" 	=> $info->email,
						"Remarks" 	=> $model["rejectReason"]
					);
					$this->utilities->send_email("RejectRegistration", $emailModel);
				}
        		else {
        			$this->db->trans_rollback();
        			throw new Exception(OperationalErrorMessage::OPS0003);
        		}
			}

		} catch (Exception $ex) {
			$this->db->trans_rollback();
        	log_message("error", "Failed to update data. ".$ex->getMessage());
        	throw new Exception(OperationalErrorMessage::OPS0001);
		}
	}

	public function ApproveRegistration() {
		$user_id = $this->session->userdata("LoginData")["LoginId"];
		$model = array(
			"status" 		=> 1,
			"approverID" 	=> $user_id
		);
		$reference 	= $this->input->post("Reference", true);

		$this->validationModel->ValidateApproveRegistration($model, $reference);
		$details = $this->registerRepo->GetRegistrationInfoStgByReference($reference);
		$this->db->trans_start();
		try {
			$result = $this->registerRepo->UpdateRegisterStg($model, $reference);
			if (!$result)
				throw new Exception(OperationalErrorMessage::OPS0001);
			else {
				$this->load->library("encryption");
				$approveModel = array(
					"RegID" 		=> $details->reference,
					"name" 			=> $this->encryption->encrypt($details->name),
					"gender" 		=> $this->encryption->encrypt($details->gender),
					"dob" 			=> $this->encryption->encrypt($details->dob),
					"address" 		=> $this->encryption->encrypt($details->address),
					"mobile" 		=> $this->encryption->encrypt($details->mobile),
					"email" 		=> $this->encryption->encrypt($details->email),
					"school" 		=> $this->encryption->encrypt($details->school),
					"schoolAddres" 	=> $this->encryption->encrypt($details->schoolAddres),
					"schoolRep" 	=> $this->encryption->encrypt($details->schoolRep),
					"schoolContact" => $this->encryption->encrypt($details->schoolContact),
					"sid" 			=> $this->encryption->encrypt($details->sid),
					"gid" 			=> $this->encryption->encrypt($details->gid),
					"status" 		=> 1,
					"infoKey" 		=> $details->infoKey,
					"Story" 		=> $details->Story,
					"Ingredients" 	=> $details->Ingredients,
					"Link" 			=> $details->Link,
					"approverID" 	=> $user_id,
					"SchoolEmail" 	=> $this->encryption->encrypt($details->SchoolEmail),
					"create_at" 	=> $details->create_at,
					"update_at" 	=> date("Y-m-d h:i:s"),
					"mobileKey" 	=> $this->utilities->generate_key($details->mobile),
					"emailKey" 		=> $this->utilities->generate_key($details->email),
					"LinkKey" 		=> $this->utilities->generate_key($details->Link),
					"nameKey" 		=> $this->utilities->generate_key($details->name)
				);
				$result = $this->registerRepo->InsertRegistration($approveModel);
				if (!$result)
					throw new Exception(OperationalErrorMessage::OPS0001);

				$logModel = array(
        			"UserId" 		=> $user_id,
        			"Category" 		=> "Registration Management",
        			"Description" 	=> "Approve: ".$reference,
        			"SID" 			=> $this->session->userdata("LoginData")["SessionId"]
        		);
				$logResult = $this->utilities->InsertActivityLog($logModel);
        		if ($logResult) {
					$this->db->trans_commit();
					$emailModel = array(
						"Name" 		=> $approveModel["name"],
						"Reference" => $approveModel["RegID"],
						"Email" 	=> $approveModel["email"],
						"Remarks" 	=> null
					);
					$this->utilities->send_email("ApproveRegistration", $emailModel);
				}
        		else {
        			$this->db->trans_rollback();
        			throw new Exception(OperationalErrorMessage::OPS0003);
        		}
			}

		} catch (Exception $ex) {
			$this->db->trans_rollback();
        	log_message("error", "Failed to update data. ".$ex->getMessage());
        	throw new Exception(OperationalErrorMessage::OPS0001);
		}
	}

	public function GetDashboardTileData() {
		$data = array(
			"TotalRegistrant" => 0,
			"TotalPending" => 0,
			"TotalApprove" => 0,
			"TotalReject" => 0
		);

		$totalRegistrant 	= $this->registerRepo->GetTotalRegistrant();
		$totalPending 		= $this->registerRepo->GetTotalRegistrantPending();
		$totalApprove 		= $this->registerRepo->GetTotalRegistrantApprove();
		$totalReject 		= $this->registerRepo->GetTotalRegistrantReject();

		$data["TotalRegistrant"] 	= $totalRegistrant;
		$data["TotalPending"] 		= $totalPending;
		$data["TotalApprove"] 		= $totalApprove;
		$data["TotalReject"] 		= $totalReject;

		return $data;
	}

	public function GetDashboardChartData() {
		$data = array(
			"RegistrationByDate" => array()
		);

		$totalRegistration_query = $this->db->select("DATE(create_at) AS date_receive, COUNT(*) AS total_count")
        ->group_by("date_receive")->order_by("date_receive", "ASC")->get("registration_stg");
        if ($totalRegistration_query->num_rows() > 0) {
            $resultSet_totalRegistration = $totalRegistration_query->result();
        } else {
            $resultSet_totalRegistration = array();
        }

		$data["RegistrationByDate"] = $resultSet_totalRegistration;

		return $data;
	}

	public function GetRegistrationData() {
		$this->load->library("encryption");
		$result 	= array();
		$startDate 	= $this->input->post("DateFrom", true);
		$endDate 	= $this->input->post("DateTo", true);

		$filterModel = array(
			"StartDate" => $startDate,
			"EndDate" 	=> $endDate
		);

		$stageData 		= $this->registerRepo->GetStgRegistration("All", $filterModel);
		$approveData 	= $this->registerRepo->GetApproveRegistration($filterModel);

		if ($stageData != null) {
			foreach ($stageData as $stageRow) {
				$status = "Unidentified";
				if ($stageRow->status == 0)
					$status = "Pending";
				elseif ($stageRow->status == 1)
					$status = "Approved";
				elseif ($stageRow->status == 2)
					$status = "Rejected";

				$arrItem = array(
					"Name" 			=> $this->encryption->decrypt($stageRow->name),
					"Gender" 		=> $this->encryption->decrypt($stageRow->gender) == "M" ? "Male" : "Female",
					"DOB" 			=> date("F d, Y", strtotime($this->encryption->decrypt($stageRow->dob))),
					"Address" 		=> $this->encryption->decrypt($stageRow->address),
					"Mobile" 		=> $this->encryption->decrypt($stageRow->mobile),
					"Email" 		=> $this->encryption->decrypt($stageRow->email),
					"School" 		=> $this->encryption->decrypt($stageRow->school),
					"SchoolAddress" => $this->encryption->decrypt($stageRow->schoolAddres),
					"SchoolRep" 	=> $this->encryption->decrypt($stageRow->schoolRep),
					"SchoolContact" => $this->encryption->decrypt($stageRow->schoolContact),
					"SchoolEmail" 	=> $this->encryption->decrypt($stageRow->SchoolEmail),
					"Reference" 	=> $stageRow->reference,
					"Status" 		=> $status,
					"Remarks" 		=> $stageRow->rejectReason,
					"CreateAt" 		=> $this->ConvertDateTime($stageRow->create_at),
					"UpdateAt" 		=> $this->ConvertDateTime($stageRow->update_at)
				);

				array_push($result, $arrItem);
			}
		}

		if ($approveData != null) {
			foreach ($approveData as $stageRow) {
				$status = "Unidentified";
				if ($stageRow->status == 0)
					$status = "Pending";
				elseif ($stageRow->status == 1)
					$status = "Approved";
				elseif ($stageRow->status == 2)
					$status = "Rejected";

				$arrItem = array(
					"Name" 			=> $this->encryption->decrypt($stageRow->name),
					"Gender" 		=> $this->encryption->decrypt($stageRow->gender) == "M" ? "Male" : "Female",
					"DOB" 			=> date("F d, Y", strtotime($this->encryption->decrypt($stageRow->dob))),
					"Address" 		=> $this->encryption->decrypt($stageRow->address),
					"Mobile" 		=> $this->encryption->decrypt($stageRow->mobile),
					"Email" 		=> $this->encryption->decrypt($stageRow->email),
					"School" 		=> $this->encryption->decrypt($stageRow->school),
					"SchoolAddress" => $this->encryption->decrypt($stageRow->schoolAddres),
					"SchoolRep" 	=> $this->encryption->decrypt($stageRow->schoolRep),
					"SchoolContact" => $this->encryption->decrypt($stageRow->schoolContact),
					"SchoolEmail" 	=> $this->encryption->decrypt($stageRow->SchoolEmail),
					"Reference" 	=> $stageRow->RegID,
					"Status" 		=> $status,
					"Remarks" 		=> null,
					"CreateAt" 		=> $this->ConvertDateTime($stageRow->create_at),
					"UpdateAt" 		=> !empty($stageRow->update_at) ? $this->ConvertDateTime($stageRow->update_at) : null
				);

				array_push($result, $arrItem);
			}
		}		

		return $result;
	}

	private function ConvertDateTime($value) {
        if (TZ_CONVERT) {
            $tz     = new DateTimeZone('Asia/Manila');
            $date   = new DateTime(date("D, d M Y H:i:s", strtotime($value))." UTC");
            $date->setTimezone($tz);
            return $date->format('F d, Y h:i A');
        } else {
            return date("F d, Y h:i A", strtotime($value));
        }
    }
}