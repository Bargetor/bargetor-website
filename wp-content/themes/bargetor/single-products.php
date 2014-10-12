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

    	<script src="<?php bloginfo('template_url');?>/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/product.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/jquery.powertimer.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/bargetor-tree.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/highcharts.js" type="text/javascript">
<!--

//-->
</script>
    	
    	<?php 
    	if (is_post_meta_show_background_img(get_the_ID())):
    	?>
    	
    	<div class="banner-single" style="background-image: url('<?php the_post_meta_background_img(get_the_ID()); ?>');">
    	<?php else:?>
    	<div class="banner-single">
    	<?php endif;?>
    			<ul class="single-bar product-navigation-bar">
    				<li id="bar-data-analysis">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-data-analysis">
							</p>
							<p>数据分析</p>
						</a>
					</li>
					<li id="bar-item-role-model">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-role-model">
							</p>
							<p>角色模型</p>
						</a>
					</li>
					<li id="bar-item-information-architecture">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-information-architecture">
							</p>
							<p>信息架构</p>
						</a>
					</li>
					<li id="bar-item-sketch">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-sketch">
							</p>
							<p>草图原型</p>
						</a>
					</li>
					<li id="bar-item-visual-design">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-visual-design"></p>
							<p>视觉设计</p>
						</a>
					</li>
					<li id="bar-item-interactive-design">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-interactive-design">
							</p>
							<p>交互设计</p>
						</a>
					</li>
					<li id="bar-item-video">
						<a href="javascript:void(0);" class="single-bar-item product-navigation-bar-item">
							<p class="single-bar-icon product-nav-bar-icon icon-video">
							</p>
							<p>思路演说</p>
						</a>
					</li>
				</ul>
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