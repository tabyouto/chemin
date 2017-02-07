<?php get_header(); ?>
<div id="content">
	<section class="primary">
		<div class="error-msg">what? 换个地方找找？</div>
		<div class="search-no-results">
			<ul>
				<?php
				$result = $wpdb->get_results("SELECT ID,post_title FROM $wpdb->posts where post_status='publish' and post_type='post' ORDER BY ID DESC LIMIT 0 , 20");
				foreach ($result as $post) {
					setup_postdata($post);
					$postid = $post->ID;
					$title = $post->post_title;
					?>
					<li><a href="<?php echo get_permalink($postid); ?>"
						   title="<?php echo $title ?>"><?php echo $title ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</section>
</div>
<?php
get_footer();