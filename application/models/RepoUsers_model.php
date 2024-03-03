<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RepoUsers_model extends CI_Model {
    public function GetUserByEmail($email) {
        $data = $this->db->where("email", $email)->get("portal_users");

        if ($data->num_rows() > 0)
            return $data->row();
        else
            return null;
    }

    public function GetUserByUserId($userId) {
        $data = $this->db->where("Id", $userId)->get("portal_users");

        if ($data->num_rows() > 0)
            return $data->row();
        else
            return null;
    }

    public function IncorrectPassword($email) {
        $this->db->set("Retry", "Retry + 1", FALSE)->where("email", $email)->update("portal_users");
        if ($this->db->affected_rows() == 0)
            log_message("error", OperationalErrorMessage::OPS0001." ".$this->db->last_query());
    }

    public function GetLatestLoginTimeByUserIdSID($user_id, $sid) {
        $where = array('UserId' => $user_id, 'sid' => $sid);
        $data = $this->db->where($where)->order_by("logAt", "desc")->get("portal_login_history");

        if ($data->num_rows() > 0)
            return $data->row();
        else
            return null;
    }

    public function InsertLoginLog($model) {
        $result = false;
        $query = $this->db->insert('portal_login_history', $model);
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error inserting login logs. ".$this->db->last_query());

        return $result;
    }

    public function UpdateUserSID($userId, $sid, $category) {
        $result = false;
        switch ($category) {
            case "Login":
                $this->db->set('sid', $sid);
                break;
            case "Logout":
                $this->db->set('sid', null);
                break;
        }
        $this->db->set('update_by', "System");
        $this->db->where('Id', $userId);
        $this->db->update('portal_users');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating user session ID. ".$this->db->last_query());

        return $result;
    }

    public function UpdateUserRetry($userId) {
        $this->db->set('retry', 0);
        $this->db->set('update_by', "System");
        $this->db->where('Id', $userId);
        $this->db->update('portal_users');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating user retry. ".$this->db->last_query());

        return $result;
    }

    public function CheckEmailExist($email) {
        $result = $this->db->where('email', $email)->get("portal_users");;

        if ($result->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function CreateAccount($model) {
        $result = false;
        $query = $this->db->insert('portal_users', $model);
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error creating user account. ".$this->db->last_query());

        return $result;
    }

    public function UpdatePassword($model, $userId) {
        $this->db->set($model);
        $this->db->where('Id', $userId);
        $this->db->update('portal_users');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating user retry. ".$this->db->last_query());

        return $result;
    }

    public function UpdateAccountStatus($model, $userId) {
        $this->db->set($model);
        $this->db->where('Id', $userId);
        $this->db->update('portal_users');
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error updating user status. ".$this->db->last_query());

        return $result;
    }
}