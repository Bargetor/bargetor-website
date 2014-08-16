<?php
	/**
	 * 
	 * 添加请求变量接口
	 * @author Madgin
	 *
	 */
	interface BargetorQueryVar{
		/**
		 * 获取请求变量
		 */
		public function getQueryVar();
		
		public function setQueryVar($var);
		/**
		 * 
		 * 模板的载入规则,将参数处理
		 * @param unknown_type $value
		 */
		public function templateRedirect($value);
	}

?>