<?php
/**
 * Template Name: Project Planner
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
	<?php gravity_form(1, false, false); ?>
	
	
	
 <script>
 	$('.fourth-row .gform_page_fields').append('<div id="dateSlider"></div>');
 	$('.fourth-row .gform_page_fields').append('<div id="slider"></div>');
 	
	$("#slider").rangeSlider();
	$("#dateSlider").dateRangeSlider({
		bounds:{
		min: new Date(2013, 7, 1),
		max: new Date(2013, 12, 31)
	}});
</script>	
	
</div><!-- #page -->
<?php get_footer(); ?>