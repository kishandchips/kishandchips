<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
?>
	</div><!-- #main .site-main -->
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="top">
			<div class="container inner">
				<?php dynamic_sidebar('footer'); ?>
			</div>
		</div>
		<div class="bottom">
			<div class="container inner">
		
			</div>
		</div>
	</footer><!-- #footer .site-footer -->
</div><!-- #wrap -->

<?php wp_footer(); ?>
</body>
</html>