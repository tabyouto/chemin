<?php get_header(); ?>
    <div class="center-bg">
            <div class="center-info">
                <div class="avatar-wrap">
                    <div style="background-image: url('<?php echo chemin_option('focus_logo', ''); ?>')"></div>
                </div>
                <div class="center-msg">
                    <?php echo chemin_option('admin_des'); ?>
                </div>
            </div>
            <div class="slant-left"></div>
            <div class="slant-right"></div>
        </div>
        <div id="content">
            <div class="notice">
                <i class="iconFont">&#xe600;</i>: <span class="notice-content"><?php echo chemin_option('notice_title');?></span>
            </div>
            <div class="article-wrap" id="article-wrap">
                <h2 class="main-title">近况：</h2>
                <?php
                if (have_posts()):
                    while (have_posts()) : the_post(); ?>
                        <article class="post post-list">
                            <div class="feature">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php if(catch_first_image()!==""): ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <img src="<?php echo catch_first_image() ?>" alt="<?php the_title(); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image"  width="150" height="150">
                                        </a>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="post-header">
                                <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <div class="p-time"><i class="iconFont">&#xe63a;</i><?php the_time('Y-m-d' ); ?></div>
                                <?php the_excerpt();?>
                            </div>
                            <footer class="entry-footer">
                                <div class="info-meta">
                                    <div class="comment">
                                        <i class="iconFont">&#xe677;</i><span> <?php comments_popup_link('没有评论', '1 条评论', '% 条评论'); ?></span>
                                    </div>
                                    <div class="views">
                                        <i class="iconFont">&#xe663;</i><span> <?php get_post_views($post -> ID); ?>  热度</span>
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
                    echo "<p>没有文章</p>";
                endif;
                ?>

            </div>
            <div id="page"><?php par_pagenavi(6); ?></div>
        </div>
        <?php get_footer(); ?>