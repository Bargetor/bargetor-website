<?php
	include_once TEMPLATEPATH . '/custom/query/BaseBargetorRewrieRule.php';
	/*
  	* 重写规则请求名称常量
  	*/
 	define('BARGETOR_QUERY_VAR_NAME', 'bargetor_custom_page');

	class BargetorRewriteRuleProxy{
		private static $instance;
		public $target;

		/*
  		* 重写映射数组，只支持第一级
  		* ex.www.bargetor.com/aboutme
  		*/
		private static  $array = array(
 		'aboutme' => '/about-me.php',
 		'products' => '/products.php',
		'works' => '/products.php',
 		'life' => '/life.php',
        'api' => '/chestnut/api_proxy.php',
		'test' => '/test/test.php',
        'elemeopenapi' => '/elemeopenapi/eleme_post_proxy.php');

		private function __construct(){
			$this->target = new BaseBargetorRewriteRule(BARGETOR_QUERY_VAR_NAME, self::$array);
		}

		public static function getInstance(){
			if(!(self::$instance instanceof self)){
			self::$instance = new self;
			}
			return self::$instance;
		}

	}
?>
