<?php

add_action( 'customize_register', 'mg_starter_theme_customize_register_footer' );
function mg_starter_theme_customize_register_footer( $wp_customize ) {
    $wp_customize->add_section( 'mg_footer_section', array(
        'title' => 'Footer'
    ) );
    $wp_customize->add_setting( 'mg_footer_enable' , array(
        'default'     => 'false',
        'transport'   => 'refresh',
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'mg_footer_enable', array(
        'type' => 'checkbox',
        'section' => 'mg_footer_section',
        'label' => esc_html__( 'Enable footer widgets?' ),
    ) );
    $wp_customize->add_setting( 'mg_footer_number_columns' , array(
        'default'     => 1,
        'transport'   => 'refresh',
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'mg_footer_number_columns', array(
        'type' => 'select',
        'section' => 'mg_footer_section',
        'label' => esc_html__( 'How many footer widgets?' ),
        'choices' => array(
            '0' => 'None',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
         ),
    ) );
}
