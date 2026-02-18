<?php
function blog_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'makaffo',
	);

	$panels = array(	
	    'blog'        => array(
			'title'      => esc_html__( 'Blog', 'makaffo' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'makaffo' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'makaffo' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
	);

	$fields = array(
		/* blog settings */
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'makaffo' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'makaffo' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),	
		'blog_style'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Blog Style', 'makaffo' ),
            'section'     => 'blog_page',
            'default'     => 'list',
            'priority'    => 8,
            'description' => esc_html__( 'Select style default for the blog page.', 'makaffo' ),
            'choices'     => array(
                'list' => esc_attr__( 'Blog List', 'makaffo' ),
                'grid' => esc_attr__( 'Blog Grid', 'makaffo' ),
            ),
        ),
        'blog_columns'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Blog Columns', 'makaffo' ),
            'section'     => 'blog_page',
            'default'     => 'pf_2_cols',
            'priority'    => 8,
            'description' => esc_html__( 'Select columns default for the blog page.', 'makaffo' ),
            'choices'     => array(
                'pf_2_cols' => esc_attr__( '2 Columns', 'makaffo' ),
                'pf_3_cols' => esc_attr__( '3 Columns', 'makaffo' ),
                'pf_4_cols' => esc_attr__( '4 Columns', 'makaffo' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'blog_style',
                    'operator' => '==',
                    'value'    => 'grid',
                ),
            ),
        ),
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'makaffo' ),
            'section'  => 'blog_page',
            'default'  => array( 'date', 'author' ),
            'choices'  => array(
                'comm'    => esc_html__( 'Comment', 'makaffo' ),
                'date'    => esc_html__( 'Date', 'makaffo' ),
                'author'  => esc_html__( 'Author', 'makaffo' ),
            ),
            'priority' => 10,
        ),
        'blog_read_more'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Details Button', 'makaffo' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'READ MORE', 'makaffo' ),
			'priority'        => 11,
		),
        /* single blog */
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'makaffo' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'ptitle_post'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Page Title', 'makaffo' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'Blog Single', 'makaffo' ),
			'priority'        => 10,
		),
		'related_post_label'        => array(
            'type'            => 'text',
            'label'           => esc_html__( 'Related Posts', 'makaffo' ),
            'section'         => 'single_post',
            'default'         => esc_html__( 'Related Posts', 'makaffo' ),
            'priority'        => 10,
        ),
        'single_separator1'     => array(
            'type'        => 'custom',
            'label'       => esc_html__( 'Social Share', 'makaffo' ),
            'section'     => 'single_post',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twitter', 'facebook', 'pinterest', 'linkedin' ),
            'choices'  => array(
                'twit'      => esc_html__( 'Twitter', 'makaffo' ),
                'face'      => esc_html__( 'Facebook', 'makaffo' ),
                'pint'      => esc_html__( 'Pinterest', 'makaffo' ),
                'link'      => esc_html__( 'Linkedin', 'makaffo' ),
                'google'    => esc_html__( 'Google Plus', 'makaffo' ),
                'tumblr'    => esc_html__( 'Tumblr', 'makaffo' ),
                'reddit'    => esc_html__( 'Reddit', 'makaffo' ),
                'vk'        => esc_html__( 'VK', 'makaffo' ),
            ),
            'priority' => 10,
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'makaffo' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'makaffo' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'post_nav'     	  => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Post Navigation', 'makaffo' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Related Posts', 'makaffo' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),

	);

	$settings['panels']   = apply_filters( 'makaffo_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'makaffo_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'makaffo_customize_fields', $fields );

	return $settings;
}