<?php

/**
 * Description of mdl_bids
 *
 * @author priyanka
 */
class user_activity extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert_user_activity($activity) {
        $activity['company_id'] = $this->session->userdata('company_id');
        $activity['company_type'] = $this->session->userdata('company_type');
        $activity['user_id'] = $this->session->userdata('user_id');
        $activity['activity_time'] = date(DATE_FORMAT_DB);
        $activity['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $this->db->insert(TABLE_USER_ACTIVITY, $activity);        
        return $this->db->insert_id();
    }
    
    function getRecentActivity(){
        $this->db->select('a.*,c.company_name,u.user_name');
        $this->db->where('a.user_id',$this->session->userdata('user_id'));
        $this->db->join(TABLE_COMPANY_MASTER." c",'c.company_id = a.company_id');
        $this->db->join(TABLE_PANEL_USER_MASTER." u",'u.user_id = a.user_id');
        $this->db->limit(12, 0);
        $this->db->order_by('activity_time', 'DESC');
        $res = $this->db->get(TABLE_USER_ACTIVITY." a");
        if ($res->num_rows() > 0) {
            return $res->result_array();
        }
        return false;
    }

}
