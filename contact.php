<?php
/**
 * Template Name: Contact Us
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
get_header(); ?>
 
<div id="contact">
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="span four equal-height break-on-mobile sidebar">
		<div class="lead clearfix">
			<div class="inner">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="information clearfix">
			<div class="inner">
				<span class="icon home">
					<?php the_field('address'); ?>
				</span>
				<span class="icon speech">
					<?php the_field('phone_number'); ?>
				</span>
				
				<a href="mailto:<?php the_field('email_address'); ?>" class="link mail"><?php the_field('email_address'); ?></a><br>
				<a href="https://twitter.com/kishandchips" target="_blank" class="link twitter">kishandchips</a>
			</div>
			<div class="bottom clearfix">Company Registration No. 7600173</div>
		</div>
	</div>
	<div class="span equal-height break-on-mobile six map">
		<div class="inner clearfix">
			<div class="flex-container">
<iframe width="600" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=Speedy+Pl,+London,+Greater+London+WC1H,+United+Kingdom&amp;sll=51.528642,-0.101599&amp;sspn=0.457938,1.234589&amp;ie=UTF8&amp;geocode=FcI_EgMdfRr-_w&amp;split=0&amp;hq=&amp;hnear=Speedy+Pl,+London+WC1H,+United+Kingdom&amp;t=m&amp;ll=51.52781,-0.124454&amp;spn=0.032039,0.051413&amp;z=15&amp;iwloc&amp;output=embed"></iframe>
			</div>
		</div>
	</div>
	<?php endwhile; ?>	
</div><!-- #page -->
<?php get_footer(); ?>