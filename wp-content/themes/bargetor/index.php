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
			<div class="container">
			
				<?php
				//获取产品分类
				$product_cat = get_products_cat();
				//获取产品分类文章总数
				$product_post_count = $product_cat->count;
				//文章索引
				$index = 0;
				query_posts('cat=' . $product_cat->term_id); 
				
				if(have_posts()) : 
					while(have_posts()) :
						the_post();
						$index ++;
						
						
						$style = '';
						$top = get_product_post_meta_upper_top(get_the_ID());
						$left = get_product_post_meta_upper_left(get_the_ID());
						$upper_img = get_product_post_meta_upper_img(get_the_ID());
						
						if(!is_null($top)): 
							$style .= ' top: ' . $top . ';';
						endif;
						
						if(!is_null($left)): 
							$style .= ' left: ' . $left . ';';
						endif;
						
						if (is_null($top) && is_null($left)):
							$style .= ' text-align: center;';
						endif;
						
						//$width = get_post_meta($post->ID, POST_META_HOME_PAGE_PRODUCT_UPPER_IMG, true);;
						//$height = get_post_meta($post->ID, POST_META_HOME_PAGE_PRODUCT_UPPER_IMG, true);;
						
						//产品样式
						$product_class = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
						//如果是最后一篇文章并且为单
						if ($index == $product_post_count && ($index % 2) == 1):
							$product_class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
						endif;
						
						?>
						<div class="<?php echo $product_class;?> home-product" >
							<a href="<?php the_permalink();?>">
								<div class="home-product-background" style="background-image: url('<?php the_post_meta_background_img(get_the_ID()); ?>');">
									<?php 
									if (!is_null($upper_img)):
									?>
									<img  src="<?php the_product_post_meta_upper_img(get_the_ID());?>" class="home-product-upper" style="<?php echo $style;?>"></img>
									<?php 
									endif;
									?>
								</div>
								<div class="home-product-detail">
									<p class="detail-product-type"><?php the_product_post_cat_name(get_the_category())?></p>
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
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>

