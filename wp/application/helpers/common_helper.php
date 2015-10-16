<?php

function start_db_transaction() {
    $CI = &get_instance();
    $CI->db->trans_start();
}

function complete_db_transaction() {
    $CI = &get_instance();
    $CI->db->trans_complete();
}
