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
    	
    	<?php the_post();?>
    	<script src="<?php bloginfo('template_url');?>/js/single.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/jquery.powertimer.js" type="text/javascript"></script>
    	<script src="<?php bloginfo('template_url');?>/js/bargetor-tree.js" type="text/javascript"></script>
    	
    	
    	<div class="banner-single">
			<div class="banner-mask-single">
				<div class="container text-center banner-about-single">
					<p class="about-title">因价值而感动 - 缄·娇快件管理</p>
					<div class="meta-single">
						<div class="meta-single-item single-type">
							<ul>
								<li><span>产品</span></li>
							</ul>
						</div>
						<div class="meta-single-item single-date">
							<ul>
								<li><span><?php the_date('Y-m-d');?></span></li>
							</ul>							
						</div>
					</div>
					<p class="about-description">这个产品灵感来自于我的朋友娇，它将通过实时的关键信息提醒和到件日期预测，解决在收快递时的心理安全感问题。</p>
				</div>
			</div>
		</div>
		
		<div class="content-single">
			<div class="container">
				<div class="col-sm-2 col-md-2 col-lg-2 product-navigation-bar">
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none role-model-icon">
						</div>
						<p>角色模型</p>
					</div>
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none information-architecture-icon">
						</div>
						<p>信息架构</p>
					</div>
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none sketch-icon">
						</div>
						<p>草图原型</p>
					</div>
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none visual-design-icon">
						</div>
						<p>视觉设计</p>
					</div>
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none interactive-design-icon">
						</div>
						<p>交互设计</p>
					</div>
					<div class="product-navigation-bar-item">
						<div class="product-nav-bar-icon product-nav-bar-icon-none video-icon">
						</div>
						<p>思路演说</p>
					</div>
				</div>
				<div class="col-sm-9 col-md-9 col-lg-9 single-main">
					<h1>角色模型</h1>
						<div class="row-fluid">
							<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 rounded role-model-item">
								<div class="role-model-item-information">
									<div class="role-model-item-pic"></div>
									<div class="role-model-item-about">
										<p class="role-model-item-profession">公司前台</p>
										<ul>
											<li>女</li>
											<li>22</li>
										</ul>
									</div>
								</div>
								<ul class="role-model-item-requirement">
									<li>方便</li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 rounded role-model-item">
								<div class="role-model-item-information">
									<div class="role-model-item-pic"></div>
									<div class="role-model-item-about">
										<p class="role-model-item-profession">公司前台</p>
										<ul>
											<li>女</li>
											<li>22</li>
										</ul>
									</div>
								</div>
								<div>
								<ul class="role-model-item-requirement">
									<li>方便，准确，高效</li>
									<li>提醒员工收取快件</li>
									<li>当员工询问时提供准确必要的信息</li>
								</ul>
								</div>
							</div>
							<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 rounded role-model-item">
								<div class="role-model-item-information">
									<div class="role-model-item-pic"></div>
									<div class="role-model-item-about">
										<p class="role-model-item-profession">公司前台</p>
										<ul>
											<li>女</li>
											<li>22</li>
										</ul>
									</div>
								</div>
								<ul class="role-model-item-requirement">
									<li>方便</li>
								</ul>
							</div>
						</div>
					<div class="role-model-main">
						<div class="container role-model-list">
							
							
							
						</div>
					</div>
					<h1>信息架构</h1>
					<div id="information-architecture-tree" class="information-architecture-main"></div>
					
					<script type="text/javascript">
						var data = {'name' : '首页', 'childNodes' : [{name : '总览'}, {name : '刷新'}, {name:'添加'},{name:'更多快件', childNodes : [{name:'配送'}, {name:'在途'}, {name:'疑难'}, {name:'完成'}]}, {name:'关注快件列表'}, {name:'用户'}, {}]};
						$('#information-architecture-tree').bargetorTree(data);
					</script>
					
					<h1>原型草图</h1>
					<h2>首页线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-home.png">
					
					<h2>产品首页线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-product-home.png">
					
					<h2>产品详情线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-product-detail.png">
					
					<h2>关于我线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-about-me.png">
					
					<h2>生活首页线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-life-home.png">
					
					<h2>生活详情线框图</h2>
					<img src="<?php bloginfo('template_url');?>/images/sketch-life-detail.png">
					
					
					<h1>视觉设计</h1>
					<h2>产品包装效果图</h2>
					<img src="<?php bloginfo('template_url');?>/images/visual.png">
					
    				<h1>交互设计</h1>
    				<div class="interactive-design-main">
    					<iframe scrolling="no" class="interactive-design-iframe" src="<?php bloginfo('template_url');?>/interactive/test/index.html"></iframe>
    				</div>
    				
    				<h1>思路演说</h1>
    				<div class="video-main">
						<iframe class="video" height="400" width="480" src="http://player.youku.com/embed/XNjIyNDM2OTQw" frameborder="0" allowfullscreen></iframe>
    				</div>
    	
    				<?php the_content();?>
    				
				</div>
			</div>
		</div>
		
		
		
		
		
		
		<?php get_sidebar(); ?>
		<?php get_footer(); ?>