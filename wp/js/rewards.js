jQuery(document).ready(function() {
	$('.page-sidebar-menu .active').removeClass('active');
    $('.page-sidebar-menu #rewards').addClass('active');
	$('#save_redeem_point').live('click', function(e) {
		if($('#redeem_amount').val() == '' ) {
			$('#amt_error').addClass('error_span');
			$('#amt_error').html('Please enter redeem amount.');
			
			$('#redeem_amount').addClass('error');
			return false;
		}
		else if(parseInt($('#redeem_amount').val()) > parseInt($('#rewards_available').val())) {
			$('#amt_error').addClass('error_span');
			$('#amt_error').html('Should not be greater than rewards available.');
			
			$('#redeem_amount').addClass('error');
			return false;
		} else {
			$('#amt_error').html('');
			$('#redeem_amount').removeClass('error');
			var redeem_amt = $('#redeem_amount').val();
				var rewards_available = $('#rewards_available').val();
				var payment_method = $('#payment_method').val();
				var reedeamed_rewards = $('#reedeamed_rewards').val();
				var notes = $('#notes').val();
			$.ajax({
				
				url : base_url+'rewards/insert_redeem_rewards',
				data : { redeem_amt:redeem_amt, rewards_available:rewards_available, payment_method:payment_method, notes:notes, reedeamed_rewards:reedeamed_rewards  },
				type: "post",
				success: function(response) {
					window.location.reload();
					set_toastr('', 'Your redeem point is credited.', 'success');
				}
			});
			return true;
		}
	});
	
});