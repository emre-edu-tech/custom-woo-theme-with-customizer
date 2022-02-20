<?php
/**
 * Template for displaying search forms in Mycodingwoocom template.
 * 
 * @package Mycodingwoocom
 */

$mycodingwoocom_unique_id = wp_unique_id( 'search-form-' );
$mycodingwoocom_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<form role="search" <?php echo $mycodingwoocom_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input placeholder="<?php echo esc_attr_x('Search &hellip;', 'mycodingwoocom') ?>" type="search" id="<?php echo esc_attr( $mycodingwoocom_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
    <?php if(class_exists('Woocommerce')): ?>
        <input type="hidden" name="post_type" id="post_type" value="product">
    <?php endif; ?>
    <button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo __('Search', 'mycodingwoocom') ?></span></button>
</form>