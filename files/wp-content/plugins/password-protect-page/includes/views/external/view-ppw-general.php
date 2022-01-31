<?php
$page            = isset( $_GET['page'] ) ? $_GET['page'] : null;
$tab             = isset( $_GET['tab'] ) ? $_GET['tab'] : null;
$using_recaptcha = ppw_core_get_setting_type_bool_by_option_name( PPW_Constants::USING_RECAPTCHA, PPW_Constants::EXTERNAL_OPTIONS ) ? 'checked' : '';
$api_key         = ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_API_KEY, PPW_Constants::EXTERNAL_OPTIONS );
$api_secret      = ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_API_SECRET, PPW_Constants::EXTERNAL_OPTIONS );
$score           = PPW_Recaptcha::get_instance()->get_limit_score();

?>
<div class="ppw_main_container" id="ppw_shortcodes_form">
	<form id="wpp_external_form" method="post">
		<input type="hidden" id="ppw_general_form_nonce"
		       value="<?php echo wp_create_nonce( PPW_Constants::GENERAL_FORM_NONCE ); ?>"/>
		<table class="ppwp_settings_table" cellpadding="4">
			<tr>
				<td>
					<label class="pda_switch" for="<?php echo PPW_Constants::USING_RECAPTCHA; ?>">
						<input type="checkbox"
						       id="<?php echo PPW_Constants::USING_RECAPTCHA; ?>" <?php echo $using_recaptcha; ?>>
						<span class="pda-slider round"></span>
					</label>
				</td>
				<td>
					<p>
						<label><?php _e( 'Enable Google reCAPTCHA Protection', 'password-protect-page' ) ?></label>
						<a href="https://passwordprotectwp.com/docs/add-google-recaptcha-wordpress-password-form/">Protect your password form</a> from abuse and spam while allowing real user access only. <a href="https://g.co/recaptcha/v3">Get the Site Key and Secret Key</a> from Google.
					</p>
				</td>
			</tr>
			<tr id="wpp_recaptcha_configs" <?php echo ! $using_recaptcha ? 'style="display: none;"' : ''; ?>>
				<td class="feature-input"></td>
				<td>
					<p>
						<label><?php echo esc_html__( 'reCAPTCHA Type', 'password-protect-page' ) ?></label>
					</p>
					<span>
					<select class="ppw_main_container select" id="recaptcha_type">
						<option value="v3">reCAPTCHA v3</option>
						<option value="v2c" disabled>reCAPTCHA v2 - Checkbox</option>
						<option value="v2i" disabled>reCAPTCHA v2 - Invisible</option>
					</select>
					<p>
						<label><?php echo esc_html__( 'Site Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_API_KEY; ?>" type="text"
                               value="<?php echo esc_attr( $api_key ); ?>"/>
					</span>
					<p>
						<label><?php echo esc_html__( 'Secret Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_API_SECRET; ?>" type="text"
                               value="<?php echo esc_attr( $api_secret ); ?>"/>
					</span>
					<p>
						<label><?php echo esc_html__( 'Threshold', 'password-protect-page' ) ?></label>
						Define users' score that will pass reCAPTCHA protection
					</p>
					<span>
						<select class="ppw_main_container select" id="<?php echo PPW_Constants::RECAPTCHA_SCORE; ?>">
						  <?php
						  for ( $i = 0; $i <= 10; $i ++ ) {
							  $s        = number_format( ($i / 10), 1 );
							  $selected = (double) $s === $score ? 'selected="selected"' : '';
							  echo '<option value="' . $s . '"' . $selected . '>' . $s . '</option>';
						  }
						  ?>
						</select>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
				</td>
			</tr>
		</table>
	</form>
</div>
