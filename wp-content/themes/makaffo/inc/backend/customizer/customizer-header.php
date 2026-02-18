<?php
function header_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'makaffo',
	);

	$sections = array(
        'main_header'     => array(
            'title'       => esc_html__( 'Header', 'makaffo' ),
            'description' => '',
            'priority'    => 8,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(
		/* header settings */
		'header_builder'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Builder?', 'makaffo' ),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 2,
        ),
		'header_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'makaffo' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'makaffo' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'makaffo' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
		),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'makaffo' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'makaffo' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 4,
	 		'placeholder' => esc_attr__( 'Select a header', 'makaffo' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
        ),
        'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'makaffo' ),
	 		'description' => esc_attr__( 'Enable when your header is transparent.', 'makaffo' ), 
            'section'     => 'main_header',
			'default'     => '',
			'priority'    => 5,
        ),
        'is_sidepanel'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel for all site?', 'makaffo' ),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 6,
			'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
        ), 
        'sidepanel_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Side Panel', 'makaffo' ), 
	 		'description' => esc_attr__( 'Choose the side panel on header.', 'makaffo' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 6,
	 		'placeholder' => esc_attr__( 'Select a panel', 'makaffo' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
	 			array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),
		'panel_left'     => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel On Left', 'makaffo' ),
            'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 7,
			'active_callback' => array(
				array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
                array(
					'setting'  => 'sidepanel_layout',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),
		'logo_site'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo', 'makaffo' ),
            'section'  => 'main_header',
            'default'  => get_template_directory_uri() . '/images/logo.svg',
            'priority' => 10,
            'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '',
				),
            ),
        ),
        'logo_width'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Logo Width (Ex: 200px)', 'makaffo' ),
            'section'  => 'main_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'makaffo' ),
                'tablet'  => esc_attr__( 'Tablet', 'makaffo' ),
                'mobile'  => esc_attr__( 'Mobile', 'makaffo' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (min-width: 1025px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '',
				),
            ),
        ),
		
	);

	$settings['sections'] = apply_filters( 'makaffo_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'makaffo_customize_fields', $fields );

	return $settings;
}