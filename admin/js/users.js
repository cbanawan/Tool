var oTable = null;
jQuery(document).ready(function () {
    var params = new Array();
// params.push({'name': 'user_email', 'value': '#search_email'});
    oTable = initdatatable('user_lists', base_url + 'users/get_all_users', params);

    $('#frm_change_pass').find('.form-control').focusout(function () {
        check_validation($(this));
    });

    $('#btn_change_pass').click(function () {
        var error = false;
        $('#frm_change_pass').find('.form-control').each(function () {
            var flag = check_validation($(this));
            if (!flag)
                error = !flag;
        });
        if (error)
            return false;
    });
});

function check_validation(element) {
    var error = false;
    element.parent().removeClass('has-error');
    element.parent().find('span.help-block').remove();
    switch (element.attr('id')) {
        case 'current_pass':
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter Current Password');
                error = true;
            } else if ($.trim(element.val()) !== '') {
                $.ajax({
                    url: base_url + 'users/check_user_password',
                    data: {'current_pass': $.trim(element.val())},
                    type: 'POST',
                    success: function (data) {
                        if (data == 'notmatched') {
                            error = true;
                            display_error('#' + element.attr('id'), 'Current Password is not valid');
                        }
                    }
                });
            }
            break;
        case 'new_pass':
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter New Password');
                error = true;
            }
            break;
        case 'retype_pass':
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter Confirm Password');
                error = true;
            } else if ($.trim(element.val()) != $.trim($('#new_pass').val())) {
                display_error('#' + element.attr('id'), 'New Password and Confirm Password not match.');
                error = true;
            }
            break;
    }
    return !error;
}