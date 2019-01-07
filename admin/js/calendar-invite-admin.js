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


			/* Make the notice dismissible when the Dismiss icon is clicked */

			b.addEventListener( 'click', function() {
				div.parentNode.removeChild( div );
			});


		}

		function refreshImage( imageId ) {
			var data = {
				action: 'myprefix_get_image',
				id: imageId
			};

			jQuery.get(ajaxurl, data, function( response ) {

				if ( true === response.success ) {
					jQuery( '#calendar-invite-preview-image' ).replaceWith( response.data.image );
				}
			});
		}

		$( 'input#calendar-invite_media_manager' ).click( function( e ) {
			var imageFrame;

			e.preventDefault();
			if ( imageFrame ) {
				imageFrame.open();
			}

			// Define image_frame as wp.media object
			imageFrame = wp.media({
				title: 'Select Media',
				multiple: false,
				library: {
					type: 'image',
				}
			});

			imageFrame.on( 'close', function() {

				// On close, get selections and save to the hidden input
				// plus other AJAX stuff to refresh the image preview
				var selection =  imageFrame.state().get( 'selection' );
				var galleryIds = new Array();
				var myIndex = 0;
				var ids;
				selection.each( function( attachment ) {
					galleryIds[myIndex] = attachment['id'];
					myIndex++;
				});
				ids = galleryIds.join( ',' );
				jQuery( 'input#calendar-invite_image_id' ).val( ids );
				refreshImage( ids );
			});

			imageFrame.on( 'open', function() {
				var ids;

				// On open, get the id from the hidden input
				// and select the appropriate images in the media manager
				var selection =  imageFrame.state().get( 'selection' );
				ids = jQuery( 'input#calendar-invite_image_id' ).val().split( ',' );
				ids.forEach( function( id ) {
					var attachment;
					attachment = wp.media.attachment( id );
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : []);
				});

			});

			imageFrame.open();
		});

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
					debugger;
					if ( 'success' == response.success ) {
						myAdminNotice( response.data.message, 'success' );
					} else {
						myAdminNotice( response.data.message, response.data.type );
					}
				}
			});
		});
	});

})( jQuery );
