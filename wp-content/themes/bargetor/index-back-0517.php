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
    	<?php get_header(); ?>
    	<div class="banner">
			<div class="banner-mask">
				<div class="container text-center banner-readme">
					<p class="readme-hi">HI,我是<span class="banner-readme-name"> Bargetor</span></p>
					<p>偶尔修修电脑的<span class="banner-readme-job"> UI/UE </span>设计师</p>
					<p>时刻因价值而感动</p>
						 
					<!-- 
					<div class="col-xs-9 col-sm-9 col-md-9 col-xm-offset-2 col-sm-offset-2 col-md-offset-3 readme-hi"><p>HI,我是<span class="banner-readme-name"> Bargetor</span></p></div>
					<div class="col-xs-9 col-sm-9 col-md-9 col-xm-offset-2 col-sm-offset-2 col-md-offset-3"><p>偶尔修修电脑的<span class="banner-readme-job"> UI/UE </span>设计师</p></div>
					<div class="col-xs-9 col-sm-9 col-md-9 col-xm-offset-2 col-sm-offset-2 col-md-offset-3"><p>时刻因价值而感动</p></div>
					 -->
				</div>
			</div>
		</div>
		<div class="content">
			<!-- 
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 home-product jian-jiao">
					<a href="<?php the_permalink();?>">
						<div class="home-product-background">
							<img src="<?php bloginfo('template_url');?>/images/jian-jiao-upper.png" class="home-product-upper"></img>
						</div>
						<div class="home-product-detail">
							<p class="detail-product-type">IPHONE APP</p>
							<p class="detail-product-line">-</p>
							<p class="detail-product-name">《缄·娇》</p>
						</div>
					</a>
				</div>
				
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 home-product xin">
					<a href="<?php the_permalink();?>">
						<div  class="home-product-background">
							<img src="<?php bloginfo('template_url');?>/images/xin-upper.png" class="home-product-upper"></img>
						</div>
						<div class="home-product-detail">
							<p class="detail-product-type">IPHONE APP</p>
							<p class="detail-product-line">-</p>
							<p class="detail-product-name">《缄·昕》</p>
						</div>
					</a>
				</div>
			<div class="row">
			</div>
			
			<div class="row">
			</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 home-product bargetor">
					<a href="<?php the_permalink();?>">
					<div class="home-product-background">
						<img src="<?php bloginfo('template_url');?>/images/bargetor-website-upper.png" class="home-product-upper"></img>
					</div>
					<div class="home-product-detail">
						<p class="detail-product-type">WEB</p>
						<p class="detail-product-line">-</p>
						<p class="detail-product-name">个人网站</p>
					</div>
					</a>
				</div>
			 -->
				<!--<?php 
			if(have_posts()) : 
				while(have_posts()) :
					the_post();
					?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 home-product jian-jiao">
						<a href="<?php the_permalink();?>">
							<div class="home-product-background">
								<img src="<?php bloginfo('template_url');?>/images/jian-jiao-upper.png" class="home-product-upper"></img>
							</div>
							<div class="home-product-detail">
								<p class="detail-product-type">IPHONE APP</p>
								<p class="detail-product-line">-</p>
								<p class="detail-product-name">《缄·娇》</p>
							</div>
						</a>
					</div>
					<?php 
				endwhile;
			endif;
			?>-->
		</div>
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>

