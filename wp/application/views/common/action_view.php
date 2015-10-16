<?php
if (isset($actions) && !empty($actions)) {
    if (count($actions) == 1) {
        ?> <li class="btn-group"> <?php
        foreach ($actions as $key => $value) {
            $href = base_url($key);
            $id = "";
            if (strstr($key, "#") != FALSE) {
                $href = "javascript:void(0)";
                $id = trim(substr($key, 1));
            }
            ?> 
                <a href="<?php echo $href; ?>" id="<?php echo $id; ?>" class="btn blue" style = "color:#fff;"><?php echo $value; ?></a>
            <?php }
            ?> </li> <?php
    } else {
        ?> 
        <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                <span>
                    Actions
                </span>
                <i class="fa fa-angle-down"></i>
            </button>    
            <ul class="dropdown-menu pull-right" role="menu" id="action_menu">
                <?php
                foreach ($actions as $key => $value) {
                    $href = base_url($key);
                    $id = "";
                    if (strstr($key, "#") != FALSE) {
                        $href = "javascript:void(0)";
                        $id = trim(substr($key, 1));
                    }
                    ?>                            
                    <li>
                        <a href="<?php echo $href; ?>" id="<?php echo $id; ?>"><?php echo $value; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }
}
?>
