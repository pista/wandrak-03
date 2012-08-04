<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'wandrak-02' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'wandrak-02' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	

<!-- JS Google Maps API -->
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/map-init.js" type="text/javascript"></script> -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jcarousel.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/underscore-min.js"></script>

<script type="text/javascript">
  var wnd_ctaLayer = null;

  $(function() {
	
	var europe = new google.maps.LatLng(46.980252,16.54541),
	    pointToMoveTo, 
	    first = true,
	    curMarker = new google.maps.Marker({}),
	    $el;
	
	var myOptions = {
	    zoom: 8,
	    center: europe,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	
	map = new google.maps.Map($("#map_canvas")[0], myOptions);

	// Inside post show kml
	if ($(".wnd_post_data").size() > 0) {
             wnd_ctaLayer = new google.maps.KmlLayer($(".wnd_post_data").data('kml'));
             wnd_ctaLayer.setMap(map);
	}

	// Main page, handle mouse hover
	$("#locations li").mouseenter(function() {

          $el = $(this);
          if (wnd_ctaLayer) {
             wnd_ctaLayer.setMap(null);
          }
          if ($el.data('kml')) {
             wnd_ctaLayer = new google.maps.KmlLayer($el.data('kml'));
             wnd_ctaLayer.setMap(map);
          }

	    $("#more-info")
	      .find("h2")
	        .html($el.find("h2").html())
	        .end()
	      .find(".excerpt")
	        .html($el.find(".longdesc").html());


/*	          
	  if (!$el.hasClass("hover")) {
	  
	    $("#locations li").removeClass("hover");
	    $el.addClass("hover");
	  
	    if (!first) { 
	      
	      // Clear current marker
	      curMarker.setMap(); 
	      
	      // Set zoom back to Chicago level
	      // map.setZoom(10);
	    }
	    
	    // Move (pan) map to new location
	   pointToMoveTo = new google.maps.LatLng($el.attr("data-geo-lat"), $el.attr("data-geo-long"));
	    map.panTo(pointToMoveTo);
	    
	    // Add new marker
	    curMarker = new google.maps.Marker({
	        position: pointToMoveTo,
	        map: map,
	        icon: "images/marker.png"
	    });
	    
	    // On click, zoom map
	    google.maps.event.addListener(curMarker, 'click', function() {
	       map.setZoom(14);
	    });
	    
	    // Fill more info area
	    $("#more-info")
	      .find("h2")
	        .html($el.find("h2").html())
	        .end()
	      .find(".excerpt")
	        .html($el.find(".longdesc").html());
	    
	    // No longer the first time through (re: marker clearing)        
	    first = false; 
	  }
*/	  
	});
	
	$("#locations li:first").trigger("mouseenter");
	if (typeof onReadyLocal == 'function') {
		onReadyLocal();
	}
  });

</script>


<!-- Google Webfonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:800|Neuton:400,400italic&subset=latin-ext' rel='stylesheet' type='text/css'>
</head>
<div id="background">
	  <div id="map_canvas" style="width:100%; height:100%;"></div>
</div>
<body <?php body_class(); ?>>	
<div id="wrapper" class="hfeed">
		<div id="header">
		<div id="masthead">
		
			<div id="branding">
				<div id="blog-title"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span></div>
<?php if ( is_home() || is_front_page() ) { ?>
		    		<h1 id="blog-description"><?php bloginfo( 'description' ) ?></h1>
<?php } else { ?>	
		    		<div id="blog-description"><?php bloginfo( 'description' ) ?></div>
<?php } ?>
			</div><!-- #branding -->
			
			<div id="access">
				<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'wandrak-02' ) ?>"><?php _e( 'Skip to content', 'wandrak-02' ) ?></a></div>
				<?php wp_page_menu( 'sort_column=menu_order' ); ?>			
			</div><!-- #access -->

			<div id="editorTools">
				<input type="button" value="Add poi" class="add_poi_button"/>
			</div>
			
		</div><!-- #masthead -->	
	</div><!-- #header -->

	<div id="main">
