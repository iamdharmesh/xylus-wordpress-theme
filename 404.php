<?php
/**
 * for 404 pages (Not Found Error).
 */
get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <main id="main" itemprop="mainContentOfPage" role="main">


                    <div class="inside-article">

                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo  _e( 'Oops! Not Found', 'xylus' ); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content" itemprop="text">
                            <p>
                                <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'xylus' ); ?>
                            </p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->

                    </div><!-- .inside-article -->


                </main><!-- main -->
            </div><!-- .col-lg-8 -->
        </div><!-- .row -->
    </div><!-- .container -->

<?php 
get_footer();