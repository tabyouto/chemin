<?php
define('AC_VERSION','1.0.0');

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	wp_die('请升级到4.4以上版本');
}
if(!function_exists('fa_ajax_comment_scripts')) :

    function fa_ajax_comment_scripts(){
        if(is_single()) {
            wp_enqueue_style( 'ajax-comment', get_template_directory_uri() . '/ajax-comment/app.css', array(), AC_VERSION );
            wp_enqueue_script( 'ajax-comment', get_template_directory_uri() . '/ajax-comment/app.js', array( 'jq' ), AC_VERSION , true );
            wp_localize_script( 'ajax-comment', 'ajaxcomment', array(
                'ajax_url'   => admin_url('admin-ajax.php'),
                'order' => get_option('comment_order'),
                'formpostion' => 'bottom', //默认为bottom，如果你的表单在顶部则设置为top。
            ) );
        }
    }

endif;

if(!function_exists('fa_ajax_comment_err')) :

    function fa_ajax_comment_err($a) {
        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $a;
        exit;
    }

endif;

if(!function_exists('fa_ajax_comment_callback')) :

    function fa_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if ( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( ! empty( $data ) ) {
            	fa_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, $size = '35'); ?>
                    <cite class="fn">
                        <?php printf(__('%s'), get_comment_author_link()); ?> <span class="say"></span>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em><?php _e('等待审核！'); ?></em>
                        <?php endif; ?>
                    </cite>
                    <time class="comment-time"><?php printf(__('%1$s at %2$s'), get_comment_date('Y-m-d'), ''); ?></time>
                </div>
                <div class="comment-meta comment-meta-data">
                    <?php edit_comment_link(__('(编辑)'), '', ''); ?>
                </div>
                <!-- <div class="comment-content"> -->
                <?php comment_text(); ?>
                <!-- </div> -->
                <div class="reply">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
            </div>
        </li>
        <?php die();
    }

endif;

add_action( 'wp_enqueue_scripts', 'fa_ajax_comment_scripts' );
add_action('wp_ajax_nopriv_ajax_comment', 'fa_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'fa_ajax_comment_callback');