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
    	<div class="banner-about-me">
			<div class="banner-mask-about-me">
				<div class="container banner-readme-about-me">
					<p class="text-center readme-hi">A Good Guy</p>
					<p>今年24岁，生于湖北仙桃，年少即开始接触计算机。当我获得了我的第一个计算机奖杯后，开始思考什么是价值。我觉得我应该去做点什么让我的朋友们感受到价值。</p>
					<p>开始接触设计在中学，当我设计出我的第一款产品后，我看到了每一个人嘴角洋溢的微笑。至此，我坚定了设计道路，开始为微笑而设计。</p>
				</div>
			</div>
		</div>
		<div class="time-line">
			<div class="container">
				<span class="text-center line-node birth">1990</span>
				<span class="text-center line-node now"><?php echo date("Y");?></span>
				<div id="time-line-bar" class="time-line-bar">
					<div id="milestone-bar" class="milestone-bar">
						<!-- 
						<span class="time-line-node" style="left: 100px;"></span>
						<span class="time-line-node" style="left: 200px;"></span>
						<span class="time-line-node" style="left: 300px;"></span>
						 -->
						<ul id="time-nodes" class="time-nodes">
							<!-- 
							<li class="time-node pennon" style="left: 100px;"></li>
							<li class="time-node gem" style="left: 200px;"></li>
							 -->
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<script src="<?php bloginfo('url');?>/?bargetor_resources=/js/time-line.js" type="text/javascript"></script>
<!--

//-->
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>