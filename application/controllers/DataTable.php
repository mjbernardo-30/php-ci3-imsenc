<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTable extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model('Utilities_model', 'utilities');
    }

    public function GetUsers() {
        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search", true);
        $search = $search['value'];

        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => 0,
            "recordsFiltered"   => 0,
            "data"              => array()
        );

        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable GetUsers -- LoginData not found.");
            echo json_encode($output);
        }
        $user_id = $this->session->userdata("LoginData")["LoginId"];

        $col    = 0;
        $dir    = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        $valid_columns = array(
            0 => 'name',
            1 => 'report',
            2 => 'create_at',
            3 => 'actions'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $this->db->select("Id, name, email, create_at, update_at, status");
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("email", $search);
            $this->db->or_like("name", $search);
            if (TZ_CONVERT) {
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(create_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(update_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
            } else {
                $this->db->or_like("DATE_FORMAT(create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(update_at, '%M %d, %Y %h:%i %p')", $search);
            }
            $this->db->group_end();
        }

        $this->db->where("Id !=", $user_id);
        $get_data   = $this->db->order_by($order, $dir)->limit($length, $start)->get("portal_users");
        $data       = array();
        if ($get_data->num_rows() > 0) {
            foreach ($get_data->result() as $rows) {
                $accountId[]   = $rows->Id;
                $name[]     = $rows->name;
                $email[]    = $rows->email;
                if ($rows->status == "1") {
                    $status[] = "<span class='text-success'>Active</span>";
                    $actions[] = "<a class='text-decoration-none' href='".base_url()."admin/users/status/".$rows->Id."/disable'>
                    <button type='button' class='btn btn-sm btn-danger'><i class='fas fa-fw fa-ban'></i> Disable</button>
                    </a>";
                } elseif ($rows->status == "2") {
                    $status[] = "<span class='text-warning'>Locked</span>";
                    $actions[] = "<a class='text-decoration-none' href='".base_url()."admin/users/reset/".$rows->Id."'>
                    <button type='button' class='btn btn-sm btn-primary'><i class='fas fa-fw fa-undo'></i> Reset</button>
                    </a>";
                } else {
                    $status[] = "<span class='text-danger'>Disabled</span>";
                    $actions[] = "<a class='text-decoration-none' href='".base_url()."admin/users/status/".$rows->Id."/enable'>
                    <button type='button' class='btn btn-sm btn-success'><i class='fas fa-fw fa-user-check'></i> Enable</button>
                    </a>";
                }
                
                $date_create[] = $this->ConvertDateTime($rows->create_at);
                if (empty($rows->update_at)) {
                    $date_update[]    = "No changes have been made.";
                } else {
                    $date_update[] = $this->ConvertDateTime($rows->update_at);
                }
            }
            for ($i=0; $i < count($accountId); $i++) { 
                $data[] = array(
                    "Name: ".$name[$i]."<br>Email: ".$email[$i]."<br>Status: ".$status[$i],
                    "0",
                    "Date Create: ".$date_create[$i]."<br>Date Update: ".$date_update[$i],
                    $actions[$i]
                );
            }
        }

        $totalEntries               = $this->TotalRecord("site_users");
        $totalEntriesFilter         = $this->TotalRecordWithFilter($search, "site_users");
        $output["recordsTotal"]     = $totalEntries;
        $output["recordsFiltered"]  = $totalEntriesFilter;
        $output["data"]             = $data;
        echo json_encode($output);
        exit();
    }

    public function GetActivityLogs() {
        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search", true);
        $search = $search['value'];

        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => 0,
            "recordsFiltered"   => 0,
            "data"              => array()
        );

        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable GetActivityLogs -- LoginData not found.");
            echo json_encode($output);
        }
        $user_id = $this->session->userdata("LoginData")["LoginId"];

        $col    = 0;
        $dir    = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc")
            $dir = "desc";

        $valid_columns = array(
            0 => 'user',
            1 => 'Category',
            2 => 'Description',
            3 => 'CreateAt'
        );

        if (!isset($valid_columns[$col]))
            $order = null;
        else
            $order = $valid_columns[$col];

        $this->db->select("b.email as user, a.Category, a.Description, a.CreateAt");
        if (!empty($search)) {
            $this->db->like("b.email", $search);
            $this->db->or_like("a.Category", $search);
            $this->db->or_like("a.Description", $search);
            $this->db->or_like("DATE_FORMAT(a.CreateAt, '%M %d, %Y %h:%i %p')", $search);
            if (TZ_CONVERT) {
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(a.CreateAt, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
            } else {
                $this->db->or_like("DATE_FORMAT(a.CreateAt, '%M %d, %Y %h:%i %p')", $search);
            }
        }

        $get_data   = $this->db->order_by($order, $dir)->limit($length, $start)->join("portal_users b", "a.UserId = b.Id")->get("portal_activity_logs a");
        $data       = array();
        if ($get_data->num_rows() > 0) {
            foreach ($get_data->result() as $rows) {
                $user[]         = $rows->user;
                $category[]     = $rows->Category;
                $description[]  = $rows->Description;
                $date[]         = $this->ConvertDateTime($rows->CreateAt);
            }
            for ($i=0; $i < count($description); $i++) { 
                $data[] = array(
                    $user[$i],
                    $category[$i],
                    $description[$i],
                    "Date Create: ".$date[$i]
                );
            }
        }

        $totalEntries               = $this->TotalRecord("site_actlogs");
        $totalEntriesFilter         = $this->TotalRecordWithFilter($search, "site_actlogs");
        $output["recordsTotal"]     = $totalEntries;
        $output["recordsFiltered"]  = $totalEntriesFilter;
        $output["data"]             = $data;
        echo json_encode($output);
        exit();
    }

    public function GetRegistrants($status) {
        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search", true);
        $search = $search['value'];

        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => 0,
            "recordsFiltered"   => 0,
            "data"              => array()
        );

        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable GetRegistrants -- LoginData not found.");
            echo json_encode($output);
        }
        $user_id = $this->session->userdata("LoginData")["LoginId"];

        $col    = 0;
        $dir    = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        $valid_columns = array(
            0 => 'name',
            1 => 'school',
            2 => 'create_at'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $this->db->select("Id, name, reference, create_at, update_at, status, school, rejectReason");
        $this->db->where("status", $status);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("nameKey", $this->utilities->generate_key($search));
            $this->db->or_like("reference", $search);
            $this->db->or_like("schoolKey", $this->utilities->generate_key($search));
            if (TZ_CONVERT) {
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(create_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(update_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
            } else {
                $this->db->or_like("DATE_FORMAT(create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(update_at, '%M %d, %Y %h:%i %p')", $search);
            }

            $this->db->group_end();
        }

        $get_data   = $this->db->order_by($order, $dir)->limit($length, $start)->get("registration_stg");
        $data       = array();
        if ($get_data->num_rows() > 0) {
            foreach ($get_data->result() as $rows) {
                $regId[]        = $rows->Id;
                $name[]         = $this->encryption->decrypt($rows->name);
                $reference[]    = $rows->reference;
                $school[]       = $this->encryption->decrypt($rows->school);
                $getStatus[]    = $rows->status;
                $reason[]       = $rows->rejectReason;
                
                $date_create[] = $this->ConvertDateTime($rows->create_at);
                if (empty($rows->update_at)) {
                    $date_update[]    = "No changes have been made.";
                } else {
                    $date_update[] = $this->ConvertDateTime($rows->update_at);
                }

                if ($rows->status == 2)
                    $resultData[] = "Name: ".$this->encryption->decrypt($rows->name)."<br>Reference: <a href='".base_url()."admin/registration/view/".urlencode($rows->reference)."'>".$rows->reference."</a><br>Reason: ".$rows->rejectReason;
                else
                    $resultData[] = "Name: ".$this->encryption->decrypt($rows->name)."<br>Reference: <a href='".base_url()."admin/registration/view/".urlencode($rows->reference)."'>".$rows->reference."</a>";
            }
            for ($i=0; $i < count($regId); $i++) {
                $result1 = "Name: <a href='".base_url()."admin/registration/view/".urlencode($reference[$i])."'>".$name[$i]."</a>";
                $result2 = $school[$i];
                $result3 = "Date Create: ".$date_create[$i];

                if (empty($date_update[$i]))
                    $result3 .= "<br>No changes have been made.";
                else
                    $result3 .= "<br>Date Update: ".$this->ConvertDateTime($date_update[$i]);

                if ($getStatus[$i] == 2)
                    $result1 .= "<br>Reason: ".$reason[$i];

                $data[] = array(
                    $result1,
                    $result2,
                    $result3
                );
            }
        }

        $totalEntries               = $this->TotalRecord("registration", $status);
        $totalEntriesFilter         = $this->TotalRecordWithFilter($search, "registration", $status);
        $output["recordsTotal"]     = $totalEntries;
        $output["recordsFiltered"]  = $totalEntriesFilter;
        $output["data"]             = $data;
        echo json_encode($output);
        exit();
    }

    public function GetApproveRegistrants() {
        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search", true);
        $search = $search['value'];

        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => 0,
            "recordsFiltered"   => 0,
            "data"              => array()
        );

        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable GetApproveRegistrants -- LoginData not found.");
            echo json_encode($output);
        }
        $user_id = $this->session->userdata("LoginData")["LoginId"];

        $col    = 0;
        $dir    = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        $valid_columns = array(
            0 => 'name',
            1 => 'school',
            2 => 'create_at',
            3 => 'approver'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $this->db->select("a.Id, a.name, a.RegID, a.create_at, a.update_at, a.status, a.school, b.email as approver");
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("a.name", $search);
            $this->db->or_like("a.RegID", $search);
            $this->db->or_like("a.school", $search);
            if (TZ_CONVERT) {
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(a.create_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(CONVERT_TZ(a.update_at, @@session.time_zone, '+08:00'), '%M %d, %Y %h:%i %p')", $search);
            } else {
                $this->db->or_like("DATE_FORMAT(a.create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(a.update_at, '%M %d, %Y %h:%i %p')", $search);
            }
            $this->db->or_like("b.email", $search);
            $this->db->group_end();
        }

        $get_data   = $this->db->order_by($order, $dir)->limit($length, $start)->join("portal_users b", "a.approverID = b.Id")->get("registration a");
        $data       = array();
        if ($get_data->num_rows() > 0) {
            foreach ($get_data->result() as $rows) {
                $regId[]        = $rows->Id;
                $name[]         = $rows->name;
                $reference[]    = $rows->RegID;
                $school[]       = $rows->school;
                $getStatus[]    = $rows->status;
                $approver[]     = $rows->approver;
                
                $date_create[] = $this->ConvertDateTime($rows->create_at);
                if (empty($rows->update_at)) {
                    $date_update[]    = "No changes have been made.";
                } else {
                    $date_update[]    = $this->ConvertDateTime($rows->update_at);
                }
            }
            for ($i=0; $i < count($regId); $i++) { 
                $data[] = array(
                    "Name: ".$this->encryption->decrypt($name[$i])."<br>Registration Reference: <a href='".base_url()."admin/registration/view/approve/".urlencode($reference[$i])."'>".$reference[$i]."</a>",
                    $this->encryption->decrypt($school[$i]),
                    "Date Create: ".$date_create[$i]."<br>Date Update: ".$date_update[$i],
                    $approver[$i]
                );
            }
        }

        $totalEntries               = $this->TotalRecord("approveRegistration");
        $totalEntriesFilter         = $this->TotalRecordWithFilter($search, "approveRegistration");
        $output["recordsTotal"]     = $totalEntries;
        $output["recordsFiltered"]  = $totalEntriesFilter;
        $output["data"]             = $data;
        echo json_encode($output);
        exit();
    }

    private function TotalRecord($service, $value = 0) {
        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable TotalRecord -- LoginData not found.");
            return 0;
        }

        $result     = null;
        $user_id    = $this->session->userdata("LoginData")["LoginId"];
        switch ($service) {
            case 'site_users':
                $result = $this->db->where("Id !=", $user_id)->count_all_results("portal_users");
                break;

            case 'site_actlogs':
                $result = $this->db->join("portal_users b", "a.UserId = b.Id")->count_all_results("portal_activity_logs a");
                break;
            
            case 'registration':
                $result = $this->db->where("status", $value)->count_all_results("registration_stg");
                break;

            case 'approveRegistration':
                $result = $this->db->join("portal_users b", "a.approverID = b.Id")->count_all_results("registration a");
                break;
        }

        return $result;
    }

    private function TotalRecordWithFilter($search, $service, $value = 0) {
        if (!$this->session->has_userdata("LoginData")) {
            log_message("error", "DataTable TotalRecordWithFilter -- LoginData not found.");
            return 0;
        }

        $result     = null;
        $user_id    = $this->session->userdata("LoginData")["LoginId"];
        switch ($service) {
            case 'site_users':
                $this->db->where("Id !=", $user_id);
                $this->db->group_start();
                $this->db->like("email", $search);
                $this->db->or_like("name", $search);
                $this->db->or_like("DATE_FORMAT(create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(update_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->group_end();
                $result = $this->db->count_all_results("portal_users");
                break;

            case 'site_actlogs':
                $this->db->like("b.email", $search);
                $this->db->or_like("a.Category", $search);
                $this->db->or_like("a.Description", $search);
                $this->db->or_like("DATE_FORMAT(a.CreateAt, '%M %d, %Y %h:%i %p')", $search);
                $result = $this->db->join("portal_users b", "a.UserId = b.Id")->count_all_results("portal_activity_logs a");
                break;

            case 'registration':
                $this->db->where("status", $value);
                $this->db->group_start();
                $this->db->like("name", $search);
                $this->db->or_like("reference", $search);
                $this->db->or_like("school", $search);
                $this->db->or_like("DATE_FORMAT(create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(update_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->group_end();
                $result = $this->db->count_all_results("registration_stg");
                break;

            case 'approveRegistration':
                $this->db->group_start();
                $this->db->like("a.name", $search);
                $this->db->or_like("a.RegID", $search);
                $this->db->or_like("a.school", $search);
                $this->db->or_like("DATE_FORMAT(a.create_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("DATE_FORMAT(a.update_at, '%M %d, %Y %h:%i %p')", $search);
                $this->db->or_like("b.email", $search);
                $this->db->group_end();
                $result = $this->db->join("portal_users b", "a.approverID = b.Id")->count_all_results("registration a");
                break;
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

    private function ConvertDateTime2UTC($value) {
        $dateTime = date("Y-m-d H:i:s", strtotime($value));
        $newDateTime = new DateTime($value); 
        $newDateTime->setTimezone(new DateTimeZone("UTC")); 
        $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
        return $dateTimeUTC;
    }
}