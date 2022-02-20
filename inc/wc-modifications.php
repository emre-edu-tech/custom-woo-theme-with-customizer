<?php
/**
 * Template overrides for Woocommerce Pages
 * 
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/#section-3
 * 
 * @package Mycodingwoocom
 */
function mycodingwoocom_wc_modify() {
    /**
     * archive-product.php and single-product.php files override
     */
    function mycodingwoocom_open_container_row() {
        echo '<div class="container shop-content"><div class="row">';
    }
    add_action('woocommerce_before_main_content', 'mycodingwoocom_open_container_row', 5);

    function mycodingwoocom_close_container_row() {
        echo '</div></div>';
    }
    add_action('woocommerce_after_main_content', 'mycodingwoocom_close_container_row', 5);

    // archive-product.php and single-product.php
    // remove 'woocommerce_get_sidebar' action for 'woocommerce_sidebar' hook
    // IMPORTANT concept to understand
    // add_action('hook_name', 'action_function', priority)
    // add_action function always echoes out (puts) values
    // This line below is true for both templates
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

    // put sidebar only on shop page
    if(is_shop()) {

        function mycodingwoocom_open_sidebar_tags() {
            echo '<div class="sidebar-shop col-12 col-md-4 col-lg-3 order-2 order-md-1">';
        }
        add_action('woocommerce_before_main_content', 'mycodingwoocom_open_sidebar_tags', 6);
        
        add_action('woocommerce_before_main_content', 'woocommerce_get_sidebar', 7);

        function mycodingwoocom_close_sidebar_tags() {
            echo '</div>';
        }
        add_action('woocommerce_before_main_content', 'mycodingwoocom_close_sidebar_tags', 8);

        // add short description just on the shop page
        add_action('woocommerce_after_shop_loop_item_title', 'the_excerpt', 1);
    }

    function mycodingwoocom_open_main_content_tags() {
        if(is_shop()) {
            echo '<div class="col-12 col-md-8 col-lg-9 order-1 order-md-2">';
        } else {
            echo '<div class="col-12">';
        }
    }
    add_action('woocommerce_before_main_content', 'mycodingwoocom_open_main_content_tags', 9);

    function mycodingwoocom_close_main_content_tags() {
        echo '</div>';
    }
    add_action('woocommerce_after_main_content', 'mycodingwoocom_close_main_content_tags', 4);

    // Filters (this function is just for demonstration for showing how filters work)
    // add_filter('filter_name', 'filter_function', priority);
    // add_filter function always returns a value
    // $value parameter represents the 2nd parameter of apply_filters() that is the value to filter
    function mycodingwoocom_remove_shop_title($value) {
        // $value = false;
        return $value;
    }
    add_filter('woocommerce_show_page_title', 'mycodingwoocom_remove_shop_title');
}

// action added for the woocommerce conditional functions to work outside of a template file,
// for example inside functions.php file
add_action('wp', 'mycodingwoocom_wc_modify');