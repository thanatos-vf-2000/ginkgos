jQuery( document ).ready( function( $ ) {

	/**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy on scroll event listener 
   */
   const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

	// Toggle mobile-menu
	$( ".nav-toggle" ).on( "click", function() {
		$( this ).toggleClass( "active" );
		$( ".mobile-menu" ).slideToggle();
		if ( $( ".search-toggle" ).hasClass( "active" ) ) {
			$( ".search-toggle" ).removeClass( "active" );
			$( ".mobile-search" ).slideToggle();
		}
		return false;
	} );

	// Toggle mobile-search
	$( ".search-toggle" ).on( "click", function() {
		$( this ).toggleClass( "active" );
		$( ".mobile-search" ).slideToggle();
		if ( $( ".nav-toggle" ).hasClass( "active" ) ) {
			$( ".nav-toggle" ).removeClass( "active" );
			$( ".mobile-menu" ).slideToggle();
		}
		return false;
	} );

	// Hide/show mobile menu/search block > 900
	$( window ).resize( function() {
		if ( $( window ).width() > 1000 ) {
			$( ".toggle" ).removeClass( "active" );
			$( ".mobile-menu" ).hide();
			$( ".mobile-search" ).hide();
		}
	} );

	// Dropdown menus on touch devices
	$( '.main-menu li.menu-item-has-children' ).doubleTapToGo();

	// Display dropdown menus on focus.
	$( '.main-menu a' ).on( 'blur focus', function( e ) {
		$( this ).parents( 'li.menu-item-has-children' ).toggleClass( 'focus' );
	} );

	// Resize videos after container
	var vidSelector = ".post iframe, .post object, .post video, .widget-content iframe, .widget-content object, .widget-content iframe";
	var resizeVideo = function( sSel ) {
		$( sSel ).each( function() {
			var $video = $( this ),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( ! $video.attr( "data-origwidth" ) ) {
				$video.attr( "data-origwidth", $video.attr( "width" ) );
				$video.attr( "data-origheight", $video.attr( "height" ) );
			}

			var ratio = iTargetWidth / $video.attr( "data-origwidth" );

			$video.css( "width", iTargetWidth + "px" );
			$video.css( "height", ( $video.attr( "data-origheight" ) * ratio ) + "px" );
		});
	};

	resizeVideo( vidSelector );

	$( window ).resize( function() {
		resizeVideo( vidSelector );
	} );

	// When Jetpack Infinite scroll posts have loaded
	$( document.body ).on( 'post-load', function() {

		var $container = $( '.posts' );
		$container.masonry( 'reloadItems' );

		$blocks.imagesLoaded( function() {
			$blocks.masonry({
				itemSelector: '.post-container'
			} );

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$( ".post-container" ).fadeIn();
		} );

		// Rerun video resizing
		resizeVideo( vidSelector );

		$container.masonry( 'reloadItems' );

		// Load Flexslider
		$( ".flexslider" ).flexslider( {
			animation: 		"slide",
			controlNav: 	false,
			nextText: 		"Next",
			prevText: 		"Previous",
			smoothHeight: 	true
		} );

		$( document ).ready( function() {
			setTimeout( function() {
				$blocks.masonry();
			}, 500 );
		} );

	} );

	/**
   * Header fixed top on scroll
   */
	 let selectHeader = select('#navigation')
	 if (selectHeader) {
	   let headerOffset = selectHeader.offsetTop
	   let nextElement = selectHeader.nextElementSibling
	   const headerFixed = () => {
		 if ((headerOffset - window.scrollY) <= 0) {
		   selectHeader.classList.add('fixed-top')
		   nextElement.classList.add('scrolled-offset')
		 } else {
		   selectHeader.classList.remove('fixed-top')
		   nextElement.classList.remove('scrolled-offset')
		 }
	   }
	   window.addEventListener('load', headerFixed)
	   onscroll(document, headerFixed)
	 }

	  /**
   * Back to top button
   */
	   let selectbacktotop = select('.back-to-top')
	   if (selectbacktotop) {
		 const toggleBacktotop = () => {
		   if (window.scrollY > 100) {
			selectbacktotop.classList.add('active')
		   } else {
			selectbacktotop.classList.remove('active')
		   }
		 }
		 window.addEventListener('load', toggleBacktotop)
		 onscroll(document, toggleBacktotop)
	   }

	/**
 * Progress bar
 */
	 let selectmain = select('#site-content')
	 let selectprogressbar = select('.progressbar')
	 let progressbarbubble = select('.progressbar__bubble')
	 if( selectprogressbar) {
   
	   const RefreshProgressBar = () => {
		 let mainOffset = selectmain.offsetTop;
		 let footerOffset = selectmain.offsetTop +selectmain.offsetHeight;
		 var wm = window.innerHeight - mainOffset
		 if (wm<0) {wm=0}
   
		// Progress percentage
		var w = (window.scrollY+wm) * 100 / (footerOffset-mainOffset)
		if (w<0) {var w=0}
   
		if (window.scrollY > 0) {
		  // After 100%
		  if ((footerOffset-mainOffset) < (window.scrollY+wm)) {
			w=100
			selectprogressbar.classList.add('progressbar--completed')
		  } else {
			selectprogressbar.classList.remove('progressbar--completed')
		  }
  
		  // Display progress bar and bubble
		  selectprogressbar.style.width = w + '%';
		  if (progressbarbubble) {
			w = Math.round(w);
			progressbarbubble.innerHTML = w+'%';
		  }
		} else {
		  selectprogressbar.style.width = '0%';
		  if (progressbarbubble) {progressbarbubble.innerHTML = '0%';}
		}
  
	  }
	  window.addEventListener('load', RefreshProgressBar)
	  onscroll(document, RefreshProgressBar)
	}
} );
