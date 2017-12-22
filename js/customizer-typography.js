/**
 * File customizer-typography.js.
 *
 * Theme Customizer typography enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Modified from:
 * https://github.com/justintadlock/customizer-typography/blob/master/js/customize-preview.js
 */
( function( $ ) {
	var elements = [ 'body', 'p', 'h1,h2,h3,h4,h5,h6', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
	$.each( elements, function( i, element ) {
		wp.customize( element + '_font_family', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'font-family', to );
			} );
		} );
		wp.customize( element + '_font_size', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'font-size', to + 'px' );
			} );
		} );
		wp.customize( element + '_font_weight', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'font-weight', to );
			} );
		} );
		wp.customize( element + '_font_style', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'font-style', to );
			} );
		} );
		wp.customize( element + '_line_height', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'line-height', to );
			} );
		} );
		wp.customize( element + '_text_decoration', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'text-decoration', to );
			} );
		} );
		wp.customize( element + '_text_transform', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'text-transform', to );
			} );
		} );
		wp.customize( element + '_color', function( value ) {
			value.bind( function( to ) {
				$( element ).css( 'color', to );
			} );
		} );
	} );
} )( jQuery );
