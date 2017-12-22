<?php
class MG_Typography_Manager {
    protected $panels = array(
        'mg_typography' => array(
            'title' => 'Typography',
            'priority' => 31
        )
    );
    protected $elements = array();

    public function __construct( $elements ) {
        $this->elements = $elements;
        $this->register_actions();
    }

    protected function register_actions() {
        add_action( 'customize_register', array( $this, 'register_controls' ) );
        add_action( 'wp_head', array( $this, 'print_styles' ) );
        add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
    }

    public function register_controls( $wp_customize ) {
        if ( ! isset( $wp_customize ) ) {
			return;
		}

        $this->add_panels( $wp_customize );
        $this->add_elements( $wp_customize );
    }

    protected function add_panels( $wp_customize ) {
        foreach( $this->panels as $panel_name => $panel_options ) {
            $wp_customize->add_panel( $panel_name, $panel_options );
        }
    }

    protected function add_elements( $wp_customize ) {
        foreach( $this->elements as $element => $label ) {
            $this->add_element( $wp_customize, array(
                'description' => 'Typography settings for the ' . $label . ' element',
                'element' => $element,
                'label' => $label . ' typography',
                'panel' => 'mg_typography', // TODO: make dynamic
                'section' => $element . '_typography',
                'title' => $label . ' typography'
            ) );
        }
    }

    protected function add_element( $wp_customize, $args = array() ) {
        $defaults = array(
            'description' => '',
            'element' => '',
            'label' => '',
            'panel' => '',
            'section' => '',
            'title' => ''
        );
        $args = wp_parse_args( $args, $defaults );
        // add the section
        $wp_customize->add_section( $args['section'], array(
    		'panel' => $args['panel'],
    		'title' => $args['title']
    	) );
        // add the settings
        // Font Family
    	$wp_customize->add_setting( $args['element'] . '_font_family', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Font size
    	$wp_customize->add_setting( $args['element'] . '_font_size', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Font weight
    	$wp_customize->add_setting( $args['element'] . '_font_weight', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Font style
    	$wp_customize->add_setting( $args['element'] . '_font_style', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Line height
    	$wp_customize->add_setting( $args['element'] . '_line_height', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Text Decoration
    	$wp_customize->add_setting( $args['element'] . '_text_decoration', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Text Transform
    	$wp_customize->add_setting( $args['element'] . '_text_transform', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // Color
    	$wp_customize->add_setting( $args['element'] . '_color', array(
    		'default' => '',
    		'transport' => 'postMessage'
    	) );
        // add the controls
        require_once get_template_directory() . '/inc/customizer-typography-control.php';
    	$wp_customize->add_control( new MG_Customize_Typography(
    		$wp_customize,
    		$args['element'] . '_typography',
    		array(
    			'label' => $args['label'],
    			'description' => $args['description'],
    			'section' => $args['section'],
    			'settings' => array(
    				'family' => $args['element'] . '_font_family',
    				'size' => $args['element'] . '_font_size',
    				'weight' => $args['element'] . '_font_weight',
    				'style' => $args['element'] . '_font_style',
    				'line_height' => $args['element'] . '_line_height',
    				'text_decoration' => $args['element'] . '_text_decoration',
    				'text_transform' => $args['element'] . '_text_transform',
    			)
    		)
    	) );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $args['element'] . '_color',
            array(
                'label'=> 'Color',
                'section' => $args['section'],
                'setting' => $args['element'] . '_color'
            )
        ) );
    }

    public function print_styles() {
    	$style = array();

    	foreach( $this->elements as $element => $label ) {
    		$_style = '';
    		$e_family = get_theme_mod( $element . '_font_family', '' );
    		$e_weight = get_theme_mod( $element . '_font_weight', '' );
    		$e_style = get_theme_mod( $element . '_font_style', '' );
    		$e_size = get_theme_mod( $element . '_font_size', '' );
    		$e_size_unit = get_theme_mod( $element . '_font_size_unit', '' );
    		$e_line_height = get_theme_mod( $element . '_line_height', '' );
    		$e_text_decoration = get_theme_mod( $element . '_text_decoration', '' );
    		$e_text_transform = get_theme_mod( $element . '_text_transform', '' );
    		$e_color = get_theme_mod( $element . '_color', '' );

    		if ( $e_family ) {
    			$_style .= sprintf( "font-family: '%s';", esc_attr( $e_family ) );
    		}
    		if ( $e_weight ) {
    			$_style .= sprintf( "font-weight: %s;", esc_attr( $e_weight ) );
    		}
    		if ( $e_style ) {
    			$_style .= sprintf( "font-style: '%s';", esc_attr( $e_style ) );
    		}
    		if ( $e_size ) {
    			$_style .= sprintf( "font-size: %spx;", esc_attr( $e_size ) );
    		}
    		if ( $e_line_height ) {
    			$_style .= sprintf( "line-height: %s;", esc_attr( $e_line_height ) );
    		}
    		if ( $e_text_decoration ) {
    			$_style .= sprintf( "text-decoration: %s;", esc_attr( $e_text_decoration ) );
    		}
    		if ( $e_text_transform ) {
    			$_style .= sprintf( "text-transform: %s;", esc_attr( $e_text_transform ) );
    		}
    		if ( $e_color ) {
    			$_style .= sprintf( "color: %s;", esc_attr( $e_color ) );
    		}

    		if ( $_style ) {
    			$style[] = sprintf( '%s { %s }', $element, $_style );
    		}
    	}

    	$style = join( '', $style );

    	if ( $style ) {
    		echo "\n" . '<style type="text/css" id="mg-typography-css">' . $style . '</style>' . "\n";
    	}
    }

    public function customize_preview_js() {
        wp_enqueue_script( 'mg-starter-theme-customizer', get_template_directory_uri() . '/js/customizer-typography.js', array( 'customize-preview' ), '20171222', true );
    }
}
