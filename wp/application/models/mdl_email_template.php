<?php

class mdl_email_template extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_email_template_list($filter, $sort = array(), $limit = NULL, $offset = NULL) {
        if (!empty($filter)) {
            if (array_key_exists("email_template_subject", $filter))
                $this->db->where('email_template_subject', $filter['email_template_subject']);
        }
        if (!empty($sort)) {
            if (array_key_exists("email_template_shortcode", $sort))
                $this->db->order_by($this->db->escape_str('email_template_shortcode'), $this->db->escape_str($sort['email_template_shortcode']));
            if (array_key_exists("email_template_subject", $sort))
                $this->db->order_by($this->db->escape_str('email_template_subject'), $this->db->escape_str($sort['email_template_subject']));
        }
        $row = 0;
        if ($limit != NULL) {
            if ($offset != NULL) {
                $row = $offset;
            }
            $this->db->limit($limit, $row);
        }
        $res = $this->db->get(TABLE_EMAIL_TEMPLATE);
        //echo $this->db->last_query();
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_email_template_list_total($filter) {
        if (!empty($filter)) {
            if (array_key_exists("email_template_subject", $filter))
                $this->db->where('email_template_subject', $filter['email_template_subject']);
        }

        $res = $this->db->get(TABLE_EMAIL_TEMPLATE);
        return $res->num_rows();
    }

    function delete_email_template($email_template_id) {
        $this->db->where('email_template_id', $email_template_id);
        $this->db->delete(TABLE_EMAIL_TEMPLATE);
        return $this->db->affected_rows();
    }

    function insert_email_template($email_template_detail) {
        $this->db->insert(TABLE_EMAIL_TEMPLATE, $email_template_detail);
        return $this->db->insert_id();
    }

    function update_email_template($email_template_id, $email_template_detail) {
        $this->db->where('email_template_id', $email_template_id);
        $this->db->update(TABLE_EMAIL_TEMPLATE, $email_template_detail);
        return $this->db->affected_rows();
    }

    function get_email_template($email_template_id) {
        $this->db->where('email_template_id', $email_template_id);
        $query = $this->db->get(TABLE_EMAIL_TEMPLATE);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function get_template_by_short_code($shortcode) {
        $this->db->where('email_template_shortcode', $shortcode);
        $query = $this->db->get(TABLE_EMAIL_TEMPLATE);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

}

?>
