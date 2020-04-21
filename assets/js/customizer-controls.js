/**
 * Customizer Controls JS
 *
 * Adds Javascript for Customizer Controls.
 *
 * @package Tortuga
 */

( function( wp, $ ) {

	// Based on https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
	wp.customize( 'custom_logo', function( setting ) {
		setting.bind( function( value ) { 
			if ( '' !== value ) {
				// Set retina logo option to false when a new logo image is uploaded.
				wp.customize.instance( 'tortuga_theme_options[retina_logo]' ).set( false );
			}
		});

		var setupControl = function( control ) {
			var setActiveState, isDisplayed;
			isDisplayed = function() {
				return '' !== setting.get();
			};
			setActiveState = function() {
				control.active.set( isDisplayed() );
			};
			setActiveState();
			setting.bind( setActiveState );
			control.active.validate = isDisplayed;
		};
		wp.customize.control( 'tortuga_theme_options[retina_logo_title]', setupControl );
		wp.customize.control( 'tortuga_theme_options[retina_logo]', setupControl );
	} );

})( this.wp, jQuery );
