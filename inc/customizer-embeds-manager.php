<?php

class MG_Embed_Manager {
    protected $sections = array(
        'mg_embeds' => array(
            'title'      => 'Embeds',
            'priority'   => 30,
        )
    );

    protected $elements = array();

    public function __construct( $elements ) {
        $this->elements = $elements;
        $this->register_actions();
    }

    protected function register_actions() {
        add_action( 'customize_register', array( $this, 'register_controls' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function register_controls( $wp_customize ) {
        if ( ! isset( $wp_customize ) ) {
			return;
		}

        $this->add_sections( $wp_customize );
        $this->add_elements( $wp_customize );
    }

    protected function add_sections( $wp_customize ) {
        foreach( $this->sections as $section_name => $section_options ) {
            $wp_customize->add_section( $section_name, $section_options );
        }
    }

    protected function add_elements( $wp_customize ) {
        foreach( $this->elements as $element_name => $element_options ) {
            $this->add_element( $wp_customize, array(
                'setting' => 'mg_embeds_' . $element_name,
        		'label' => $element_options['label'],
        		'section' => 'mg_embeds' // TODO: make dynamic
            ) );
        }
    }

    protected function add_element( $wp_customize, $args = array() ) {
        $defaults = array(
            'default' => false,
            'label' => '',
            'section' => '',
            'setting' => '',
        );
        $args = wp_parse_args( $args, $defaults );

        $wp_customize->add_setting( $args['setting'] , array(
    	    'default'     => $args['default'],
    	    'transport'   => 'refresh',
    		'capability' => 'edit_theme_options',
    		'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    	) );
    	$wp_customize->add_control( $args['setting'], array(
    		'type' => 'checkbox',
    		'section' => esc_html__( $args['section'] ),
    		'label' => esc_html__( $args['label'] ),
    	) );
    }

    public function enqueue_scripts() {
        foreach( $this->elements as $element_name => $element_options ) {
            if( get_theme_mod( 'mg_embeds_' . $element_name) ) {
                // styles
                $styles = $element_options['styles'];
                if( is_array($styles) ) {
                    foreach( $styles as $style_name => $style_url ) {
                        wp_enqueue_style( $style_name, $style_url );
                    }
                } else if( $styles != '' ) {
                    wp_enqueue_style( $element_name, $styles );
                }
                // scripts
                $scripts = $element_options['scripts'];
                if( is_array($scripts) ) {
                    foreach( $scripts as $script_name => $script_url ) {
                        wp_enqueue_script( $script_name, $script_url, array( 'jquery' ) );
                    }
                } else if( $scripts != '' ) {
                    wp_enqueue_script( $element_name, $scripts, array( 'jquery' ) );
                }
            }
        }
    }

    /**
     * Sanitize a checkbox input.
     * @param $checked the checkbox input
     * @return true if checkbox input is a valid checkbox value, false otherwise
     */
    public function sanitize_checkbox( $checked ) {
      // Boolean check.
      return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
}
