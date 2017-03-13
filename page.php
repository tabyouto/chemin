<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 */

get_header(); ?>
    <div id="content">
        <div id="primary" class="content-area">
            <article>
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <footer class="post-footer">
                        <div class="tag-wrap">
                            <?php if (get_the_tags()) {
                                echo '<i class="icon iconFont">&#xe60d;</i>';
                                the_tags('', ' ', ' ');
                            } ?>
                        </div>
                        <?php get_template_part( 'template-parts/content', 'post-like' ); ?>
                    </footer>
                <?php endwhile; endif; ?>
            </article>
            <div class="comment-wrap">
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
<?php
get_footer();