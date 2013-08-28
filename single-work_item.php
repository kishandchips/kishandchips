<?php
/**
 * The template for displaying Our Work archives.
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
query_posts(array_merge($wp_query->query_vars, array('orderby' => 'menu_order', 'order' => 'ASC')));
get_header(); ?>
<?php 
	$logo_id = get_field('item_logo');
	$logo = wp_get_attachment_image_src($logo_id, 'full');
	$header_id = get_field('header_image_id');
	$header_image = wp_get_attachment_image_src($header_id, 'full');
?>
<div id="single-work">
	<div class="header" style="background-color: <?php the_field('header_background_color')?>;">
		<div class="content" style="background-image: url(<?php echo $header_image[0]; ?>);">
			<div class="vh-align-center">
				<?php if(get_field('item_logo') !=''): ?>
					<img src="<?php echo $logo[0]; ?>" alt="">
				<?php else :?>
					<h4 class="title"><?php the_title(); ?></h4> 
				<?php endif;?>		
				<div class="title"><?php the_field('item_sub_title')?></div>	
			</div>
		</div>
		<div id="content">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div>
		<?php if(get_field('project_description') !=''): ?>
		<div class="description">
			<div class="container">
				<div class="span six push-two">
					<h4 class="title"><?php the_field('project_title')?></h4>
					<p><?php the_field('project_description')?></p>

					<?php if(get_field('project_website') !=''): ?>
						<a class="link" href="<?php the_field('project_website')?>" target="_blank"><?php _e('Visit website')?></a>
					<?php endif;?>
					<a class="link back-btn right" href="<?php echo get_permalink(11); ?>"><?php _e('Back to Projects')?></a>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
</div><!-- #page -->
<?php get_footer(); ?>