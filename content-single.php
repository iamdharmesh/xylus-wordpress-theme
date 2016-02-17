
<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview'); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">

		<div class="entry-content" itemprop="text">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'xylus' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">

            <?php
            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'xylus' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                    _x( 'Tags :', 'Used before tag names.', 'xylus' ),
                    $tags_list
                );
            }
            ?>
            <br>
			<?php edit_post_link( __( 'Edit', 'generate' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->


</article>
