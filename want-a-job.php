<?php
/**
 * Template Name: Want a job?
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
get_header(); ?>
 
<div id="project-planner">
	<div id="content">
		<?php if ( get_field('content')):?>
			<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
	</div>
	<?php gravity_form(2, false, false); ?>	
</div><!-- #page -->
<?php get_footer(); ?>