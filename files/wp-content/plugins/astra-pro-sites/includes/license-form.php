<?php
/**
 * Premium License
 *
 * @since 1.0.0
 * @package Astra Pro Sites
 */

$status_class = 'default';

if ( isset( $_POST['bsf_license_manager']['license_key'] ) && empty( $_POST['bsf_license_manager']['license_key'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$status_class = 'empty';
} elseif ( isset( $_POST['bsf_license_activation']['success'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$current_status = esc_attr( $_POST['bsf_license_activation']['success'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	$status_class = 'fail';
	if ( $current_status ) {
		$status_class = 'success';
	}
}

?>

<div id="astra-pro-sites-license-form" class="astra-pro-sites-license-form-status-<?php echo esc_attr( $status_class ); ?>">
	<div class="inner">
		<?php
		switch ( $status_class ) {
			case 'success':
				?>
					<div class="astra-pro-sites-success-message">
						<p><?php esc_html_e( 'Congratulations! You\'ve activated your Starter Templates License key successfully — A world of beautiful templates awaits.', 'astra-sites' ); ?></p>
					</div>
					<?php
				break;

			case 'empty':
			case 'fail':
				?>
					<div class="astra-pro-sites-fail-message">
						<p><?php esc_html_e( 'Whoops! It seems like the entered license key is invalid/expired. If you feel this is an error, please reach out to our support team.', 'astra-sites' ); ?></p>
					</div>
					<?php
				break;

			case 'default':
			default:
				?>
					<div class="astra-pro-sites-welcome-message">
						<p><?php esc_html_e( 'This is a premium template available with \'Agency\' packages.', 'astra-sites' ); ?></p>
						<p><?php esc_html_e( 'If you already own an Agency pack, validate your license key to import the template.', 'astra-sites' ); ?></p>
					</div>
					<?php
				break;
		}

			$bsf_product_id = bsf_extract_product_id( ASTRA_PRO_SITES_DIR );
			$args           = array(
				'product_id'                       => $bsf_product_id,
				'button_text_activate'             => esc_html__( 'Activate License', 'astra-sites' ),
				'button_text_deactivate'           => esc_html__( 'Deactivate License', 'astra-sites' ),
				'license_form_title'               => '',
				'license_deactivate_status'        => esc_html__( 'Your license is not active!', 'astra-sites' ),
				'license_activate_status'          => esc_html__( 'Your license is activated!', 'astra-sites' ),
				'submit_button_class'              => 'astra-product-license button-default',
				'form_class'                       => 'form-wrap bsf-license-register-' . esc_attr( $bsf_product_id ),
				'bsf_license_form_heading_class'   => 'astra-license-heading',
				'bsf_license_active_class'         => 'success-message',
				'bsf_license_not_activate_message' => 'license-error',
				'size'                             => 'regular',
				'bsf_license_allow_email'          => false,
			);
			// @codingStandardsIgnoreStart
			echo bsf_license_activation_form( $args );
			// @codingStandardsIgnoreEnd
			?>

	</div>
</div>
