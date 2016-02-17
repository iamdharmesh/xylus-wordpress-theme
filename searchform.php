<?php
/**
 * Search form Template
 */
?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="padding-left: 0px;">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="s">
        <div class="input-group-btn">
            <button class="btn btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
</form>
