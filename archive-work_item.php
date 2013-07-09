<?php
/**
 * The template for displaying Our Work archives.
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
query_posts(array_merge($wp_query->query_vars, array('orderby' => 'menu_order', 'order' => 'ASC')));
get_header(); ?>

<div id="archive-work">
	<div class="container">
		<?php $i = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$logo_id = get_field('item_logo');
				$logo = wp_get_attachment_image_src($logo_id, 'full');
			?>
				<a class="item overlay-btn" href="<?php the_permalink(); ?>">
					<div class="work row clearfix">
						<div class="span four info equal-height">
							<div class="centerer valign-center">
								<div class="logo">
									<img src="<?php echo $logo[0]; ?>" alt="">
								</div>
								<div class="title"><?php the_field('item_sub_title')?></div>
							</div>		
						</div>
						<div class="span six image equal-height">
							<?php the_post_thumbnail('full', array('class' => 'scale')); ?>
						</div>
					</div>
				</a>
			<?php $i++; ?>
		<?php endwhile; ?>
	</div>
</div><!-- #page -->
<?php get_footer(); ?>