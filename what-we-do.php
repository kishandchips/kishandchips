<?php
/**
 * Template Name: What We Do
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

get_header(); ?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<div id="what-we-do">
			<div id="content" <?php post_class(); ?>>
				<?php while ( have_posts() ) : the_post(); ?><?php if ( !$post->post_content == '' ): ?>
				<div class="page-content">
					<div class="container">
						<?php the_content(); ?>
					</div>
				</div><?php endif; ?><?php if ( get_field( 'content' ) ):?><?php get_template_part( 'inc/content' ); ?><?php endif; ?><?php endwhile; // end of the loop. ?>
			</div>
			<div id="capabilities">
				<div class="container">
					<?php
					$args = array( 'post_type' => 'page', 'posts_per_page' => -1, 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order' );
					$parent = new WP_Query( $args );

					if ( $parent->have_posts() ) : ?><?php while ( $parent->have_posts() ) : $parent->the_post(); ?><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
					<div id="child-<?php the_ID(); ?>" class="outer <?php echo ( ++$j % 2 == 0 ) ? 'even' : 'odd'; ?>">
						<div class="child-page clearfix" style="background-image: url(<?php echo $image[0]; ?>);">
							<div class="span five break-on-mobile">
								<h3>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p>
									<?php the_content(); ?>
								</p><a href="<?php the_permalink(); ?>" class="link more-btn acc-open">Read More</a> <a href="" class="link close-btn acc-close">Close</a>
							</div>
						</div>
						<div class="accordion hide">
							<?php // Custom Content Layout ?>
							<?php $id = ( isset( $id ) ) ? $id : $post->ID; ?>
							<?php $i = 0; ?>
							<?php if ( get_field( 'content', $id ) ): ?>
							<div class="inner">
								<?php while ( has_sub_field( 'content', $id ) ) : ?><?php
										$background_image_id = get_sub_field( 'background_image_id' );
									$background_image = wp_get_attachment_image_src( $background_image_id, 'full' );
								?>
								<?php if ( get_sub_field( 'row_title' ) ): ?>
									<div class="row-title">
										<?php the_sub_field( 'row_title' ); ?>
									</div>
								<?php endif;?>
								<?php
								$layout = get_row_layout();
								switch ( $layout ) {

								case 'row':
									if ( get_sub_field( 'column' ) ):
								?>
								<div class="row" style="background-color: <?php the_sub_field( 'background_color' ) ?>; background-image: url(<?php echo $background_image[0]; ?>); <?php the_sub_field( 'css' ); ?>">
									<div class="inner clearfix">
										<?php $total_columns = count( get_sub_field( 'column', $id ) ); ?><?php while ( has_sub_field( 'column', $id ) ) : ?><?php
												$col_background_image_id = get_sub_field( 'column_background_image_id' );
											$col_background_image = wp_get_attachment_image_src( $col_background_image_id, 'full' );
										?><?php
											switch ( $total_columns ) {
											case 2:
												$class = 'five';
												break;
											case 3:
												$class = 'one-third';
												break;
											case 4:
												$class = 'one-fourth';
												break;
											case 5:
												$class = 'one-fifth';
												break;
											case 1:
											default:
												$class = 'ten';
												break;
											} ?>
										<div class="break-on-mobile span <?php if ( get_sub_field( 'hide_on_mobile', $curr_page->ID ) == true ) { ?>hide-on-mobile<?php } ?> <?php echo $class; ?>" style="<?php the_sub_field( 'css' ); ?>; background-image: url(<?php echo $col_background_image[0]; ?>);">
											<?php the_sub_field( 'content' ); ?><?php if ( get_sub_field( 'list_item_with_icon' ) ): ?>
											<ul class="icon-list">
												<?php while ( has_sub_field( 'list_item_with_icon', $id ) ) : ?><?php
															$list_item_with_icon_image_id = get_sub_field( 'item_icon' );
														$list_item_with_icon_image = wp_get_attachment_image_src( $list_item_with_icon_image_id, 'full' );
												?>
												<li style="background-image: url(<?php echo $list_item_with_icon_image[0]; ?>);">
													<div class="item-title">
														<?php the_sub_field( 'item_title' ); ?>
													</div>
													<div class="item-content">
														<?php the_sub_field( 'item_content' ); ?>
													</div>
												</li><?php endwhile; ?>
											</ul><?php endif; ?>
										</div><?php endwhile; ?>
									</div>
								</div>
								<?php endif; ?>
								<?php break; ?>
								<?php case 'pages':  ?>
								<?php $pages = get_sub_field( 'pages' ); ?>
								<?php if ( !empty( $pages ) ): ?>
								<div class="pages">
									<header class="line-header">
										<h5 class="title">
											<?php the_sub_field( 'title' ); ?>
										</h5>
									</header>
									<ul class="page-list clearfix">
										<?php foreach ( $pages as $post ): ?><?php setup_postdata( $post ) ?>
											<li class="page span">
												<a href="<?php the_permalink(); ?>" class="overlay-btn"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'scale' ) ); ?></a>
												<h6 class="uppercase">
													<a href="<?php the_permalink(); ?>" class="uppercase"><?php the_title(); ?></a>
												</h6>
											</li>
										<?php endforeach; ?>
										<?php wp_reset_postdata(); ?>
									</ul>
								</div>
							<?php endif; ?>
							<?php break; ?>
							<?php } ?>
							<?php $i++; ?>
							<?php endwhile; ?>
							</div>
							<?php endif; ?>

							<?php // Content of Capabilities Repeater Field ?>
							<?php if ( get_field( 'capability_rows', $id ) ): ?><?php while ( has_sub_field( 'capability_rows', $id ) ) : ?>
							<div class="row clearfix">
								<?php
									$cap_image_id = get_sub_field( 'image' );
									$cap_image = wp_get_attachment_image_src( $cap_image_id, 'full' );
								?><?php if ( get_sub_field( 'image' ) !='' ) :?>
								<div class="image">
									<img src="<?php echo $cap_image[0]; ?>" alt="">
								</div><?php endif; ?>
								<div class="text">
									<h3 class="name">
										<?php the_sub_field( 'title' ); ?>
									</h3>
									<p>
										<?php the_sub_field( 'description' ); ?>
									</p>
								</div>
							</div><?php endwhile; ?><?php endif; ?>
							<div class="close-bottom">
								<a href="" class="link close-btn">Close</a>
							</div>
						</div>
					</div><?php endwhile; ?><?php endif; wp_reset_query(); ?>
				</div>
			</div><!-- #capabilities -->
		</div><!-- #page -->
		<?php get_footer(); ?>
	</body>
</html>