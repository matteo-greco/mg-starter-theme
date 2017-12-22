<?php

add_action( 'customize_register', 'mg_starter_theme_customize_register_nav' );
function mg_starter_theme_customize_register_nav( $wp_customize ) {
    $wp_customize->add_section( 'mg_nav_section', array(
        'panel' => 'nav_menus',
        'title' => 'Secondary Nav'
    ) );
    $wp_customize->add_setting( 'mg_nav_secondary' , array(
        'default'     => 'false',
        'transport'   => 'refresh',
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'mg_nav_secondary', array(
        'type' => 'checkbox',
        'section' => 'mg_nav_section',
        'label' => esc_html__( 'Enable secondary nav?' ),
    ) );
}
