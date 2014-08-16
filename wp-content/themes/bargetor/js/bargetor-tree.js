/**
 * 信息架构树
 */

/**
 * data 为json数据，结构举例：
 * node = {'name':'首页', 'childNodes':[node, node]};
 */

(function($){
	
	/**
	 * bargetorTree
	 * 定义jquery插件
	 */
	$.fn.bargetorTree = function(data){
		this.bargetorTree.initTree(this, data);
	};
	
	/**
	 * 树配置信息
	 */
	$.fn.bargetorTree.config = {
			width : 100,
			nodeClassName : 'bargetor-tree-node',
			lineWidth : 36,
			lineColor : '#B6A36F',
			spaceHeight : 20,
			mousemoveMin : 10,
			moveSpeed : 100,
			moveInterval : 500
	};
	
	/**
	 * 初始化
	 */
	$.fn.bargetorTree.initTree = function($tree, data){
		if(!data || data == '')return;
		var jsonData;
		if(typeof(data) == 'string'){
			try{
				jsonData = eval('(' + data + ')');				
			}catch (e) {
				jsonData = $tree.bargetorTree.resolveData(data);			
			}
			//如果字符串不是json数据，则解析
		}else if(typeof(data) == 'object'){
			jsonData = data;
		}else{
			return;
		}
		$tree.bargetorTree.rootNode = new TreeNode(jsonData);
		$tree.bargetorTree.rootNode.build();
		$tree.append($tree.bargetorTree.rootNode.node);
		$tree.bargetorTree.rootNode.adjustPosition();
		$tree.bargetorTree.adjust($tree);
		
		
		var $rootNode = $tree.bargetorTree.rootNode.node;
		//绑定鼠标移动事件
		$tree.bargetorTree.bindMouseMove($rootNode);
		//校验开关
		$tree.bargetorTree.checkSwitch($rootNode);
		//绑定到尺寸改变事件
		$(window).resize(function() {
			$rootNode.bargetorTree.checkSwitch($rootNode);
    	});
		$tree.bargetorTree.buildMouseMoveTimer($tree.bargetorTree.rootNode.node);
	}

	/**
	 * 解析数据
	 */
	$.fn.bargetorTree.resolveData = function(data){
		var json = buildNode(null);
		var currentNode = json;
		//当前层级为父层级
		var currentNodeIndex = 0;
		var d = data.replace(/&#8211;/g, '--');
		d = d.replace(/&#8212;/g,'---');
		d = d.trim();
		
		d.replace(/-{0,}[^-]*/g,function(node){
			if(!node || node == '')return;
			var layerAndData = getNodeLayerAndStr(node);
			//if(layerAndData.layer > currentNodeIndex)json.name = layerAndData.data;
			var n = getNode(currentNode, layerAndData.layer - currentNodeIndex);
			n.name = layerAndData.data;
			currentNodeIndex = layerAndData.layer;
			currentNode = n;
		});
		return json;
	}
	
	/**
	 * 在当前节点找到指定层级的节点
	 * @param currentNode
	 * @param layer
	 */
	function getNode(currentNode, layer){
		var result = buildNode(null);
		if(currentNode == null)return result;
		var l = Math.abs(layer);
		var c = currentNode;
		if(layer == 0){
			c = currentNode.parent;
		}
		
		while(l > 0){
			if (layer > 0){
				if(layer > 1){					
					if(c.childNodes.length == 0){
						var newChild = buildNode(c);
						c.childNodes.push(newChild);
						c = newChild;
					}else{
						c = c.childNodes[c.childNodes.length - 1];
					}
				}
			}else{
				c = c.parent;
			}
			l --;
		}
		c = layer < 0 ? c.parent : c;
		if(c == null)c = currentNode;
		result.parent = c;
		c.childNodes.push(result);
		return result;
	}
	
	/**
	 * 创建节点
	 * @param parent
	 * @returns {___anonymous2379_2420}
	 */
	function buildNode(parent){
		return {parent: parent, 'name': '', childNodes: []};
	}
	
	/**
	 * 返回节点的层级和数据
	 * @param node
	 */
	function getNodeLayerAndStr(node){
		var layer = 0;
		while(node.indexOf('-', layer) >= 0){
			layer ++;
		}
		return {layer : layer, data : node.substring(layer)};
	}
	
	/**
	 * 过往鼠标移动事件
	 */
	$.fn.bargetorTree.mousemoveEvent = {
		oldEvent : null,
		moveInterval : $.fn.bargetorTree.config.moveInterval,
		speed : $.fn.bargetorTree.config.moveSpeed,
		isStop : false,
		isMove : false,
		/**
		 * 某一边的移动开关
		 */
		isUpClose : false,
		isDownClose : false,
		isLeftClose : false,
		isRightClose : false,
		isUp : false,
		isDown : false,
		isLeft : false,
		isRight : false
	};
	
	/**
	 * 校验开关
	 */
	$.fn.bargetorTree.checkSwitch = function($rootNode){
		var left = $rootNode.offset().left - $rootNode.parent().offset().left;
    	var top = $rootNode.offset().top - $rootNode.parent().offset().top;
    	var right = $rootNode.parent().innerWidth() - $rootNode.innerWidth() - left;
    	var bottom = $rootNode.parent().innerHeight() - $rootNode.innerHeight() - top;
    	var mousemoveEvent = $rootNode.bargetorTree.mousemoveEvent;
    	if(left >= 0){
    		mousemoveEvent.isLeftClose = true;    		
    	}else{
    		mousemoveEvent.isLeftClose = false; 
    	}
    	if(right >= 0){
    		mousemoveEvent.isRightClose = true;    		
    	}else{
    		mousemoveEvent.isRightClose = false;
    	}
    	if(top >= 0){
    		mousemoveEvent.isUpClose = true;    		
    	}else{
    		mousemoveEvent.isUpClose = false;    		
    	}
    	if(bottom >= 0){
    		mousemoveEvent.isDownClose = true;    		
    	}else{
    		mousemoveEvent.isDownClose = false;    		
    	} 
	}
	
	/**
	 * 创建鼠标移动定时器，用于移动
	 */
	$.fn.bargetorTree.buildMouseMoveTimer = function($rootNode){
		var mousemoveEvent = $rootNode.bargetorTree.mousemoveEvent;
		$rootNode.powerTimer({
	        interval: mousemoveEvent.moveInterval,
	        func: function(){
	        	if(!mousemoveEvent.isStop){
	        		if(mousemoveEvent.isRight && !mousemoveEvent.isRightClose){
	        			moveRight($rootNode, mousemoveEvent);
	        		}
	        		if(mousemoveEvent.isLeft && !mousemoveEvent.isLeftClose){
	        			moveLeft($rootNode, mousemoveEvent);
	        		}
	        		
	        		if(mousemoveEvent.isDown && !mousemoveEvent.isDownClose){
	        			moveDown($rootNode, mousemoveEvent);
	        		}
	        		
	        		if(mousemoveEvent.isUp && !mousemoveEvent.isUpClose){
	        			moveUp($rootNode, mousemoveEvent);
	        		}
	        	}
//	        	var left = $rootNode.offset().left - $rootNode.parent().offset().left;
//	        	var top = $rootNode.offset().top - $rootNode.parent().offset().top;
//	        	var right = $rootNode.parent().innerWidth() - $rootNode.innerWidth() - left;
//	        	var bottom = $rootNode.parent().innerHeight() - $rootNode.innerHeight() - top;
//	        	$('#light').text('left' + left + 'right' + right + 'top' + top + 'bottom' + bottom);
	        },
	     });
	}
	
	/**
	 * 绑定鼠标移动事件
	 */
	$.fn.bargetorTree.bindMouseMove = function($rootNode){
		var mousemoveEvent = $rootNode.bargetorTree.mousemoveEvent;
		$rootNode.bind('mousemove', function(event){
			var oldEvent = mousemoveEvent.oldEvent;
			//更新过往鼠标事件
			mousemoveEvent.oldEvent = event;
			if(!oldEvent)return;
			if(mousemoveEvent.isMove)return;
			var x = event.clientX - oldEvent.clientX;
			var y = event.clientY - oldEvent.clientY;
			var xAbs = Math.abs(x);
			var yAbs = Math.abs(y);
			//小于30忽略
			var minMove = $(this).bargetorTree.config.mousemoveMin;
			if(xAbs < minMove)xAbs = 0;
			if(yAbs < minMove)yAbs = 0;
			if(xAbs < minMove && yAbs < minMove)return;
			if(xAbs > yAbs){
				if(x > 0){
					//右
					if(!mousemoveEvent.isRight){
						setUpMousemoveEvent(mousemoveEvent);
						mousemoveEvent.isRight = true;
						mousemoveEvent.isStop = false;
						//if(mousemoveEvent.isMove)return;
						//moveRight($(this), mousemoveEvent);						
					}
				}else{
					//左
					if(!mousemoveEvent.isLeft){
						setUpMousemoveEvent(mousemoveEvent);
						mousemoveEvent.isLeft = true;
						mousemoveEvent.isStop = false;
						//if(mousemoveEvent.isMove)return;
						//moveRight($(this), mousemoveEvent);						
					}
				}
			}else{
				if(y > 0){
					//下
					if(!mousemoveEvent.isDown){
						setUpMousemoveEvent(mousemoveEvent);
						mousemoveEvent.isDown = true;
						mousemoveEvent.isStop = false;
						//if(mousemoveEvent.isMove)return;
						//moveRight($(this), mousemoveEvent);						
					}
				}else{
					//上
					if(!mousemoveEvent.isUp){
						setUpMousemoveEvent(mousemoveEvent);
						mousemoveEvent.isUp = true;
						mousemoveEvent.isStop = false;
						//if(mousemoveEvent.isMove)return;
						//moveRight($(this), mousemoveEvent);						
					}
				}
			}
		});
		
		$rootNode.bind('mouseover', function(){
			mousemoveEvent.isStop = false;
		});
		
		$rootNode.bind('mouseout', function(){
			mousemoveEvent.isStop = true;
		});
	}
	
	//重置鼠标移动事件
	function setUpMousemoveEvent(mousemoveEvent){
		mousemoveEvent.isRight = false;
		mousemoveEvent.isLeft = false;
		mousemoveEvent.isDown = false;
		mousemoveEvent.isUp = false;
	}
	
	/**
	 * 向上移动,直到边界
	 */
	function moveUp($rootNode, mousemoveEvent){
//		mousemoveEvent.isMove = true;
//		var top = $rootNode.offset().top - $rootNode.parent().offset().top;
//		if(top == 0){
//			mousemoveEvent.isStop = true;
//			mousemoveEvent.isMove = false;
//			return;
//		}
//		var speed = mousemoveEvent.speed;
//    	var interval = mousemoveEvent.moveInterval;
//    	if(mousemoveEvent.speed > top){
//    		speed = top;
//    		interval = (top / mousemoveEvent.speed) * mousemoveEvent.moveInterval;
//    	}
//		$rootNode.animate({top:'-=' + speed}, interval, 'linear', function(){
//			mousemoveEvent.isMove = false;
//		});
		var top = $rootNode.offset().top - $rootNode.parent().offset().top;
		move($rootNode, mousemoveEvent, 'top', -top);
	}
	
	/**
	 * 向下移动,直到边界
	 */
	function moveDown($rootNode, mousemoveEvent){
//		mousemoveEvent.isMove = true;
//		var top = $rootNode.offset().top - $rootNode.parent().offset().top;
//    	var bottom = $rootNode.parent().innerHeight() - $rootNode.innerHeight() - top;
//    	if(bottom == 0){
//			mousemoveEvent.isStop = true;
//			mousemoveEvent.isMove = false;
//			return;
//		}
//		var speed = mousemoveEvent.speed;
//    	var interval = mousemoveEvent.moveInterval;
//    	if(mousemoveEvent.speed > bottom){
//    		speed = bottom;
//    		interval = (bottom / mousemoveEvent.speed) * mousemoveEvent.moveInterval;
//    	}
//		$rootNode.animate({top:'+=' + speed}, interval, 'linear', function(){
//			mousemoveEvent.isMove = false;
//		});
		var top = $rootNode.offset().top - $rootNode.parent().offset().top;
		var bottom = $rootNode.parent().innerHeight() - $rootNode.innerHeight() - top;
		move($rootNode, mousemoveEvent, 'top', bottom);
	}
	
	/**
	 * 向左移动,直到边界
	 */
	function moveLeft($rootNode, mousemoveEvent){
//		mousemoveEvent.isMove = true;
//		var left = $rootNode.offset().left - $rootNode.parent().offset().left;
//		if(left == 0){
//			mousemoveEvent.isStop = true;
//			mousemoveEvent.isMove = false;
//			return;
//		}
//		var speed = mousemoveEvent.speed;
//    	var interval = mousemoveEvent.moveInterval;
//    	if(mousemoveEvent.speed > left){
//    		speed = left;
//    		interval = (left / mousemoveEvent.speed) * mousemoveEvent.moveInterval;
//    	}
//		$rootNode.animate({left:'-=' + speed}, interval, 'linear', function(){
//			mousemoveEvent.isMove = false;
//		});
		var left = $rootNode.offset().left - $rootNode.parent().offset().left;
		move($rootNode, mousemoveEvent, 'left', -left);
	}
	
	/**
	 * 向右移动,直到边界
	 */
	function moveRight($rootNode, mousemoveEvent){
//		mousemoveEvent.isMove = true;
//		var left = $rootNode.offset().left - $rootNode.parent().offset().left;
//    	var right = $rootNode.parent().innerWidth() - $rootNode.innerWidth() - left;
//		if(right == 0){
//			mousemoveEvent.isStop = true;
//			mousemoveEvent.isMove = false;
//			return;
//		}
//		var speed = mousemoveEvent.speed;
//    	var interval = mousemoveEvent.moveInterval;
//    	if(mousemoveEvent.speed > right){
//    		speed = right;
//    		interval = (right / mousemoveEvent.speed) * mousemoveEvent.moveInterval;
//    	}
//		$rootNode.animate({left:'+=' + speed}, interval, 'linear', function(){
//			mousemoveEvent.isMove = false;
//		});
		
		var left = $rootNode.offset().left - $rootNode.parent().offset().left;
    	var right = $rootNode.parent().innerWidth() - $rootNode.innerWidth() - left;
		move($rootNode, mousemoveEvent, 'left', right);
	}
	
	/**
	 * 移动
	 * @param $rootNode
	 * @param mousemoveEvent
	 * @param type
	 * @param value
	 */
	function move($rootNode, mousemoveEvent, type, value){
		if(value == 0){
			mousemoveEvent.isStop = true;
			mousemoveEvent.isMove = false;
			return;
		}
		mousemoveEvent.isMove = true;
		var speed = value < 0 ? -mousemoveEvent.speed : mousemoveEvent.speed;
    	var interval = mousemoveEvent.moveInterval;
    	if(mousemoveEvent.speed > Math.abs(value)){
    		speed = value;
    		interval = (Math.abs(speed) / mousemoveEvent.speed) * mousemoveEvent.moveInterval;
    	}
    	var style = {};
    	style[type] = '+=' + speed;
		$rootNode.animate(style, interval, 'linear', function(){
			mousemoveEvent.isMove = false;
			//如果有移动，则校验开关
    		$rootNode.bargetorTree.checkSwitch($rootNode);
		});
	}
	
	
	/**
	 * 调整树的高度和宽度
	 */
	$.fn.bargetorTree.adjust = function($tree){
		$tree.bargetorTree.rootNode.node.css('height', $tree.bargetorTree.rootNode.getHeight());
		$tree.bargetorTree.rootNode.node.css('width', $tree.bargetorTree.rootNode.getWidth());
	};
	
	//树节点
	function TreeNode(data, parents){
		//节点数据
		this.name = data.name;
		//父节点
		this.parents = parents;
		//子节点
		this.childNodes = [];
		//子节点数据
		this.childNodesData = data.childNodes;
		//生成的jquery对象
		this.node;
		//节点主体对象
		this.main;
		//节点左边横线对象
		this.leftHorizontalLine;
		//节点右边横线对象
		this.rightHorizontalLine;
		//节点竖线对象，如果没有子节点则空
		this.verticalLine;
		//节点ul对象，用于放子节点
		this.childNodesUl;
	}
	
	/**
	 * 创建对象
	 */
	TreeNode.prototype.build = function(){
		var node = $('<div></div>');
		node.css("position", "relative");
		if(this.name || this.name != ''){
			//如果有父节点则需要左边的横线
			if(this.parents && this.parents.main){
				this.leftHorizontalLine = this.buildHorizontalLine();
				node.append(this.leftHorizontalLine);
			}
			this.main = this.buildMain();
			node.append(this.main);
			
			//如果有子节点，生成一条横线
			if(this.childNodesData && this.childNodesData.length > 1 && this.main){

				//横线
				this.rightHorizontalLine = this.buildHorizontalLine();
				node.append(this.rightHorizontalLine);
				
				//竖线
				this.verticalLine = this.buildVerticalLine();
				node.append(this.verticalLine);
				
			}
		}
		//创建子节点
		this.buildChildNodes();
		node.append(this.childNodesUl);
		
		//调整位置
		//this.adjustPosition();
		
		this.node = node;
		return this.node;
	}
	
	/**
	 * 创建子节点
	 */
	TreeNode.prototype.buildChildNodes = function(){
		if(this.childNodesData && this.childNodesData.length > 0){
			if(!this.childNodesUl){
				this.childNodesUl = this.buildChildNodesUl();
			}
			this.childNodes = [];
			for(var i = 0, len = this.childNodesData.length; i < len; i++){
				var nodeData = this.childNodesData[i];
				if(!nodeData.name || nodeData.name == '')continue;
				var li = this.buildChildNodeLi();
				var node = new TreeNode(nodeData, this);
				li.append(node.build());
				this.childNodes.push(node);
				this.childNodesUl.append(li);
			}
		}
	}
	
	TreeNode.prototype.buildChildNodeLi = function(){
		var li = $(this.getChildNodeLiHtml());
		li.css('position', 'relative');
		return li;
	}
	
	TreeNode.prototype.getChildNodeLiHtml = function(){
		var html = '<li>';
		html += '</li>';
		return html;
	}
	
	/**
	 * 创建子节点Ul
	 */
	TreeNode.prototype.buildChildNodesUl = function(){
		var ul = $(this.getChildNodesUl());
		
		ul.css('position', 'absolute');
		ul.css('list-style', 'none');
		ul.css('padding', '0px');
		ul.css('margin', '0px');
		
		return ul;
	}
	
	/**
	 * 获取子节点UlHtml代码
	 */
	TreeNode.prototype.getChildNodesUl = function(){
		var html = "<ul>";
		html += "ul";
		return html;
	}
	
	/**
	 * 创建一条竖线
	 */
	TreeNode.prototype.buildVerticalLine = function(){
		var line = $(this.getVerticalLineHtml());
		line.css('position', 'absolute');
		line.css('height', '72px');
		line.css('width', '1px');
		line.css('border-left-style', 'solid');
		line.css('border-left-width', '1px');
		line.css('border-color', $.fn.bargetorTree.config.lineColor);
		return line;
	}
	
	/**
	 * 获取一条竖线HTML代码
	 */
	TreeNode.prototype.getVerticalLineHtml = function(){
		var html = '';
		html += '<div>';
		html += '</div>';
		return html;
	}
	
	/**
	 * 创建一条横线
	 */
	TreeNode.prototype.buildHorizontalLine = function(){
		var line = $(this.getHorizontalLineHtml());
		
		line.css('position', 'absolute');
		line.css('height', '1px');
		line.css('width', $.fn.bargetorTree.config.lineWidth + 'px');
		line.css('border-top-style', 'solid');
		line.css('border-top-width', '1px');
		line.css('border-color', $.fn.bargetorTree.config.lineColor);

		return line;
	}
	
	/**
	 * 获取一条横线HTML代码
	 */
	TreeNode.prototype.getHorizontalLineHtml = function(){
		var html = '';
		html += '<div>';
		html += '</div>';
		return html;
	}
	
	/**
	 * 创建主体
	 */
	TreeNode.prototype.buildMain = function(){
		var main = $(this.getMainHtml());
		//添加CSS属性
		main.css('position', 'absolute');
		main.css('width', $.fn.bargetorTree.config.width);
		return main;
	}
	
	/**
	 * 获取节点主体HTML代码
	 */
	TreeNode.prototype.getMainHtml = function(){
		var html = '<div class="' + $.fn.bargetorTree.config.nodeClassName + '">';
		html += '<p>';
		html += this.name;
		html += '</p>';
		html += '</div>';
		return html;
	}
	
	/**
	 * 获取节点高度
	 */
	TreeNode.prototype.getHeight = function(){
		var mainHeight = 0;
		if(this.main){
			mainHeight = this.main.outerHeight(true);			
		}
		var childHeight = this.getChildNodeHeight();
		return mainHeight < childHeight ? childHeight : mainHeight;
	}
	
	/**
	 * 获取子节点总高度
	 */
	TreeNode.prototype.getChildNodeHeight = function(){
		var height = 0;
		if(this.childNodes.length > 0){
			height += $.fn.bargetorTree.config.spaceHeight * (this.childNodes.length - 1);
			for (var i = 0, len = this.childNodes.length; i < len; i++){
				height += this.childNodes[i].getHeight();
			}
		}
		return height;
	}
	
	/**
	 * 获取节点宽度
	 */
	TreeNode.prototype.getWidth = function(){
		var width = 0;
		if(this.leftHorizontalLine){
			width += this.leftHorizontalLine.outerWidth(true);
		}
		if(this.main){
			width += this.main.outerWidth(true);			
		}
		if(this.rightHorizontalLine){
			width += this.rightHorizontalLine.outerWidth(true);			
		}
		//获取最宽的子节点宽度
		width += this.getMaxChildWidth();
		return width;
	}
	
	/**
	 * 获取最宽子节点宽度
	 */
	TreeNode.prototype.getMaxChildWidth = function(){
		var maxWidth = 0;
		if(this.childNodes.length > 0){
			for (var i = 0, len = this.childNodes.length; i < len; i++){
				var childWidth = this.childNodes[i].getWidth();
				maxWidth = childWidth > maxWidth ? childWidth : maxWidth;
			}
		}
		return maxWidth;
	}
	
	/**
	 * 调整位置
	 */
	TreeNode.prototype.adjustPosition = function(){
		this.adjustTop();
		this.adjustLeft();
		//调用子节点调整位置
		for(var i = 0, len = this.childNodes.length; i < len; i++){
			var node = this.childNodes[i];
			node.adjustPosition();
		}
	}
	
	/**
	 * 调整高度
	 */
	TreeNode.prototype.adjustTop = function(){
		var mainHeight = 0;
		var midTop;
		
		if(this.main){
			mainHeight = this.main.outerHeight(true);
		}
		
		//计算中间点位置
		if(this.childNodes.length <= 0){
			midTop = mainHeight / 2;
		}else{
			//如果有子节点则取最开头一个子节点的中间位置到最后一个子节点的中间位置
			var height = this.getHeight();
			var fristChild = this.childNodes[0];
			var lastChild = this.childNodes[this.childNodes.length - 1];
			var startTop = fristChild.getHeight() / 2;
			var lineHeight = height - (fristChild.getHeight() + lastChild.getHeight()) / 2;
			midTop = startTop + lineHeight / 2;
			
			//调整垂直线长度
			if(this.verticalLine){
				this.verticalLine.css('height', lineHeight);
				this.verticalLine.css('top', startTop);
			}
		}
		
		//调整top
		if(this.leftHorizontalLine){
			this.leftHorizontalLine.css('top', midTop);
		}
		if(this.rightHorizontalLine){
			this.rightHorizontalLine.css('top', midTop);
		}
		
		if(this.main){			
			this.main.css('top', midTop - mainHeight / 2);
		}
		
		//调整子节点位置
		var top = 0;
		for(var i = 1, len = this.childNodes.length; i < len; i++){
			var preNode = this.childNodes[i - 1];
			var node = this.childNodes[i];
			top += preNode.getHeight() + $.fn.bargetorTree.config.spaceHeight;
			node.node.css('top', top);
		}
	}
	
	/**
	 * 调整X
	 */
	TreeNode.prototype.adjustLeft = function(){
		//调整left
		var left = 0;
		if(this.leftHorizontalLine){
			left += this.leftHorizontalLine.outerWidth(true);
		}
		if(this.main){
			this.main.css('left', left);
			left += this.main.outerWidth(true);			
		}
		if(this.rightHorizontalLine){
			this.rightHorizontalLine.css('left', left);
		}
		if(this.verticalLine){
			left += this.rightHorizontalLine.outerWidth(true);
			this.verticalLine.css('left', left);
		}
		if(this.childNodesUl){
			this.childNodesUl.css('left', left);
		}
	}
	
})(jQuery);

