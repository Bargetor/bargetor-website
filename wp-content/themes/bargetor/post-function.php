<?php
include_once TEMPLATEPATH . '/constant.php';




/**
 * 获取工作类型
 */
function get_works_cat(){
	$works_cat = get_category_by_slug('works');
	return $works_cat;
}

/**
 * 获取产品类型
 */
function get_products_cat(){
	$product_cat = get_category_by_slug('products');
	return $product_cat;
}

/**
 * 获取生活类型
 */
function get_life_cat(){
	$life_cat = get_category_by_slug('life');
	return $life_cat;
}

/**
 * 查询所有工作文章
 */
function query_works_posts(){
	$works_cat = get_works_cat();
	query_posts('cat=' . $works_cat->term_id);
}

/**
 * 查询产品文章
 */
function query_life_posts(){
	$life_cat = get_life_cat();
	query_posts('cat=' . $life_cat->term_id);
}

/**
 * 查询产品文章
 */
function query_product_posts(){
	$product_cat = get_products_cat();
	query_posts('cat=' . $product_cat->term_id);
}

/**
 * 输出类型名称
 * @param unknown_type $categorys
 */
function the_product_post_cat_name($categorys){
	//获取产品类型
	$category;
	if(count($categorys) == 0):
		$category = '未知';
	else :
		$category = $categorys[0]->cat_name;
	endif;
	echo $category;
}

function the_post_meta_background_img($post_id){
	echo get_post_meta_background_img($post_id);
}

function the_product_post_meta_upper_img($post_id){
	echo get_product_post_meta_upper_img($post_id);
}

function the_product_post_meta_upper_top($post_id){
	echo get_product_post_meta_upper_top($post_id);
}

function the_product_post_meta_upper_left($post_id){
	echo get_product_post_meta_upper_left($post_id);
}

function the_product_post_meta_product_home_background_img($post_id){
	echo get_product_post_meta_product_home_background_img($post_id);
}

function the_post_sub_title($post_id){
	echo get_post_sub_title($post_id);
}



/******************************* get meta *************************************/
function is_post_meta_show_background_img($post_id){
	$is = get_post_meta($post_id, POST_META_IS_SHOW_BACKGROUND, true);
	return strcasecmp($is, 'false') == 0 ? false : true;
}

function get_post_meta_background_img($post_id){
	$img = get_post_meta($post_id, POST_META_HOME_PAGE_PRODUCT_BACKGROUND_IMG, true);
	return strlen($img) <= 0 ? null : home_url() . $img;
}

function get_product_post_meta_upper_img($post_id){
	$img = get_post_meta($post_id, POST_META_HOME_PAGE_PRODUCT_UPPER_IMG, true);
	return strlen($img) <= 0 ? null : home_url() . $img;
}

function get_product_post_meta_upper_top($post_id){
	return get_post_meta($post_id, POST_META_HOME_PAGE_PRODUCT_UPPER_TOP, true);
}

function get_product_post_meta_upper_left($post_id){
	return get_post_meta($post_id, POST_META_HOME_PAGE_PRODUCT_UPPER_LEFT, true);
}

function get_product_post_meta_product_home_background_img($post_id){
	$img = get_post_meta($post_id, POST_META_PRODUCT_HOME_PAGE_PRODUCT_BACKGROUND_IMG, true);
	return strlen($img) <= 0 ? null : home_url() . $img;
}

function get_post_sub_title($post_id){
	return get_post_meta($post_id, POST_META_POST_SUB_TITLE, true);
}

?>