<?php
/**
 * The template for displaying Our Work archives.
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
query_posts(array_merge($wp_query->query_vars, array(
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'meta_key' => 'is_case_study',
	'meta_query' => array(
	   array(
	       'key' => 'is_case_study',
	       'value' => 1,
	       'compare' => '!=',
	   )
	)	
	)));
get_header(); ?>
<div id="archive-work">
	<div class="container">
		<h2><?php _e('Project Archives')?></h2>
		<div class="categories clearfix">
			<?php
                $args = array(
                    'orderby'   => 'name',
                    'order'     => 'ASC',
                    'taxonomy'  => 'item_category',
                    'hide_empty'    => 1
                );
                $terms = get_terms( 'item_category', $args );
                $current_cat_id = get_queried_object()->term_id;
			?>
			<ul>
				<li>
					<a <?php if($current_cat_id == ''): ?>class='current'<?php endif; ?> href="<?php echo get_permalink(1849); ?>"><?php _e('All Projects')?></a>
				</li>
				<?php foreach ($terms as $term) : ?>
					<li>
						<a <?php if($current_cat_id == $term->term_id): ?>class='current'<?php endif; ?> href="<?php echo get_term_link($term);?>"><?php echo $term->name; ?></a>
					</li>
				 <?php endforeach; ?>
			</ul>
			<a class="link back-btn right floatbtn" href="<?php echo get_permalink(11); ?>" title="<?php _e('Back to Projects')?>">
				<?php _e('Back to Projects')?>
			</a>
		</div>
		<?php $i = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$logo_id = get_field('item_logo');
				$logo = wp_get_attachment_image_src($logo_id, 'full');
			?>
				<a class="item overlay-btn span third" href="<?php the_permalink(); ?>">
					<div class="work row clearfix">
						<div class="info">
							<div class="logo">
								<?php if(get_field('item_logo') !=''): ?>
									<img src="<?php echo $logo[0]; ?>" alt="">
								<?php else :?>
									<h4 class="title"><?php the_title(); ?></h4> 
								<?php endif;?>															
							</div>
							<div class="title"><?php the_field('item_sub_title')?></div>
						</div>
						<div class="image">
							<?php the_post_thumbnail('full', array('class' => 'scale')); ?>
						</div>
					</div>
				</a>
			<?php $i++; ?>
		<?php endwhile; ?>
	</div>
</div><!-- #page -->
<?php get_footer(); ?>