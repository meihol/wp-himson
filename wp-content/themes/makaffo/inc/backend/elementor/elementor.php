<?php
/*Load the theme's custom Widgets so that they appear in the Elementor element panel.*/
add_action( 'elementor/widgets/register', 'makaffo_register_elementor_widgets' );
function makaffo_register_elementor_widgets() {
    if ( defined( 'ELEMENTOR_PATH' ) && class_exists('Elementor\Widget_Base') ) {
        /*Include Elementor Widget files here. */
        require_once( get_template_directory() . '/inc/backend/elementor/widgets/widgets.php' );
        require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/widgets.php' );
    }
}

/*Add a custom 'category_makaffo' category for to the Elementor element panel so that our theme's widgets have their own category.*/
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_makaffo',
        [
            'title' => __( 'Makaffo', 'makaffo' ),
            'icon' => 'fa fa-plug', /*//default icon*/
        ],
        1 /*// position*/
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_makaffo_header',
        [
            'title' => __( 'OT Header', 'makaffo' ),
            'icon' => 'fa fa-plug', /*//default icon*/
        ],
        2 /*// position*/
    );
});

/*Post types with Elementor*/
function makaffo_add_cpt_support() {
    
    /*if exists, assign to $cpt_support var*/
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    /*check if option DOESN'T exist in db*/
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'ot_portfolio', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    /*if it DOES exist, but portfolio is NOT defined*/
    else {
        $ot_portfolio       = in_array( 'ot_portfolio', $cpt_support );
        $ot_header_builders = in_array( 'ot_header_builders', $cpt_support );
        $ot_footer_builders = in_array( 'ot_footer_builders', $cpt_support );
        if( !$ot_portfolio ){
            $cpt_support[] = 'ot_portfolio'; //append to array
        }
        if( !$ot_header_builders ){
            $cpt_support[] = 'ot_header_builders'; //append to array
        }
        if( !$ot_footer_builders ){
            $cpt_support[] = 'ot_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'makaffo_add_cpt_support' );

/*Upload SVG for Elementor*/
function makaffo_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'makaffo_unfiltered_files_upload' );

/*Header post type*/
add_action( 'init', 'makaffo_create_header_builder' ); 
function makaffo_create_header_builder() {
    register_post_type( 'ot_header_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Header Builder', 'makaffo' ),
                'singular_name'     => esc_html__( 'Header Builder', 'makaffo' ),
                'add_new'           => esc_html__( 'Add New', 'makaffo' ),
                'add_new_item'      => esc_html__( 'Add New Header', 'makaffo' ),
                'edit'              => esc_html__( 'Edit', 'makaffo' ),
                'edit_item'         => esc_html__( 'Edit Header', 'makaffo' ),
                'all_items'         => esc_html__( 'All Headers', 'makaffo' ),
                'new_item'          => esc_html__( 'New Header', 'makaffo' ),
                'view'              => esc_html__( 'View', 'makaffo' ),
                'view_item'         => esc_html__( 'View Header', 'makaffo' ),
                'search_items'      => esc_html__( 'Search Header', 'makaffo' ),
                'not_found'         => esc_html__( 'No Header found', 'makaffo' ),
                'not_found_in_trash'=> esc_html__( 'No Header found in Trash', 'makaffo' ),
                'parent'            => esc_html__( 'Parent Header', 'makaffo' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Footer post type*/
add_action( 'init', 'makaffo_create_footer_builder' ); 
function makaffo_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Footer Builder', 'makaffo' ),
                'singular_name'     => esc_html__( 'Footer Builder', 'makaffo' ),
                'add_new'           => esc_html__( 'Add New', 'makaffo' ),
                'add_new_item'      => esc_html__( 'Add New Footer', 'makaffo' ),
                'edit'              => esc_html__( 'Edit', 'makaffo' ),
                'edit_item'         => esc_html__( 'Edit Footer', 'makaffo' ),
                'all_items'         => esc_html__( 'All Footers', 'makaffo' ),
                'new_item'          => esc_html__( 'New Footer', 'makaffo' ),
                'view'              => esc_html__( 'View', 'makaffo' ),
                'view_item'         => esc_html__( 'View Footer', 'makaffo' ),
                'search_items'      => esc_html__( 'Search Footer Builders', 'makaffo' ),
                'not_found'         => esc_html__( 'No Footer found', 'makaffo' ),
                'not_found_in_trash'=> esc_html__( 'No Footer found in Trash', 'makaffo' ),
                'parent'            => esc_html__( 'Parent Footer', 'makaffo' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/**
 * enables default language and translation management for 'ot_header_builders', 'ot_footer_builders' in Polylang
 */

if ( function_exists( 'pll_the_languages' ) ) {
    add_filter( 'pll_get_post_types', 'add_cpt_to_pll', 10, 2 );
    function add_cpt_to_pll( $post_types ) {
        $post_types['ot_header_builders'] = 'ot_header_builders';
        $post_types['ot_footer_builders'] = 'ot_footer_builders';
        return $post_types;
    }
}

/*Fix Elementor Pro*/
function makaffo_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'makaffo_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/section/section_structure/after_section_end', function( $section, $args ) {

    /* header options */
    $section->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'For Header', 'makaffo' ),
            'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $section->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'makaffo' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'sticky-header',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'makaffo' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'sticky-header',
            ],
        ]
    );
    $section->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'makaffo' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
                '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);',
            ],
            'condition' => [
                'sticky_class' => 'sticky-header',
            ],
        ]
    );

    $section->end_controls_section();

}, 10, 2 );
