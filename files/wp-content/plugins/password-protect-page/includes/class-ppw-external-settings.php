<?php

class PPW_External_Settings {
	/**
	 * Render UI external submenu settings page.
	 */
    public function render_ui() {
        $head_title = is_pro_active_and_valid_license() ? 'PPWP Pro' : 'PPWP Lite';
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"></div>
			<h2>
				<?php echo esc_html__( $head_title . ': Integrations', 'password-protect-page' ); ?>
			</h2>
			<?php
			$activated_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'recaptcha';
			$this->render_tabs( $activated_tab );
			$this->render_content( $activated_tab );
			?>
		</div>
		<?php
	}

	/**
	 * Get external tabs.
	 *
	 * @return array
	 */
	public function get_tabs() {
		return apply_filters(
			'ppw_external_tabs',
			array(
				array(
					'tab'      => 'recaptcha',
					'tab_name' => 'reCAPTCHA',
				),
			)
		);
	}

	/**
	 * Render tab for external page.
	 *
	 * @param string $active_tab Activate tab
	 */
    public function render_tabs( $active_tab ) {
    	$tabs = $this->get_tabs();

		?>
		<h2 class="ppwp_wrap_tab_title nav-tab-wrapper">
			<?php
			if ( ! is_array( $tabs ) ) {
				return;
			}

			foreach ( $tabs as $tab ) {
				if ( ! is_array( $tab ) ) {
					continue;
				}

				if ( empty( $tab['tab'] ) || empty( $tab['tab_name'] ) ) {
					continue;
				}
				?>
				<a href="?page=<?php echo esc_html( PPW_Constants::EXTERNAL_SERVICES_PREFIX ); ?>&tab=<?php echo esc_attr( $tab['tab'] ); ?>"
				   class="nav-tab <?php echo $active_tab === $tab['tab'] ? 'nav-tab-active' : ''; ?>"><?php _e( $tab['tab_name'], 'password-protect-page' ); ?></a>
			<?php } ?>
		</h2>
		<?php
    }

    public function render_content( $active_tab ) {
    	$tabs = $this->get_tabs();
	    foreach ( $tabs as $tab ) {
		    if ( $active_tab === $tab['tab'] ) {
			    do_action( 'ppw_render_external_content_' . $tab['tab'] );
			    break;
		    }
	    }
    }
}
