<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Makaffo
 */

?>
<?php                                                     
	$format 	 = get_post_format();
	$link_video  = get_post_meta(get_the_ID(),'post_video', true);
	$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
	$link_link   = get_post_meta(get_the_ID(),'post_link', true);
	$text_link   = get_post_meta(get_the_ID(),'text_link', true);
	$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
	$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
	$images		 = '';
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box masonry-post-item'); ?>>
	<div class="post-inner">
	    <?php if ( $format == 'gallery' ) { ?>
			
			<?php if ( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_gallery', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
				<?php if( !empty($images) ){ ?>
				<div class="gallery-post ot-carousel" <?php if( is_rtl() ){ echo'dir="rtl"'; }?>>
					<div class="owl-carousel owl-theme"> 
	                	<?php foreach ( $images as $image ) {  ?>
                    		<div class="item-image">
	                    		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                			</div>
                		<?php } ?>    
            		</div>
        		</div> 
	            <?php } ?>

		        <?php makaffo_posted_in(); ?>

		        <?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

			</div>

	    <?php }elseif( $format == 'image' ) { ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_image', array( 'size' => 'full' ) ); } ?>
	    	<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
			    <?php if($images){ ?>              
			        <?php foreach ( $images as $image ) {  ?>				            
			            <a href="<?php the_permalink(); ?>">
			            	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			            </a>
			        <?php } ?>                
			    <?php } ?>
			    
				<?php makaffo_posted_in(); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

			</div>
			
	    <?php }elseif( $format == 'audio' ){ ?>

	    	<div class="entry-media">
	        	<?php makaffo_posted_in(); ?>

	        	<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>
	        </div>

	    	<?php if( $link_audio ){ ?>
			<div class="audio-box">
				<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
			</div>
			<?php } ?>

	    <?php }elseif( $format == 'video' ){ ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'bg_video', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
			    <?php if($images){ ?>
			    	<div class="video-popup">
				    	<a class="octf-btn octf-btn-play" href="<?php echo esc_url( $link_video ); ?>">
							<i class="ot-flaticon-play-button"></i>
						</a> 
						<?php foreach ( $images as $image ) {  ?>
				            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
				        <?php } ?>
					</div>
			                        
			    <?php } ?>
				<?php makaffo_posted_in(); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

			</div>

	    <?php }elseif( $format == 'link' ){ ?>

			<div class="entry-media">
	        	<?php makaffo_posted_in(); ?>

	        	<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>
	        </div>

	        <?php if( $text_link ){ ?>
			<div class="link-box">
				<a href="<?php echo esc_url( $link_link ); ?>" class="title-link"><?php echo esc_html( $text_link ); ?></a>
			</div>
			<?php } ?>

	    <?php }elseif( $format == 'quote' ){ ?>
			
			<div class="entry-media">
	        	<?php makaffo_posted_in(); ?>

	        	<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

	        </div>
			<div class="quote-box">
				<div class="quote-text">
					<?php echo esc_html( $quote_text ); ?>
					<span><?php echo esc_html( $quote_name ); ?></span>
				</div>
			</div>

	    <?php }elseif ( has_post_thumbnail() ) { ?>

	        <div class="entry-media post-cat-abs">
	            <a href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail('full'); ?>
	            </a>

	            <?php makaffo_posted_in(); ?>

	            <?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

	        </div>
	        
	    <?php }else{ ?>
			
			<div class="entry-media">
	        	<?php makaffo_posted_in(); ?>

	        	<?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( makaffo_get_option( 'post_entry_meta' ) ) { makaffo_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

	        </div>

	    <?php } ?>

	    <div class="inner-post">
	        <div class="entry-header">

	            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

	        </div><!-- .entry-header -->

	        <div class="entry-summary the-excerpt">

	            <?php if( is_singular('post') ){
	            	echo makaffo_excerpt(11);
	            }else{
					the_excerpt(); 
	            } ?>

	        </div><!-- .entry-content -->
	        <div class="entry-footer">
	        	<?php if(makaffo_get_option('blog_read_more')){ ?><a href="<?php the_permalink(); ?>" class="more hover"><?php echo esc_html(makaffo_get_option('blog_read_more')); ?></a><?php } ?>
	        </div>
	    </div>
	</div>
</article>
