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
	$(function() {
		function myAdminNotice( msg, type ) {

			/* create notice div */

			var div = document.createElement( 'div' );
			switch (type) {
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

			var p = document.createElement( 'p' );

			/* Add message text */

			p.appendChild( document.createTextNode( msg ) );

			// Optionally add a link here

			/* Add the whole message to notice div */

			div.appendChild( p );

			/* Create Dismiss icon */

			var b = document.createElement( 'button' );
			b.setAttribute( 'type', 'button' );
			b.classList.add( 'notice-dismiss' );

			/* Add screen reader text to Dismiss icon */

			var bSpan = document.createElement( 'span' );
			bSpan.classList.add( 'screen-reader-text' );
			bSpan.appendChild( document.createTextNode( 'Dismiss this notice' ) );
			b.appendChild( bSpan );

			/* Add Dismiss icon to notice */

			div.appendChild( b );

			/* Insert notice after the first h1 */

			var h1 = document.getElementsByTagName( 'h1' )[0];
			h1.parentNode.insertBefore( div, h1.nextSibling);


			/* Make the notice dismissable when the Dismiss icon is clicked */

			b.addEventListener( 'click', function () {
				div.parentNode.removeChild( div );
			});


		}

		$(".wc-action-button-invite").click(function (e) {
			e.preventDefault();
			var urlParams = new URLSearchParams(this.search);
			var nonce = urlParams.get('_wpnonce')
			var action = urlParams.get('action');
			var order_id = urlParams.get('order_id');

			jQuery.ajax({
				type: "post",
				dataType: "json",
				url: this.pathname,
				data: {action: action, order_id: order_id, nonce: nonce},
				success: function (response) {
					if (response.type == "success") {
						myAdminNotice(response.message, 'success');
					} else {
						myAdminNotice('Failed to send. Check wordpress log for details', 'error');
					}
				}
			});
		});
	});

})( jQuery );
