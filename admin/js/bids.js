/*  
 * @Author: Priyanka Patel
 */
jQuery(document).ready(function() {
    $('a[id^="fresh_bid_reply_"]').live('click', function() {
        var bid_id = $(this).attr('id').split("_")[3];
        $('#fresh_bid_reply_container_' + bid_id).show('slow');
    });
    $('a[id^="btn_seedetail_"]').live('click', function() {
        var project_id = $(this).attr('id').split("_")[2];
        var bid_id = $(this).attr('id').split("_")[3];
        var project_country_id = $(this).attr('id').split("_")[4];
        $('.detail_container').hide();
        $.ajax({
            url: base_url + 'projects/update_read_status',
            data: {project_id: project_id, project_country_id: project_country_id, is_researcher: 0},
            type: "post",
            success: function(response) {
            }
        });
        $('#detail_container_' + project_id + '_' + bid_id).toggle('slow');
        $('#reply_div').toggle('slow');
    });
    $('a[id^="add_bid_details_"]').live('click', function() {
        var bid_id = $(this).attr('id').split("_")[3];
        $('#add_bid_container_' + bid_id).show('slow');
    });
    $('a[id^="accept_bid_"]').live('click', function() {
        var bid_id = $(this).attr('id').split("_")[2];
        $.ajax({
            url: base_url + 'projects/accept_bid',
            data: {bid_id: bid_id},
            type: "post",
            success: function(response) {
                window.location.reload();
            }
        });
    });
});