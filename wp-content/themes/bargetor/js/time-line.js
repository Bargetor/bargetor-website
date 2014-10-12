var time_node_icon_prefix = 'icon-'

function percentageTime(a, b, c, d) {
	var e = c.getTime() - a.getTime();
	var f = b.getTime() - a.getTime();
	var g = c.getTime() - b.getTime();
	var h = (f / e * 100).toFixed(d);
	return h
}
function loadNotes() {
	$.ajax({
		type : "GET",
		url : "../?bargetor_resources=/js/timeline-notes.json",
		dataType : "json",
		error : function(a) {
			//未知错误
			if(a.status == '200'){
				timelineSetup(eval('(' + a.responseText + ')'));
			}
		},
		success : function(a) {
			var a = a;
			timelineSetup(a);
		}
	})
}
function timelineSetup(a) {
	$("#time-line-bar #milestone-bar .time-line-node").remove();
	$("#time-line-bar #milestone-bar #time-nodes").empty();
	containerWidth = parseInt($("#time-line-bar #milestone-bar").width());
	progressWidth = containerWidth - 140;
	notesWidth = progressWidth - 30;
	$("#about .progress-bar").css({
		width : progressWidth
	});
	$("#about .progress-bar .notes").css({
		width : notesWidth
	});
	$("#about").css("overflow", "visible");
	addNotes(a)
}
function addNotes(a) {
	results = a;
	var b = "";
	//添加节点时反向添加，即发生在后的先添加
	for ( var c = results.nodes.length - 1; c >= 0; c--) {
		//由于在移动设备上浏览器不支持live操作，所以这里绑定单击事件
		b += "<li onclick='timeNodeAnimationOnclick();'";
		b += ' class="time-node ';
		var image;
		if (results.nodes[c].image){
			image = results.nodes[c].image;
		}else {
			image = 'blue-star';
		}
		b += image;
		b += '">';
		b += "<span class='" + time_node_icon_prefix + image +"'></span>";
		b += '<div class="caption">';
		b += '<div class="arrow"></div>';
		b += '<h4 class="heading">' + results.nodes[c].title;
		var date = new Date(results.nodes[c].date);
		b += '<span> - ' + (date.getYear() + 1900) + '</span>';
		b += "</h4>";
		b += '<p class="date">' + results.nodes[c].date + "<p>";
		b += '<p class="description">' + results.nodes[c].description
				+ "</p>";
		b += "</div>";
		b += "</li>"
	}
	$("#time-line-bar #milestone-bar .time-nodes").prepend(b);
	
	for ( var d = 0; d < a.nodes.length; d++) {
		var e = '<span class="time-line-node';
		e += '">';
		e += '<p class="date">' + a.nodes[d].date + "</p>";
		e += "</span>";
		$("#time-line-bar #milestone-bar").prepend(e);
	}
	
	refreshNodeLocal();
	
}

function refreshNodeLocal(){
	//避免重叠保持一个前节点
	var preNode;
	//因为是节点添加时是反向的，所以节点从右往左循环
	$("#time-line-bar #milestone-bar .time-nodes li").each(function() {
		var date = new Date($(this).find(".date").html());
		var percentage = percentageTime(birth, date, present, 20);
		var width = $(this).width();
		var timeLineWidth = $("#milestone-bar .time-nodes").width();
		var left = timeLineWidth * (percentage / 100) - width / 2;
		if (preNode){
			var maxLeft = preNode.position().left - $(this).width();
			if (left > maxLeft){
				left = maxLeft - 10;//10像素的间隙
			}
		}
		var captionMaxLeft = timeLineWidth - 120;
		if (parseInt(left) > captionMaxLeft) {
			var e = parseInt(left) - captionMaxLeft;
			$(this).find(".caption").css({
				left : -e
			});
			$(this).find(".caption .arrow").css({
				left : e + 10
			})
		} else {
		}
		$(this).css("left", left);
		
		
		var f = $(this).find(".caption").height();
		$(this).find(".caption").css("top", -f - 30);
		
		
		preNode = $(this);
		
	});
	
	
	//根据节点放置时间线上的点
	var timeLineNodes = $("#time-line-bar #milestone-bar .time-line-node");
	var i = 0;
	$("#time-line-bar #milestone-bar .time-nodes li").each(function() {
		var timeLineNode = $(timeLineNodes[i]);
		var left = $(this).position().left + ($(this).width() - timeLineNode.width()) / 2;
		timeLineNode.css("left", left - 2);
		i++;
	});
}
var birth = new Date("1990/07/11 01:00:00");
var present = new Date;
var death = new Date("2067/08/09 01:00:00");
$(document).ready(function() {
	loadNotes();
});
$(document).ready(
		function() {
			$("#time-line-bar #milestone-bar .time-nodes li").live(
					"mouseenter singletap",
					function() {
						$(this).animate(
								{
									top : -45
								},
								200,
								function() {
									$(this).find(".caption").stop(true, true)
											.fadeIn(200)
								})
					}).live(
					"mouseleave",
					function() {
						$(this).stop(true, true).find(".caption").stop(true,
								true).delay(200).fadeOut(400, function() {
							$(this).parents("li").animate({
								top : -52
							}, 200)
						})
					})
		});
$(window).resize(function() {
	refreshNodeLocal();
});

function timeNodeAnimationOnclick(){
	var node = $(this.event.srcElement);
	var isCaptionShow = node.attr('isCaptonShow');
	if(!isCaptionShow || isCaptionShow == 'false'){
		nodeCaptionShow(node);
		node.attr('isCaptonShow', true);
	}else{
		nodeCaptionHidden(node);
		node.attr('isCaptonShow', false);
	}
}

function nodeCaptionShow(node){
	node.animate({
		top : -45
	}, 200, function() {
		$(this).find(".caption").stop(true, true).fadeIn(200)
	});
}

function nodeCaptionHidden(node){
	node.stop(true, true).find(".caption").stop(true,
			true).delay(200).fadeOut(400, function() {
		$(this).parents("li").animate({
			top : -52
		}, 200)
	});
}