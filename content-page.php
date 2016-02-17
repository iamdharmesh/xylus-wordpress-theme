
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
			<?php edit_post_link( __( 'Edit', 'xylus' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->


</article>
