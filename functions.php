<?php
/**
 * Mycodingwoocom functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package MyCodingWoocom
 */

/**
 * Load customizer-js file
 */
// Load customizer js
function mycodingproject_customizer_controls() {
    wp_enqueue_script('mycodingwoocom-customizer-controls', get_template_directory_uri() . '/js/customize-controls.js', array('jquery'), '1.0', true);
}
add_action('customize_controls_enqueue_scripts', 'mycodingproject_customizer_controls');

/**
 * Require customizer file
 */
if(!file_exists(get_template_directory() . '/inc/customizer.php')) {
    // file does not exist... return an error.
    return new WP_Error('customizer.php', __('it appears customizer.php does not exist in this location'));
} else {
    require_once get_template_directory() . '/inc/customizer.php';
}

/**
 * Require wp bootstrap navwalker class
 */
if(!file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
    // file does not exist... return an error.
    return new WP_Error('class-wp-bootstrap-navwalker.php', __('it appears class-wp-bootstrap-navwalker.php does not exist in this location'));
} else {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

// change custom scripts example - it is very important for the cropping to work better
add_action( 'wp_print_scripts', 'cleanup_scripts', PHP_INT_MAX);
add_action( 'wp_print_footer_scripts', 'cleanup_scripts', PHP_INT_MAX);
function cleanup_scripts() {
    wp_deregister_script('imgareaselect');
    wp_dequeue_script('imgareaselect');
    wp_enqueue_script('imgareaselect', get_template_directory_uri() . '/js/jquery.imgareaselect.min.js', array('jquery'), '1.0', true);
}

// filemtime() returns the last modification time of a file given as parameter
// after finishing the development, remove the filemtime function and put the theme's version number instead
function mycodingwoocom_load_assets() {
    // Include the Google fonts
    // If you include more than one font, separate their url with the pipe (|) character
    // Google Fonts
 	wp_enqueue_style( 'mycodingwoocom-google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700|Seaweed+Script' );

    // Include the bootstrap css
    wp_enqueue_style('mycodingwoocom-bootstrap4', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.6.1', 'all');

    // include flexslider css
    wp_enqueue_style('mycodingwoocom-flexslider', get_template_directory_uri() . '/inc/flexslider/flexslider.css', array(), '2.0', 'all');

    // Include theme stylesheet file
    wp_enqueue_style('mycodingwoocom-main', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'), 'all');

    // Include the bootstrap js
    wp_enqueue_script('mycodingwoocom-bootstrap4', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.6.1', true);

    // include flexslider js
    wp_enqueue_script('mycodingwoocom-flexslider', get_template_directory_uri() . '/inc/flexslider/jquery.flexslider-min.js', array('jquery'), '2.0', true);

    // include custom javascript
    wp_enqueue_script('mycodingproject-custom', get_template_directory_uri() . '/js/custom.js', array(), filemtime(get_template_directory() . '/js/custom.js'), true);
}
add_action('wp_enqueue_scripts', 'mycodingwoocom_load_assets');

/**
 * Main Configuration File - executes first on after_setup_theme hook
 * Register navigation menu positions on the website
 */
function mycodingwoocom_config() {
    register_nav_menus([
        'mycodingwoocom-main-menu' => __('Main Menu', 'mycodingwoocom'),
        'mycodingwoocom-footer-menu' => __('Footer Menu', 'mycodingwoocom'),
    ]);

    // Add theme support directives
    add_theme_support('woocommerce', [
        // 'thumbnail_image_width' => 300, // default is 300
        'single_image_width' => 400,
        'product_grid' => [
            'default_rows' => 4,
            // 'min_rows' => 3,
            // 'max_rows' => 6,
            'default_columns' => 4,
            'min_columns' => 3,
            'max_columns' => 6,
        ],
    ]);

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    $logo_args = [
        'height' => 85,
        'width' => 160,
        'flex-height' => true,
        'flex-width' => true,
    ];
    add_theme_support('custom-logo', $logo_args);

    // add img-fluid class to custom logo -> added for img-fluid class addition
    add_filter( 'wp_get_attachment_image_attributes', function($attr) {
        if(isset($attr['class'])  && 'custom-logo' === $attr['class'])
            $attr['class'] = 'custom-logo img-fluid';

        return $attr;
    });

    // Setting the content width
    if(!isset($content_width)) {
        $content_width = 600;
    }

    // Custom image size for the slider
    add_image_size('mycodingwoocom-slider', 1920, 800, ['center', 'center']);
}
add_action('after_setup_theme', 'mycodingwoocom_config', 0);

/**
 * Woocommerce template override actions and filters
 * IMPORTANT!
 * before adding these modifications to functions.php file, it should be checked that if
 * Woocommerce is activated in other words Woocommerce class exists 
 */
if(class_exists('Woocommerce')) {
    require_once get_template_directory() . '/inc/wc-modifications.php';
}

/**
 * Show cart contents / total with Ajax
 */

add_filter('woocommerce_add_to_cart_fragments', 'mycodingwoocom_woocommerce_header_add_to_cart_fragment');
function mycodingwoocom_woocommerce_header_add_to_cart_fragment($fragments) {

    ob_start();
    ?>
    <span class="cart-items"><?php echo WC()->cart->get_cart_contents_count() ?></span>
    <?php
    $fragments['span.cart-items'] = ob_get_clean();
    
    return $fragments;
}