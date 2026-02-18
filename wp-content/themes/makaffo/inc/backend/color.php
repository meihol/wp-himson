<?php 
//Custom Style Frontend
if(!function_exists('makaffo_color_scheme')){
    function makaffo_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( !empty( makaffo_get_option('main_color') ) && makaffo_get_option('main_color') != '#004fef' ){
            $color_scheme = 
            '
            :root {
                --makaffo-color-primary: '.makaffo_get_option('main_color').';
            }
            .octf-btn{
                --makaffo-btn-bg: '.makaffo_get_option('main_color').';
            }
            blockquote{
                border-color: '.makaffo_get_option('main_color').';
            }

            ';
        }

        if(! empty($color_scheme)){
            echo '<style type="text/css">'.$color_scheme.'</style>';
        }
    }
}
add_action('wp_head', 'makaffo_color_scheme');