<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package bargetor
 * @subpackage bargetor
 * @since bargetor 1.0
 */
?>
<!DOCTYPE HTML>
<html lang="zh_cn" class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
	<head>
		<title><?php bloginfo('name');?><?php wp_title();?></title>
		<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/images/favicon.ico">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>"/>
		<meta name="generator" content="Wordpress<?php bloginfo('version');?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- 微博分享元数据 -->
		<meta property="wb:webmaster" content="bb870eddddf52475" />
		
		<link rel="altemate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url');?>"/>
		<link rel="altemate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url');?>"/>
		<link rel="altemate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url');?>"/>
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>"/>
		
		<?php 
			wp_get_archives('type=monthly&format=link');
			//comments_popup_script();//off by default
			wp_head();
		?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">
		<script src="<?php bloginfo('template_url');?>/js/jquery-1.11.1.min.js"></script>
		<script src="<?php bloginfo('template_url');?>/js/jquery-migrate-1.2.1-min.js"></script>
		<script src="<?php bloginfo('template_url');?>/js/common.js"></script>
		
		
	</head>
	
	<body>
	
	<div class="navbar navbar-default navbar-fixed-top header" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed header-calls-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="header-logo" href="<?php bloginfo('url');?>"></a>
        </div>
        <div class="navbar-collapse collapse header-calls-div">
          <ul class="nav navbar-nav navbar-right header-calls-ul">
            <li><a href="<?php bloginfo('url');?>/aboutme">关于我</a></li>
            <li><a href="<?php bloginfo('url');?>/works">作品</a></li>
            <li><a href="<?php bloginfo('url');?>/life">生活</a></li>
            <!-- class="active" 选中状态  -->
            <li><a href="javascript:void(0);" onclick="gotoBottom();">联系我</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
