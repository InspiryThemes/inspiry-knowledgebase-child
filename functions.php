<?php
/*-----------------------------------------------------------------------------------*/
/*	Enqueue Styles in Child Theme
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_enqueue_child_styles')) {
    function inspiry_enqueue_child_styles(){
        if ( !is_admin() ) {
            // dequeue and deregister parent default css
            wp_dequeue_style( 'inspiry-parent-default' );
            wp_deregister_style( 'inspiry-parent-default' );
            // dequeue parent custom css
            wp_dequeue_style( 'custom-css' );
            // parent default css
            wp_enqueue_style( 'inspiry-parent-default', get_template_directory_uri().'/style.css' );
            // parent custom css
            wp_enqueue_style( 'custom-css' );
            // child default css
            wp_enqueue_style('child-default', get_stylesheet_uri(), array('inspiry-parent-default'), '', 'all' );
            // child custom css
            wp_enqueue_style('child-custom',  get_stylesheet_directory_uri() . '/child-custom.css', array('child-default'), '', 'all' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_child_styles', PHP_INT_MAX );
if ( !function_exists( 'inspiry_load_translation_from_child' ) ) {
    /**
     * Load translation files from child theme
     */
    function inspiry_load_translation_from_child() {
        load_child_theme_textdomain ( 'framework', get_stylesheet_directory () . '/languages' );
    }
    add_action ( 'after_setup_theme', 'inspiry_load_translation_from_child' );
}