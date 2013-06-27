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
	<?php // if ( get_field('slides')) :?>
		<div id="homepage-scroller" class="scroller container" data-auto-scroll="true" >
			<div class="outer">
				<div class="inner">

				</div>
			</div>
		</div><!-- #homepage-scroller -->
	<?php //endif; ?>

</section><!-- #front-page -->

<?php get_footer(); ?>