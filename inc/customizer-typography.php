<?php

require_once get_template_directory() . '/inc/customizer-typography-manager.php';

$elements = array(
    'body' => 'Body',
    'p' => 'Paragraph',
    'h1,h2,h3,h4,h5,h6' => 'All Headings',
    'h1' => 'Heading 1',
    'h2' => 'Heading 2',
    'h3' => 'Heading 3',
    'h4' => 'Heading 4',
    'h5' => 'Heading 5',
    'h6' => 'Heading 6'
);

new MG_Typography_Manager( $elements );
