<?php
	/**
	 * 
	 * 重写规则接口
	 * @author Madgin
	 *
	 */
	interface  BargetorRewriteRule extends BargetorQueryVar{
		public function getRewriteRules();
		
		/**
		 * 创建重写规则
		 * @param unknown_type $wp_rewrite
		 */
		public function createRewriteRules($wp_rewrite);
	}

?>