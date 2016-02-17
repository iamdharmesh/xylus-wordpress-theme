<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_head();
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/respond.min.js"></script>
    <![endif]-->

</head>

<body  <?php body_class(); ?>>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php _e( 'Toggle navigation', 'xylus' ); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'nav navbar-nav navbar-right',
                        'fallback_cb'     => 'wp_page_menu',
                        'walker'          => new wp_bootstrap_navwalker()
                    )
                );
            }
            ?>
        </div><!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<?php
if(is_single() || is_page()) {
    if ( has_post_thumbnail() ) {
        $url = wp_get_attachment_url( get_post_thumbnail_id() );

    }else{
        if( get_header_image() ){
            $url = get_header_image();
        }else{
            $url = get_template_directory_uri() . '/images/header.jpg';
        }
    }
}else{
    if( get_header_image() ){
        $url = get_header_image();
    }else{
        $url = get_template_directory_uri() . '/images/header.jpg';
    }
}

?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('<?php echo $url;?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">


                <?php
                if ( is_front_page() && is_home()) {
                    ?>
                    <div class="site-heading">
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>

                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ){ ?>
                        <hr class="small">
                        <span class="subheading"><?php echo $description; ?></span>
                    <?php } ?>
                    </div>
                <?php
                }elseif(is_page()){
                    ?>
                    <div class="site-heading">
                        <h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <?php
                        $subtitle = get_post_meta($post->ID,'xylus_subtitle',true);
                        if(isset($subtitle) && $subtitle != ''){ ?>
                            <hr class="small">
                            <span class="subheading"><?php echo $subtitle; ?></span>
                        <?php
                        }?>

                    </div>
                <?php
                }elseif( is_single()){
                    // in Single.php file
                }
                elseif(is_home()){
                    ?>
                    <div class="site-heading">
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <hr class="small">
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ){ ?>
                        <span class="subheading"><?php echo $description; ?></span>
                        </div>
                    <?php }
                }elseif(is_page()){
                    ?>
                    <div class="site-heading">
                        <h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    </div>
                <?php
                }
                elseif(is_404()){
                ?>
                    <div class="site-heading">
                        <h1><a><?php _e( 'Oops!', 'xylus' );?></a><br><?php _e( 'Page Not Found', 'xylus' );?></h1>
                    </div>
                <?php
                }
                elseif(is_archive()){
                    ?>
                    <div class="post-heading"><h1><a>
                        <?php
                        if(is_author()):
                            printf( __( 'All posts by %s', 'xylus' ), get_the_author() );

                        elseif(is_category()):
                            printf( __( 'Category Archives: %s', 'xylus' ), single_cat_title( '', false ) );

                        elseif(is_tag()):
                            printf( __( 'Tag Archives: %s', 'xylus' ), single_tag_title( '', false ) );

						elseif( is_day() ) :
                            printf( __( 'Daily Archives: %s', 'xylus' ), get_the_date() );

                        elseif ( is_month() ) :
                            printf( __( 'Monthly Archives: %s', 'xylus' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'xylus' ) ) );

                        elseif ( is_year() ) :
                            printf( __( 'Yearly Archives: %s', 'xylus' ), get_the_date( _x( 'Y', 'yearly archives date format', 'xylus' ) ) );

                        else :
                            _e( 'Archives', 'xylus' );

                        endif;
                        ?>
                    </a></h1></div>
                    <?php

                }
                elseif( is_search()){ ?>
                    <div class="site-heading">
                        <h1><a><?php _e( 'Search', 'xylus' );?></a><br><?php _e( 'Results', 'xylus' );?></h1>
                    </div>
                <?php
                }
                if( !is_single()){
                ?>

            </div>
        </div>
    </div>
</header>
<?php }?>