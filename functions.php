<?php

define( 'XYLUS_VERSION', '1.0.0');
define( 'XYLUS_URI', get_template_directory_uri() );
define( 'XYLUS_DIR', get_template_directory() );


add_action('after_setup_theme','xylus_setup');

if(!function_exists('xylus_setup')){
/* sets up themes Defaults and Registers supports for WordPress features. */
    function xylus_setup(){
        /**
         * Make theme available for translation
         * Translations can be filled in the /languages/ directory
         */
        load_theme_textdomain('xylus',get_template_directory().'/languages');

        /**
         * Add RSS feed to head
         */
        add_theme_support('automatic-feed-links');

        /**
         * Enable Support for post thumbnail on pages and posts
         */
        add_theme_support( 'post-thumbnails' );

        /**
         * Enable Support Custom Header Image.
         */
        $args = array(
           'default-image' => get_template_directory_uri() . '/images/header.jpg',
        );

        add_theme_support( 'custom-header',$args );

        /**
         * Enable Support Custom Background
         */
        add_theme_support( 'custom-background' );

        /**
         * Allow Shortcode in widgets
         */
        add_filter('widget_text', 'do_shortcode');

        /**
         * Enable Support for title tag
         */
        add_theme_support( 'title-tag' );



        /**
         * Register Navigation Menu
         */
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'xylus' ),
        ) );

        if ( ! isset( $content_width ) ){
            $content_width = 750;
        }


    }
}




// nav walker
require_once( get_template_directory()  . '/inc/navwalker.php');

/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'xylus_widgets_init' );
function xylus_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Footer Widget 1', 'xylus' ),
        'id'            => 'footer-widget-1',
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget 2', 'xylus' ),
        'id'            => 'footer-widget-2',
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget 3', 'xylus' ),
        'id'            => 'footer-widget-3',
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'xylus_scripts' );
function xylus_scripts(){

    // xylus stylesheets
    wp_enqueue_style('xylus-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', false, XYLUS_VERSION, 'all');
    wp_enqueue_style('xylus-style', get_template_directory_uri() . '/style.css', false, XYLUS_VERSION, 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, XYLUS_VERSION, 'all');
    wp_enqueue_style('google-font', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic', false, XYLUS_VERSION, 'all');
    wp_enqueue_style('google-font2', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', false, XYLUS_VERSION, 'all');

    // xylus scripts
    wp_enqueue_script( 'xylus-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), XYLUS_VERSION, true );
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

}


/**
 * Excerpt length and Read more setup
 */

function xylus_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'xylus_excerpt_length', 999 );


if ( ! function_exists( 'xylus_excerpt_more' ) ) :
function xylus_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'xylus') . '</a>';
}
add_filter( 'excerpt_more', 'xylus_excerpt_more' );
endif;


if ( ! function_exists( 'xylus_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function xylus_post_meta() {

        if ( 'post' !== get_post_type() )
            return;

        echo '<div class="pull-left">';
            the_time('F j, Y');
            _e(' | ', 'xylus');
            the_author_posts_link();
        echo '</div>';

        echo '<div class="pull-right">';
            if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
                echo '<span>';
                    comments_popup_link( __( 'Leave a comment', 'xylus' ), __( '1 Comment', 'xylus' ), __( '% Comments', 'xylus' ) );
                echo '</span>';
            endif;
        echo '</div>';
    }
endif;


if ( ! function_exists( 'xylus_pagination' ) ) :
    /**
     * Pagination Below post archive.
     */

    function xylus_pagination(){


        echo '<ul class="pager"><li class="pull-left">';
        next_posts_link(' &larr; Older Posts ');
        echo '</li><li class="pull-right">';
        previous_posts_link(' Newer Posts &rarr; ');
        echo '</li></ul>';
    }

endif;


/**
 * Add Meta box for Page Subtitle
 *
 */

add_action( 'add_meta_boxes', 'xylus_page_subtitle_add' );

function xylus_page_subtitle_add(){
    add_meta_box( 'page-subtitle', 'Page Subtitle', 'xylus_page_meta_box', 'page', 'normal', 'high' );
}

function xylus_page_meta_box(){
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $subtitle = isset($values['xylus_subtitle']) ? $values['xylus_subtitle'][0] : '';

    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'xylus_page_subtitle_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="xylus_subtitle">Page Subtitle: </label>
        <input type="text" name="xylus_subtitle" id="xylus_subtitle" value="<?php echo $subtitle; ?>" />
    </p>
<?php
}

add_action( 'save_post', 'xylus_page_subtitle_save' );
function xylus_page_subtitle_save( $post_id ){

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'xylus_page_subtitle_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

        // Make sure your data is set before trying to save it
    if( isset( $_POST['xylus_subtitle'] ) )
        update_post_meta( $post_id, 'xylus_subtitle', $_POST['xylus_subtitle'] );
}



if( ! function_exists('xylus_get_avatar_url') ){
    /**
     * Get avatar url
     */
    function xylus_get_avatar_url($get_avatar){
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);
        return $matches[1];
    }
}


if( ! function_exists("xylus_comments_list") ){

    /**
     * Comments link
     *
     */
    function xylus_comments_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) {
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e( 'Pingback:', 'xylus' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'xylus' ), '<span class="edit-link">', '</span>' ); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div id="comment-<?php comment_ID(); ?>" class="comment media">
                        <div class="pull-left comment-author vcard">
                            <?php
                            $get_avatar = get_avatar( $comment, 48 );
                            $avatar_img = xylus_get_avatar_url($get_avatar);
                            //Comment author avatar
                            ?>
                            <img class="avatar img-circle" src="<?php echo $avatar_img ?>" alt="">
                        </div>

                        <div class="media-body">

                            <div class="well">

                                <div class="comment-meta media-heading">
                                <span class="author-name">
                                    <?php _e('By', 'xylus'); ?> <strong><?php echo get_comment_author(); ?></strong>
                                </span>
                                    -
                                    <time datetime="<?php echo get_comment_date(); ?>">
                                        <?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?>
                                        <?php edit_comment_link( __( 'Edit', 'xylus' ), '<small class="edit-link">', '</small>' ); //edit link ?>
                                    </time>

                                <span class="reply pull-right">
                                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' =>  sprintf( __( '%s Reply', 'xylus' ), '<i class="icon-repeat"></i> ' ) , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </span><!-- .reply -->
                                </div>

                                <?php if ( '0' == $comment->comment_approved ) {  //Comment moderation ?>
                                    <div class="alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'xylus' ); ?></div>
                                <?php } ?>

                                <div class="comment-content comment">
                                    <?php comment_text(); //Comment text ?>
                                </div><!-- .comment-content -->

                            </div><!-- .well -->


                        </div>
                    </div><!-- #comment-## -->
                <?php
                break;
        } // end comment_type check

    }

}


if( ! function_exists('xylus_comment_form') ){

    /**
     * Comment form
     */

    function xylus_comment_form($args = array(), $post_id = null ){


        if ( null === $post_id )
            $post_id = get_the_ID();
        else
            $id = $post_id;

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        if ( ! isset( $args['format'] ) )
            $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';


        $req      = get_option( 'require_name_email' );

        $aria_req = ( $req ? " aria-required='true'" : '' );

        $html5    = 'html5' === $args['format'];

        $fields   =  array(
            'author' => '
        <div class="form-group">
        <div class="col-sm-6 comment-form-author">
        <input   class="form-control"  id="author"
        placeholder="' . __( 'Name', 'xylus' ) . '" name="author" type="text"
        value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
        </div>',


            'email'  => '<div class="col-sm-6 comment-form-email">
        <input id="email" class="form-control" name="email"
        placeholder="' . __( 'Email', 'xylus' ) . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . '
        value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
        </div>
        </div>',


            'url'    => '<div class="form-group">
        <div class=" col-sm-12 comment-form-url">' .
                '<input  class="form-control" placeholder="'. __( 'Website', 'xylus' ) .'"  id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
        </div></div>',

        );

        $required_text = sprintf( ' ' . __('Required fields are marked %s', 'xylus'), '<span class="required">*</span>' );

        $defaults = array(
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),

            'comment_field'        => '
    <div class="form-group comment-form-comment">
    <div class="col-sm-12">
    <textarea class="form-control" id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', 'xylus' ) . '" rows="8" aria-required="true"></textarea>
    </div>
    </div>
    ',

            'must_log_in'          => '


    <div class="alert alert-danger must-log-in">'
                . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) )
                . '</div>',

            'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'xylus' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</div>',

            'comment_notes_before' => '<div class="alert alert-info comment-notes">' . __( 'Your email address will not be published.', 'xylus' ) . ( $req ? $required_text : '' ) . '</div>',

            'comment_notes_after'  => '<div class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'xylus' ), ' <code>' . allowed_tags() . '</code>' ) . '</div>',

            'id_form'              => 'commentform',

            'id_submit'            => 'submit',

            'title_reply'          => __( 'Leave a Reply', 'xylus' ),

            'title_reply_to'       => __( 'Leave a Reply to %s', 'xylus' ),

            'cancel_reply_link'    => __( 'Cancel reply', 'xylus' ),

            'label_submit'         => __( 'Post Comment', 'xylus' ),

            'format'               => 'xhtml',
        );


        $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

        if ( comments_open( $post_id ) ) { ?>

            <?php do_action( 'comment_form_before' ); ?>

            <div id="respond" class="comment-respond">

                <h3 id="reply-title" class="comment-reply-title">
                    <?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?>
                    <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
                </h3>

                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>

                    <?php echo $args['must_log_in']; ?>

                    <?php do_action( 'comment_form_must_log_in_after' ); ?>

                <?php } else { ?>

                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>"
                          class="form-horizontal comment-form"<?php echo $html5 ? ' novalidate' : ''; ?> role="form">
                        <?php do_action( 'comment_form_top' ); ?>

                        <?php if ( is_user_logged_in() ) { ?>

                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>

                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>

                        <?php } else { ?>

                            <?php echo $args['comment_notes_before']; ?>

                            <?php

                            do_action( 'comment_form_before_fields' );

                            foreach ( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                            }

                            do_action( 'comment_form_after_fields' );

                        }

                        echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );

                        echo $args['comment_notes_after']; ?>

                        <div class="form-submit">
                            <input class="btn btn-danger btn-lg" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                            <?php comment_id_fields( $post_id ); ?>
                        </div>

                        <?php do_action( 'comment_form', $post_id ); ?>

                    </form>

                <?php } ?>

            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php } else { ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php } ?>
    <?php


    }

}


if ( ! function_exists( 'xylus_post_navigation' ) ) {


    /**
     * Display post nav
     */

    function xylus_post_navigation() {
        global $post;

        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next and ! $previous ){
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="pager">
                <?php if ( $previous ) { ?>
                    <li class="previous">
                        <?php previous_post_link( '%link', _x( '<i class="icon-long-arrow-left"></i> %title', 'Previous post link', 'xyus' ) ); ?>
                    </li>
                <?php } ?>

                <?php if ( $next ) { ?>
                    <li class="next"><?php next_post_link( '%link', _x( '%title <i class="icon-long-arrow-right"></i>', 'Next post link', 'xyus' ) ); ?></li>
                <?php } ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
}


// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';
