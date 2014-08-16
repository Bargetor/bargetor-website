<?php
/**
 * The main template file
 *
 * This is the bargetor template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://www.bargetor.com
 *
 * @package bargetor
 * @subpackage bargetor
 * @since bargetor 1.0
 */

?>

    	
    	<div class="banner-single">
			<div class="banner-mask-single">
				<div class="container text-center banner-about-single">
					<p class="about-title"><?php the_title();?></p>
					<div class="meta-single">
						<div class="meta-single-item single-type">
							<ul>
								<li><span><?php the_product_post_cat_name(get_the_category());?></span></li>
							</ul>
						</div>
						<div class="meta-single-item single-date">
							<ul>
								<li><span><?php the_date('Y-m-d');?></span></li>
							</ul>							
						</div>
					</div>
					<p class="about-description"><?php the_post_sub_title(get_the_ID());?></p>
				</div>
				<?php include TEMPLATEPATH . '/single-share.php';?>
			</div>
		</div>
		
		<div class="content-single">
			<div class="container">
				<div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 single-main">
    				<?php the_content();?>    				
				</div>
			</div>
		</div>