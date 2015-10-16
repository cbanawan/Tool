<?php

class common_function {

    public function get_company_type($input_type, $is_selected = '', $field_name = '') {
        $type_display = '';
        $selected = '';
        $checked = '';
        $type_array = array("1" => "Researcher (Buyer/Client)", "2" => "Partner (Panel Company)", "3" => "Both");
        foreach ($type_array as $type_key => $type_value) {
            if ($type_key == $is_selected) {
                $selected = "selected";
                $checked = "checked";
            }
            if ($input_type == 'select') {
                $type_display .= '<option value="' . $type_key . '" ' . $selected . '>' . $type_value . '</option>';
            } else {
                $type_display .= '<label class="radio-inline"><input type="radio" name="' . $field_name . '" value = "' . $type_key . '" ' . $checked . '> ' . $type_value . '</label>';
            }
        }
        return $type_display;
    }
    
    function in_array_field($needle, $needle_field, $haystack, $strict = false) {
        if ($strict) {
            foreach ($haystack as $item)
                if (isset($item->$needle_field) && $item->$needle_field === $needle){
                   
                    return $item;
                }
        }
        else {
            foreach ($haystack as $item)
                if (isset($item->$needle_field) && $item->$needle_field == $needle){
                    return $item;
                }
        }
        return false;
    }
	public function get_segment_format($country_name, $segment, $segment_name, $bid_status = '', $is_deleted = '') {
		$bid_display = '';
		if($is_deleted == 1) { 
			$main_class = 'deleted';
		} else {
			if($bid_status == 1) { 
				$main_class = 'on_conversation';
			} else if($bid_status == 2) {
				$main_class = 'deleted';
			} else if($bid_status == 3)  {
				$main_class = 'on_won';
			} else { 
				$main_class = '';
			}
		}
		$bid_display .= '<span class="prj-block-display '.$main_class.'">'.$country_name.'&nbsp;'.$segment.' &nbsp;('.$segment_name.')</span>';
		return $bid_display;
	}
	public function get_segment_format_proj($country_name, $segment, $segment_name) {
		$bid_display = '';
		$bid_display .= $country_name.'&nbsp;'.$segment.' &nbsp;('.$segment_name.')';
		return $bid_display;
	}
	public function display_estimate_cost($cpc, $ncompelete, $project_setup, $min_cost) {
		$estimate_cost = intVal(($cpc * $ncompelete) + $project_setup );
		if($estimate_cost > $min_cost) {
			return $estimate_cost;
		} else {
			return $min_cost;
		}
	
	}
}

?>
