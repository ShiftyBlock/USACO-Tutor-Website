<?php
/**
* Plugin Name: Change Password Protected Message
* Plugin URI: https://www.pipdig.co/
* Description: Change the message displayed on content which is Password Protected.
* Author: pipdig
* Author URI: https://www.pipdig.co/
* Version: 1.2.5
*/

if (!defined('ABSPATH')) die;

// Remove "Protected: " from title
function pipdig_cppm_remove_protected_title() {
	return '%s';
}
add_filter('private_title_format', 'pipdig_cppm_remove_protected_title');
add_filter('protected_title_format', 'pipdig_cppm_remove_protected_title');


function pipdig_cppm_filter_text($output) {
	
	$options = get_option('pipdig_pw_text');
	
	if (isset($options['text_value'])) {
		
		$value = wp_kses_post($options['text_value']);
		
		if (!empty($value)) {
			
			// Divi
			$output = str_replace(__('To view this protected post, enter the password below:', 'Divi'), $value, $output); // older
			$output = str_replace(__('To view this protected post, enter the password below', 'Divi'), $value, $output); // newer
			
			// Shapley
			$output = str_replace(__('This post is password protected. To view it please enter your password below:', 'shapely'), $value, $output);
			
			// Werkstatt
			$output = str_replace(__('This is a protected area. Please enter your password:', 'werkstatt'), $value, $output);
			
			// Standard
			$output = str_replace(__('This content is password protected. To view it please enter your password below:'), $value, $output);
		
		}
		
	}

	return $output;
}
add_filter('the_password_form', 'pipdig_cppm_filter_text', 999);


// Add settings link to plugins page
function pipdig_cppm_settings_link($links) {
	$links[] = '<a href="'.get_admin_url(null, 'options-reading.php#pipdig_cppm').'">'.__('Settings').'</a>';
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'pipdig_cppm_settings_link');


// Register and define the settings
function pipdig_cppm_settings(){
	register_setting(
		'reading',
		'pipdig_pw_text',
		'pipdig_cppm_settings_validate'
	);
	
	add_settings_field(
		'text_value',
		'Message to display for Password Protected content (can include basic HTML)',
		'pipdig_cppm_settings_input',
		'reading',
		'default'
	);

}
add_action('admin_init', 'pipdig_cppm_settings');


function pipdig_cppm_settings_input() {
	$options = get_option('pipdig_pw_text');
	$value = wp_kses_post($options['text_value']);
	if (empty($value)) {
		$value = __('This content is password protected. To view it please enter your password below:');
	}
	?>
	<div id="pipdig_cppm"></div>
	<textarea id="text_value" name="pipdig_pw_text[text_value]" class="large-text code"><?php echo $value; ?></textarea>
	<p class="description">Have you found <a href="https://wordpress.org/plugins/change-password-protected-message/" target="_blank" rel="noopener">this plugin</a> useful? You might like to <a href="https://wordpress.org/support/plugin/change-password-protected-message/reviews/#new-post" target="_blank" rel="noopener">add a quick review</a>. If you have a feature request or need any help please post in the <a href="https://wordpress.org/support/plugin/change-password-protected-message/" target="_blank" rel="noopener">support forum</a> :)</p>
	<?php
}

function pipdig_cppm_settings_validate($input) {
	$valid = array();
	$valid['text_value'] = wp_kses_post($input['text_value']);
	return $valid;
}