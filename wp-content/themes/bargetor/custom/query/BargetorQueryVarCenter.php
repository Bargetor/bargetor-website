<?php
	class BargetorQueryVarCenter{
		private static $instance;
		private $queryVarArray;
		/**
		 * 
		 * 默认需要添加的请求名
		 * @var unknown_type
		 */
		private static $default_query_var_array = array(
		/**
		* 
		* 统一资源请求属性名
		* @var bargetor_resources
		*/
		'bargetor_resources'
		);
		
		private function __construct(){
			$this->queryVarArray = array();
			foreach (self::$default_query_var_array as $var){
				$this->addQueryVar(new BaseBargetorQueryVar($var));
			}
		}
		
		public static function getInstance(){
			if(!(self::$instance instanceof self)){
			self::$instance = new self;
			}
			return self::$instance;
		}
		
		public function addQueryVar($query_var){
			$this->queryVarArray[] = $query_var;
		}
		
		public function getQueryVarArray(){
			$query_var_array = array();
			foreach ($this->queryVarArray as $query_var){
				$query_var_array[] = $query_var->getQueryVar();
			}
			return $query_var_array;
		}
		
		/**
		 * 
		 * 处理请求
		 * @param unknown_type $wp_query
		 */
		public function templateRedirect($wp_query){
			reset($this->queryVarArray);
			foreach ($this->queryVarArray as $query_var){
				$value =  @$wp_query->query_vars[$query_var->getQueryVar()];
				if(is_null($value))continue;
				$query_var->templateRedirect($value);
			}
		}
		
	}
?>