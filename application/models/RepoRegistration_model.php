<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RepoRegistration_model extends CI_Model {
    public function __construct() {
        $this->load->model('Utilities_model', 'utilities');
	}

    public function CheckRegistrationInfo($value) {
        $data = $this->db->where("infoKey", $value)->get("registration");

        if ($data->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function CheckRegistrationMobile($value) {
        $result = false;
        $data = $this->db->where("mobileKey", $value)->count_all_results("registration");

        if ($data > 0)
            $result = true;

        return $result;
    }

    public function CountMobile($value) {
        $value = $this->utilities->GetMobileNumber($value);
        $value = $this->utilities->generate_key($value);
        $data = $this->db->where("mobileKey", $value)->count_all_results("registration");

        return $data;
    }

    public function CheckRegistrationEmail($value) {
        $data = $this->db->where("emailKey", $value)->get("registration");

        if ($data->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function CheckRegistrationEntry($value) {
        $data = $this->db->where("LinkKey", $value)->get("registration");

        if ($data->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function Register($model) {
        $result = false;
        $data   = null;

        $this->load->library('encryption');

        $model["name"]          = $this->encryption->encrypt($model["name"]);
        $model["dob"]           = $this->encryption->encrypt($model["dob"]);
        $model["school"]        = $this->encryption->encrypt($model["school"]);
        $model["schoolAddres"]  = $this->encryption->encrypt($model["schoolAddres"]);
        $model["gender"]        = $this->encryption->encrypt($model["gender"]);
        $model["email"]         = $this->encryption->encrypt($model["email"]);
        $model["mobile"]        = $this->encryption->encrypt($model["mobile"]);
        $model["address"]       = $this->encryption->encrypt($model["address"]);
        $model["schoolRep"]     = $this->encryption->encrypt($model["schoolRep"]);
        $model["schoolContact"] = $this->encryption->encrypt($model["schoolContact"]);
        $model["SchoolEmail"]   = $this->encryption->encrypt($model["SchoolEmail"]);
        $query = $this->db->insert('registration_stg', $model);
        if ($this->db->affected_rows() > 0) {
            $result = true;
            $data   = $this->db->insert_id();
        } else
            log_message("error", "Error creating registration. ".$this->db->last_query());

        $resArray = array("Result" => $result, "Reference" => $data);
        return $resArray;
    }

    public function Step2Registration($model, $regId) {
        $result = false;        

        $this->load->library('encryption');

        $model["sid"] = $this->encryption->encrypt($model["sid"]);
        $model["gid"] = $this->encryption->encrypt($model["gid"]);
        $this->db->set('reference', $model["reference"]);
        $this->db->set('sid', $model["sid"]);
        $this->db->set('gid', $model["gid"]);
        $this->db->where('Id', $regId);
        $this->db->update('registration_stg');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating registration. ".$this->db->last_query());

        return $result;
    }

    public function GetRegistrationInfoStgByReference($reference) {
        $this->load->library("encryption");
        $data = $this->db->where("reference", $reference)->get("registration_stg");
        
        if ($data->num_rows() > 0) {
            $data->row()->sid           = $this->encryption->decrypt($data->row()->sid);
            $data->row()->gid           = $this->encryption->decrypt($data->row()->gid);
            $data->row()->SchoolEmail   = $this->encryption->decrypt($data->row()->SchoolEmail);
            $data->row()->schoolContact = $this->encryption->decrypt($data->row()->schoolContact);
            $data->row()->schoolRep     = $this->encryption->decrypt($data->row()->schoolRep);
            $data->row()->address       = $this->encryption->decrypt($data->row()->address);
            $data->row()->mobile        = $this->encryption->decrypt($data->row()->mobile);
            $data->row()->email         = $this->encryption->decrypt($data->row()->email);
            $data->row()->gender        = $this->encryption->decrypt($data->row()->gender);
            $data->row()->schoolAddres  = $this->encryption->decrypt($data->row()->schoolAddres);
            $data->row()->school        = $this->encryption->decrypt($data->row()->school);
            $data->row()->dob           = $this->encryption->decrypt($data->row()->dob);
            $data->row()->name          = $this->encryption->decrypt($data->row()->name);
            return $data->row();
        } else
            return null;
    }

    public function GetInfoStgByReference($reference) {
        $data = $this->db->where("reference", $reference)->get("registration_stg");

        if ($data->num_rows() > 0)
            return $data->row();
        else
            return null;
    }

    public function UpdateRegisterStg($model, $reference) {
        $result = false;        

        $this->db->set($model);
        $this->db->where('reference', $reference);
        $this->db->update('registration_stg');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating registration. ".$this->db->last_query());

        return $result;
    }

    public function InsertRegistration($model) {
        $result = false;

        $query = $this->db->insert('registration', $model);
        if ($this->db->affected_rows() > 0)
            $result = true;
        else 
            log_message("error", "Error inserting registration. ".$this->db->last_query());

        return $result;
    }

    public function GetTotalRegistrant() {
        return $this->db->count_all_results("registration_stg");
    }

    public function GetTotalRegistrantPending() {
        return $this->db->where("status", 0)->count_all_results("registration_stg");
    }

    public function GetTotalRegistrantApprove() {
        return $this->db->where("status", 1)->count_all_results("registration");
    }

    public function GetTotalRegistrantReject() {
        return $this->db->where("status", 2)->count_all_results("registration_stg");
    }

    public function GetStgRegistration($type, $filter) {
        $data       = null;
        $getData    = null;
        switch ($type) {
            case 'All':
                $this->db->where("Date(create_at) >=", $filter["StartDate"]);
                $this->db->where("Date(create_at) <=", $filter["EndDate"]);
                $getData = $this->db->where("status !=", 1)->order_by("create_at")->get("registration_stg");
                break;

            case 'Pending':
                # code...
                break;

            case 'Reject':
                # code...
                break;
        }

        if ($getData != null && $getData->num_rows() > 0)
            $data = $getData->result();
        
        return $data;
    }

    public function GetApproveRegistration($filter) {
        $data       = null;
        $getData    = null;

        $this->db->where("Date(create_at) >=", $filter["StartDate"]);
        $this->db->where("Date(create_at) <=", $filter["EndDate"]);
        $getData = $this->db->where("status", 1)->order_by("create_at")->get("registration");

        if ($getData != null && $getData->num_rows() > 0)
            $data = $getData->result();
        
        return $data;
    }
 }