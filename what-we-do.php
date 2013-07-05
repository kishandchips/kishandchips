<?php
/**
 * Template Name: What We Do
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

get_header(); ?>

<div id="about-us">
<div id="content" <?php post_class(); ?>>
	<?php while ( have_posts() ) : the_post(); ?>
			<?php if(!$post->post_content == ''): ?>
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>
			<?php if ( get_field('content')):?>
			<?php get_template_part('inc/content'); ?>
			<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
	
	<div id="capabilities">
		<div class="container">
		<h2>Capabilities</h2>
		<?php
			$args = array('post_type' => 'page', 'posts_per_page' => -1, 'post_parent' => $post->ID,'order' => 'ASC','orderby' => 'menu_order');
			$parent = new WP_Query( $args );

			if ( $parent->have_posts() ) : ?>
			    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
			    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			    
			    	<div id="child-<?php the_ID(); ?>" class="outer <?php echo (++$j % 2 == 0) ? 'even' : 'odd'; ?>">
				        <div class="child-page clearfix" style="background-image: url(<?php echo $image[0]; ?>);">
					        <div class="span five break-on-mobile">
					            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					            <p><?php the_content(); ?></p>
					            <a href="" class="link more-btn acc-open">Read More</a>
					            <a href="" class="link close-btn acc-close">Close</a>
				            </div>
				        </div>
				        <div class="accordion hide">
				        	<div class="inner">
				        		<?php the_content(); ?>	
				        	</div>
					        <div class="close-bottom">
					        	<a href="" class="link close-btn">Close</a>
					        </div>
				        </div>
			        </div>
			        
			    <?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>
	
</div>
</div><!-- #page -->
<?php get_footer(); ?>