<?php

/**
 * Template Name: 友情链接
 */

get_header();

?>
    <div id="content">
        <div id="primary" class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <!--            <span class="linkss-title">友链</span>-->
                <article <?php post_class("post-item"); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="links">
                        <?php echo get_link_items(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
            <div class="comment-wrap">
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
<?php

get_footer();