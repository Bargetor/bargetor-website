<?php
/**
 * Bargetor setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Bargetor 1.0
 */

 include_once TEMPLATEPATH . '/constant.php';
 include_once TEMPLATEPATH . '/custom/query/BargetorQueryVarCenter.php';
 include_once TEMPLATEPATH . '/custom/query/BargetorRewriteRuleProxy.php';
 include_once TEMPLATEPATH . '/shout-codes.php';
 
 
 /**
  * 初始化重写规则
  */
 BargetorQueryVarCenter::getInstance()->addQueryVar(BargetorRewriteRuleProxy::getInstance()->target);

 
 //$aboutme = str_replace(home_url(), '', get_theme_root_uri()) . '/' . wp_get_theme() . "/aboutme.php";
 
 //add_rewrite_rule("^aboutme/?$", $aboutme, 'top');
 
 
 add_action('generate_rewrite_rules', 'bargetor_rewrite_rules');
 /**********重写规则************/
 function bargetor_rewrite_rules( $wp_rewrite ){
 	/*
 	 * 
 	$new_rules = array(
        'aboutme/?$' => 'index.php?' . BARGETOR_QUERY_VAR_NAME . '=aboutme',   
 	); //添加翻译规则
 	 */
 	BargetorRewriteRuleProxy::getInstance()->target->createRewriteRules($wp_rewrite);
 }
 
 /*******添加query_var变量***************/
 add_action('query_vars', 'bargetor_add_query_vars');
 function bargetor_add_query_vars($public_query_vars){
 	foreach (BargetorQueryVarCenter::getInstance()->getQueryVarArray() as $query_var){
		$public_query_vars[] = $query_var; //往数组中添加添加my_custom_page
 	}
 	return $public_query_vars;
 }
 
 //模板载入规则   
 add_action("template_redirect", 'bargetor_template_redirect');   
 function bargetor_template_redirect(){
 	global $wp;
 	global $wp_query, $wp_rewrite;
 	BargetorQueryVarCenter::getInstance()->templateRedirect($wp_query);
 }

 /***************激活主题更新重写规则***********************/
 add_action( 'load-themes.php', 'bargetor_frosty_flush_rewrite_rules' );
 function bargetor_frosty_flush_rewrite_rules() {
 	global $pagenow, $wp_rewrite;
 	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
 	$wp_rewrite->flush_rules();
 }
 
 
 /************************* 后台相关  *********************************/
 
 //定义后台目录常量
 define('BACKSTAGE_PATH', get_bloginfo('template_url') . '/backstage');
 
 //编辑框标签
 add_action('admin_print_scripts', 'bargetor_add_edit_quicktags');
 function bargetor_add_edit_quicktags(){
	wp_enqueue_script(
        'bargetor-edit-quicktags', 
	BACKSTAGE_PATH . '/bargetor-edit-quicktags.js',
	array('quicktags')
    );
 }
 
 //初始化时执行post_edit_button函数   
 add_action('init', 'post_edit_button');   
 function post_edit_button() {   
    //判断用户是否有编辑文章和页面的权限   
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {   
        return;   
    }   
    //判断用户是否使用可视化编辑器   
    if ( get_user_option('rich_editing') == 'true' ) {   
		add_filter( 'mce_external_plugins', 'add_plugin' );   
		add_filter( 'mce_buttons', 'register_button' );   
    }
 } 
 
 function register_button( $buttons ) {
 	//javascript代码A标签按钮 
	array_push( $buttons, "|", "javascript_a_button" );
 	//添加数据分析按钮 
	array_push( $buttons, "|", "data_analysis_button" );
	//添加数据图表按钮 
	array_push( $buttons, "|", "data_chart_button" );
	//添加人物角色集按钮 
	array_push( $buttons, "|", "role_model_tag_button" );
 	//添加人物角色集按钮 
	array_push( $buttons, "|", "role_model_list_button" );
 	//添加人物角色按钮 
	array_push( $buttons, "|", "role_model_button" );
	//添加 信息架构按钮 
	array_push( $buttons, "|", "information_architecture_button" );
	//添加 原型草图按钮 
	array_push( $buttons, "|", "sketch_button" );
	//添加视觉设计按钮 
	array_push( $buttons, "|", "visual_design_button" );
	//添加 交互设计按钮 
	array_push( $buttons, "|", "interactive_design_button" );
	//添加 思路演说视频按钮 
	array_push( $buttons, "|", "video_button" );
	//array_push( $buttons, "|", "mylink" ); //添加一个mylink按钮   
  
	return $buttons;   
 }
 function add_plugin( $plugin_array ) {
 	//数据分析按钮的js路径 
 	$plugin_array['javascript_a_button'] = BACKSTAGE_PATH . '/javascript-a-button.js';
 	//数据分析按钮的js路径 
 	$plugin_array['data_analysis_button'] = BACKSTAGE_PATH . '/data-analysis-button.js';
 	//数据分析按钮的js路径 
 	$plugin_array['data_chart_button'] = BACKSTAGE_PATH . '/data-chart-button.js';
 	//人物角色标记按钮的js路径 
 	$plugin_array['role_model_tag_button'] = BACKSTAGE_PATH . '/role-model-tag-button.js';
 	//人物角色集按钮的js路径 
 	$plugin_array['role_model_list_button'] = BACKSTAGE_PATH . '/role-model-list-button.js';
 	//人物角色按钮的js路径 
	$plugin_array['role_model_button'] = BACKSTAGE_PATH . '/role-model-button.js';
	//信息架构按钮的js路径 
	$plugin_array['information_architecture_button'] = BACKSTAGE_PATH . '/information-architecture-button.js';
	//原型草图按钮的js路径 
	$plugin_array['sketch_button'] = BACKSTAGE_PATH . '/sketch-button.js';
	//视觉按钮的js路径 
	$plugin_array['visual_design_button'] = BACKSTAGE_PATH . '/visual-design-button.js';
	//交互设计按钮的js路径 
	$plugin_array['interactive_design_button'] = BACKSTAGE_PATH . '/interactive-design-button.js';
	//思路演说视频按钮的js路径 
	$plugin_array['video_button'] = BACKSTAGE_PATH . '/video-button.js';
	//$plugin_array['mylink'] = get_bloginfo( 'template_url' ) . '/js/mylink.js'; //mylink按钮的js路径   
	return $plugin_array;
 }

 
 /******************************* 文章相关 *********************************/
 add_action('publish_post', 'add_custom_field_automatically');//发布文章时
 add_action('pre_post_update', 'add_custom_field_automatically');//保存草稿时
 /**
  * 
  * 为文章添加自定义字段
  * @param unknown_type $post_ID
  */
 function add_custom_field_automatically($post_ID) {
	global $wpdb;
	if(!wp_is_post_revision($post_ID)) {
		//文章副标题
		add_post_meta($post_ID, POST_META_POST_SUB_TITLE, '', true);
		//首页产品背景图片
		add_post_meta($post_ID, POST_META_HOME_PAGE_PRODUCT_BACKGROUND_IMG, '', true);
		//首页产品前景图片
		add_post_meta($post_ID, POST_META_HOME_PAGE_PRODUCT_UPPER_IMG, '', true);
		//首页产品前景图片,空为居中
		add_post_meta($post_ID, POST_META_HOME_PAGE_PRODUCT_UPPER_TOP, '', true);
		//首页产品前景图片
		add_post_meta($post_ID, POST_META_HOME_PAGE_PRODUCT_UPPER_LEFT, '', true);
		//产品首页产品封面图片
		add_post_meta($post_ID, POST_META_PRODUCT_HOME_PAGE_PRODUCT_BACKGROUND_IMG, '', true);
		//是否在文章中显示背景图片
		add_post_meta($post_ID, POST_META_IS_SHOW_BACKGROUND, 'true', true);
	}
 }
?>