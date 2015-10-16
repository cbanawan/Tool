<?php

/**
 * Description of lib_common
 *
 * @author Priyanka Patel
 */
class lib_common {

    private $ci;

    public function __construct() {
        $this->ci = &get_instance();
    //    $this->ci->load->model('user_model');
    }   
    
    public function datatable_basics($aColumns) {
        $iDisplayStart = $this->ci->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->ci->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->ci->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->ci->input->get_post('iSortingCols', true);
        $sSearch = $this->ci->input->get_post('sSearch', true);
        $sEcho = $this->ci->input->get_post('sEcho', true);

        // Paging
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $limit = intval($iDisplayLength);
            $offset = intval($iDisplayStart);
        }

        // Ordering
        if (isset($iSortCol_0)) {
            $sort_array = array();
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $iSortCol = $this->ci->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->ci->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->ci->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    $sort_array[$aColumns[intval($this->ci->db->escape_str($iSortCol))]] = $sSortDir;
                }
            }
        }
        $returnArr = array();
        $returnArr['sEcho'] = $sEcho;
        $returnArr['limit'] = $limit;
        $returnArr['offset'] = $offset;
        $returnArr['sort_array'] = $sort_array;
        return $returnArr;
    }

    public function createLogFile($process, $data) {
        $logFolder = APPPATH . "logs/";
        if (is_array($data)) {
            $data = print_r($data, true);
        }
        $fileContent = '\n';
        $fileContent .= gmdate("Y-m-d H:i:s") . " -- " . microtime(true) . " -- " . $data . "\n";
        $serviceFp = fopen($logFolder . $process . ".log", "a+");
        fwrite($serviceFp, $fileContent);
        fclose($serviceFp);
    }

    public function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y') {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    public function selectedDateRange($first, $last, $step = '+1 day', $format = 'd/m/Y') {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[date($format, $current)] = array();
            $current = strtotime($step, $current);
        }

        return $dates;
    }
	public function generate_long_key() {
		//return chr( mt_rand( 97 ,122 ) ) .substr( md5( time( ) ) ,1 );
		 $random = md5(uniqid());
		 return $random;
	}
	public function random_password() {
		return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
	}
	public function show_stars($field_name,$default = '', $disable= 0){
            if (($default > 0) && ($default % 2)) {
            $default = $default + 1;
        }
        $star_display = '';
		$checked = '';
		$disabled = '';
		for( $i=2;$i <= 20; $i=$i+2){
			if($default == $i) {
				$checked = 'checked="checked"';
			} else { $checked = '';}
			if($disable == 1) {
				$disabled = 'disabled="disabled"';
			} else {
				$disabled = '';
			}
			$star_display .= '<input class="star  {split:2} '.$field_name.'" type="radio" name="'.$field_name.'" value="'.$i.'" '.$disabled.' '.$checked.' />';
		}
		return $star_display;
	}
	
}
