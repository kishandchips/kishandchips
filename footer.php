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
				<div class="span three break-on-mobile"><span class="label">Say Hello</span><a href="mailto:hello@kishandchips.com" class="link mail">hello@kishandchips.com</a></div>
				<div class="span three break-on-mobile"><span class="label">Have a project?</span><a href="<?php bloginfo('url')?>/project-planner" class="link">Project Planner</a></div>
				<div class="span three break-on-mobile"><span class="label">Want a job?</span><a href="" class="link">Send us your CV</a></div>
				<div class="span one socials break-on-mobile">
					<a href="" data-icon='"' title="Visit us on Twitter"></a>
					<a href="" data-icon='!' title="Visit us on Facebook"></a>
				</div>
			</div>
		</div>
		<div class="bottom">
			<div class="container inner">
				<span>&copy; 2013</span> KISH &amp; CHIPS
			</div>
		</div>
	</footer><!-- #footer .site-footer -->
</div><!-- #wrap -->

<?php wp_footer(); ?>
</body>
</html>