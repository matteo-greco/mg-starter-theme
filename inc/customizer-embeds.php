<?php

require_once get_template_directory() . '/inc/customizer-embeds-manager.php';

$elements = array(
    'bootstrap' => array(
        'label' => 'Bootstrap',
        'styles' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',
        'scripts' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js'
    ),
    'fontawesome' => array(
        'label' => 'FontAwesome',
        'styles' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    ),
    'simplelineicons' => array(
        'label' => 'Simple Line Icons',
        'styles' => 'https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css',
    )
);

new MG_Embed_Manager( $elements );
