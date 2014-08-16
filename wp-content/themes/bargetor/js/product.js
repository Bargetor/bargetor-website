
var productBarConfig = {};
productBarConfig['tag-data-analysis'] = 'bar-data-analysis';
productBarConfig['tag-role-model'] = 'bar-item-role-model';
productBarConfig['tag-information-architecture'] = 'bar-item-information-architecture';
productBarConfig['tag-sketch'] = 'bar-item-sketch';
productBarConfig['tag-visual-design'] = 'bar-item-visual-design';
productBarConfig['tag-interactive-design'] = 'bar-item-interactive-design';
productBarConfig['tag-video'] = 'bar-item-video';

//按顺序记录Tap位置
var tagLocation = {};


/***
 * 产品导航栏初始化
 */
function productBarInit(){
	for(var p in productBarConfig){
		var tag = $('#' + p);
		var barItem = $('#' + productBarConfig[p]);
		if(!tag.length){
			barItem.css('display', 'none');
		}else{
			barItem.click(function(){
				var clickItem = $(this);
				showBarItem(clickItem);
				gotoProductTag(clickItem.get(0).id);
			})
		}
	}
}

/**
 * 是否为产品页
 */
function isProductShow(){
	return true;
}

/**
 * 初始化procuctTag的位置顺序
 */
function productTagInit(){
	tagLocation = {};
	for(var p in productBarConfig){
		var tag = $('#' + p);
		if(tag.length) tagLocation[p] = tag.offset().top - 100;
	}
	
}

/**
 * 产品导航栏滑动事件
 */
function productBarScrollEvent(){
	var scrollTop = $(document).scrollTop();
	var minTagId;
	var min = 99999999999;

	for(var p in tagLocation){
		var value = tagLocation[p] - scrollTop;
		var v = Math.abs(value);
		if(v < min && (value < 100 && value > -100)){
			minTagId = p;
			min = v;
		}
	}
	if(minTagId){
		showBarItem($('#' + productBarConfig[minTagId]));		
	}
}

/**
 * 显示产品导航元素
 * @param item
 */
function showBarItem(item){
	$('.product-navigation-bar-item').each(function(){
		//if($(this).parentElement == clickItem.get(0))return;
		//未选中状态
		//$(this).find('.product-nav-bar-icon').css('background-position-y', '0px');
		//$(this).find('p').css('color', '#B6A36F');
		$(this).removeClass('product-nav-bar-item-current');
	});
	//选中
	//$(this).find('a .product-nav-bar-icon').css('background-position-y', '-84px');
	//$(this).find('a p').css('color', '#FF5350');
	item.find('a').addClass('product-nav-bar-item-current');
}

/**
 * 到产品标记处
 */
function gotoProductTag(barId){
	for(var p in productBarConfig){
		if(productBarConfig[p] == barId){
			var top = $('#' + p).offset().top - 100;
			gotoTag(top);
		}
	}
}


/**
 * 调整人物角色模型高度
 */
function adjustRoleModelHeight(){
	var preItem;
	var index = 0;
	$('.role-model-item').each(function(){
		var element = $(this);
		if(!preItem || element.context.parentElement == preItem.context.parentElement){
			if(index % 2 == 1){
				if(element.height() < preItem.height()){
					//这里加上0.2是为了避免奇数个的长度比较长，造成下一排错位的现象
					element.css('height', preItem.outerHeight() + 0.2);
				}else{
					preItem.css('height', element.outerHeight());
				}
			}else{
				preItem = element;
			}
		}else{
			preItem = element;
			index = 0;
		}
		index ++;
	});	
}

/**
 * 显示产品导航栏
 */

function showProductBar(){
	var scrollTop = $(document).scrollTop(),
    bannerHeight = $('.banner-single').innerHeight();
	var bar = $('.product-navigation-bar');
	if(scrollTop >= bannerHeight - 100){
		bar.css('top', 110);
		bar.css('opacity', 1);
	}else{
		bar.css('top', 0);
		bar.css('opacity', 0);
	}
}

/**
 * 显示导航栏
 */

function showBar(){
	var scrollTop = $(document).scrollTop(),
    bannerHeight = $('.banner-single').innerHeight();
	
	if(scrollTop >= bannerHeight){
		$('.header').css('position', 'relative');
	}else{
		$('.header').css('position', 'fixed');
	}
}

/**
 * 调整产品导航栏位置
 */
function adjustProductPostion(){
	//减去30是因为H1标签的坐标为-60
	var left = ($('.single-main').offset().left - 30 - $('.product-navigation-bar').outerWidth()) / 2;
	$('.product-navigation-bar').css('left', left);
}

$(window).scroll(function(){
	showProductBar();
	
});


$(document).ready(function(){
	adjustProductPostion();
	adjustRoleModelHeight();
	if(isProductShow()){
		productBarInit();
		productTagInit();
		
		//图片加载好，重新初始化位置
		$('img').imagesLoaded(function() {
			productTagInit();
		});
		
		$(window).scroll(function(){
			productBarScrollEvent();
		});
		$(window).resize(function(){
			productTagInit();
			adjustProductPostion();
		});
	}
});

