// JavaScript Document
$(function(){
	$('#forgotPasswordModal').on('shown', function(){
		$('#forgotPasswordModal #inputEmail').focus();
	});
	
	$('#forgot-form').on('submit', function(){
		var email = $('#forgot-form #inputEmail');
		
		if(email.val() == ''){
			$('#forgot-form #form-msg').html('Enter you email address');
			$('#forgot-form #form-msg').addClass('alert alert-error');
			email.focus();
			return false;
		}
		else{
			$('#forgot-form #form-msg').html('');
			$('#forgot-form #form-msg').removeClass('alert alert-error');
			$('#forgot-form #progress').html('<i class="icon-spinner icon-spin"></i> validating...');

			$.post(site_url + 'account/validateEmail', {
				email : email.val()
			}, function(data){
				if(data.stats > 0){
					$('#forgot-form #progress').html('');
					$('#forgot-form #form-msg').html(data.msg);
					$('#forgot-form #form-msg').addClass('alert alert-success');
					email.val('');
				}
				else{
					$('#forgot-form #progress').html('');
					$('#forgot-form #form-msg').html(data.msg);
					$('#forgot-form #form-msg').addClass('alert alert-error');
					email.focus();
				}
			}, 'json');
			
			return false;
		}
	});
});