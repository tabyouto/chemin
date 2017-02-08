<?php
/**
 * Created by IntelliJ IDEA.
 * User: hjoker
 * Date: 2017/2/5
 * Time: 12:41
 */






function mbtheme_init_smilies(){
    global $wpsmiliestrans;
    $wpsmiliestrans = array(
        ':mrgreen:' => 'icon_mrgreen.gif',
        ':neutral:' => 'icon_neutral.gif',
        ':twisted:' => 'icon_twisted.gif',
        ':arrow:' => 'icon_arrow.gif',
        ':shock:' => 'icon_eek.gif',
        ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
        ':cool:' => 'icon_cool.gif',
        ':evil:' => 'icon_evil.gif',
        ':grin:' => 'icon_biggrin.gif',
        ':idea:' => 'icon_idea.gif',
        ':oops:' => 'icon_redface.gif',
        ':razz:' => 'icon_razz.gif',
        ':roll:' => 'icon_rolleyes.gif',
        ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':eek:' => 'icon_surprised.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':sad:' => 'icon_sad.gif',
        '8-)' => 'icon_cool.gif',
        '8-O' => 'icon_eek.gif',
        ':-(' => 'icon_sad.gif',
        ':-)' => 'icon_smile.gif',
        ':-?' => 'icon_confused.gif',
        ':-D' => 'icon_biggrin.gif',
        ':-P' => 'icon_razz.gif',
        ':-o' => 'icon_surprised.gif',
        ':-x' => 'icon_mad.gif',
        ':-|' => 'icon_neutral.gif',
        ';-)' => 'icon_wink.gif',
        '8O' => 'icon_eek.gif',
        ':(' => 'icon_sad.gif',
        ':)' => 'icon_smile.gif',
        ':?' => 'icon_confused.gif',
        ':D' => 'icon_biggrin.gif',
        ':P' => 'icon_razz.gif',
        ':o' => 'icon_surprised.gif',
        ':x' => 'icon_mad.gif',
        ':|' => 'icon_neutral.gif',
        ';)' => 'icon_wink.gif',
        ':!:' => 'icon_exclaim.gif',
        ':?:' => 'icon_question.gif',
    );

    remove_action( 'wp_head' , 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts' , 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles' , 'print_emoji_styles' );
    remove_action( 'admin_print_styles' , 'print_emoji_styles' );
    remove_filter( 'the_content_feed' , 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss' , 'wp_staticize_emoji' );
    remove_filter( 'wp_mail' , 'wp_staticize_emoji_for_email' );

}

add_action( 'init', 'mbtheme_init_smilies', 5 );





/**
 * 添加图片表情
 */
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}

add_filter('comment_form_before_fields','add_smile');
/**
 * 插入表情
 */
function add_smile() {
    include(TEMPLATEPATH . '/smiley.php');
}
