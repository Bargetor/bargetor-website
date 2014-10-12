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
    	<?php the_post();?>
    	<script src="<?php bloginfo('template_url');?>/js/single.js" type="text/javascript"></script>
    	
    	
	    <?php
			if (in_category('products')) {
				include(TEMPLATEPATH . '/single-products.php');
			}elseif (in_category('life')){
				include(TEMPLATEPATH . '/single-life.php');
			}else {
				include(TEMPLATEPATH . '/single-default.php');
			}
		?>
		<!-- 公共工具栏 -->
		<div >
			<ul class="single-bar single-common-bar">
				<li id="">
					<a href="javascript:gotoTop();" class="single-bar-item">
					<!-- 
						<div class="single-bar-icon single-bar-common-icon single-bar-common-up-icon">
						</div>
					 -->
						<p class="single-bar-icon single-bar-common-icon icon-single-bar-common-up"></p>
						<p>回到顶部</p>
					</a>
				</li>
			<ul>
		</div>
		
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>

