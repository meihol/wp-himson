<?php
/**
 * Template part for displaying widget Portfolio Carousel 2
 *
 * @package Makaffo
 */
?>
<?php 
	$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
?>
<article class="project-item">
	<div class="projects-box">
		<figure class="projects-thumbnail">
			<?php  
				if ( has_post_thumbnail() ) {
					$args['settings']['post_thumbnail'] = [
						'id' => get_post_thumbnail_id(),
					];
					$thumbnail_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $args['settings'], 'post_thumbnail' );
				}else{
					$image_url = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png';
					$thumbnail_html = '<img src="' . $image_url . '"/>';
				}
			?>
			<a href="<?php the_permalink(); ?>">
				<?php echo wp_kses_post( $thumbnail_html ); ?>
			</a>
		</figure>

		<div class="project-details dflex">
        	<h3 class="project-title">
        		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        	</h3>
        	<div class="project-exc">
        		<?php echo the_excerpt(); ?>
        	</div>
		</div>
	</div>
</article>

