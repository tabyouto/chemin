<?php
/**
 * Template part for displaying like.
 *
 */
?>
<div class="post-like">
    <span class="post-like">
                <a href="javascript:;" class="js-rating <?php if(isset($_COOKIE['specs_zan_'.$post->ID])) echo 'is-active';?>" data-action="ding" data-id="<?php the_ID(); ?>">
                    <i class="icon-heart"></i>
                    <span class="js-count">
                        <?php if( get_post_meta($post->ID,'specs_zan',true) ){
                            echo get_post_meta($post->ID,'specs_zan',true);
                        } else {
                            echo '0';
                        }?>
                    </span>
                </a>
            </span>
</div>