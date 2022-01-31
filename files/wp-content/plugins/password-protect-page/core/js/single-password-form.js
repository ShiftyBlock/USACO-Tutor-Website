(function ($) {
  $(document).ready(function () {
    $('form.ppw-post-password-form.post-password-form').bind('submit', handleSubmitBtn);
  });

  function handleSubmitBtn(evt) {
	evt.preventDefault();
	$form = $(this);
	$inputs = $form.find('input');
	var values = {};
	var $submitBtn = {};
	$inputs.each(function() {
	  if ( 'Submit' !== this.name ) {
		values[this.name] = $(this).val();
	  } else {
		$submitBtn = $(this);
	  }
	});
	values['nonce'] = ppw_data.nonce;
	values['action'] = 'ppw_validate_password';

	$submitBtn.prop("disabled", true);
	sendRequestToValidatePassword(
	    values,
	  function(data, error) {
		$submitBtn.prop("disabled", false);
		var $message = $form.find('div.ppw-ppf-error-msg');
		if (error) {
		  if ($message.length === 0) {
			var message = error.responseJSON && error.responseJSON.message ? error.responseJSON.message : 'Please enter the correct password!';
			$form.append('<div class="ppwp-wrong-pw-error ppw-ppf-error-msg">' + message + '</div>');
		  }

		  return;
		}

		$message.remove();
		$form.parent().replaceWith(data.post_content)
	  }
	);
  }

  function sendRequestToValidatePassword(_data, cb) {
	$.ajax({
	  url: ppw_data.ajaxUrl,
	  type: 'POST',
	  data: _data,
	  success: function (data) {
		cb(data, null);
	  },
	  error: function (error) {
		cb(null, error);
	  },
	  timeout: 10000
	})
  }
})(jQuery);
