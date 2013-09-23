<?php
/**
 * Template Name: Want a job?
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
get_header(); ?>
 
<div id="form-want-a-job">
	<div id="content">
		<?php if ( get_field('content')):?>
			<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
	</div>
	<?php gravity_form(2, false, false); ?>	
</div><!-- #page -->
 <script>
$(function() {

 	$('.gform_page_footer').append('<div class="button-sub">We&apos;ll be in touch very soon!</div>');

    $('#gform_target_page_number_2').attr('value','0');
    $('#gform_source_page_number_2').attr('value','0');

    $('.file-upload .ginput_container').append('<a class="upload-btn">Choose File</div>');
    $('.file-upload .ginput_container .upload-btn').on('click', function() {
    	$('.file-upload .ginput_container input').click();
    });
});
</script>	

<?php get_footer(); ?>