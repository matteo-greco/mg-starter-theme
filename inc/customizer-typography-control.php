<?php
class MG_Customize_Typography extends WP_Customize_Control {
    public $type = 'typography';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );

        $defaults = array(
            'family' => '',
            'size' => '',
            'weight' => '',
            'style' => '',
            'line_height' => '',
            'text_decoration' => '',
            'text_transform' => '',
        );
        $args = wp_parse_args( $args, $defaults );

        $this->family = $args['family'];
        $this->size = $args['size'];
        $this->weight = $args['weight'];
        $this->style = $args['style'];
        $this->line_height = $args['line_height'];
        $this->text_decoration = $args['text_decoration'];
        $this->text_transform = $args['text_transform'];
    }

    private function get_font_family_options() {
        return array(
            'Arial' => 'Arial',
			'Georgia' => 'Georgia',
            'Times New Roman' => 'Times New Roman',
            'Verdana' => 'Verdana',
        );
    }

    private function get_font_weight_options() {
        return array(
			'100' => 'Thin',
			'300' => 'Light',
			'400' => 'Normal',
			'500' => 'Medium',
			'700' => 'Bold',
			'900' => 'Ultra Bold',
		);
    }

    private function get_font_style_options() {
        return array(
			'normal' => 'Normal',
			'italic' => 'Italic',
			'oblique' => 'Oblique',
		);
    }

    private function get_font_decoration_options() {
        return array(
            'none' => 'None',
            'underline' => 'Underline',
            'underline dotted' => 'Dotted underline',
        );
    }

    private function get_font_transform_options() {
        return array(
            'none' => 'None',
            'uppercase' => 'Uppercase',
            'lowercase' => 'Lowercase',
            'capitalize' => 'Capitalize',
            'full-width' => 'Full Width',
        );
    }

    private function select_helper( $name, $options ) {
        ?>
        <select <?php echo $this->link( $name ); ?>>
            <option value=""></option>
        <?php foreach( $options as $choice => $label ): ?>
            <option value="<?php echo $choice; ?>" <?php if( $choice == $this->value( $name ) ): ?>selected="selected"<?php endif; ?>><?php echo $label; ?></option>
        <?php endforeach; ?>
        </select>
        <?php
    }

    public function render_content() {
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <label>
            <span class="customize-control-title">Family</span>
            <?php $this->select_helper( 'family', $this->get_font_family_options() ); ?>

            <span class="customize-control-title">Size (px)</span>
            <input type="number" min="0" value="<?php echo esc_attr( $this->value( 'size' ) ); ?>" <?php $this->link( 'size' ); ?>>

            <span class="customize-control-title">Weight</span>
            <?php $this->select_helper( 'weight', $this->get_font_weight_options() ); ?>

            <span class="customize-control-title">Style</span>
            <?php $this->select_helper( 'style', $this->get_font_style_options() ); ?>

            <span class="customize-control-title">Line Height (multiplier)</span>
            <input type="number" min="0" step="0.1" value="<?php echo esc_attr( $this->value( 'line_height' ) ); ?>" <?php $this->link( 'line_height' ); ?>>

            <span class="customize-control-title">Text Decoration</span>
            <?php $this->select_helper( 'text_decoration', $this->get_font_decoration_options() ); ?>

            <span class="customize-control-title">Text Transform</span>
            <?php $this->select_helper( 'text_transform', $this->get_font_transform_options() ); ?>
        </label>
        <?php
    }
}
