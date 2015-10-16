<?php

/**
 * Description of mdl_bids
 *
 * @author priyanka
 */
class mdl_bids extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_statuswise_bids($bid_status) {
        $this->db->select('b.*,co.country_name,pc.*,p.project_name,p.project_external_note,c.company_name,c.company_countries');
        $this->db->where('b.partner_id', $this->session->userdata('company_id'));
        $this->db->where('b.bid_status', $bid_status);
//        $this->db->join(TABLE_BID_REPLIES_CHILD . " bc", 'b.bid_id = bc.bid_id');
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", "b.project_country_id = pc.project_country_id");
        $this->db->join(TABLE_COMPANY_MASTER . " c", 'c.company_id = b.researcher_id');
        $this->db->join(TABLE_COUNTRY_MASTER . " co", 'pc.country_id = co.country_id');        
        $this->db->order_by('bid_createddate', 'desc');
        $this->db->group_by('b.project_id');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

}
