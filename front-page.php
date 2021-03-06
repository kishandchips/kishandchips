<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

get_header(); ?>
<section id="front-page" class="clearfix">
	<?php if ( get_field('slides')) :?>
		<div id="homepage-scroller" class="scroller" data-auto-scroll="true" data-callback="onHomeScrollerChange" >
			<div class="outer">
				<div class="inner">
					<div class="scroller-mask">
							<div class="header">
								<span class="black kc_title">
									<?php _e('Kish & Chips :'); ?>
								</span>
								<span class="dark-yellow digital_title" >
									<?php _e('Digital Architects'); ?>
								</span>				
							</div>							
						<?php $i = 0; ?>
						<?php while (the_repeater_field('slides')) : ?>					
						<?php 
							$work_item = get_sub_field('work_item');
							
							$image_id = get_sub_field('image_id');
							$image = wp_get_attachment_image_src($image_id, 'slide');
							$background_image_id = get_sub_field('background_image_id');
							$background_image = wp_get_attachment_image_src($background_image_id, 'full');    			
						?>
						<div class="scroll-item <?php if($i == 0) echo 'current'; ?>" data-id="<?php echo $i;?>" data-kc-color="<?php the_sub_field('kc_color')?>" data-digital-color="<?php the_sub_field('digital_color')?>" style="background-image: url(<?php echo $background_image[0]; ?>);">
							<div class="content container">
								<a href="<?php echo get_permalink($work_item->ID); ?>">
									<img class="scale <?php if($i == 0) echo 'first'; ?>" src="<?php echo $image[0]; ?>" alt="">
								</a>
								<a class="project-link" href="<?php echo get_permalink($work_item->ID); ?>">
									<?php echo get_the_title($work_item->ID); ?>
									<span>View Project</span>
								</a>
							</div>
						</div>
						<?php $i++; ?>
						<?php endwhile; ?>
					</div>
					<div class="scroller-navigation">
						<a class="prev-btn"></a>
						<a class="next-btn"></a>
					</div>
				</div>
			</div>
		</div><!-- #homepage-scroller -->
	<?php endif; ?>
	
	<div id="content">
		<div class="top-border"></div>
		<?php if(!$post->post_content == ''): ?>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>
		<?php if ( get_field('content')):?>
		<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
	</div>

</section><!-- #front-page -->

<?php get_footer(); ?>