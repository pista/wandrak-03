<?php get_header(); ?>

<script type="text/javascript">
    $(function() {
    	var controlsWidthAdd = 82;
    	var itemsPerPage = Math.floor(($("#carousel_holder").width() - controlsWidthAdd) / $("#carousel li").outerWidth());
    	$("<style type='text/css'> .carousel-wrap { width: " + (itemsPerPage * $("#carousel li").outerWidth()) + "px; } </style>").appendTo("head");
        $("#carousel").carousel( { dispItems: itemsPerPage } );
    	$("#carousel").width(
    		$("#carousel .carousel-wrap").outerWidth() + controlsWidthAdd);
    });
</script>
	
		<div id="container">	
			<div id="content">
		
		<div id="carousel_holder">
			<div id="carousel">
<ul id="locations">

<?php while ( have_posts() ) : the_post() ?>
<li data-kml="<?php if (get_post_custom_values('kml')) { $myKml = get_post_custom_values('kml'); echo $myKml[0]; } ?>">
		
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'wandrak-02'), the_title_attribute('echo=0') ); ?>">
				<?php printf( __('Permalink to %s', 'wandrak-02'), the_title_attribute('echo=0') ); ?>
			</a>
		</h2>
		
		<div class="entry-meta">
				
				<span class="post-month"><?php the_time('M') ?></span>
				<span class="post-day"><?php the_time('d') ?></span>
				
				<div class="longdesc"><?php the_content( __('Continue Reading &rarr;','wandrak-02' ) ); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'wandrak-02' ) . '&after=</div>') ?></div>
		</div><!-- .entry-meta -->
</li>

<!-- #entry-content -->


				
<?php comments_template(); ?>
	
<?php endwhile; ?>		

</ul>
</div>
</div>
<div id="more-info">
					<h2 class="preview"></h2>
					<div class="excerpt"></div>
</div>			
			</div><!-- #content -->		
		</div><!-- #container -->

		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>
