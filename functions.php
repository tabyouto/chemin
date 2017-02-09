<?php

define('CHEMIN_VERSION', '1.0.0');

/**
 * 引入主题后台框架
 */
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
    require_once dirname(__FILE__) . '/inc/options-framework.php';
}

/**
 * load .php.
 */
require_once('inc/fn.php');

require get_template_directory() . '/ajax-comment/main.php';

require_once('plugin/disableGoogleFonts.php');
require_once('plugin/disableEmbed.php');
require_once('plugin/disableCategory.php');
require_once('plugin/smile.php');


/**
 * 支持外链缩略图
 */
if (function_exists('add_theme_support'))
    add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 150, true);
function catch_first_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (empty($matches[1][0])) {
        $first_img = '';
    } else {
        $first_img = $matches[1][0];
    }
    if (empty($first_img)) {
        // $random = mt_rand(1, 6);
        // echo get_bloginfo ( 'stylesheet_directory' ).'/images/random/'.$random.'.jpg';
        return get_bloginfo('stylesheet_directory') . '/images/random/1.jpg';
    }
    return $first_img;
}

// Gravatar头像使用中国服务器
function gravatar_cn($url)
{
    $gravatar_url = array('http://0.gravatar.com', 'http://1.gravatar.com', 'http://2.gravatar.com', 'http://cn.gravatar.com');
    return str_replace($gravatar_url, 'https://secure.gravatar.com', $url);
}

add_filter('get_avatar_url', 'gravatar_cn', 4);

// 阻止站内文章互相Pingback 
function theme_noself_ping(&$links)
{
    $home = get_option('home');
    foreach ($links as $l => $link)
        if (0 === strpos($link, $home))
            unset($links[$l]);
}

add_action('pre_ping', 'theme_noself_ping');

/**
 * 增加editor 样式
 */
add_editor_style();

/**
 * 取消分类描述 html过滤
 */
remove_filter('pre_term_description', 'wp_filter_kses');


/**
 * Enqueue scripts and styles.
 */
function chemin_scripts()
{
    wp_enqueue_style('chemin-style', get_stylesheet_uri());


    wp_enqueue_script('jq', get_template_directory_uri() . '/js/jquery.min.js', array(), CHEMIN_VERSION, true);

    wp_enqueue_script('global', get_template_directory_uri() . '/js/global.js', array('jq'), CHEMIN_VERSION, true);

    if (is_single()) {
        wp_enqueue_script('prettyCode', get_template_directory_uri() . '/js/prettyCode.js', array('jq'), CHEMIN_VERSION, true);

        wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array(), CHEMIN_VERSION, true);
    }


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'chemin_scripts');


//禁止加载WP自带的jquery
function modify_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

add_action('init', 'modify_jquery');


function chemin_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on chemin, use a find and replace
     * to change 'chemin' to the name of your theme in all the template files.
     */
    load_theme_textdomain('chemin', get_template_directory() . '/languages');


    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150, true);

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => esc_html__('Primary', 'chemin'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'status',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('chemin_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));

    add_filter('pre_option_link_manager_enabled', '__return_true');

    // 优化代码
    //去除头部冗余代码
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_generator'); //隐藏wordpress版本
    remove_filter('the_content', 'wptexturize'); //取消标点符号转义


    // Disable REST API
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
//    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    // Filters for WP-API version 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');
    // Filters for WP-API version 2.x
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');


    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // Remove the Link header for the WP REST API
    // [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);

    function coolwp_remove_open_sans_from_wp_core()
    {
        wp_deregister_style('open-sans');
        wp_register_style('open-sans', false);
        wp_enqueue_style('open-sans', '');
    }

    add_action('init', 'coolwp_remove_open_sans_from_wp_core');

    /**
     * Disable the emoji's
     */
    function disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    }

    add_action('init', 'disable_emojis');

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param    array $plugins
     * @return   array             Difference betwen the two arrays
     */
    function disable_emojis_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }

    // 移除菜单冗余代码
    add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
    add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
    add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
    function my_css_attributes_filter($var)
    {
        return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent')) : '';
    }

}

add_action('after_setup_theme', 'chemin_setup');


/**
 * 改造img标签 懒加载
 */
add_filter('the_content', 'lazyload');
function lazyload($content)
{
    $url = get_theme_root_uri();
    if (!is_feed() || !is_robots) {
        $content = preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i', "<img\$1data-original=\"\$2\" src=\"$url/chemin/images/loading.jpg\"\$3>\n<noscript>\$0</noscript>", $content);
    }
    return $content;
}


/**
 * post views.
 */
function get_post_views($post_id)
{

    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }

    echo number_format_i18n($count);

}

function set_post_views()
{

    global $post;

    if (isset($post->ID)) {
        $post_id = $post->ID;
    } else {
        $post_id = '';
    }
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);

    if (is_single() || is_page()) {

        if ($count == '') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }

    }

}

add_action('get_header', 'set_post_views');


/**read more**/
function excerpt_more($excerpt)
{
    return '';
}

add_filter('excerpt_more', 'excerpt_more');


/*excerpt length*/
function excerpt_length($length)
{
    return 80;
}

add_filter("excerpt_length", "excerpt_length");


/**
 * 修改评论结构
 */
function custome_comments($comment, $args, $depth)
{
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
    <?php
}


/**
 * 添加编辑按钮
 */
if (!function_exists('chemin_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function chemin_posted_on()
    {
        edit_post_link(
            esc_html__('- [Edit]', 'hacker'),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;


// 评论添加@
function comment_add_at($comment_text, $comment = '')
{
    if ($comment->comment_parent > 0) {
        $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">' . get_comment_author($comment->comment_parent) . '</a> ' . $comment_text;
    }

    return $comment_text;
}

add_filter('comment_text', 'comment_add_at', 20, 2);
//=========================================================================


function comment_mail_notify($comment_id)
{
    $comment = get_comment($comment_id);//根据id获取这条评论相关数据
    $content = $comment->comment_content;
    //对评论内容进行匹配
    $match_count = preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si', $content, $matchs);
    if ($match_count > 0) {//如果匹配到了
        foreach ($matchs[1] as $parent_id) {//对每个子匹配都进行邮件发送操作
            SimPaled_send_email($parent_id, $comment);
        }
    } elseif ($comment->comment_parent != '0') {//以防万一，有人故意删了@回复，还可以通过查找父级评论id来确定邮件发送对象
        $parent_id = $comment->comment_parent;
        SimPaled_send_email($parent_id, $comment);
    } else return;
}

add_action('comment_post', 'comment_mail_notify');
function SimPaled_send_email($parent_id, $comment)
{//发送邮件的函数 by Qiqiboy.com
    $admin_email = get_bloginfo('admin_email');//管理员邮箱
    $parent_comment = get_comment($parent_id);//获取被回复人（或叫父级评论）相关信息
    $author_email = $comment->comment_author_email;//评论人邮箱
    $to = trim($parent_comment->comment_author_email);//被回复人邮箱
    $spam_confirmed = $comment->comment_approved;
    if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了新的回复';
        $message = '<div style="background-color:#eef2fa;border:1px solid #333;color:#111;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;font-family:MicroSoft YaHei;font-size:14px;">
				<p style="background-color: #333333;color: #fff;padding: 10px 0 10px 20px;margin: 0;border-radius: 5px 5px 0 0;"><span style="color: #71B033;font-size: 16px;font-weight: 300;">' . get_option("blogname") . '</span> 上有新的回复</p>
				<div style="padding: 10px 20px;">
	    		<p><span>' . trim(get_comment($parent_id)->comment_author) . '</span>,你好!</p>
	            <p>您曾在 <a href="">《' . get_the_title($comment->comment_post_ID) . '》</a>的留言:woshuonishisheileme 有新的回复:</p>
	            <p>' . trim($comment->comment_author) . '给你的回复:<br /></p>
	            <p style="background-color: #ddd;padding: 12px;color: #464646;">' . trim($comment->comment_content) . '<br /></p>
	            <p>您可以点击 <a style="color:#709A17" href="' . htmlspecialchars(get_comment_link($parent_id, array("type" => "all"))) . '">查看回复的完整內容</a></p>
	            <p>(此邮件有系统自动发出, 请勿回复.)</p>
	            <p>欢迎再度爆踩 <a style="color:#709A17" href="' . get_option('home') . '">' . get_option('blogname') . ' </a></p>
	    	</div>
		</div>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}

//======================================================================================


add_filter('pre_site_transient_update_core', create_function('$a', "return null;")); // 关闭核心提示
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;")); // 关闭插件提示
add_filter('pre_site_transient_update_themes', create_function('$a', "return null;")); // 关闭主题提示
remove_action('admin_init', '_maybe_update_core');    // 禁止 WordPress 检查更新
remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件
remove_action('admin_init', '_maybe_update_themes');  // 禁止 WordPress 更新主题


function par_pagenavi($range = 3)
{
    global $paged, $wp_query;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>首页</a>";}
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a>";
            }
        }
        next_posts_link(' »');
    }
}


function get_the_link_items($id = null)
{
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output = '';
    if (!empty($bookmarks)) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) {
            $output .= '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" rel="external nofollow"><span class="sitename">' . $bookmark->link_name . '</span><div class="linkdes">' . $bookmark->link_description . '</div></a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}

function get_link_items()
{
    $linkcats = get_terms('link_category');
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .= '<h3 class="link-title">' . $linkcat->name . '</h3>';
            if ($linkcat->description) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
            $result .= get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}

?>