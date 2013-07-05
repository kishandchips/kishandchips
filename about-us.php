<?php
/**
 * Template Name: About Us
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
	
	<div id="key-principles" class="row"> 
		<div class="container">
			<?php while (has_sub_field('key_principles_content', $id)) : ?>
				<?php 
					$item_image_id = get_sub_field('item_image');
					$item_image = wp_get_attachment_image_src($item_image_id, 'full');
				?>
				<div class="break-on-mobile span equal-height third">
					<div class="image">
						<img src="<?php echo $item_image[0]; ?>" alt="">	
					</div>
					<div class="text">
						<h3><?php the_sub_field('item_title'); ?></h3>
						<?php the_sub_field('item_description'); ?>						
					</div>
				</div>
			<?php endwhile; ?>	
		</div>
	</div>	
	
	<div id="meet-the-team">
		<div class="container">
			<h2>Meet the Team</h2>
				<?php while (has_sub_field('meet_the_team', $id)) : ?>
					<div class="row clearfix <?php echo (++$j % 2 == 0) ? 'even' : 'odd'; ?>">
						<?php 
							$member_image_id = get_sub_field('member_image');
							$member_image = wp_get_attachment_image_src($member_image_id, 'full');
						?>
							<div class="image">
								<img src="<?php echo $member_image[0]; ?>" alt="">	
							</div>
							<div class="text">
								<h3 class="name"><?php the_sub_field('member_name'); ?></h3>
								<div class="position"><?php the_sub_field('member_position'); ?></div>
								<p><?php the_sub_field('member_description'); ?></p>
							</div>
					</div>				
				<?php endwhile; ?>		
		</div>
	</div>
</div>
</div><!-- #page -->
<?php get_footer(); ?>