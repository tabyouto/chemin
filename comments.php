<?php if( have_comments() ) : ?>
	<h4 id="comments"><?php comments_number('No Comments','1 条回应','% 条回应：' ); echo "“".get_the_title()."”"; ?></h4>
	<ol>
		<?php wp_list_comments('callback=custome_comments'); ?>
	</ol>
<?php endif; ?>
<?php 
	$comments_args = array(
		'label_submit' => 'Post Comment',
		'title_reply'  => '发表评论',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'fields' => apply_filters( 'comment_form_default_fields', 
			array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '昵称' ) . '</label> ' . ( $req ? '<span class="require-single">* </span>' : '' ) .'<input id="author" class="am-" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . ($req ? "aria-required='true'" : '' ) . ' required="required" /></p>',

				'email'  => '<p class="comment-form-email">' .'<label for="email">' . __( '邮箱' ) . '</label> ' .( $req ? '<span class="require-single">* </span>' : '' ) .'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ($req ? "aria-required='true'" : '' ) . ' required="required" />'.'</p>',

				'url'    => '<p class="comment-form-url"><label for="url">站点</label><input type="text" size="30" value="'.$comment_author_url.'" name="url" id="url"></p>' ) ),

				'comment_field' => '<p>' .'<label for="comment">' . __( '' ) . '</label>' .'<textarea id="comment" name="comment" cols="40" rows="8" aria-required="true"></textarea>' .'</p>',
				'label_submit' => __( '提交评论' )

	);
	comment_form($comments_args);

?>
