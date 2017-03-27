<?php
/**
 * Template part for displaying search form.
 *
 */
?>
<div class="search-form-wrap form-hide">
    <form name="search_at" role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>" class="Search-form">
        <div class="Search-inner">
            <p>What is it you truly desire now?</p>
            <div class="">
                <i class="iconFont">&#xe634;</i>
                <input type="search" value="" name="s" placeholder="search..." id="SearchInput" onkeydown= "if(event.keyCode==13)search_at.submit()" />
            </div>
            <label id="searchsubmit" class="Label" for="SearchInput"></label>
        </div>
    </form>
</div>
