<?php
//if ($this->session->userdata('user_type') == 1) { 
if (isset($actions) && !empty($actions)) {
    ?> 
    <li class="btn-group">
        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
            <span>
                Actions
            </span>
            <i class="fa fa-angle-down"></i>
        </button>    
        <ul class="dropdown-menu pull-right" role="menu">
    <?php foreach ($actions as $key => $value) { ?>                            
                <li>
                    <a href="<?php echo base_url($key); ?>"><?php echo $value; ?></a>
                </li>
    <?php } ?>
        </ul>
    </li>
<?php
}
//} ?>