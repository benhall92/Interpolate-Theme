<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline input-group">

    <input class="form-control mr-sm-2" placeholder="<?php _e('Search', 'inter_theme'); ?>" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />

    <button id="searchSubmit" class="btn btn-secondary btn-outline-success my-2 my-sm-0" type="submit"><?php _e('Search', 'inter_theme'); ?></button>

</form>