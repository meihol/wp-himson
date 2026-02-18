<?php
/**
 * The template for displaying archive portfolio pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Makaffo
 */

get_header(); ?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">	
					<div class="projects-filter-wrapper">	
						<div class="isotope-filter filter">			
							<ul>
								<li><a href="#" data-filter="*" class="active filter-item"><?php esc_html_e('All', 'makaffo'); ?></a></li>
								<?php 
									$terms = get_terms("portfolio_cat"); // get all categories, but you can use any taxonomy
									$count = count($terms); //How many are they?
									if ( $count > 0 ){  //If there are more than 0 terms
										foreach ( $terms as $term ) {  //for each term:
											$id_slug  = $term->term_id;
											echo "<li><a href='#' class='filter-item' data-filter='.portfolio-category-id-".$id_slug."'>" . $term->name . "</a></li>\n";
											//create a list item with the current term slug for sorting, and name for label
										}
									} 
								?>
							</ul>
						</div>
						<?php $p_count = wp_count_posts('ot_portfolio'); $c = $p_count->publish; if ( have_posts() ) : ?>
							<div class="projects-masonry isotope row <?php makaffo_portfolio_option_class(); ?>">
								<div class="grid-sizer"></div>
								<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										* Include the Post-Type-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Type name) and that will be used instead.
										*/
										get_template_part( 'template-parts/content', 'project-filter' );

									endwhile; 
								?>
							</div>
							<?php if( $c > makaffo_get_option('portfolio_posts_per_page') ) { ?>
								<?php 
									$loadmore_param = [
										'data_load'		=> 3,
									];
								?>
								<div class="loadmore_wrapper">
									<button class="octf-btn btn-loadmore more" data-param_options="{}">
										<?php esc_attr_e('Load More','makaffo'); ?>
									</button>
								</div>							
							<?php } ?>
						<?php 	
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>	
					</div>	
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();

