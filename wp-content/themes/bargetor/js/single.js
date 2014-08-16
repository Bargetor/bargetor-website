//居中带有A标签的图片
function centerAImg(){
	$('.content-single .single-main a').each(function(){
		if($(this).find('img').length > 0){
			$(this).addClass('a-img');
		}
	});
}

$(document).ready(function(){
	//centerAImg();
});

/**
 * 显示公共导航栏
 */

function showCommonBar(){
	var scrollTop = $(document).scrollTop(),
    bannerHeight = $('.banner-single').innerHeight();
	var bar = $('.single-common-bar');
	if(scrollTop >= bannerHeight - 100){
		bar.css('opacity', 1);
	}else{
		bar.css('opacity', 0);
	}
}

/**
 * 每一条分享需要@我
 */
var bargetorWeiboId = "神经病患者蓝桥";

/**
 * 分享至微博
 */
function shareToWeibo(apikey, targetUrl, title, pic){
	var shareUrl = "http://service.weibo.com/share/share.php";
	var prams = '';
	var content = buildWeiboShareContent(targetUrl, title);
	if(targetUrl != null && targetUrl != ''){
		prams += '&url=' + targetUrl;
	}
	
	if(content != null && content != ''){
		prams += '&title=' + content;
	}
	
	if(pic != null && pic != ''){
		prams += '&pic=' + pic;
	}
	
	window.open(shareUrl + '?' + prams);
}

/**
 * 创建微博分享内容
 * @param targetUrl
 * @param title
 * @returns
 */
function buildWeiboShareContent(targetUrl, title){
	var content = title;
	
//	content += '(';
//	if(targetUrl != null && targetUrl != ''){
//		content += '分享来自：' + targetUrl;
//	}
	
	content += ' @' + bargetorWeiboId;
	
//	content += ')';
	
	content += " 分享来自：";
	
	return content;
}

/**
 * 分享到QQ空间
 * @param apikey
 * @param targetUrl
 * @param title
 * @param pic
 */
function shareToQzone(apikey, targetUrl, title, pic){
	var shareUrl = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey";
	var prams = '';
	var content = buildQzoneShareContent(targetUrl, title);
	if(targetUrl != null && targetUrl != ''){
		prams += 'url=' + encodeURIComponent(targetUrl);
	}
	
	if(content != null && content != ''){
		prams += '&title=' + encodeURIComponent(content);
	}
	
	if(pic != null && pic != ''){
		prams += '&pics=' + encodeURIComponent(pic);
	}
	
	window.open(shareUrl + '?' + prams);
}

/**
 * 创建QQ空间分享内容
 * @param targetUrl
 * @param title
 * @returns
 */
function buildQzoneShareContent(targetUrl, title){
	var content = title;
	
	content += '(';
	if(targetUrl != null && targetUrl != ''){
		content += '分享来自：' + targetUrl;
	}
	
	//content += ' @' + bargetorWeiboId;
	
	content += ')';
	
	return content;
}


/**
 * 寻找图片
 * 任意个数的参数，优先级别按照参数顺序排列
 */
function findPic(){
	for(var i = 0, len = arguments.length; i < len; i++){
		if(arguments[i] != null && arguments[i] != '')return arguments[i];
	}
	return null;
}

$(window).scroll(function(){
	showCommonBar();
	
});
