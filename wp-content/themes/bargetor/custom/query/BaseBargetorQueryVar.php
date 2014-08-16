<?php
	include_once TEMPLATEPATH . '/custom/query/BargetorQueryVar.php';
	class BaseBargetorQueryVar implements BargetorQueryVar{
		private $var;
		
		/**
		 * 
		 * 构造函数
		 * @param unknown_type $var_name
		 */
		public function __construct($var){
			$this->setQueryVar($var);
		}
		
		public function getQueryVar(){
			return $this->var;
		}
		
		public function setQueryVar($var){
			$this->var = $var;
		}
		
		public function templateRedirect($value){
			include(TEMPLATEPATH . $value);
	        die();
		}
		
	}
?>