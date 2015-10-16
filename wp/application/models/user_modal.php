<?php

class user_modal extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function check_user_credential($login_user_email, $login_user_password = NULL, $is_check = 0, $forgot_check = 0, $is_active=1 ) {
        $this->db->where('user_email', $login_user_email);
        if ($is_active == 1) $this->db->where('is_active', 1);
        if ($forgot_check != 1) {
            $this->db->where('user_password', md5($login_user_password));
        }
        $query = $this->db->get(TABLE_PANEL_USER_MASTER);
        if ($is_check == 0) {
            return $query->num_rows();
        } else {
            return $query->row();
        }
    }

    function check_register_email($user_email) {
        $this->db->where('user_email', $user_email);
		$this->db->where('is_active', 1);
        $query = $this->db->get(TABLE_PANEL_USER_MASTER);
        return $query->num_rows();
    }
	function check_company_exists($company_name) {
        $this->db->where('company_name', $company_name);
		
        $query = $this->db->get(TABLE_COMPANY_MASTER);
        return $query->num_rows();
    }

    function check_long_key($long_key,$is_active=0, $is_check = 0) {
       $this->db->where('long_key', $long_key);
       $this->db->where('is_active', $is_active);
	   $query = $this->db->get(TABLE_PANEL_USER_MASTER);
           if ($is_check == 0) {
            return $query->num_rows();
        } else {
            return $query->row();
        }
       
	}
	function get_user($user_id){
		$query = $this->db->query("select * from ".TABLE_PANEL_USER_MASTER." where user_id = '".$user_id."' and is_active = 1 ");      
		return $query->row_array();
	}
	function get_last_user(){
		$this->db->order_by("user_id", "desc");
		$this->db->limit("1", "0");
		$query = $this->db->get(TABLE_PANEL_USER_MASTER);
		return $query->row();
	}
	function active_user($long_key){
		 $this->db->query("update " . TABLE_PANEL_USER_MASTER . " set is_active = '1', user_entry_ip = '" . $_SERVER['REMOTE_ADDR'] . "', user_modified_date = now() where long_key = '" . $long_key . "'");
	}
	function insert_user_company($user_company_data){
		$this->db->query("insert into ".TABLE_COMPANY_MASTER." (company_id,company_name,company_type,company_entry_date,company_modified_date,company_entry_ip) values(null, '".$user_company_data['company_name']."', '".$user_company_data['user_type']."', now(), now(), '".$_SERVER['REMOTE_ADDR']."') ");
		$company_id = $this->db->insert_id();
		$this->db->query("insert into ".TABLE_PANEL_USER_MASTER." (user_id, user_name, user_email, user_password, user_type, company_id, long_key, is_active,user_entry_date, user_modified_date, user_entry_ip,profile_complete) values(null, '".$user_company_data['user_name']."', '".$user_company_data['user_email']."', '".md5($user_company_data['user_password'])."', '1', '".$company_id."', '".$user_company_data['long_key']."', 0, now(), now(), '".$_SERVER['REMOTE_ADDR']."',0)");
		
	}
    function insert_user($user_data) {
        $this->db->insert(TABLE_PANEL_USER_MASTER, $user_data);
        return $this->db->insert_id();
		
		//$this->db->query("insert into " . TABLE_PANEL_USER_MASTER . " (user_id, user_name, user_email, user_password, user_type, company_id, long_key, is_active,user_entry_date, user_modified_date, user_entry_ip, profile_complete) values(null, '" . $user_data['user_name'] . "', '" . $user_data['user_email'] . "', '" . md5($user_data['user_password']) . "', '2', '" . $user_data['company_id'] . "', '" . $user_data['long_key'] . "', '1', now(), now(), '" . $_SERVER['REMOTE_ADDR'] . "','0')");
    }

    function delete_user($user_id) {
        $this->db->query("delete from " . TABLE_PANEL_USER_MASTER . " where user_id = '" . $user_id . "'");
    }

    function update_user_detail($user_id, $user = '') {
        $this->db->where('user_id', $user_id);
        $this->db->set('user_modified_date ', date(DATE_FORMAT_DB));
        $this->db->set('profile_complete ', 1);
		if($user != '') {
			$this->db->update(TABLE_PANEL_USER_MASTER, $user);
		} else {
			$this->db->update(TABLE_PANEL_USER_MASTER);
		}
		return $this->db->affected_rows();
    }

    function get_user_list($filter, $sort = array(), $limit = NULL, $offset = NULL) {
        if (!empty($filter)) {
            if (array_key_exists("user_email", $filter))
                $this->db->where('user_email', $filter['user_email']);
        }
        if (!empty($sort)) {
            if (array_key_exists("user_name", $sort))
                $this->db->order_by($this->db->escape_str('user_name'), $this->db->escape_str($sort['user_name']));
            if (array_key_exists("user_email", $sort))
                $this->db->order_by($this->db->escape_str('user_email'), $this->db->escape_str($sort['user_email']));
        }
        $row = 0;
        if ($limit != NULL) {
            if ($offset != NULL) {
                $row = $offset;
            }
            $this->db->limit($limit, $row);
        }
        $this->db->where('user_type', 2);
//        $this->db->where('company_id',  1);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $res = $this->db->get(TABLE_PANEL_USER_MASTER);
//        echo $this->db->last_query();
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_user_list_total($filter) {
        if (!empty($filter)) {
            if (array_key_exists("user_email", $filter))
                $this->db->where('user_email', $filter['user_email']);
        }
        $this->db->where('user_type', 2);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $res = $this->db->get(TABLE_PANEL_USER_MASTER);
        return $res->num_rows();
    }
    
    function get_user_password($user_id){
        $this->db->select('user_password');
        $this->db->where('user_id', $user_id);
        $res = $this->db->get(TABLE_PANEL_USER_MASTER);
        if ($res->num_rows) {
            return $res->row();
        }
        return false;
    }
	function get_company_type($company_id){
		$this->db->select('company_type');
		$this->db->where('company_id', $company_id);
		$res = $this->db->get(TABLE_COMPANY_MASTER);
		return $res->row();
	}
	function get_company_users($company_id) {
		$this->db->where('company_id', $company_id);
		$res = $this->db->get(TABLE_PANEL_USER_MASTER);
		return $res->result();
	}
	function insert_session_log($user_log_data){
		$this->db->insert(TABLE_SESSION_LOG, $user_log_data);
        return $this->db->insert_id();
	}
	function insert_user_activity($activity) {
        $activity['company_id'] = $this->session->userdata('company_id');
        $activity['company_type'] = $this->session->userdata('company_id');
        $activity['user_id'] = $this->session->userdata('user_id');
        $activity['activity_time'] = date(DATE_FORMAT_DB);
        $activity['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $this->db->insert(TABLE_USER_ACTIVITY, $activity);
        return $this->db->insert_id();
    }
}

?>
