<?php
/**
 * Template Name: Panel Home Page
 */
function header_style(){ ?>

<style>
			p.small {
				<!-- font-variant: small-caps; -->
				font-face:verdana;
				font-size:17px;
				text-align:center;
				<!-- color: #009933; -->
				
				}
		</style>
<?php }
add_action('wp_head','header_style');
get_header(); 
?>
<div class="container">
	<div class="content_block no-sidebar row">
        <div class="fl-container span12">
            <div class="row">
                <div class="posts-block span12">
                    <div class="contentarea">
						<div class="row-fluid">                                
                                        <div class="span12 module_cont module_revolution_slider first-module">
                                            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/theme-js/jquery.themepunch.plugins.min.js"></script>
                                            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/theme-js/jquery.themepunch.revolution.min.js"></script>
                                            <div class="rs-fullscreen">
                                                <div class="fullwidthbanner-container" >
                                                    <div class="fullwidthbanner" >
                                                        <ul>
															    
                                                            <!-- THE FIRST SLIDE -->
                                                            <li data-masterspeed="400" data-slotamount="7" data-transition="fade">
                                                                <img src="<?php echo get_template_directory_uri(); ?>/img/slider/slide1f.jpg" alt="">
                                                                <!-- THE CAPTIONS OF THE FIRST SLIDE -->   
                                                                <div class="caption lfl ltl start"
                                                                     data-x="525"
                                                                     data-y="80"
                                                                     data-endeasing="easeInOutBack" 
                                                                     data-endspeed="1000" 
                                                                     data-end="6500" 
                                                                     data-easing="easeInOutBack" 
                                                                     data-start="500" 
                                                                     data-speed="1000"><img src="<?php echo get_template_directory_uri(); ?>/img/slider/ls1_img1.png" alt="Image 4">
																</div>    
                                                            </li>
                                        
                                                            <!-- THE SECOND SLIDE -->
                                                            <li data-masterspeed="400" data-slotamount="7" data-transition="fade">
                                                                <img src="<?php echo get_template_directory_uri(); ?>/img/slider/slide2f.jpg" alt="">
                                                                <div class="caption lfl ltl start"
                                                                     data-x="366"
                                                                     data-y="40"
                                                                     data-endeasing="easeInOutBack" 
                                                                     data-endspeed="1000" 
                                                                     data-end="6500" 
                                                                     data-easing="easeInOutBack" 
                                                                     data-start="500" 
                                                                     data-speed="1000"><img src="<?php echo get_template_directory_uri(); ?>/img/slider/ls2_img1.png" alt="Image 1">
																</div>              
                                                            </li>

                                                            <!-- THE THIRD SLIDE -->
                                                            <li data-masterspeed="400" data-slotamount="7" data-transition="fade">
                                                                <img src="<?php echo get_template_directory_uri(); ?>/img/slider/slide3f.jpg" alt="">
                                                                <div class="caption lfl ltl start"
                                                                     data-x="350"
                                                                     data-y="40"
                                                                     data-endeasing="easeInOutBack" 
                                                                     data-endspeed="1000" 
                                                                     data-end="6500" 
                                                                     data-easing="easeInOutBack" 
                                                                     data-start="500" 
                                                                     data-speed="1000"><img src="<?php echo get_template_directory_uri(); ?>/img/slider/ls2_img1.png" alt="Image 1">
																</div>              
                                                            </li>
															
															<!-- THE FOURTH SLIDE -->
															
                                                            <li data-masterspeed="400" data-slotamount="7" data-transition="fade">
                                                                <img src="<?php echo get_template_directory_uri(); ?>/img/slider/slide4f.jpg" alt="">
                                                                
																<div class="caption lfr start"
                                                                     data-x="30"
                                                                     data-y="20"
                                                                     data-easing="easeInOutBack" 
                                                                     data-start="500" 
                                                                     data-speed="1000"><img src="<?php echo get_template_directory_uri(); ?>/img/slider/ls4_img2.png" alt="Image 1"></div>
                                                                <div class="caption lfr start"
																	data-x="109" 
																	data-y="47" 
																	data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:5;scaleY:5;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
																	data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
																	data-speed="600"
																	data-start="1000"
																	data-easing="easeInOutBack"
																	data-endspeed="500"
																	data-endeasing="Power4.easeOut"
																	data-autoplay="false"
																	data-autoplayonlyfirsttime="false"
																	style="z-index: 8"><iframe width="560" height="315" src="http://www.youtube.com/embed/AbN0oZcupm4" frameborder="0" allowfullscreen></iframe> 
																</div>      
                                                                
																
																
																<!-- <div class="caption lfr start"
                                                                    data-autoplay="false" 
                                                                    data-x="109" 
                                                                    data-y="47" 
                                                                    data-easing="easeInOutBack" 
                                                                    data-start="500" 
                                                                    data-speed="1000"> <iframe width="560" height="315" src="http://www.youtube.com/embed/AbN0oZcupm4" frameborder="0" allowfullscreen></iframe>
																</div> -->
																
																<div class="caption lfl ltl start"
                                                                     data-x="750"
                                                                     data-y="40"
                                                                     data-endeasing="easeInOutBack" 
                                                                     data-endspeed="1000" 
                                                                     data-end="16500" 
                                                                     data-easing="easeInOutBack" 
                                                                     data-start="1750" 
                                                                     data-speed="1000"><img src="<?php echo get_template_directory_uri(); ?>/img/slider/ls4_img1.png" alt="Image 1">
																</div>
                                                                
                                                            </li>
                                                        </ul>
                                                        <div class="tp-bannertimer tp-bottom"></div>
													</div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                //var tpj=jQuery;
                                                //$.noConflict();
												//<![CDATA[
                                                $(document).ready(function() {
                                                    $('.rs-fullscreen').css('margin-left' , -1*($(window).width()-$('.container').width())/2+'px').width($(window).width());														
                                                    if ($.fn.cssOriginal!=undefined)
                                                        $.fn.css = $.fn.cssOriginal;                                                
                                                    var api = $('.fullwidthbanner').revolution({
                                                        delay:7000,
                                                        startheight:450,
                                                        startwidth:1230,
                                                        hideThumbs:200,
                                                        thumbWidth:100,	// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                                                        thumbHeight:50,
                                                        thumbAmount:5,
                                                        navigationType:"none",	//bullet, thumb, none, both (No Thumbs In FullWidth Version !)
                                                        navigationArrows:"verticalcentered",	//nexttobullets, verticalcentered, none
                                                        navigationStyle:"round",	//round,square,navbar
                                                        touchenabled:"on",	// Enable Swipe Function : on/off
                                                        onHoverStop:"on",	// Stop Banner Timet at Hover on Slide on/off
                                                        navOffsetHorizontal:0,
                                                        navOffsetVertical:20,
                                                        stopAtSlide:-1,	// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                                                        stopAfterLoops:-1,	// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
                                                        hideCaptionAtLimit:0,	// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                                                        hideAllCaptionAtLilmit:0,	// Hide all The Captions if Width of Browser is less then this value
                                                        hideSliderAtLimit:0,	// Hide the whole slider, and stop also functions if Width of Browser is less than this value
                                                        shadow:0,	//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                                                        fullWidth:"on"	// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
                                                    });
                                                });
												//]]
                                            </script>
                                            
                                        </div><!--.module_cont -->
										                                                                    
									</div><!-- .row-fluid -->					
			<?php while ( have_posts() ) : the_post(); 
				the_content();
			 endwhile; ?>
								</div>
                        <div class="clear"><!-- ClearFix --></div>
                    </div>
                </div>	
				
		</div><!-- .container -->
<?php
get_footer();
