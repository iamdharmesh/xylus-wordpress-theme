<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) { ?>
        <h2 class="comments-title">
            <?php
            printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'xylus' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
        <hr>
        <ul class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                    'callback'    => 'xylus_comments_list'
                ) );
            ?>
        </ul><!-- .comment-list -->


    <?php
    } // have_comments()

    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h3 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'xylus' ); ?></h3>
            <ul class="pager  comment-navigation">
                <li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'xylus' ) ); ?></li>
                <li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'xylus' ) ); ?></li>
            </ul>

        </nav><!-- .comment-navigation -->

    <?php } // Check for comment navigation ?>

    <?php if ( ! comments_open() && get_comments_number() ) { ?>
        <div class="alert alert-warning no-comments"><?php _e( 'Comments are closed.' , 'xylus' ); ?></div>
    <?php } else {

        xylus_comment_form();
    }

    ?>
</div><!-- #comments -->