<?php
/**去掉全角转半角*/
remove_filter('the_content', 'wptexturize');

/********************** javascript a ****************************************/
function javascript_a_short_code($attr, $content = null){
	extract( shortcode_atts( array (
    'title' => ''
  	), $attr ) );
	$html = '';
  	if (strlen($title) <= 0)return $html;
  	if (is_null($content))return $html;
  	$html .= '<a';
  	$html .= ' href="javascript:';
  	$html .= $content;
  	$html .= '">';
  	$html .= $title;
  	$html .= '</a>';
  	return $html;
}
add_shortcode('javascript_a', 'javascript_a_short_code');


/******************** data analysis **************************/
function data_analysis_short_code($attr, $content = null){
	$html = '<h1 id="tag-data-analysis">数据分析</h1>';
	return $html;
}
add_shortcode('data_analysis', 'data_analysis_short_code');

/********************** data chart **************************/
function data_chart_short_code($attr, $content = null){
	
	extract( shortcode_atts( array (
    'data_chart_id' => ''
  	), $attr ) );
	$html = '<div id="' . $data_chart_id . '"></div>';
	$html .= '<script type="text/javascript">';
	$html .= '$(function () {';
	$html .= '$("#' . $data_chart_id . '").highcharts(';
	
	$html .= $content;
	
	$html .= ');});';
	$html .= "</script>";
	return $html;
}
add_shortcode('data_chart', 'data_chart_short_code');


/********************* role model *****************************/
function role_model_tag_short_code($attr){
	return '<h1 id="tag-role-model">角色模型</h1>';
}
add_shortcode('role_model_tag', 'role_model_tag_short_code');

function role_model_list_short_code($attr, $content = null){
	return '<div class="role-model-main">
				<div id="role-model-list" class="container role-model-list">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('role_model_list', 'role_model_list_short_code');

function role_model_short_code($attr, $content = null){
	extract( shortcode_atts( array (
    'age' => '0',
	'sex' => '男',
	'job' => '' //默认
  	), $attr ) );
	
	$html = '<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 rounded role-model-item">';
	$html .= '<div class="role-model-item-information">
				<div class="role-model-item-pic"></div>
				<div class="role-model-item-about">';
	$html .= 		'<p class="role-model-item-profession">' . $job . '</p>';
	$html .= 		'<ul><li>' . $sex . '</li><li>' . $age . '</li></ul>';
	$html .=	'</div>';
	$html .= '</div>';
	
	$html .= '<ul class="role-model-item-requirement">' . do_shortcode($content) . '</ul>';
	$html .= '</div>';
	return $html;
}
add_shortcode('role_model', 'role_model_short_code');

function role_model_demand_short_code($attr, $content = null){
	return '<li>' . $content . '</li>';
}
add_shortcode('demand', 'role_model_demand_short_code');


/********************** information_architecture *****************************/
function information_architecture_short_code($attr, $content = null){
	$html = '<h1 id="tag-information-architecture">信息架构</h1><div id="information-architecture-tree" class="information-architecture-main"></div>
			<script type="text/javascript">
				var data = "' . $content . '";
				$("#information-architecture-tree").bargetorTree(data);
			</script>';
	return $html;
}
add_shortcode('information_architecture', 'information_architecture_short_code');


/********************** sketch *****************************/
function sketch_short_code($attr, $content = null){
	$html = '<h1 id="tag-sketch">草图原型</h1>';
	return $html;
}
add_shortcode('sketch', 'sketch_short_code');

/********************** visual design *****************************/
function visual_design_short_code($attr, $content = null){
	$html = '<h1 id="tag-visual-design">视觉设计</h1>';
	return $html;
}
add_shortcode('visual_design', 'visual_design_short_code');

/********************** interactive_design *****************************/
function interactive_design_short_code($attr, $content = null){
	$html = '<h1 id="tag-interactive-design">交互设计</h1>';
	extract( shortcode_atts( array (
    'url' => '',
	'isTemplatePath' => 'false'//默认
  	), $attr ) );
  	
  	if($isTemplatePath == 'false'){
  		$url = home_url() . '/wp-content/uploads' . $url;
  	}else{
  		$url = TEMPLATEPATH . $url;
  	}
	
  	$html .= '<div class="interactive-design-main">
    			<iframe scrolling="no" class="interactive-design-iframe" src="' . $url . '"></iframe>
    		</div>';
  	
	return $html;
}
add_shortcode('interactive_design', 'interactive_design_short_code');

/********************** bargetor_video *****************************/
function bargetor_video_short_code($attr, $content = null){
	extract( shortcode_atts( array (
    'url' => ''//默认
  	), $attr ) );
	
	$html = '<h1 id="tag-video">演说视频</h1>';
	$html .= '<div class="video-main">
				<iframe class="video" height="400" width="480" src="' . $url . '" frameborder="0" allowfullscreen></iframe>
    		 </div>';
	return $html;
}
add_shortcode('bargetor_video', 'bargetor_video_short_code');
?>