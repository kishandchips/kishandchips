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
$(function() {
 	$('.fourth-row .gform_page_fields').append('<li class="gfield"><label class="gfield_label">When do you need to carry out this project?</label><div id="dateSlider"></div></div><li>');
 	$('.fourth-row .gform_page_fields').append('<li class="gfield"><label class="gfield_label">What budget is available for this project?</label><div id="slider"></div></li>');

 	$('.gform_page_footer').append('<div class="button-sub">We&apos;ll be in touch very soon!</div>');
 	
	$("#slider").rangeSlider({
		bounds:{min: 2, max: 15},
		defaultValues:{min: 3, max: 8},
		step: 0.1,
		 formatter:function(val){
        	var value = Math.round(val * 5) / 5,
          	decimal = value - Math.round(val);
        	return decimal == 0 ? '£' + value.toString() + ".0" + 'K' :  '£' + value.toString() + 'K';

		}
	});

	$("#dateSlider").dateRangeSlider({
		bounds:{
			min: new Date(2013, 7, 1),
			max: new Date(2013, 12, 31)
		},
		 defaultValues:{
			min: new Date(2013, 7, 11),
			max: new Date(2013, 9, 10)
		},
		formatter:function(val){
			var days = val.getDate(),
			  	month = val.getMonth() + 1,
			  	year = val.getFullYear();
			return days + "/" + month + "/" + year;
		}		
	});

    $("#dateSlider").bind("valuesChanged", function(e, data){
		$('#input_1_15').val(data.values.min);
		$('#input_1_16').val(data.values.max);    
    });

    $("#slider").bind("valuesChanged", function(e, data){
		$('#input_1_17').val('£' + data.values.min + 'K');
		$('#input_1_18').val('£' + data.values.max + 'K');

		if (data.values.max == 15) {
			$('#slider .ui-rangeSlider-rightLabel .ui-rangeSlider-label-value').append('<span> +</span>');
			$('#input_1_18').val('£' + data.values.max + 'K +');
		} else {
			$('#slider .ui-rangeSlider-rightLabel .ui-rangeSlider-label-value span').remove();
		}
    });   

    $('#gform_target_page_number_1').attr('value','0');
    $('#gform_source_page_number_1').attr('value','0');
});
</script>	
	
</div><!-- #page -->
<?php get_footer(); ?>