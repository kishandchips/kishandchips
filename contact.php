<?php
/**
 * Template Name: Contact Us
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
get_header(); ?>
 
<div id="contact">
	<div class="">
		<div class="span four equal-height break-on-mobile sidebar">
			<div class="lead clearfix">
				<div class="inner">
					<?php the_content()	; ?>
				</div>
			</div>
			<div class="information clearfix">
				<div class="inner">
					<span class="icon home">
						Kish and Chips Ltd<br>Hamilton Road<br>London<br>XXX XXX
					</span>
					<span class="icon speech">
						07766 335 681
					</span>
					
					<a href="#" class="link mail">hello@kishandchips.com</a><br>
					<a href="#" class="link twitter">kishandchips</a>
				</div>
				<div class="bottom clearfix">Company Registration No. 7600173</div>
			</div>
		</div>
		<div class="span equal-height break-on-mobile six map">
			<div class="inner clearfix">
				<div class="flex-container">
					Map
				</div>
			</div>
		</div>	
	</div>
</div><!-- #page -->
<?php get_footer(); ?>