<?php
/**
 *
 * Template Name: 友情链接
 * 
 */

get_header(); ?>

sdfsdfsdf
	<div id="content">
		<div id="primary" class="content-area">
			<article>
				<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>
					<header class="entry-header">
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header>
					<div class="entry-content">
							<ul>
								<?php  wp_list_bookmarks(); ?>
							</ul>
					</div>
					<footer class="post-footer">
						<div class="tag-wrap">
							<?php if ( get_the_tags() ) {
								echo '<i class="icon iconFont">&#xe60d;</i>';
								the_tags('', ' ', ' ');
							}?>
						</div>
						<div class="post-like">
							<a href="">
								<i class="icon iconFont no-like">&#xe664;</i>12
							</a>
						</div>
					</footer>
				<?php endwhile; endif; ?>
			</article>
			<?php get_template_part( 'template-parts/content', 'relate' ); ?>
			<div class="comment-wrap">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>


<?php
get_footer();







