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
		<div id="homepage-scroller" class="scroller" data-auto-scroll="true" >
			<div class="outer">
				<div class="inner">
					<div class="scroller-mask">
						<?php $i = 0; ?>
						<?php while (the_repeater_field('slides')) : ?>
						<?php 
							$image_id = get_sub_field('image_id');
							$image = wp_get_attachment_image_src($image_id, 'slide');
							$background_image_id = get_sub_field('background_image_id');
							$background_image = wp_get_attachment_image_src($background_image_id, 'full');    			
						?>
						<div class="scroll-item <?php if($i == 0) echo 'current'; ?>" data-id="<?php echo $i;?>" style="background-image: url(<?php echo $background_image[0]; ?>);">
							<div class="content container">
								<img class="scale" src="<?php echo $image[0]; ?>" alt="">
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
		<?php if(!$post->post_content == ''): ?>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>
		<?php if ( get_field('content')):?>
		<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
		
		<div class="bottom">
			<div class="row">
				<div class="container">
					<div class="column span five break-on-mobile">
					quotes
					</div>
					<div class="column span five break-on-mobile">
					twitter
					</div>				
				</div>
			</div>
		</div>	
	</div>

</section><!-- #front-page -->

<?php get_footer(); ?>