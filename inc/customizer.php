<?php

/**
 *  Mycodingwoocom Theme Customizer
 */

function mycodingwoocom_customizer($wp_customize) {
    // Footer copyright information
    // A section only appears after controls are added
    $wp_customize->add_section('sec_copyright', [
        'title' => 'Copyright Information',
        'description' => 'Copyright Section',
    ]);

    // Field 1 - Copyright Text Box
    // Here sanitize_text_field could be used
    $wp_customize->add_setting('set_copyright', [
        'type' => 'theme_mod',
        'default' => 'Copyright 20xx - All rights reserved',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    // IMPORTANT: first parameter of the add_control() function 
    // must be the name of the setting that this control binds to
    $wp_customize->add_control('set_copyright', [
        'type' => 'text',
        'label' => 'Copyright Information',
        'description' => 'Please add your copyright information here',
        'section'=> 'sec_copyright',
    ]);

    /**
     * SLIDER Section
     * --------------------
     */
    $wp_customize->add_section('sec_slider', [
        'title' => 'Slider Settings',
        'description' => 'Choose Slides for the Homepage slider',
    ]);

    // Get the number of slides that the user wants to show
    $wp_customize->add_setting('set_number_of_slides', [
        'type' => 'theme_mod',
        'default' => 0,
        'sanitize_callback' => 'absint',
    ]);

    $choices_number_of_slides = [];
    for ($i=0; $i <= 20; $i++) { 
        $choices_number_of_slides[$i] = $i;
    } 

    $wp_customize->add_control('set_number_of_slides', [
        'label' => __('Number of Slides'),
        'description' => __('Enter number of slides that you want to show'),
        'section' => 'sec_slider',
        'priority' => 1,
        'type' => 'select',
        'choices' => $choices_number_of_slides,
    ]);

    // Checkbox activation for the slides
    for ($i=1; $i < count($choices_number_of_slides) ; $i++) { 
        $wp_customize->add_setting('set_slide_'.$i.'_activate', [
            'type' => 'theme_mod',
            'default' => 0,
        ]);

        $wp_customize->add_control('set_slide_'.$i.'_activate', [
            'type' => 'checkbox',
            'label' => esc_html__('Activate Slide '.$i),
            'description' => esc_html__('Activate slider before using it'),
            'section' => 'sec_slider',
        ]);   
    }

    // Slide Controls - Every Slide will have 5 controls to completely work
    // This for loop checks how many slides are activated by the user using dropdown
    /**
     *  1. Background Image
     *  2. Slide Title
     *  3. Slide Subtitle
     *  4. Slide Button Text
     *  5. Slide Button URL
     */
    for ($i=1; $i < count($choices_number_of_slides); $i++) {
        // Controls for the Slide
        // Slide Background Image
        $wp_customize->add_setting('set_slide_'.$i.'_bg_image', [
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'absint',
        ]);
    
        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'set_slide_'.$i.'_bg_image', [
            'label' => __('Slide '.$i.' Background Image'),
            'description' => esc_html__('Upload an image of 1920x600 or bigger for the slide background'),
            'section' => 'sec_slider',
            'height' => 800,
            'width' => 1920,
            'flex_width' => false,
            'flex_height' => true,
            'button_labels' => [
                'select' => __('Select Slide Image'),
                'change' => __('Change Slide Image'),
                'remove' => __('Remove Slide Image'),
                'default' => __('Default Slide Image'),
                'placeholder' => __('No image selected for the slide'),
                'frame_title' => __('Select Image'),
                'frame_button' => __('Choose Image'),
            ],
            'active_callback' => 'ctrl_set_slide_activate',
        ]));

        // Slide Title
        $wp_customize->add_setting('set_slide_'.$i.'_title', [
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'esc_attr',
        ]);

        $wp_customize->add_control('set_slide_'.$i.'_title', [
            'label' => __('Slide '.$i.' Title'),
            'description' => __('Enter a title for Slide '.$i),
            'section' => 'sec_slider',
            'type' => 'text',
            'active_callback' => 'ctrl_set_slide_activate',
        ]);

        // Slide Description
        $wp_customize->add_setting('set_slide_'.$i.'_desc', [
            'type' => 'theme_mod',
            'default' => '',
        ]);

        $wp_customize->add_control('set_slide_'.$i.'_desc', [
            'label' => __('Slide '.$i.' Description'),
            'description' => __('Enter a descriptive text for Slide '.$i),
            'section' => 'sec_slider',
            'type' => 'textarea',
            'active_callback' => 'ctrl_set_slide_activate',
        ]);

        // Slide Button Text
        $wp_customize->add_setting('set_slide_'.$i.'_btn_text', [
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('set_slide_'.$i.'_btn_text', [
            'label' => __('Slide '.$i.' Button Text'),
            'description' => __('Enter a text for Slide '.$i.' Button'),
            'section' => 'sec_slider',
            'type' => 'text',
            'active_callback' => 'ctrl_set_slide_activate',
        ]);

        // Slide 1 Button URL
        $wp_customize->add_setting('set_slide_'.$i.'_btn_url', [
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control('set_slide_'.$i.'_btn_url', [
            'label' => __('Slide '.$i.' Button URL'),
            'description' => __('Enter a URL address for button to link'),
            'section' => 'sec_slider',
            'type' => 'url',
            'active_callback' => 'ctrl_set_slide_activate',
        ]);
    }

    // Active Callback Functions for all control groups
    function ctrl_set_slide_activate($control) {
        for ($i=1; $i < 21; $i++) {
            $slide_activate_setting = $control->manager->get_control('set_slide_'.$i.'_activate')->value();
            $control_id = $control->id;
            // Check if the active control is the slide bg image
            if($control_id == 'set_slide_'.$i.'_bg_image') {
                if($slide_activate_setting == 1) {
                    return true;
                } else {
                    return false;
                }
            }

            // check if the active control is the slide title
            if($control_id == 'set_slide_'.$i.'_title') {
                if($slide_activate_setting == 1) {
                    return true;
                } else {
                    return false;
                }
            }

            //check if the active control is the slide desc
            if($control_id == 'set_slide_'.$i.'_desc') {
                if($slide_activate_setting == 1) {
                    return true;
                } else {
                    return false;
                }
            }

            // check if the active control is the button text
            if($control_id == 'set_slide_'.$i.'_btn_text') {
                if($slide_activate_setting == 1) {
                    return true;
                } else {
                    return false;
                }
            }

            // check if the active control is the button url
            if($control_id == 'set_slide_'.$i.'_btn_url') {
                if($slide_activate_setting == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * PRODUCTS Section
     * --------------------
     */
    $wp_customize->add_section('sec_products_homepage', [
        'title' => 'Homepage Products',
        'description' => 'Settings for the Popular Products and New Arrivals on the Homepage',
    ]);

    // Popular Products Title
    $wp_customize->add_setting('set_popular_products_custom_title', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('set_popular_products_custom_title', [
        'label' => 'Popular Products - Custom Title',
        'description' => 'Enter a custom Title for Popular Products Section',
        'section' => 'sec_products_homepage',
        'type' => 'text',
    ]);

    // Popular Products Product Number Limit
    $wp_customize->add_setting('set_popular_products_limit', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('set_popular_products_limit', [
        'label' => 'Number of popular products',
        'description' => 'Enter the number of popular products to show',
        'section' => 'sec_products_homepage',
        'type' => 'number',
    ]);

    // Popular Products Number of Columns
    $wp_customize->add_setting('set_popular_products_col', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('set_popular_products_col', [
        'label' => 'Number of popular product columns',
        'description' => 'Enter the number of columns that show the popular products',
        'section' => 'sec_products_homepage',
        'type' => 'number',
    ]);

    // Latest Products Settings
    $wp_customize->add_setting('set_latest_products_custom_title', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('set_latest_products_custom_title', [
        'label' => 'Latest Products - Custom Title',
        'description' => 'Enter a custom Title for Latest Products Section',
        'section' => 'sec_products_homepage',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('set_latest_products_limit', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint',
    ]);
    
    $wp_customize->add_control('set_latest_products_limit', [
        'label' => 'Number of Latest Products',
        'description' => 'Enter the number of latest products to show',
        'section' => 'sec_products_homepage',
        'type' => 'number',
    ]);

    $wp_customize->add_setting('set_latest_products_col', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint',
    ]);
    
    $wp_customize->add_control('set_latest_products_col', [
        'label' => 'Number of Latest Product Columns',
        'description' => 'Enter the number of columns to show latest products',
        'section' => 'sec_products_homepage',
        'type' => 'number',
    ]);

    // Deal of the week
    // Activation checkbox
    $wp_customize->add_setting('set_deal_activate', [
        'type' => 'theme_mod',
        'default' => 0,
        'sanitize_callback' => 'mycodingwoocom_sanitize_checkbox',
    ]);

    $wp_customize->add_control('set_deal_activate', [
        'type' => 'checkbox',
        'label' => esc_html__('Activate Deal of the Week'),
        'description' => esc_html__('Activate Deal of the week before using it'),
        'section' => 'sec_products_homepage',
    ]);

    $wp_customize->add_setting('set_deal_of_the_week', [
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint',
    ]);

    $args = [
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ];
    
    $query = new WP_Query($args);
    $all_products = [];
    if($query->have_posts()) {
        foreach($query->posts as $post) {
            $all_products[$post->ID] = $post->post_title;
        }
    }

    wp_reset_postdata();

    $wp_customize->add_control('set_deal_of_the_week', [
        'label' => __('Deal of the Week'),
        'description' => __('Pick the product that you want to show as deal of the week'),
        'section' => 'sec_products_homepage',
        'type' => 'select',
        'choices' => $all_products,
        'active_callback' => 'ctrl_set_deal_activate',
    ]);

    function ctrl_set_deal_activate($control) {
        if($control->manager->get_control('set_deal_activate')->value() == 1) {
            return true;
        } else {
            return false;
        }
    }
}

add_action('customize_register', 'mycodingwoocom_customizer');

// checkbox sanitize
function mycodingwoocom_sanitize_checkbox($checked) {
    return (isset($checked) && $checked == true) ? true : false;
}