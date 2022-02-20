<?php
/**
 * The template for displaying the footer
 *
 * Contains all footer content and closing of html.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MyCodingWoocom
 */

?>
        <footer>
            <section class="footer-widgets">
                <div class="container">
                    <div class="row">
                        Footer Widgets
                    </div>
                </div>
            </section>
            <section class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="copyright-content col-12 col-md-6">
                            <p>
                                <?php if(get_theme_mod('set_copyright')): ?>
                                    <?php echo get_theme_mod('set_copyright') ?>
                                <?php else: ?>
                                    <?php echo 'Copyright 20xx - All rights reserved' ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <nav class="footer-menu col-12 col-md-6 text-left text-md-right">
                            <?php
                                wp_nav_menu([
                                    'theme_location' => 'mycodingwoocom-footer-menu',
                                ]);
                            ?>
                        </nav>
                    </div>
                </div>
            </section>
        </footer>
    </div>
<?php wp_footer() ?>
</body>
</html>