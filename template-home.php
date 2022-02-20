<?php
/**
 * Template Name: Home Page
 * The home page template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MyCodingWoocom
 */

get_header()
?>
    <section class="content-area">
        <main>
            <?php if(get_theme_mod('set_number_of_slides') > 0): ?>
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                        <?php for ($i=1; $i <= 20 ; $i++): ?>
                            <?php if(get_theme_mod('set_slide_'.$i.'_activate')): ?>
                                <li>
                                    <?php if(get_theme_mod('set_slide_'.$i.'_bg_image')): ?>
                                        <img class="img-fluid" src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('set_slide_'.$i.'_bg_image'))) ?>" />
                                        <?php else: ?>
                                            <p class="text-danger">Please provide an image for the background</p>
                                    <?php endif; ?>
                                    <div class="container">
                                        <div class="slide-details-container">
                                            <?php if(get_theme_mod('set_slide_'.$i.'_title')): ?>
                                                <div class="slide-title">
                                                    <h1><?php echo get_theme_mod('set_slide_'.$i.'_title') ?></h1>
                                                </div>
                                            <?php endif; ?>
                                            <div class="slide-description">
                                                <?php if(get_theme_mod('set_slide_'.$i.'_desc')): ?>
                                                    <div class="subtitle">
                                                        <?php echo get_theme_mod('set_slide_'.$i.'_desc') ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(get_theme_mod('set_slide_'.$i.'_btn_text')): ?>
                                                    <?php
                                                        $btn_url = '#';
                                                        if(get_theme_mod('set_slide_'.$i.'_btn_url')):
                                                            $btn_url = get_theme_mod('set_slide_'.$i.'_btn_url');
                                                        endif;
                                                    ?>
                                                    <a href="<?php echo $btn_url ?>" class="link"><?php echo get_theme_mod('set_slide_'.$i.'_btn_text') ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                      </ul>
                    </div>
                </section>
                <?php else: ?>
                    <p class="text-danger">At least one background image must be set for a background image to be the slide background!</p>
            <?php endif; ?>
            <?php if(class_exists('Woocommerce')): ?>
                <section class="popular-products pt-5">
                    <?php
                        $popular_products_limit = get_theme_mod('set_popular_products_limit', 4);
                        $popular_products_col = get_theme_mod('set_popular_products_col', 4);
                    ?>
                    <div class="container">
                        <h2><?php echo (get_theme_mod('set_popular_products_custom_title', 'Popular Products')) ?></h2>
                        <?php echo do_shortcode('[products limit="'.$popular_products_limit.'" columns="'.$popular_products_col.'" orderby="popularity"]') ?>
                    </div>
                </section>
                <section class="new-arrivals pt-5">
                    <?php
                        $latest_products_limit = get_theme_mod('set_latest_products_limit', 4);
                        $latest_products_col = get_theme_mod('set_latest_products_col', 4);
                    ?>
                    <div class="container">
                        <h2><?php echo (get_theme_mod('set_latest_products_custom_title', 'New Arrivals')) ?></h2>
                        <?php echo do_shortcode('[products limit="'.$latest_products_limit.'" columns="'.$latest_products_col.'" orderby="date"]') ?>
                    </div>
                </section>
                <?php if(get_theme_mod('set_deal_activate') == 1): ?>
                    <section class="deal-of-the-week">
                        <div class="container">
                            <?php
                            $deal_of_the_week_product_id = get_theme_mod('set_deal_of_the_week');
                            if(!$deal_of_the_week_product_id) {
                                // get the latest product as the default one
                                $args = [
                                    'post_type' => 'product',
                                    'posts_per_page' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                ];
                                $custom_product_query = new WP_Query($args);
                                $latest_product_id = null;
                                if($custom_product_query->have_posts()) {
                                    foreach($custom_product_query->posts as $post) {
                                        $latest_product_id = $post->ID;
                                    }
                                }
                                $deal_of_the_week_product_id = $latest_product_id;
                            }
                            // get the product by its id that should be shown
                            // if there is no product installed then it will not show
                            $deal_of_the_week_product = null;
                            if(isset($deal_of_the_week_product_id)) {
                                // get the product object by product id
                                $deal_of_the_week_product = wc_get_product($deal_of_the_week_product_id);
                                // get the currency
                                $currency = get_woocommerce_currency_symbol();
                                $regular_price = $deal_of_the_week_product->regular_price;
                                $sale_price = $deal_of_the_week_product->sale_price;
                                $discount_percent = null;
                                // calculate the discount
                                if(!empty($sale_price)) {
                                    $discount_percent = absint(100 - (($sale_price / $regular_price) * 100));
                                }
                            }
                            ?>
                            <?php if($deal_of_the_week_product): ?>
                                <h2>Deal of the Week</h2>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="deal-img col-md-6 col-12 ml-auto text-center">
                                        <?php 
                                        // remember if the image is large then classes are attachment-larger size-large
                                        echo $deal_of_the_week_product->get_image('large', array('class' => 'attachment-large size-large img-fluid'), true) ?>
                                    </div>
                                    <div class="deal-desc col-md-4 col-12 mr-auto text-center">
                                        <?php if(!empty($discount_percent)): ?>
                                            <span class="discount"><?php echo $discount_percent . '% OFF' ?></span>
                                        <?php endif; ?>
                                        <h3>
                                            <a href="<?php echo get_post_permalink($deal_of_the_week_product_id) ?>"><?php echo $deal_of_the_week_product->name ?></a>
                                        </h3>
                                        <?php if(!empty($deal_of_the_week_product->short_description)): ?>
                                            <p><?php echo $deal_of_the_week_product->short_description ?></p>
                                        <?php endif; ?>
                                        <?php if(!empty($regular_price) || !empty($sale_price)): ?>
                                            <div class="prices">
                                                <?php if(!empty($regular_price)): ?>
                                                    <span class="regular"><?php echo $currency.$regular_price ?></span>
                                                <?php endif; ?>
                                                <?php if(!empty($sale_price)): ?>
                                                    <span class="sale"><?php echo $currency.$sale_price ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <form class="cart" action="<?php echo get_post_permalink($deal_of_the_week_product_id)  ?>" method="post" enctype="multipart/form-data">

                                            <div class="quantity">
                                                <label class="screen-reader-text" for="quantity_<?php echo $deal_of_the_week_product_id ?>"><?php echo $deal_of_the_week_product->name ?> quantity</label>
                                                <input type="number" id="quantity_<?php echo $deal_of_the_week_product_id ?>" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric">
                                            </div>

                                            <button type="submit" name="add-to-cart" value="<?php echo $deal_of_the_week_product_id ?>" class="single_add_to_cart_button button alt"><?php _e('Add to cart', 'mycodingwoocom') ?></button>

                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p class="text-danger">Please upload at least one product to your Woocommerce Store to see the functionality</p>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
            <section class="blog-home">
                <div class="container">
                    <div class="row">
                        <?php if(have_posts()): ?>
                            <?php while(have_posts()): the_post(); ?>
                                <article>
                                    <h2><?php the_title() ?></h2>
                                    <div class="post-content">
                                        <?php the_content() ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>There are no posts to display.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>
    </section>
<?php get_footer() ?>