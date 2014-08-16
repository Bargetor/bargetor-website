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
    	<script src="<?php bloginfo('template_url');?>/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/masonry.pkgd.min.js" type="text/javascript"></script>
    	<div class="banner-life">
			<div class="banner-mask-life">
				<div class="container text-center banner-readme-life">
					<p class="readme-hi">生活</p>
					<p>在这里我将分享我的知识、想法和兴趣</p>
				</div>
			</div>
		</div>
		
		<div class="life-list">
			<div id="life-masonry" class="container life-masonry">
			<!-- 
			 
				<div class="life">
					<a class="rounded" href="#">
						<img class="life-img" src="<?php bloginfo('template_url');?>/images/wuzhen-life.jpg">
						<p class="title">乌镇 - 印染布</p>
						<p class="description">在乌镇的旅途，古老的制布法。</p>
						<p class="date">2013-04-25</p>
					</a>
				</div>
				<div class="life">
					<a class="rounded" href="#">
						<img class="life-img" src="<?php bloginfo('template_url');?>/images/emotional-life.jpg">
						<p class="title">APP设计中的情感化</p>
						<p class="description">在科学与人文快速发展的今天，在物欲横流的人类世界，在工业时代洗礼之后，我们缺少的到底是什么？</p>
						<p class="date">2013-04-30</p>
					</a>
				</div>
				<div class="life">
					<a class="rounded" href="#">
						<img class="life-img" src="<?php bloginfo('template_url');?>/images/vivi-life.jpg">
						<p class="title">Labber - 在泥潭中翻滚的人</p>
						<p class="description">“你们修筑，修筑，预备道路，将绊脚石从我百姓的路中除掉。” —— 《以赛亚书》 第57章14节。</p>
						<p class="date">2013-04-25</p>
					</a>
				</div>
				<div class="life">
					<a class="rounded" href="#">
						<img class="life-img" src="<?php bloginfo('template_url');?>/images/wuzhen-life.jpg">
						<p class="title">乌镇 - 印染布</p>
						<p class="description">在乌镇的旅途，古老的制布法。</p>
						<p class="date">2013-04-25</p>
					</a>
				</div>
				<div class="life">
					<a class="rounded" href="#">
						<img class="life-img" src="<?php bloginfo('template_url');?>/images/wuzhen-life.jpg">
						<p class="title">乌镇 - 印染布</p>
						<p class="description">在乌镇的旅途，古老的制布法。</p>
						<p class="date">2013-04-25</p>
					</a>
				</div>
				-->
				<?php 
					query_life_posts();
					if(have_posts()):
						while (have_posts()):
							the_post();
				?>
							<div class="life">
								<a class="rounded" href="<?php the_permalink();?>">
									<?php
									$background = get_post_meta_background_img(get_the_ID());
									if(!is_null($background)):
									?>
										<img class="life-img" src="<?php echo $background; ?>">
									<?php
									endif;
									?>
									<p class="title"><?php the_title();?></p>
									<p class="description"><?php the_post_sub_title(get_the_ID());?></p>
									<p class="date"><?php the_date('Y-m-d');?></p>
								</a>
							</div>
				
				<?php
						endwhile;
					endif;
				?>
			</div>
		</div>
		<script>
			$('#life-masonry').imagesLoaded(function() {
			  $('#life-masonry').masonry({
			    itemSelector: '.life'
			  });
			});
		</script>

		<?php get_sidebar(); ?>
		<?php get_footer(); ?>