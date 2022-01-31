<?php
$no_reload_page = PPW_Constants::NO_RELOAD_PAGE;
$checked = ppw_core_get_setting_type_bool_by_option_name( $no_reload_page, PPW_Constants::MISC_OPTIONS ) ? 'checked' : '';
$message = array(
	'label'       => 'Unlock Protected Content without Page Refresh',
	'description' => '<a target="_blank" rel="noreferrer noopener" href="https://passwordprotectwp.com/docs/unlock-password-protected-content-without-page-refresh/">Use Ajax to display protected content</a> without having to reload the entire page. It will help improve user experience and avoid server caching after users enter their password.<br>This beta version comes with some limitations that will be improved in our upcoming releases.'
);

?>
<tr>
	<td>
		<label class="pda_switch" for="<?php echo esc_attr( $no_reload_page ); ?>">
			<input type="checkbox"
			       id="<?php echo esc_attr( $no_reload_page ); ?>" <?php echo esc_attr( $checked ); ?>/>
			<span class="pda-slider round"></span>
		</label>
	</td>
	<td>
		<p>
			<label><?php echo esc_html__( $message['label'], $no_reload_page ) ?>
				<sup class="ppwp-setting-beta">Beta</sup>
			</label>
			<?php echo _e( $message['description'], $no_reload_page ) ?>
		</p>
	</td>
</tr>
