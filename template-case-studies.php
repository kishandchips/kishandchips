<?php
/**
 * Template Name: Case Studies
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

global $wp_query;
$args = array( 
		'post_type' => 'work_item',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 16
	);
query_posts( $args );
get_header(); ?>

<div id="template-case-studies">
	<div class="container">
		<?php $i = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$logo_id = get_field('item_logo');
				$logo = wp_get_attachment_image_src($logo_id, 'full');
			?>
				<a class="item overlay-btn" href="<?php the_permalink(); ?>">
					<div class="work row clearfix">
						<div class="span four info">
							<div class="centerer valign-center">
								<div class="logo">
									<?php if(get_field('item_logo') !=''): ?>
										<img src="<?php echo $logo[0]; ?>" alt="">
									<?php else :?>
										<h4 class="title"><?php the_title(); ?></h4> 
									<?php endif;?>															
								</div>
								<div class="title"><?php the_field('item_sub_title')?></div>
							</div>		
						</div>
						<div class="span six image right">
							<?php the_post_thumbnail('full', array('class' => 'scale')); ?>
						</div>
					</div>
				</a>
			<?php $i++; ?>
		<?php endwhile; ?>
		<div class="footer text-center">
			<a class="button" href="<?php echo get_permalink(1849); ?>" class="link">Project Archive</a>
		</div>
	</div>
</div><!-- #page -->
<?php get_footer(); ?>