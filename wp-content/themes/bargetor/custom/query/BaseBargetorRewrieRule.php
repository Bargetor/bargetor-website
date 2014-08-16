<?php
	include_once TEMPLATEPATH . '/custom/query/BaseBargetorQueryVar.php';
	include_once TEMPLATEPATH . '/custom/query/BargetorRewriteRule.php';
	class BaseBargetorRewriteRule extends BaseBargetorQueryVar implements BargetorRewriteRule{
		
		private $array;
		
		public function __construct($query_var, $rule_array){
			$this->setQueryVar($query_var);
			$this->array = $rule_array;
		}
		
		public function getRewriteRules(){
			return $this->array;
		}
		
		public function createRewriteRules($wp_rewrite){
			$new_rules = array();
		 	reset($this->array);
		 	while (list($key, $val) = each($this->array)){
		 		$new_rules = $new_rules + array($key . '?$' => 'index.php?' . $this->getQueryVar() . '=' . $key);
		 	}
		 	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
		}
		
		public function templateRedirect($value){
			reset($this->array);
		 	while (list($key, $val) = each($this->array)){
			 	if ($value == $key){
			        include(TEMPLATEPATH.$val);
			        die();
			        break;
			    }
		 	}
		}
	}

?>