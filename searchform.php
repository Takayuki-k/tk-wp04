<?php $form = '
<form method="get" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
    <input type="text" placeholder="search" value="" name="s" class="s">
    <input type="submit" class="searchsubmit" value="S">
</form>';
echo $form; ?>