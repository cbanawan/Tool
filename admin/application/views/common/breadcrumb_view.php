<li>
    <i class="fa fa-home"></i>
    <a href="<?php echo base_url(); ?>home">Home</a>
    <i class="fa fa-angle-right"></i>
</li>
<?php //if($this->session->userdata('user_type') == 1) { ?> 
<!--<li>
    <a href="<?php echo base_url('users'); ?>">Users</a>
    <i class="fa fa-angle-right"></i>
</li> -->
<?php //} ?>

<?php
if (isset($site_nav)) {
    foreach ($site_nav as $key => $nav) {
        $link = base_url().$key;
        if ($key == 'last')
            $link = 'javascript:void(0)';
        ?>
        <li>    
            <a href="<?php echo $link; ?>"><?php echo $nav; ?></a>
            <?php if ($key !== 'last') { ?>
                <i class="fa fa-angle-right"></i>
            <?php } ?>
        </li>
    <?php }
}
?>























































