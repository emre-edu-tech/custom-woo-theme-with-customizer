<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MyCodingWoocom
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title() ?></title>
    <?php wp_head() ?>
</head>
<body <?php body_class() ?>>
    <div id="page" class="site">
        <header>
            <section class="site-search">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start align-items-center">
                        <?php get_search_form() ?>
                    </div>
                </div>
            </section>
            <section class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="brand col-12 col-md-3 col-lg-2 text-center text-md-left">
                            <?php if(has_custom_logo()): ?>
                                <?php the_custom_logo() ?>
                            <?php else: ?>
                                <a href="<?php echo home_url() ?>">
                                    <p class="site-title"><?php bloginfo('title') ?></p>
                                    <span class="site-tagline"><?php bloginfo('description') ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="second-column col-12 col-md-9 col-lg-10">
                            <div class="row">
                                <?php if(class_exists('Woocommerce')): ?>
                                    <div class="account navbar-expand col-6">
                                        <ul class="navbar-nav">
                                            <?php if(is_user_logged_in()): ?>
                                                <li class="nav-item"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>" class="nav-link"><?php _e('My Account', 'mycoodingwoocom') ?></a></li>

                                                <li class="nav-item"><a href="<?php echo esc_url(wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id')))) ?>" class="nav-link"><?php _e('Logout', 'mycoodingwoocom') ?></a></li>
                                            <?php else: ?>
                                                <li class="nav-item"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>" class="nav-link"><?php _e('Login / Register', 'mycoodingwoocom') ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="shopping-cart text-right col-6">
                                        <a href="<?php echo wc_get_cart_url(); ?>"><span class="cart-icon"></span><span class="cart-items"><?php echo WC()->cart->get_cart_contents_count() ?></span></a>
                                    </div>
                                <?php endif; ?>
                                <div class="col-12">
                                    <nav class="main-menu navbar navbar-expand-md navbar-light" role="navigation">
                                        <!-- Brand and toggle get grouped for better mobile display -->
                                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'mycodingwoocom' ); ?>">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <?php
                                        wp_nav_menu( array(
                                            'theme_location'    => 'mycodingwoocom-main-menu',
                                            'depth'             => 4,
                                            'container'         => 'div',
                                            'container_class'   => 'collapse navbar-collapse',
                                            'container_id'      => 'bs-example-navbar-collapse-1',
                                            'menu_class'        => 'nav navbar-nav',
                                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'            => new WP_Bootstrap_Navwalker(),
                                        ) );
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>