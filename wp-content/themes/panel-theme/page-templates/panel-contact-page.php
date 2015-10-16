<?php
/**
 * Template Name: Panel Contact Page
 */
get_header(); 
?>

<div class="page_title_block">
            	<div class="container">
                    <h1 class="title"><?php the_title();?></h1>
                </div>
            </div>        
        <div class="container">
			<div class="content_block no-sidebar row">
                    <div class="fl-container span12">
                        <div class="row">
                            <div class="posts-block span12">
                                <div class="contentarea">
                                    
                                    <div class="row-fluid">
                                        
			
			<?php while ( have_posts() ) : the_post(); 
				the_content();
			 endwhile; ?>
			 </div><!-- .row-fluid -->
<!-- .module_line_trigger -->

                                    
                                                                    
                                </div><!-- .contentarea -->
                            </div>
                            <div class="left-sidebar-block span3">
                               
                            </div><!-- .left-sidebar -->
                        </div>
                        <div class="clear"><!-- ClearFix --></div>
                    </div><!-- .fl-container -->
                    <div class="right-sidebar-block span3">
                        <aside class="sidebar">
                        </aside>
                    </div><!-- .right-sidebar -->
                    <div class="clear"><!-- ClearFix --></div>
                </div>

		</div><!-- .container -->
<?php
get_footer();
