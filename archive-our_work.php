<?php
/**
 * The template for displaying Our Work archives.
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

get_header(); ?>

<div id="archive-our-work">
looofasz árkhájv
	<?php while ( have_posts() ) : the_post(); ?>
	<div id="content" <?php post_class(); ?>>
		<?php if(!$post->post_content == ''): ?>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>
		<?php if ( get_field('content')):?>
		<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
	</div>
	<?php endwhile; // end of the loop. ?>

</div><!-- #page -->
<?php get_footer(); ?>