( function( $ ) {
"use strict";
wp.customize( 'team_link_color', function( value ) {
value.bind( function( to ) {
$( 'a' ).css( 'color', to );
} );
} );
wp.customize( 'team_header_color', function( value ) {
value.bind( function( to ) {
$( 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a' ).css( 'color', to );
} );
} );
wp.customize( 'team_header_font', function( value ) {
value.bind( function( to ) {
$( 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a' ).css( 'font-family', to );
} );
} );
} )( jQuery );