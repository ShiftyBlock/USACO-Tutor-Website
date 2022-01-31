<?php

if ( ! class_exists( 'PPW_Customizer_Sitewide' ) ) {
    // TODO: need to force PPW_Pro_Customizer_Service extend this class to remove the code duplication.
    class PPW_Customizer_Sitewide {

		/**
		 * Instance of PPW_Pro_Shortcode class.
		 *
		 * @var PPW_Customizer_Sitewide
		 */
		protected static $instance = null;

		public function register_sitewide_form() {
			add_action( 'customize_register', array( $this, 'customize_register' ), 15 );
		}

		public static function register_themes() {
			$self = new self();
			add_action( 'customize_register', array( $self, 'customize_register_themes' ), 25 );
			add_action( 'ppw_custom_style_form_entire_site', array( $self, 'load_css_to_pro' ), 15 );
		}

		public function register_sitewide_style() {
			add_action( PPW_Constants::HOOK_CUSTOM_STYLE_FORM_ENTIRE_SITE, array( $this, 'dynamic_styles' ) );
		}

	    /**
	     * @param $wp_customize
	     */
		public function customize_register_themes( $wp_customize ) {
			if ( ! class_exists( 'PPW_Presets_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-presets.php';
			}

			$wp_customize->add_section( 'ppw_customize_presets', array(
				'title'    => __( 'Themes', 'password-protect-page' ),
				'panel'    => 'ppwp_sitewide',
				'priority' => 50,
			) );

			$wp_customize->add_setting( 'ppw_customize_presets_settings', array(
				'default'    => 'default0',
				'capability' => 'edit_theme_options',
			) );

			$wp_customize->add_control(
				new PPW_Presets_Control( $wp_customize, 'ppw_customize_presets_settings',
					array(
						'section' => 'ppw_customize_presets',
						// 'label'   => __( 'Themes', 'loginpress' ),
						'choices' => $this->get_templates(),
					)
				)
			);
		}

		/**
		 * Get instance of PPW_Customizer
		 *
		 * @return PPW_Customizer_Sitewide
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				// Use static instead of self due to the inheritance later.
				// For example: ChildSC extends this class, when we call get_instance
				// it will return the object of child class. On the other hand, self function
				// will return the object of base class.
				self::$instance = new static();
			}

			return self::$instance;
		}

		/**
		 * Register customizer fields
		 *
		 * @param object $wp_customize customizer object.
		 *
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			if ( ! class_exists( 'PPW_Toggle_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-title-group-control.php';
			}
			if ( ! class_exists( 'PPW_Title_Group_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-toggle-control.php';
			}

			/* register toggle control */
			$wp_customize->register_control_type( 'PPW_Toggle_Control' );
			$wp_customize->register_control_type( 'PPW_Title_Group_Control' );

			$wp_customize->add_panel( 'ppwp_sitewide',
				array(
					'priority'       => 999,
					'capability'     => 'edit_theme_options',
					'theme_supports' => '',
					'title'          => __( 'PPWP Sitewide Login Form', 'password-protect-page' ),
				)
			);

			/* form logo section */
			$wp_customize->add_section( 'ppwp_pro_form_logo', array(
				'title'    => __( 'Logo', 'password-protect-page' ),
				'panel'    => 'ppwp_sitewide',
				'priority' => 100,
			) );

			// Add an option to disable the logo.
			$wp_customize->add_setting( 'ppwp_pro_logo_disable' );
			$wp_customize->add_control(
				new PPW_Toggle_Control(
					$wp_customize,
					'ppwp_pro_logo_disable_control', array(
					'label'       => __( 'Disable Logo', 'password-protect-page' ),
					'section'     => 'ppwp_pro_form_logo',
					'type'        => 'toggle',
					'settings'    => 'ppwp_pro_logo_disable',
				) )
			);

			/* logo customize */
			$wp_customize->add_setting( 'ppwp_pro_logo_customize', array(
				'default' => __( PPW_DIR_URL . 'includes/views/entire-site/assets/ppwp-logo.png', 'password-protect-page' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					'ppwp_pro_logo_customize_control', array(
					'label'    => __( 'Logo Image', 'password-protect-page' ),
					'section'  => 'ppwp_pro_form_logo',
					'settings' => 'ppwp_pro_logo_customize',
				) )
			);

			/* logo width */
			$wp_customize->add_setting( 'ppwp_pro_logo_customize_width' );
			$wp_customize->add_control( 'ppwp_pro_logo_customize_width_control', array(
				'label'       => __( 'Logo Width', 'password-protect-page' ),
				'description' => __( 'Width in px', 'password-protect-page' ),
				'section'     => 'ppwp_pro_form_logo',
				'settings'    => 'ppwp_pro_logo_customize_width',
				'type'        => 'number',
			) );

			/* logo height */
			$wp_customize->add_setting( 'ppwp_pro_logo_customize_height' );
			$wp_customize->add_control( 'ppwp_pro_logo_customize_height_control', array(
				'label'       => __( 'Logo Height', 'password-protect-page' ),
				'description' => __( 'Height in px', 'password-protect-page' ),
				'section'     => 'ppwp_pro_form_logo',
				'settings'    => 'ppwp_pro_logo_customize_height',
				'type'        => 'number',
			) );

			/* logo border-radius */
			$wp_customize->add_setting( 'ppwp_pro_logo_customize_border_radius' );
			$wp_customize->add_control( 'ppwp_pro_logo_customize_border_radius_control', array(
				'label'       => __( 'Logo Radius', 'password-protect-page' ),
				'description' => __( 'Border Radius in %', 'password-protect-page' ),
				'section'     => 'ppwp_pro_form_logo',
				'settings'    => 'ppwp_pro_logo_customize_border_radius',
				'type'        => 'number',
			) );

            /* password form section */
			$wp_customize->add_section( 'ppwp_pro_form_instructions', array(
				'title'    => __( 'Password Form', 'password-protect-page' ),
				'panel'    => 'ppwp_sitewide',
				'priority' => 300,
			) );

			/* form section group */
			$wp_customize->add_setting( 'ppwp_pro_form_section_group' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pro_form_section_group', array(
					'label'			=> __( 'Password Form', 'password-protect-page' ),
					'section'  		=> 'ppwp_pro_form_instructions',
					'settings' 		=> 'ppwp_pro_form_section_group',
					'type'     		=> 'control_title',
				) )
			);

			/* enable form transparency */
			$wp_customize->add_setting( 'ppwp_pro_form_enable_transparency' );
			$wp_customize->add_control(
				new PPW_Toggle_Control(
					$wp_customize,
					'ppwp_pro_form_enable_transparency_control', array(
					'label'       => __( 'Enable Form Transparency', 'password-protect-page' ),
					'section'     => 'ppwp_pro_form_instructions',
					'type'        => 'toggle',
					'settings'    => 'ppwp_pro_form_enable_transparency',
				) )
			);

			/* password form background color */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_background_color', array(
				'default' => '',
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pro_form_instructions_background_color_control', array(
					'label'    => __( 'Form Background Color', 'password-protect-page' ),
					'section'  => 'ppwp_pro_form_instructions',
					'settings' => 'ppwp_pro_form_instructions_background_color',
				) )
			);

			/* password form width */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_width' );
			$wp_customize->add_control( 'ppwp_pro_form_instructions_width_control', array(
				'label'			=> __( 'Form Width', 'password-protect-page' ),
				'section'  		=> 'ppwp_pro_form_instructions',
				'settings' 		=> 'ppwp_pro_form_instructions_width',
				'description'	=> 'Width in px',
				'type'     		=> 'number',
			) );

			/* password form border radius */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_border_radius' );
			$wp_customize->add_control( 'ppwp_pro_form_instructions_border_radius_control', array(
				'label'			=> __( 'Form Border Radius', 'password-protect-page' ),
				'section'  		=> 'ppwp_pro_form_instructions',
				'settings' 		=> 'ppwp_pro_form_instructions_border_radius',
				'description'	=> 'Border Radius in px',
				'type'     		=> 'number',
			) );

			/* password label group */
			$wp_customize->add_setting( 'ppwp_pro_password_label_group' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pro_password_label_group', array(
					'label'			=> __( 'Password Field', 'password-protect-page' ),
					'section'  		=> 'ppwp_pro_form_instructions',
					'settings' 		=> 'ppwp_pro_password_label_group',
					'type'     		=> 'control_title',
				) )
			);

			/* password label font size */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_password_label_font_size' );
			$wp_customize->add_control( 'ppwp_pro_form_instructions_password_label_font_size_control', array(
				'label'       => __( 'Font Size', 'password-protect-page' ),
				'section'     => 'ppwp_pro_form_instructions',
				'settings'    => 'ppwp_pro_form_instructions_password_label_font_size',
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'type'        => 'number',
			) );

			/* password label color */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_password_label_color' );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pro_form_instructions_password_label_color_control', array(
					'label'    => __( 'Label Color', 'password-protect-page' ),
					'section'  => 'ppwp_pro_form_instructions',
					'settings' => 'ppwp_pro_form_instructions_password_label_color',
				) )
			);

			/* placeholder text */
			$wp_customize->add_setting( 'ppwp_pro_form_instructions_placeholder' );
			$wp_customize->add_control( 'ppwp_pro_form_instructions_placeholder_control', array(
				'label'    => __( 'Placeholder', 'password-protect-page' ),
				'section'  => 'ppwp_pro_form_instructions',
				'settings' => 'ppwp_pro_form_instructions_placeholder',
				'type'     => 'text',
			) );

			/* form button section */
			$wp_customize->add_section( 'ppwp_pro_form_button', array(
				'title'    => __( 'Button', 'password-protect-page' ),
				'panel'    => 'ppwp_sitewide',
				'priority' => 400,
			) );

			/* button label */
			$wp_customize->add_setting( 'ppwp_pro_form_button_label', array(
				'default' => __( 'Enter', 'password-protect-page' ),
			) );
			$wp_customize->add_control( 'ppwp_pro_form_button_label_control', array(
				'label'    => __( 'Button Label', 'password-protect-page' ),
				'section'  => 'ppwp_pro_form_button',
				'settings' => 'ppwp_pro_form_button_label',
				'type'     => 'text',
			) );

			/* button text color */
			$wp_customize->add_setting( 'ppwp_pro_form_button_text_color' );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pro_form_button_text_color_control', array(
					'label'    => __( 'Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_pro_form_button',
					'settings' => 'ppwp_pro_form_button_text_color',
				) )
			);

			/* button background color */
			$wp_customize->add_setting( 'ppwp_pro_form_button_background_color' );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pro_form_button_background_color_control', array(
					'label'    => __( 'Background Color', 'password-protect-page' ),
					'section'  => 'ppwp_pro_form_button',
					'settings' => 'ppwp_pro_form_button_background_color',
				) )
			);

        }

		/**
		 * Add dynamic styles
		 *
		 * TODO: move this styles into css file.
		 * @return void
		 */
	    public function dynamic_styles() {
	    	$sw_custom_css = $this->get_preset_css();
		    $sw_custom_css = $sw_custom_css . "
			.pda-form-login {
				width: " . get_theme_mod( 'ppwp_pro_form_instructions_width' ) . "px!important;
			}

			.pda-form-login label {
				font-size: " . get_theme_mod( 'ppwp_pro_form_instructions_password_label_font_size' ) . "px!important;
				color: " . get_theme_mod( 'ppwp_pro_form_instructions_password_label_color' ) . "!important;
			}

			.pda-form-login form {
				background-color: " . get_theme_mod( 'ppwp_pro_form_instructions_background_color' ) . "!important;
				border-radius: " . get_theme_mod( 'ppwp_pro_form_instructions_border_radius' ) . "px!important;
			}

			.pda-form-login a.ppw-swp-logo {
				background-image: none, url(" . get_theme_mod( 'ppwp_pro_logo_customize', PPW_DIR_URL . 'includes/views/entire-site/assets/ppwp-logo.png' ) . ")!important;
				background-size: cover;
				width: " . get_theme_mod( 'ppwp_pro_logo_customize_width', '' ) . "px!important;
				height: " . get_theme_mod( 'ppwp_pro_logo_customize_height', '' ) . "px!important;
				border-radius: " . get_theme_mod( 'ppwp_pro_logo_customize_border_radius', '' ) . "%!important;
			}
			
			.pda-form-login .button-login {
				color: " .  get_theme_mod( 'ppwp_pro_form_button_text_color' ) . "!important;
				background-color: " . get_theme_mod( 'ppwp_pro_form_button_background_color' ) . "!important;
				border-color: " . get_theme_mod( 'ppwp_pro_form_button_background_color' ) . "!important;
			}
			";

			// remove space in $sw_custom_css.
			$sw_custom_css = $this->optimize_css( $sw_custom_css );
			echo $sw_custom_css;
		}

		/*
		 * Optimize css.
		 */
		public function optimize_css( $sw_custom_css ) {
	    	return preg_replace( "/\s{2,}/", " ", str_replace( "\n", "", str_replace( ', ', ",", $sw_custom_css ) ) );
		}

	    /**
	     * Get templates.
	     *
	     * @return array
	     */
	    public function get_templates() {
		    $free_templates = array();
		    $themes_name    = array(
			    __( 'Default', 'password-protect-page' ),
			    __( 'Event', 'password-protect-page' ),
			    __( 'Business', 'password-protect-page' ),
			    __( 'Wedding', 'password-protect-page' ),
		    );

		    foreach ( $themes_name as $index => $theme_name ) {
			    $free_templates["default{$index}"] = array(
				    'thumbnail' => PPW_DIR_URL . 'includes/customizers/assets/images/thumbnail/sw-default' . $index . '.png',
				    'id'        => "default{$index}",
				    'name'      => $theme_name,
				    'css_file'  => PPW_DIR_PATH . 'includes/customizers/assets/css/sw-default' . $index . '.php',
			    );
		    }

		    return apply_filters( 'ppw_customizer_sitewide_templates', $free_templates );
	    }

	    /**
	     * Get css of a theme.
	     *
	     * @return string
	     */
	    public function get_preset_css() {
		    $default_preset = 'default0';
		    $preset         = get_theme_mod( 'ppw_customize_presets_settings', $default_preset );
		    $sw_custom_css  = '';
		    if ( $preset !== $default_preset ) {
			    $templates = $this->get_templates();
			    if ( isset( $templates[ $preset ], $templates[ $preset ]['css_file'] ) ) {
				    ob_start();
				    include_once( $templates[ $preset ]['css_file'] );
				    ?>
				    @media screen and (max-width: 768px) {
					    .pda-form-login {
					        width: 100%;
			            }
				        .pda-form-login form {
				            width: 90%;
				        }
				    }
				    <?php
				    $sw_custom_css = ob_get_clean();
			    }
		    }

		    return $sw_custom_css;
	    }

	    public function load_css_to_pro() {
	    	echo $this->optimize_css( $this->get_preset_css() );
	    }


    }
}
