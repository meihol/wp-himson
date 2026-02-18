<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Makaffo
 */

if ( ! function_exists( 'makaffo_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function makaffo_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'makaffo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'makaffo_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function makaffo_posted_in() {
        $categories_list = get_the_category_list( esc_html__( ' ', 'makaffo' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'makaffo' ), $categories_list ); // WPCS: XSS OK.
        }

        echo '<div class="post-cat"><div class="posted-in">' . $posted_in . '</div></div>'; // WPCS: XSS OK.

    };
endif;

if ( ! function_exists( 'makaffo_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function makaffo_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'makaffo' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'makaffo_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function makaffo_post_meta() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'makaffo' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( '%s', 'post author', 'makaffo' ),
            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
        );

        $comment_num = sprintf(
            /* translators: %s: post author. */
            esc_html_x( '%s', 'post comment', 'makaffo' ),
            '<a href="' .get_comments_link(). '">'. get_comments_number_text( esc_html__('0 Comments', 'makaffo'), esc_html__('1 Comment', 'makaffo'), esc_html__(  '% Comments', 'makaffo') ). '</a>' );

        $metas = makaffo_get_option( 'post_entry_meta' );
        if ( ! empty( $metas ) ) :
            if( in_array('date', $metas) ) echo '<span class="posted-on">' . $posted_on . '</span>';
            if( in_array('author', $metas) ) echo '<span class="byline">' . $byline . '</span>';
            if( in_array('comm', $metas) ) echo '<span class="comment-num">' . $comment_num . '</span>';
        endif;

    }
endif;

if ( ! function_exists( 'makaffo_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function makaffo_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'makaffo' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tagcloud">' . esc_html__( '%1$s', 'makaffo' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

	}
endif;

/** Posts Navigation **/
if ( ! function_exists( 'makaffo_posts_navigation' ) ) :
    function makaffo_posts_navigation($prev = '<i class="ot-flaticon-left"></i>', $next = '<i class="ot-flaticon-right"></i>', $pages='') {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $pagination = array(
            'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'        => '',
            'current'       => max( 1, get_query_var('paged') ),
            'total'         => $pages,
            'prev_text'     => $prev,
            'next_text'     => $next,
            'type'          => 'list',
            'end_size'      => 3,
            'mid_size'      => 3
        );
        $return =  paginate_links( $pagination );
        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
    }
endif;

/** Excerpt Section Blog Post **/
if ( ! function_exists( 'makaffo_excerpt' ) ) :
    function makaffo_excerpt($limit) {
    
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    
        return $excerpt;
    };
endif;

/** custom comment list **/
if ( ! function_exists( 'makaffo_comment_list' ) ) :
    function makaffo_comment_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
            <article class="comment-wrap clearfix">

                <div class="gravatar">
                    <?php echo get_avatar( $comment, 60 ); ?>
                </div>

                <div class="comment-content">
                    <div class="comment-meta">
                        <h6 class="comment-author"><?php esc_html_e('By ','makaffo'); ?><?php printf(__('%s','makaffo'), the_author_posts_link()) ?></h6>
                        <span class="comment-time"><?php comment_time( get_option( 'date_format' ) ); ?></span>
                    </div>
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0'){ ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.','makaffo') ?></em>
                        <?php }else{ ?>
                            <?php comment_text() ?>
                        <?php } ?>
                    </div>
                    <div class="comment-reply"><?php echo preg_replace( '/comment-reply-link/', 'comment-reply-link more hover', get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))); ?></div>
                </div>

            </article>
        </li>

        <?php
    }
endif;

/*Generate custom search form*/
function makaffo_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <label><span class="screen-reader-text">Search for:</span>
    <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search &hellip;', 'makaffo' ) . '" value="' . get_search_query() . '" name="s" /></label>
	<button type="submit" class="search-submit"><i class="ot-flaticon-magnifying-glass"></i></button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'makaffo_search_form' );

/*Add span to category post count*/
function makaffo_cat_count_span($links) {
    $links = str_replace('</a> (', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('wp_list_categories', 'makaffo_cat_count_span');

/*Add span to archive post count*/
function makaffo_archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'makaffo_archive_count_span');

/** Socials Share Post**/
if ( ! function_exists( 'makaffo_socials_share' ) ) :

    function makaffo_socials_share(){
        $share = makaffo_get_option( 'post_socials' );
        echo '<div class="share-post">';

        if( in_array('twit', $share) ) echo '<a class="twit" target="_blank" href="https://twitter.com/intent/tweet?text=' .get_the_title(). '&url=' .get_the_permalink(). '" title="Twitter"><i class="ot-flaticon-twitter"></i></a>';
        if( in_array('face', $share) ) echo '<a class="face" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' .get_the_permalink(). '" title="Facebook"><i class="ot-flaticon-facebook-app-symbol"></i></a>';
        if( in_array('pint', $share) ) echo '<a class="pint" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=' .get_the_permalink(). '&description=' .get_the_title(). '" title="Pinterest"><i class="ot-flaticon-pinterest"></i></a>';
        if( in_array('link', $share) ) echo '<a class="linked" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' .get_the_permalink(). '&title=' .get_the_title(). '&summary=' .esc_url( get_home_url('/') ). '&source=' .get_bloginfo( 'name' ). '" title="LinkedIn"><i class="ot-flaticon-linkedin"></i></a>';
        if( in_array('google', $share) ) echo ' <a class="google" target="_blank" href="https://plus.google.com/share?url=' .get_the_permalink(). '" title="Google Plus"><i class="ot-flaticon-google-plus"></i></a>';
        if( in_array('tumblr', $share) ) echo ' <a class="tumblr" target="_blank" href="http://www.tumblr.com/share/link?url=' .get_the_permalink(). '&name=' .get_the_title(). '&description=' .get_the_excerpt(). '" title="Tumblr"><i class="ot-flaticon-tumblr"></i></a>';
        if( in_array('reddit', $share) ) echo '<a class="reddit" href="http://reddit.com/submit?url=' .get_the_permalink(). '&title=' .get_the_title(). '" target="_blank" title="Reddit"><i class="ot-flaticon-reddit" aria-hidden="true"></i></a>';
        if( in_array('vk', $share) ) echo '<a class="vk" href="http://vk.com/share.php?url=' .get_the_permalink(). '" target="_blank" title="VK"><i class="ot-flaticon-vk-logo-of-social-network"></i></a>';

        echo '</div>';
    };
endif;

/** Add Contact Methods in the User Profile **/
function makaffo_user_contact_methods( $user_contact ) {
    $user_contact['facebook']   = esc_html__( 'Facebook URL', 'makaffo' );
    $user_contact['skype']      = esc_html__( 'Skype Username', 'makaffo' );
    $user_contact['twitter']    = esc_html__( 'Twitter Handle', 'makaffo' );
    $user_contact['youtube']    = esc_html__( 'Youtube Channel', 'makaffo' );
    $user_contact['linkedin']   = esc_html__( 'LinkedIn', 'makaffo' );
    $user_contact['googleplus'] = esc_html__( 'Google +', 'makaffo' );
    $user_contact['pinterest']  = esc_html__( 'Pinterest', 'makaffo' );
    $user_contact['instagram']  = esc_html__( 'Instagram', 'makaffo' );
    $user_contact['dribbble']   = esc_html__( 'Dribbble', 'makaffo' );
    $user_contact['github']     = esc_html__( 'Github Profile', 'makaffo' ); 
    return $user_contact; 
};
add_filter( 'user_contactmethods', 'makaffo_user_contact_methods' );

/** Post Author Info Box**/ 
function makaffo_author_info_box() {

    global $post;

    $author_details = '';
    // Get author's display name - NB! changed display_name to first_name. Error in code.
    $display_name = get_the_author_meta( 'display_name', $post->post_author );

    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    // Get author's biographical information or description
    $user_description   = get_the_author_meta( 'user_description', $post->post_author );
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_skype         = get_the_author_meta('skype', $post->post_author);
    $user_linkedin      = get_the_author_meta('linkedin', $post->post_author);
    $user_youtube       = get_the_author_meta('youtube', $post->post_author);
    $user_googleplus    = get_the_author_meta('googleplus', $post->post_author);
    $user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
    $user_dribbble      = get_the_author_meta('dribbble', $post->post_author);
    $user_github        = get_the_author_meta('github', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    if ( ! empty( $display_name ) )
    // Author avatar - - the number 90 is the px size of the image.
    $author_details .= '<div class="author-image">' . get_avatar( get_the_author_meta('ID') , 132 ) . '</div>';
    $author_details .= '<div class="author-info">';
    $author_details .= '<h5>' . $display_name . '</h5>';
    $author_details .= '<p class="des">' . get_the_author_meta( 'description' ). '</p>';
    $author_details .= '<div class="author-socials">';

    // Check if author has Twitter in their profile
    if ( ! empty( $user_twitter ) ) {
        $author_details .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" title="Twitter" class="tooltip"><i class="ot-flaticon-twitter"></i> </a>';
    }

    if ( ! empty( $user_facebook ) ) {
        $author_details .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" title="Facebook" class="tooltip"><i class="ot-flaticon-facebook-app-symbol"></i> </a>';
    }

    if ( ! empty( $user_skype ) ) {
        $author_details .= ' <a href="' . $user_skype .'" target="_blank" rel="nofollow" title="Username paaljoachim Skype" class="tooltip"><i class="fab fa-skype"></i> </a>';
    }

    if ( ! empty( $user_linkedin ) ) {
        $author_details .= ' <a href="' . $user_linkedin .'" target="_blank" rel="nofollow" title="LinkedIn" class="tooltip"><i class="ot-flaticon-linkedin"></i> </a>';
    }

    if ( ! empty( $user_youtube ) ) {
        $author_details .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" title="Youtube" class="tooltip"><i class="ot-flaticon-youtube"></i> </a>';
    }

    if ( ! empty( $user_googleplus ) ) {
        $author_details .= ' <a href="' . $user_googleplus .'" target="_blank" rel="nofollow" title="Google+" class="tooltip"><i class="ot-flaticon-google-plus"></i> </a>';
    }

    if ( ! empty( $user_pinterest ) ) {
        $author_details .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" title="Pinterest" class="tooltip"><i class="ot-flaticon-pinterest"></i> </a>';
    }

    if ( ! empty( $user_instagram ) ) {
        $author_details .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" title="Instagram" class="tooltip"><i class="ot-flaticon-instagram"></i> </a>';
    }

    if ( ! empty( $user_dribbble ) ) {
        $author_details .= ' <a href="' . $user_dribbble .'" target="_blank" rel="nofollow" title="Dribbble" class="tooltip"><i class="ot-flaticon-dribbble-logo"></i> </a>';
    }

    if ( ! empty( $user_github ) ) {
        $author_details .= ' <a href="' . $user_github .'" target="_blank" rel="nofollow" title="Github" class="tooltip"><i class="ot-flaticon-github"></i> </a>';
    }

    $author_details .= '</div></div>';

    // Pass all this info to post content 
    echo '<div class="author-bio">' . $author_details . '</div>';
}
/** Allow HTML in author bio section **/
remove_filter('pre_user_description', 'wp_filter_kses');

/** Single Post Navigation **/
if ( ! function_exists( 'makaffo_single_post_nav' ) ) :

    function makaffo_single_post_nav(){
        echo '<div class="post-nav clearfix">';
        if ( get_previous_post() ) {
            $ppost  = get_previous_post();
            $ptitle = get_the_title( $ppost->ID );

            // if ( ! is_singular('post') ) {
            //     $pdate = '';
            //     $pcates = get_the_terms( $ppost->ID, 'portfolio_cat' );
            //     if ( ! is_wp_error( $pcates ) && ! empty( $pcates ) ) :            
            //         foreach ( $pcates as $pterm ) {
            //             // The $pterm is an object, so we don't need to specify the $taxonomy.
            //             $term_link = get_term_link( $pterm );
            //             if ( is_wp_error( $term_link ) ) {
            //                 continue;
            //             }
            //             $pdate .= $pterm->name . '  ';
            //         }                                                   
            //     endif; 
            // } else {
                $pdate  = get_the_time( get_option( 'date_format' ), $ppost->ID );
            // }    

            $pimage = get_the_post_thumbnail( $ppost->ID , 'thumbnail');
            if( !empty( $pimage ) ){
                $pimage = '<div class="thumb-post-prev">'.$pimage.'<div class="overlay icon"><i class="ot-flaticon-left"></i></div></div>';
            }
            
            echo '<div class="post-prev">';
            previous_post_link( '%link', $pimage.'<div class="info-post-prev"><h6><span class="title-link">'.$ptitle.'</span></h6><span>'.$pdate.'</span></div>' );
            echo '</div>';
        }

        if ( get_next_post() ) {
            $npost  = get_next_post();
            $ntitle = get_the_title( $npost->ID );
            
            // if ( ! is_singular('post') ) {
            //     $ndate = '';
            //     $ncates = get_the_terms( $npost->ID, 'portfolio_cat' );
            //     if ( ! is_wp_error( $ncates ) && ! empty( $ncates ) ) :
            //         foreach ( $ncates as $nterm ) {
            //             // The $nterm is an object, so we don't need to specify the $taxonomy.
            //             $term_link = get_term_link( $nterm );                    
            //             if ( is_wp_error( $term_link ) ) {
            //                 continue;
            //             }
            //             $ndate .= $nterm->name . '  ';
            //         }                                                   
            //     endif; 
            // } else {
                $ndate  = get_the_time( get_option( 'date_format' ), $npost->ID );
            // }

            $nimage = get_the_post_thumbnail( $npost->ID , 'thumbnail');
            if( !empty( $nimage ) ){
                $nimage = '<div class="thumb-post-next">'.$nimage.'<div class="overlay icon"><i class="ot-flaticon-right"></i></div></div>';
            }

            echo '<div class="post-next">';            
            next_post_link( '%link', '<div class="info-post-next"><h6><span class="title-link">'.$ntitle.'</span></h6><span>'.$ndate.'</span></div>'.$nimage );
            echo '</div>';
        }
        echo '</div>';
    };
endif;

/** Related Posts **/
function makaffo_related_posts() {

    global $post;

    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
    if( $related ) : 

    echo '<div class="related-posts">';
    echo '<h3>'.esc_html__( makaffo_get_option( 'related_post_label' ), 'makaffo' ).'</h3>';
    echo '<div class="row">';
    foreach( $related as $post ) {
    setup_postdata($post); ?>
    
    <div class="col-sm-6">
        <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
    </div>

    <?php } wp_reset_postdata();

    echo '</div>';
    echo '</div>';

    endif;
};

/** Custom widget recent post **/
require get_template_directory() . '/inc/frontend/widgets/recent-posts.php';
require get_template_directory() . '/inc/frontend/widgets/author-widget.php';