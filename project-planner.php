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

 	$('.fourth-row .gform_page_fields').append('<li class="gfield"><label class="gfield_label">When do you need to carry out this project?</label><div id="dateSlider"></div></div><li>');
 	$('.fourth-row .gform_page_fields').append('<li class="gfield"><label class="gfield_label">What budget is available for this project?</label><div id="slider"></div></li>');
 	
	$("#slider").rangeSlider({
		bounds:{min: 2, max: 15},
		defaultValues:{min: 3, max: 8},
		step: 0.1
	});
	$("#dateSlider").dateRangeSlider({
		bounds:{
			min: new Date(2013, 7, 1),
			max: new Date(2013, 12, 31)
		},
		 defaultValues:{
			min: new Date(2013, 7, 11),
			max: new Date(2013, 9, 10)
		}
	});

    $("#dateSlider").bind("valuesChanged", function(e, data){
		$('#input_1_15').val(data.values.min);
		$('#input_1_16').val(data.values.max);    
    });

    $("#slider").bind("valuesChanged", function(e, data){
		$('#input_1_12').val(data.values.min);
		$('#input_1_14').val(data.values.max);
    });    

</script>	
	
</div><!-- #page -->
<?php get_footer(); ?>