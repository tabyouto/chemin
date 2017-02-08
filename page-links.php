<?php

/**
 * Template Name: links
 */

get_header();

?>
    <div id="content">
        <?php while (have_posts()) : the_post(); ?>

            <span class="linkss-title">友链</span>

            <article <?php post_class("post-item"); ?>>

                <?php the_content(); ?>

                <div class="links">
                    <?php echo get_link_items(); ?>

                </div>


            </article>
        <?php endwhile; ?>
    </div>
<?php

get_footer();