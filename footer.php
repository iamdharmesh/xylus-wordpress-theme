<!-- Footer -->
<footer>
    <div class="footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-md-4 footer-widget">
                    <?php if (dynamic_sidebar('footer-widget-1')) : else : ?>
                    <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

                    <?php endif; ?>
                </div>
                <div class="col-sm-4 col-md-4 footer-widget">
                    <?php if (dynamic_sidebar('footer-widget-2')) : else : ?>
                    <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

                    <?php endif; ?>
                </div>
                <div class="col-sm-4 col-md-4 footer-widget">
                    <?php if (dynamic_sidebar('footer-widget-3')) : else : ?>
                    <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <?php
        if(get_theme_mod('hide_copyright') == '' || get_theme_mod('hide_social') == ''){
            ?>
            <div class="copyright text-muted">
                <div class="container">
                    <?php if(get_theme_mod('hide_copyright') == ''){?>
                        <p class="pull-left">
                            <?php echo sanitize_text_field(get_theme_mod( 'xylus_copyright', __('No copyright information has been saved yet.', 'xylus' ))); ?>
                        </p>
                    <?php } if(get_theme_mod('hide_social') == ''){?>
                        <ul class="list-inline pull-right">
                            <?php if(get_theme_mod('xylus_facebook') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_facebook')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_twitter') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_twitter')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_googleplus') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_googleplus')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_linkedin') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_linkedin')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_github') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_github')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_skype') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_skype')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-skype fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_youtube') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_youtube')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_wordpress') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_wordpress')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-wordpress fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_tumblr') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_tumblr')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-tumblr fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php } if(get_theme_mod('xylus_pinterest') != ''){?>
                                <li>
                                    <a href="<?php echo  esc_url(get_theme_mod( 'xylus_pinterest')); ?>">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
    ?>

</footer>
<?php wp_footer(); ?>

</body>
</html>