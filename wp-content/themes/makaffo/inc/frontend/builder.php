<?php
/** header desktop **/
if ( ! function_exists( 'makaffo_header_builder' ) ) {
    function makaffo_header_builder (){
        $header_builder = '';    

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_header', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ( $metabox_fb != '' ) {
                    $header_builder = $metabox_fb;
                }else{
                    $header_builder = makaffo_get_option('header_layout');
                }
            } 
        }else{
            $header_builder = makaffo_get_option('header_layout');
        }

        if( !$header_builder || empty( makaffo_get_option('header_builder') ) ) {
            get_template_part('inc/frontend/header/header-default');
        }else{
            echo '<div class="header-desktop">';
            if ( did_action( 'elementor/loaded' ) ) { 
                if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {
                    $translated_header_builder = apply_filters( 'wpml_object_id', $header_builder );
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $translated_header_builder );
                } else {              
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_builder ); 
                }
            }
            echo '</div>';
        }
    }
}

/** header mobile **/
if ( ! function_exists( 'makaffo_mobile_builder' ) ) {
    function makaffo_mobile_builder (){
        
        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_hmb = rwmb_meta( 'select_header_mobile', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_hmb != '') {
                    $mobile_builder = $metabox_hmb;
                } else {
                    $mobile_builder = makaffo_get_option('header_mobile');
                }
            } 
        } else {
            $mobile_builder = makaffo_get_option('header_mobile');
        }

        if ( !$mobile_builder || empty( makaffo_get_option('header_builder') ) ) {
            get_template_part('inc/frontend/header/header-mobile');
        } else {
            echo '<div class="header-mobile">';
            if ( did_action( 'elementor/loaded' ) ) {   
                if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {
                    $translated_mobile_builder = apply_filters( 'wpml_object_id', $mobile_builder );
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $translated_mobile_builder );
                } else {            
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content( $mobile_builder ); 
                }
            }
            echo '</div>';
        }
    }
}

/** side panel **/
if ( ! function_exists( 'makaffo_sidepanel_builder' ) ) {
    function makaffo_sidepanel_builder (){

        $panel_builder = makaffo_get_option('sidepanel_layout');

        if ( !$panel_builder ) {
            return;
        } else {
            if ( did_action( 'elementor/loaded' ) ) {  
                if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {
                    $translated_panel_builder = apply_filters( 'wpml_object_id', $panel_builder );
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $translated_panel_builder );
                } else {              
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content( $panel_builder ); 
                }
            }
        }
    }
}

/** 404 template **/
if ( ! function_exists( 'makaffo_404_builder' ) ) {
    function makaffo_404_builder (){

        $error_builder = makaffo_get_option('page_404');

        if ( !$error_builder ) { ?>
            <div class="error-404 not-found text-center">
                <div class="container">
                    <img src="https://himson.in/wp-content/uploads/2025/08/Himson-site-logo.svg" class="himson-404-logo" alt="Himson"/>
                    <h1><?php wp_kses( _e( '404', 'makaffo' ), wp_kses_allowed_html('post')  ); ?></h1>
                    <h2><?php esc_html_e( 'Sorry we can`t find that page!', 'makaffo' ); ?></h2>
                    <div class="page-content">
                        <p><?php esc_html_e( 'The page you are searching for is under construction. We are working on our new design so prepare for the new chapter of our website journey.', 'makaffo' ); ?></p>
                        <?php get_search_form(); ?>
                        <a class="octf-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="ot-flaticon-left"></i><?php esc_html_e( 'Back to home', 'makaffo' ); ?></a>
                    </div>
                </div>
            </div>
        <?php } else {
            if ( did_action( 'elementor/loaded' ) ) {   
                if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {
                    $translated_error_builder = apply_filters( 'wpml_object_id', $error_builder );
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $translated_error_builder );
                } else {             
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content( $error_builder ); 
                }
            }
        }
    }
}

/** footer **/
if ( ! function_exists( 'makaffo_footer_builder' ) ) {
    function makaffo_footer_builder (){
        $footer_builder = '';    

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_footer', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_fb != '') {
                    $footer_builder = $metabox_fb;
                } else {
                    $footer_builder = makaffo_get_option('footer_layout');
                }
            } 
        } else {
            $footer_builder = makaffo_get_option('footer_layout');
        }

        if ( !$footer_builder ) {
            return;
        } else {
            echo '<footer id="site-footer" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
            if ( did_action( 'elementor/loaded' ) ) {   
                if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {
                    $translated_footer_builder = apply_filters( 'wpml_object_id', $footer_builder );
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $translated_footer_builder );
                } else {              
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_builder ); 
                }
            }
            echo '</footer>';
        }
    }
}