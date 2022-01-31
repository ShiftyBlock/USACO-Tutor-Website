(function ($, api) {
  var customizePrefix = '_customize-input-';
  var themePrefix = 'ppw_customize_presets_settings';
  var defaultShowLogo = null;
  var defaultData = {
    'default1': {
	  '#customize-control-ppwp_pro_form_instructions_background_color_control input.wp-color-picker' : ''
	},
	'default2': {
	  '#customize-control-ppwp_pro_form_instructions_background_color_control input.wp-color-picker' : ''
	},
	'default3': {
	  '#customize-control-ppwp_pro_form_instructions_background_color_control input.wp-color-picker' : ''
	},
  }

  // Editor control.
  $(window).load(function () {
	$('textarea.wp-editor-area').each(function () {
	  var $this = $(this),
		id = $this.attr('id'),
		$input = $('input[data-customize-setting-link="' + id + '"]'),
		editor = tinyMCE.get(id),
		setChange,
		content;

	  if (editor) {
		editor.on('change', function (e) {
		  editor.save();
		  content = editor.getContent();
		  clearTimeout(setChange);
		  setChange = setTimeout(function () {
			$input.val(content).trigger('change');
		  }, 500);
		});
	  }

	  $this.css('visibility', 'visible').on('keyup', function () {
		content = $this.val();
		clearTimeout(setChange);
		setChange = setTimeout(function () {
		  $input.val(content).trigger('change');
		}, 500);
	  });
	});

	$('.customize-control-ppw-presets input[type="radio"]').on('change', function () {
	  var theme = $(this).val();
	  Object.keys(defaultData).forEach(function(theme) {
	    if ( $('#' + themePrefix + theme).is(':checked') ) {
	      	var themeData = defaultData[theme];
			Object.keys(themeData).forEach(function(themeKey){
			  changeInput(themeKey, themeData[themeKey], 'change');
			});
		}
	  });
	  var checkbox_values = $(this)
		.parents('.customize-control')
		.find('input[type="radio"]:checked')
		.val();
	  $(this)
		.parents('.customize-control')
		.find('input[type="hidden"]')
		.val(checkbox_values)
		.delay(500)
		.trigger('change');
	  $logo = $('#toggle-ppwp_pro_logo_disable_control');
	  if (defaultShowLogo !== null) {
		defaultShowLogo = $logo.is(':checked');
	  }
	  if ( 'default0' !== theme && $logo.length > 0) {
		$logo.prop('checked', true).trigger('input');
	  } else {
		$logo.prop('checked', defaultShowLogo).trigger('input');
	  }
	});

	function changeInput( key, value, type = 'input' ) {
	  $(key).val(value).delay(500).trigger(type);
	}

  });


})(jQuery, wp.customize);
