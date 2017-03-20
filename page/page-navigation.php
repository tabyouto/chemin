<?php

/**
 * Template Name: 网址导航
 */

get_header();

?>
    <div id="content">
        <div id="primary" class="content-area page-navigation">
            <?php while (have_posts()) : the_post(); ?>
                <header class="entry-header">
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                </header>
                <!--            <span class="linkss-title">友链</span>-->
                <article <?php post_class("post-item"); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
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