<?php
/**
 * Template Name: Panel Page
 */
function header_custom_script(){ 
	wp_enqueue_script( 'validation-script', get_template_directory_uri().'/theme-js/validation.js', array(), '1.0.0', true );
}

add_action('wp_head','header_custom_script');
get_header(); 
?>

<div class="page_title_block">
            	<div class="container">
                    <h1 class="title"><?php the_title();?></h1>
                </div>
            </div>        
        <div class="container">
			<?php while ( have_posts() ) : the_post(); 
				the_content();
			 endwhile; ?>
		</div><!-- .container -->
<?php
get_footer();
