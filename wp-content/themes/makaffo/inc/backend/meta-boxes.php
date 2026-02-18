<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function makaffo_register_meta_boxes( $meta_boxes ) {
	
	/*Post format's meta box*/
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Format Details', 'makaffo' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'makaffo' ),
				'id'               => 'post_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
				/*Image size that displays in the edit page. Possible sizes small,medium,large,original*/
    			'image_size'       => 'thumbnail',
			),
			array(
				'name'  			=> esc_html__( 'Gallery', 'makaffo' ),
				'id'    			=> 'post_gallery',
				'type'  			=> 'image_advanced',
				'class' 			=> 'gallery',
				/*Image size that displays in the edit page. Possible sizes small,medium,large,original*/
    			'image_size'       	=> 'thumbnail',
			),			
			array(
				'name'  => esc_html__( 'Audio', 'makaffo' ),
				'id'    => 'post_audio',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
				'desc'  => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'Video', 'makaffo' ),
				'id'    => 'post_video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
				'desc'  => 'Example: https://vimeo.com/87959439',
			),
			array(
				'name'  => esc_html__( 'Background Video', 'makaffo' ),
				'id'    => 'bg_video',
				'type'  => 'image_advanced',
				'class' => 'video',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Link', 'makaffo' ),
				'id'    => 'post_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Text Link', 'makaffo' ),
				'id'    => 'text_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Quote', 'makaffo' ),
				'id'    => 'post_quote',
				'type'  => 'textarea',
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Quote Name', 'makaffo' ),
				'id'    => 'quote_name',
				'type'  => 'text',
				'class' => 'quote',
			)		
		),
	);

	/*Page Settings*/
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__( 'Page Header Settings', 'makaffo' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'id'        			=> 'page_layout',
                'name'      			=> esc_html__( 'Page Layout', 'makaffo' ),
                'type'      			=> 'image_select',
                'options'   			=> array(
                    'full-content'    	=> get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'       			=> 'full-content'
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'makaffo' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'makaffo' ),
                'off_label'        => esc_html__( 'Off', 'makaffo' ),
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'makaffo' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            )
		),
	);
    
	$meta_boxes[] = array (
      	'id' 			=> 'select-header-footer',
      	'title' 		=> esc_html__( 'Header/Footer Settings', 'makaffo' ),
      	'pages' 		=> array ('page'),
      	'context' 		=> 'normal',
      	'priority' 		=> 'high',
      	'autosave' 		=> false,
      	'fields' 		=>   array (  
        	array(
        		'name' 					=> esc_html__( 'Header Layout', 'makaffo' ),
				'id' 					=> 'select_header',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header', 'makaffo' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array(
                'name'             		=> esc_html__( 'Header Transparent?', 'makaffo' ),
                'id'               		=> 'is_trans',
				'type'             		=> 'select',
				'options'   			=> array(
                    'default'   		=> esc_html__( 'Default', 'makaffo' ),
                    'yes' 				=> esc_html__( 'Yes', 'makaffo' ),
                    'no' 				=> esc_html__( 'No', 'makaffo' ),
                ),
                'std'       			=> 'default'
            ),
			array(
        		'name' 					=> esc_html__( 'Header Mobile Layout', 'makaffo' ),
				'id' 					=> 'select_header_mobile',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header mobile', 'makaffo' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array (
        		'name' 					=> esc_html__( 'Footer Layout', 'makaffo' ),
				'id' 					=> 'select_footer',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_footer_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a footer', 'makaffo' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
        	),
      	),
	);

	$meta_boxes[] = array(
        'id'       => 'ppheader-settings',
        'title'    => esc_html__( 'Page Header Settings', 'makaffo' ),
        'pages'    => array( 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'makaffo' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => 'On',
                'off_label'        => 'Off',
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'makaffo' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
			),
        ),
	);

	$meta_boxes[] = array(
        'id'       => 'pthumb-settings',
        'title'    => esc_html__( 'Portfolio Featured Image Settings', 'makaffo' ),
        'pages'    => array( 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'id'        => 'thumb_size',
                'name'      => esc_html__( 'Select Size', 'makaffo' ),
                'type'      => 'select',
                'options'   => array(
                    'normal' 	=> 'Normal Width',
                    'w_double'    => 'Double Width',
                ),
                'std'       => 'normal'
            ),
        ),
    );

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'makaffo_register_meta_boxes' );
