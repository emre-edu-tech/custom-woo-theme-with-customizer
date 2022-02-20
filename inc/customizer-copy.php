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

    // Checkbox activation for the slides
    // First slider will be active by default
    $wp_customize->add_setting('set_slide_1_activate', [
        'type' => 'theme_mod',
        'default' => 0,
    ]);

    $wp_customize->add_control('set_slide_1_activate', [
        'type' => 'checkbox',
        'label' => esc_html__('Activate Slide 1'),
        'description' => esc_html__('Activate slider before using it'),
        'section' => 'sec_slider',
    ]);

    $wp_customize->add_setting('set_slide_2_activate', [
        'type' => 'theme_mod',
        'default' => 0,
    ]);

    $wp_customize->add_control('set_slide_2_activate', [
        'type' => 'checkbox',
        'label' => esc_html__('Activate Slide 2'),
        'description' => esc_html__('Activate slider before using it'),
        'section' => 'sec_slider',
    ]);

    $wp_customize->add_setting('set_slide_3_activate', [
        'type' => 'theme_mod',
        'default' => 0,
    ]);

    $wp_customize->add_control('set_slide_3_activate', [
        'type' => 'checkbox',
        'label' => esc_html__('Activate Slide 3'),
        'description' => esc_html__('Activate slider before using it'),
        'section' => 'sec_slider',
    ]);

    // Slider Controls - Every Slide will have 5 controls to completely work
    /**
     *  1. Background Image
     *  2. Slide Title
     *  3. Slide Subtitle
     *  4. Slide Button Text
     *  5. Slide Button URL
     */
    
    /** ------------------------------------------------------------------------ */
    // Controls for the Slide 1
    // Slide 1 Background Image
    $wp_customize->add_setting('set_slide_1_bg_image', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'set_slide_1_bg_image', [
        'label' => __('Slide 1 Background Image'),
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
        'active_callback' => 'ctrl_set_slide_1_activate',
    ]));

    // Slide 1 Title
    $wp_customize->add_setting('set_slide_1_title', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    ]);

    $wp_customize->add_control('set_slide_1_title', [
        'label' => __('Slide 1 Title'),
        'description' => __('Enter a title for Slide 1'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_1_activate',
    ]);

    // Slide 1 Description
    $wp_customize->add_setting('set_slide_1_desc', [
        'type' => 'theme_mod',
        'default' => '',
    ]);

    $wp_customize->add_control('set_slide_1_desc', [
        'label' => __('Slide 1 Description'),
        'description' => __('Enter a descriptive text for Slide 1'),
        'section' => 'sec_slider',
        'type' => 'textarea',
        'active_callback' => 'ctrl_set_slide_1_activate',
    ]);

    // Slide 1 Button Text
    $wp_customize->add_setting('set_slide_1_btn_text', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('set_slide_1_btn_text', [
        'label' => __('Slide 1 Button Text'),
        'description' => __('Enter a text for Slide 1 Button'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_1_activate',
    ]);

    // Slide 1 Button URL
    $wp_customize->add_setting('set_slide_1_btn_url', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('set_slide_1_btn_url', [
        'label' => __('Slide 1 Button URL'),
        'description' => __('Enter a URL address for button to link'),
        'section' => 'sec_slider',
        'type' => 'url',
        'active_callback' => 'ctrl_set_slide_1_activate',
    ]);

    function ctrl_set_slide_1_activate($control) {
        if($control->manager->get_setting('set_slide_1_activate')->value() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /** ------------------------------------------------------------------------ */
    // Controls for the slide 2
    // Slide 2 Background Image
    $wp_customize->add_setting('set_slide_2_bg_image', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'set_slide_2_bg_image', [
        'label' => __('Slide 2 Background Image'),
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
        'active_callback' => 'ctrl_set_slide_2_activate',
    ]));

    // Slide 2 Title
    $wp_customize->add_setting('set_slide_2_title', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    ]);

    $wp_customize->add_control('set_slide_2_title', [
        'label' => __('Slide 2 Title'),
        'description' => __('Enter a title for Slide 2'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_2_activate',
    ]);

    // Slide 2 Description
    $wp_customize->add_setting('set_slide_2_desc', [
        'type' => 'theme_mod',
        'default' => '',
    ]);

    $wp_customize->add_control('set_slide_2_desc', [
        'label' => __('Slide 2 Description'),
        'description' => __('Enter a descriptive text for Slide 2'),
        'section' => 'sec_slider',
        'type' => 'textarea',
        'active_callback' => 'ctrl_set_slide_2_activate',
    ]);

    // Slide 2 Button Text
    $wp_customize->add_setting('set_slide_2_btn_text', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('set_slide_2_btn_text', [
        'label' => __('Slide 2 Button Text'),
        'description' => __('Enter a text for Slide 2 Button'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_2_activate',
    ]);

    // Slide 2 Button URL
    $wp_customize->add_setting('set_slide_2_btn_url', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('set_slide_2_btn_url', [
        'label' => __('Slide 2 Button URL'),
        'description' => __('Enter a URL address for button to link'),
        'section' => 'sec_slider',
        'type' => 'url',
        'active_callback' => 'ctrl_set_slide_2_activate',
    ]);

    function ctrl_set_slide_2_activate($control) {
        if($control->manager->get_setting('set_slide_2_activate')->value() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /** ------------------------------------------------------------------------ */
    // Controls for the Slide 3
    // Slide 3 Background Image
    $wp_customize->add_setting('set_slide_3_bg_image', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'set_slide_3_bg_image', [
        'label' => __('Slide 3 Background Image'),
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
        'active_callback' => 'ctrl_set_slide_3_activate',
    ]));

    // Slide 3 Title
    $wp_customize->add_setting('set_slide_3_title', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    ]);

    $wp_customize->add_control('set_slide_3_title', [
        'label' => __('Slide 3 Title'),
        'description' => __('Enter a title for Slide 3'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_3_activate',
    ]);

    // Slide 3 Description
    $wp_customize->add_setting('set_slide_3_desc', [
        'type' => 'theme_mod',
        'default' => '',
    ]);

    $wp_customize->add_control('set_slide_3_desc', [
        'label' => __('Slide 3 Description'),
        'description' => __('Enter a descriptive text for Slide 3'),
        'section' => 'sec_slider',
        'type' => 'textarea',
        'active_callback' => 'ctrl_set_slide_3_activate',
    ]);

    // Slide 3 Button Text
    $wp_customize->add_setting('set_slide_3_btn_text', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('set_slide_3_btn_text', [
        'label' => __('Slide 3 Button Text'),
        'description' => __('Enter a text for Slide 3 Button'),
        'section' => 'sec_slider',
        'type' => 'text',
        'active_callback' => 'ctrl_set_slide_3_activate',
    ]);

    // Slide 3 Button URL
    $wp_customize->add_setting('set_slide_3_btn_url', [
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('set_slide_3_btn_url', [
        'label' => __('Slide 3 Button URL'),
        'description' => __('Enter a URL address for button to link'),
        'section' => 'sec_slider',
        'type' => 'url',
        'active_callback' => 'ctrl_set_slide_3_activate',
    ]);

    function ctrl_set_slide_3_activate($control) {
        if($control->manager->get_setting('set_slide_3_activate')->value() == 1) {
            return true;
        } else {
            return false;
        }
    }
}

add_action('customize_register', 'mycodingwoocom_customizer');