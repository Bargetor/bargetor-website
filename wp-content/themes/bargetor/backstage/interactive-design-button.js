(function() {
	/**
	 * 常量
	 */
	
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.interactive_design_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('interactive_design_button', {    
                title : '交互设计',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/interactive-design-icon.png',
                onclick : function() { 
                	showInteractiveDesignWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('interactive_design_button', tinymce.plugins.interactive_design_button);

function showInteractiveDesignWindow(editor){
    	
    	function buildData(data){
    		return '[interactive_design url="' + data.url + '" isTemplatePath="' + data.isTemplatePath + '"][/interactive_design]';
    		
    	}
    	
    	/**
    	 * 创建窗体
    	 */
    	function buildWindowBody(){
    		//工作
        	var videoCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: 'Axure相对地址：'
        					},
        					{
        		    			name: 'url',
        						type: 'textbox'
        					},
        					{
        						name: 'isTemplatePath', 
        						type: 'checkbox', 
        						checked: false, 
        						text: '是否存放于模板目录(否则就在上传目录)'
        					}
        				]
        	}
        	
        	
        	return [{title: 'General',
				type: 'form',
				items: [videoCtrl]}];
    	}
    	
    	editor.windowManager.open({
			title: "交互设计",
			body: buildWindowBody(),
			onSubmit: function(e) {
				// We get a lovely "Wrong document" error in IE 11 if we
				// don't move the focus to the editor before creating an undo
				// transation since it tries to make a bookmark for the current selection
				editor.execCommand("mceInsertContent", false, buildData(e.data));
			}
		});
    	
    }
})(); 

