<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
      var myField;
      tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
      } else {
        return false;
      }
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
                + tag
                + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
      }      else {
        myField.value += tag;
        myField.focus();
      }
    }
/* ]]> */
</script>
<a href="javascript:grin(':?:')"       class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_question.gif"  alt="" /></a>
<a href="javascript:grin(':razz:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_razz.gif"      alt="" /></a>
<a href="javascript:grin(':sad:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sad.gif"       alt="" /></a>
<a href="javascript:grin(':evil:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_evil.gif"      alt="" /></a>
<a href="javascript:grin(':!:')"       class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_exclaim.gif"   alt="" /></a>
<a href="javascript:grin(':smile:')"   class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_smile.gif"     alt="" /></a>
<a href="javascript:grin(':oops:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_redface.gif"   alt="" /></a>
<a href="javascript:grin(':grin:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_biggrin.gif"   alt="" /></a>
<a href="javascript:grin(':eek:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_surprised.gif" alt="" /></a>
<a href="javascript:grin(':shock:')"   class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_eek.gif"       alt="" /></a>
<a href="javascript:grin(':???:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_confused.gif"  alt="" /></a>
<a href="javascript:grin(':cool:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cool.gif"      alt="" /></a>
<a href="javascript:grin(':lol:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_lol.gif"       alt="" /></a>
<a href="javascript:grin(':mad:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mad.gif"       alt="" /></a>
<a href="javascript:grin(':twisted:')" class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_twisted.gif"   alt="" /></a>
<a href="javascript:grin(':roll:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_rolleyes.gif"  alt="" /></a>
<a href="javascript:grin(':wink:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_wink.gif"      alt="" /></a>
<a href="javascript:grin(':idea:')"    class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_idea.gif"      alt="" /></a>
<a href="javascript:grin(':arrow:')"   class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_arrow.gif"     alt="" /></a>
<a href="javascript:grin(':neutral:')" class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_neutral.gif"   alt="" /></a>
<a href="javascript:grin(':cry:')"     class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cry.gif"       alt="" /></a>
<a href="javascript:grin(':mrgreen:')" class="smile-icon"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mrgreen.gif"   alt="" /></a>
<br />