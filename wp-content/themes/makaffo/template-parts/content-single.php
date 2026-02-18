<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Makaffo
 */

$format = get_post_format();

$gallery_img  = get_post_meta(get_the_ID(),'post_gallery', true);
$post_image  = get_post_meta(get_the_ID(),'post_image', true);
$bg_video  = get_post_meta(get_the_ID(),'bg_video', true);
$link_video  = get_post_meta(get_the_ID(),'post_video', true);
$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
$link_link   = get_post_meta(get_the_ID(),'post_link', true);
$text_link   = get_post_meta(get_the_ID(),'text_link', true);
$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post post-box'); ?>>
    <div class="post-meta">
        <?php makaffo_posted_in(); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
        <?php if(makaffo_get_option('post_entry_meta')) : ?>
        <div class="entry-meta">
            <?php makaffo_post_meta(); ?>
        </div>
        <?php endif; endif; ?>
        
    </div>
    <div class="entry-header">
        <h3><?php the_title(); ?></h3>
    </div>
    <?php if( $format == 'gallery' ) { ?>
        <?php if ( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_gallery', array( 'size' => 'full' ) ); } ?>
        <?php if( !empty($images) ){ ?>
            <div class="entry-media">
                <div  class="gallery-post ot-carousel" <?php if( is_rtl() ){ echo'dir="rtl"'; }?>>
                    <div class="owl-carousel owl-theme">        
                        <?php foreach ( $images as $image ) { ?>
                            <div class="item-image">
                                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                            </div> 
                        <?php } ?>
                    </div>
                </div>
            </div> 
        <?php } ?>         

    <?php }elseif( $format == 'image' ) { ?>

        <div class="entry-media">
            <?php if( function_exists( 'rwmb_meta' ) ) {  $images = rwmb_meta( 'post_image', array( 'size' =>'full' ) ); ?>
                <?php if($images){ ?>              
                    <?php foreach ( $images as $image ) { ?>                            
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                        </a>
                    <?php } ?>                
                <?php } ?>
            <?php } ?>
        </div>
        
    <?php }elseif( $format == 'audio' ){ ?>

        <div class="audio-box">
            <iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
        </div>

    <?php }elseif( $format == 'video' ){ ?>

        <div class="entry-media">
            <?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'bg_video', array( 'size' =>'full' ) ); ?>
                <?php if($images){ ?>     
                    <div class="video-popup">        
                        <a class="octf-btn octf-btn-play" href="<?php echo esc_url( $link_video ); ?>">
                            <i class="ot-flaticon-play-button"></i>
                        </a> 
                    </div>
                    <?php  foreach ( $images as $image ) {  ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                    <?php } ?>                
                <?php } ?>
            <?php } ?>
        </div>

    <?php }elseif( $format == 'link' ){ ?>
        <?php if($text_link){ ?>
        <div class="link-box">
            <i class="ot-flaticon-link1"></i>
            <a href="<?php echo esc_url( $link_link ); ?>"><?php echo esc_html( $text_link ); ?></a>
        </div>
        <?php } ?>

    <?php }elseif( $format == 'quote' ){ ?>
        <?php if($quote_text){ ?>
        <div class="quote-box">
            <i class="ot-flaticon-left-quotes-sign"></i>
            <div class="quote-text">
                <?php echo esc_html( $quote_text ); ?>
                <span><?php echo esc_html( $quote_name ); ?></span>
            </div>
        </div>
        <?php } ?>

    <?php }elseif ( has_post_thumbnail() ) { ?>

        <div class="entry-media"><?php the_post_thumbnail(); ?></div>
        
    <?php } ?>
    <div class="inner-post">

        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'makaffo'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'makaffo'),
                    'after' => '</div>',
                ));
            ?>

        </div><!-- .entry-content -->
        
        <div class="entry-footer clearfix">
            <?php makaffo_entry_footer(); ?>
            <?php if( makaffo_get_option('post_socials') ) makaffo_socials_share(); ?>
        </div>
        
        
    </div>
    <?php if(makaffo_get_option('author_box') || makaffo_get_option('post_nav')){ ?>
        <div class="author_nav_block">
            <?php if( makaffo_get_option('author_box') ) makaffo_author_info_box(); ?>
            <?php if( makaffo_get_option('post_nav') ) makaffo_single_post_nav(); ?>
        </div>
        <?php } ?>
        <?php if( makaffo_get_option('related_post') ) makaffo_related_posts(); ?>
</article>
