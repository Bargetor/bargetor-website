/**
 * 滑动到标记处
 * @param tag 为标记所在top位置
 */
function gotoTag(tag){
	if(tag < 0)return;
	var scroll = Math.abs(tag - $(document).scrollTop());
	var time;
	//2000像素以外，固定时间，2000以内平均速度
	if(scroll > 2000){
		time = 2000;
	}else{
		time = scroll / 1.5;
	}
	$('html, body, .content').animate({scrollTop: tag}, time);
}

function gotoBottom(){
	var documentHeight = $(document).height();
	gotoTag(documentHeight);
}

function gotoTop(){
	gotoTag(0);
}