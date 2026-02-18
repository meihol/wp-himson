<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Makaffo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>

        <h4 class="comments-title"><?php comments_number( esc_html__('Comments (0)', 'makaffo'), esc_html__('Comment (1)', 'makaffo'), esc_html__(  'Comments (%)', 'makaffo') ); ?></h4>

        <ol class="comment-list">
            <?php wp_list_comments('callback=makaffo_comment_list'); ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'makaffo' ); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    // Custom comments_args here: https://codex.wordpress.org/Function_Reference/comment_form
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $comments_args = array(
        'title_reply'   => esc_html__('Leave a Comment', 'makaffo'),
        'comment_field' => '<p class="comment-form-comment"><span class="text-primary">'. esc_html__( 'Comment', 'makaffo' ) .'</span><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_attr__( 'Type your comment', 'makaffo' ) .'" required></textarea></p>',

        'fields'        => apply_filters( 'comment_form_default_fields', array(
            'author' =>
                '<div class="row"><p class="comment-form-author col-md-6"><span class="text-primary">'. esc_html__( 'Full Name*', 'makaffo' ) .'</span><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" placeholder="'. esc_attr__( 'Your Name*', 'makaffo' ) .'" required /></p>',

            'email' =>
                '<p class="comment-form-email col-md-6"><span class="text-primary">'. esc_html__( 'Email*', 'makaffo' ) .'</span><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30" placeholder="'. esc_attr__( 'Your Email*', 'makaffo' ) .'" required /></p>',
                
            'website' => '<p class="comment-form-url col-md-12"><span class="text-primary">'. esc_html__( 'Link Website*', 'makaffo' ) .'</span><input id="website" name="website" type="text" placeholder="'.esc_attr__('Link', 'makaffo').'" /></p></div>',
        )),
        'class_submit' => 'octf-btn octf-btn-primary more',
        'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">%4$s</button>',
        'label_submit' => esc_html__( 'Post a Comment', 'makaffo' ),
        'format'       => 'xhtml'
    );
    comment_form( $comments_args );
    ?>

</div><!-- #comments -->