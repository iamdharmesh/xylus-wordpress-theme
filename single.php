<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Generate
 */

get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="post-heading">
            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
            <h2 class="subheading"></h2>
                                <span class="meta">
                                    <?php
                                    printf(__('Posted By %1$s','xylus'),get_the_author());
                                    /* translators: used between list items, there is a space after the comma */
                                    $categories_list = get_the_category_list( __( ', ', 'xylus' ) );
                                    if ( $categories_list ) :
                                        printf( __( ' in %1$s', 'xylus' ), $categories_list );
                                    endif; // End if categories
                                    _e(' on ','xylus'); $my_date = the_date('F j, Y');
                                    ?>
                                </span>
        </div>
    <?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
</header>

<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <main id="main" itemtype="http://schema.org/Blog" itemscope="itemscope" itemprop="mainContentOfPage" role="main">

                    <?php while ( have_posts() ) : the_post(); ?>


                        <?php get_template_part( 'content', 'single' ); ?>

                        <?php xylus_post_navigation(); ?>
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() ) : ?>
                                <div class="comments-area">
                                    <?php comments_template(); ?>
                                </div>
                        <?php endif; ?>

                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->
	        </div>
        </div>
    </div>
</article>

<?php 
get_footer();