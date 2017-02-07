<?php get_header(); ?>
    <div id="content">
        <div class="search-wrap">
            <form class="s-search">
                <i class="iconFont">&#xe634;</i>
                <input class="text-input" type="search" name="s" placeholder="<?php _e('搜索...', 'akina') ?>">
            </form>
        </div>
        <div class="article-wrap">
            <div class="search-result">搜索结果: <?php the_search_query(); ?></div>
            <?php
            if (have_posts()):
                while (have_posts()) : the_post(); ?>
                    <article class="post post-list">
                        <div class="feature">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php if (catch_first_image() !== ""): ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo catch_first_image() ?>" alt="<?php the_title(); ?>"
                                             class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                             width="150" height="150">
                                    </a>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-header">
                            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <div class="p-time"><i class="iconFont">&#xe63a;</i><?php the_time('Y-m-d'); ?></div>
                            <?php the_excerpt(); ?>
                        </div>
                        <footer class="entry-footer">
                            <div class="info-meta">
                                <div class="comment">
                                    <i class="iconFont">
                                        &#xe677;</i><span> <?php comments_popup_link('没有评论', '1 条评论', '% 条评论'); ?></span>
                                </div>
                                <div class="views">
                                    <i class="iconFont">&#xe663;</i><span> <?php get_post_views($post->ID); ?> 热度</span>
                                </div>
                            </div>
                            <div class="more-link">
                                <a href="<?php the_permalink(); ?>"><i class="iconFont">&#xe635;</i></a>
                            </div>
                        </footer><!-- .entry-footer -->
                    </article>
                    <?php
                endwhile;
            else:
                ?>
                <p class="sorry">抱歉, 没有找到你想要的文章. 看看其他文章吧.</p>
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
                <?php
            endif;
            ?>


        </div>
    </div>

<?php get_footer(); ?>