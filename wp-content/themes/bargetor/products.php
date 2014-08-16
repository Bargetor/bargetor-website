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

 include_once TEMPLATEPATH . '/post-function.php';

?>
    	<?php get_header(); ?>
    	<div class="banner-products">
			<div class="banner-mask-products">
				<div class="container text-center banner-readme-products">
					<p class="readme-hi">作品</p>
					<p>万物皆因价值而感动</p>
				</div>
			</div>
		</div>
		<div class="products-list">
			<div class="container">
				 <?php 
				//获取作品分类
				query_works_posts();
				if(have_posts()) : 
					while(have_posts()) :
						the_post();
				?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 rounded product">
						<a href="<?php the_permalink();?>">
							<div class="prodcut-img rounded" style="background-image: url('<?php the_product_post_meta_product_home_background_img(get_the_ID());?>');"></div>
							<div class="product-mask rounded">
								<p class="detail-product-type"><?php the_product_post_cat_name(get_the_category());?></p>
								<p class="detail-product-line">-</p>
								<p class="detail-product-name"><?php the_title();?></p>
							</div>
						</a>
					</div>
					
				<?php
					endwhile;
				endif;
				?> 
				
			</div>
			
		</div>
		
		<script type="text/javascript">
		function setProductHeight(){
			$('.prodcut-img').each(function(){
				$(this).css('height',$(this).width());
			});
		}
		
		$(document).ready(function(){
			setProductHeight();
		});

		$(window).resize(function(){
			setProductHeight();
		});
		</script>
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>