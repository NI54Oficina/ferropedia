( function ( $ ) {

	$( document ).ready( function () {
		
		$( '.rating2' ).raty2( {
			starType	: 'i' ,
			numberMax	: 4,
			number		: 4 ,
			path		: post_ratings.path,
			// half		: true,
			score		: function( ) {
				return $( this ).data( 'rating' );
			},
			readOnly	: function( ) {
				return $( this ).data( 'readonly' );
			},
			click		: function( score, event ) {
				
				var blocks = $( '.post-ratings2[data-post="' + $( this ).data( 'post' ) + '"]' );
				console.log("entra rate 2 envio");
				$.ajax( {
					url			: post_ratings.ajaxURL,
					type		: 'GET',
					dataType	: 'json',
					context		: this,
					data: ( {
						action		: 'rate_post2',
						nonce		: post_ratings.nonce,
						post_id		: $( this ).data( 'post' ),
						rate		: score
					} ),
					beforeSend: function () {
						blocks.removeClass( 'error' ).addClass( 'loading' );
					},
					error: function ( response ) {
						blocks.addClass( 'error' );
					},
					success: function ( response ) {
						
						// we have an error, display it
						if ( response.error ) {
							blocks.addClass( 'error' ).find( '.rating-meta' ).html( response.error );
							return;
						}
						
						// no error, replace the control html with the new one
						blocks.find( '.rating-meta' ).html( response.html  );
						
						// update rating and readonly status, reload block
						blocks.find( '.rating' ).raty2( 'set', { readOnly: true } );
						blocks.find( '.rating' ).raty2( 'set', { score: score } ); 
						blocks.find( '.rating' ).raty2( 'reload' );
						// other plugins can hook into this event.
						// (the response object contains more info than we used here)
						blocks.trigger( 'rated_post', response );
						$("#score4-"+score).text(parseInt($("#score4-"+score).text())+1);
					}
				} );

				return true;
			}
		} );
	
	} );

} )( jQuery );