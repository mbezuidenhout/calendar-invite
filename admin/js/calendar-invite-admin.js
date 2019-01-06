(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( function() {
		function myAdminNotice( msg, type ) {
			var div;
			var p;
			var b;
			var bSpan;
			var h1;

			div = document.createElement( 'div' );
			switch ( type ) {
				case 'error':
					div.classList.add( 'notice', 'notice-error' );
					break;
				case 'warning':
					div.classList.add( 'notice', 'notice-warning' );
					break;
				case 'success':
					div.classList.add( 'notice', 'notice-success' );
					break;
				case 'notice':
				default:
					div.classList.add( 'notice', 'notice-info' );
					break;
			}

			/* create paragraph element to hold message */

			p = document.createElement( 'p' );

			/* Add message text */

			p.appendChild( document.createTextNode( msg ) );

			// Optionally add a link here

			/* Add the whole message to notice div */

			div.appendChild( p );

			/* Create Dismiss icon */

			b = document.createElement( 'button' );
			b.setAttribute( 'type', 'button' );
			b.classList.add( 'notice-dismiss' );

			/* Add screen reader text to Dismiss icon */

			bSpan = document.createElement( 'span' );
			bSpan.classList.add( 'screen-reader-text' );
			bSpan.appendChild( document.createTextNode( 'Dismiss this notice' ) );
			b.appendChild( bSpan );

			/* Add Dismiss icon to notice */

			div.appendChild( b );

			/* Insert notice after the first h1 */

			h1 = document.getElementsByTagName( 'h1' )[0];
			h1.parentNode.insertBefore( div, h1.nextSibling );


			/* Make the notice dismissable when the Dismiss icon is clicked */

			b.addEventListener( 'click', function() {
				div.parentNode.removeChild( div );
			});


		}

		$( '.wc-action-button-invite' ).click( function( e ) {
			var urlParams = new URLSearchParams( this.search );
			var nonce = urlParams.get( '_wpnonce' );
			var action = urlParams.get( 'action' );
			var orderId = urlParams.get( 'order_id' );
			e.preventDefault();

			jQuery.ajax({
				type: 'post',
				dataType: 'json',
				url: this.pathname,
				data: { 'action': action, 'order_id': orderId, 'nonce': nonce},
				success: function( response ) {
					if ( 'success' == response.type ) {
						myAdminNotice( response.message, 'success' );
					} else {
						myAdminNotice( response.message, response.type );
					}
				}
			});
		});
	});

})( jQuery );
