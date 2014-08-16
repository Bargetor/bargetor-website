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


 /*
  * 重写规则请求名称常量
  */
 define('BARGETOR_QUERY_VAR_NAME', 'bargetor_custom_page');
 
 /*
  * 重写映射数组，只支持第一级
  * ex.www.bargetor.com/aboutme
  */
 class BargetorRewriteArray{
 	static  $array = array(
 	'aboutme' => '/about-me.php', 
 	'products' => '/products.php');
 }
 

 add_action('admin_print_scripts', 'bargetor_add_edit_quicktags');
 function bargetor_add_edit_quicktags(){
	wp_enqueue_script(
        'bargetor-edit-quicktags', 
	get_stylesheet_directory_uri().'/backstage/bargetor-edit-quicktags.js',
	array('quicktags')
    );
 }
 
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
 	$new_rules = array();
 	reset(BargetorRewriteArray::$array);
 	while (list($key, $val) = each(BargetorRewriteArray::$array)){
 		$new_rules = $new_rules + array($key . '?$' => 'index.php?' . BARGETOR_QUERY_VAR_NAME . '=' . $key);
 	}
 	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
 	//php数组相加
 }
 
 /*******添加query_var变量***************/
 add_action('query_vars', 'bargetor_add_query_vars');
 function bargetor_add_query_vars($public_query_vars){
 	$public_query_vars[] = BARGETOR_QUERY_VAR_NAME; //往数组中添加添加my_custom_page
 	 
 	return $public_query_vars;
 }
 
 //模板载入规则   
 add_action('template_redirect', 'bargetor_template_redirect');   
 function bargetor_template_redirect(){
    global $wp;   
    global $wp_query, $wp_rewrite;
       
    //查询my_custom_page变量
    $reditect_page = @$wp_query->query_vars[BARGETOR_QUERY_VAR_NAME];
    if (is_null($reditect_page))return;
    //如果my_custom_page等于hello_page，则载入user/helloashu.php页面   
    //注意 my-account/被翻译成index.php?my_custom_page=hello_page了。 
    /*
     * 
    if ($reditect_page == "aboutme"){
        include(TEMPLATEPATH.'/about-me.php');
        die();   
    }
     */ 
    reset(BargetorRewriteArray::$array);
 	while (list($key, $val) = each(BargetorRewriteArray::$array)){
	 	if ($reditect_page == $key){
	        include(TEMPLATEPATH.$val);
	        die();
	        break; 
	    }
 	}
 } 

 /***************激活主题更新重写规则***********************/  
 add_action( 'load-themes.php', 'bargetor_frosty_flush_rewrite_rules' );   
 function bargetor_frosty_flush_rewrite_rules() {   
    global $pagenow, $wp_rewrite;
    if ( 'themes.php' == $pagenow && isset($_GET['activated'] ) )   
        $wp_rewrite->flush_rules();
 }

?>