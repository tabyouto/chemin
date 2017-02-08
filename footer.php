<?php
/**
 * Created by IntelliJ IDEA.
 * User: hjoker
 * Date: 2017/2/1
 * Time: 20:44
 */
?>
<div id="footer">
            <div class="container">
                <p>
                <?php esc_attr_e('Copyright ©', 'chemin'); ?> 
                <?php esc_attr_e(date('Y')); ?> by myself 
                <?php esc_attr_e('. All rights reserved.', 'chemin'); ?>
                <?php if(chemin_option('chemin_footer_html_sitemaps')) echo '|' . '<a target="_blank" href="' . chemin_option('chemin_footer_html_sitemaps'). '">站点地图</a>'; ?>
                <?php if(chemin_option('chemin_footer_xml_sitemaps')) echo '|' . '<a target="_blank" href="' . chemin_option('chemin_footer_xml_sitemaps'). '">XML</a>'; ?>
                </p>
                <p>my dream</p>
            </div>
        </div>
    </div>
<?php get_template_part( 'template-parts/content', 'search-form' ); ?>
<?php wp_footer(); ?>
</body>
</html>
