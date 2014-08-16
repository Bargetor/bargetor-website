(function() {
	/**
	 * 常量
	 */
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.javascript_a_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('javascript_a_button', {    
                title : '执行Javascript的A标签',
              //注意图片的路径 url是当前js的路径  
                icon : 'link',
                onclick : function() {
                	//editor.execCommand("mceInsertContent", false, '[data_chart][/data_chart]');
                	showJavascriptAWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('javascript_a_button', tinymce.plugins.javascript_a_button);
    
    //由于数据图基于代码，并且效果的展现是基于短代码，所以就直接用一个代码框，编辑好后填入。
    
    function showJavascriptAWindow(editor){
    	 /**
    	 * 创建窗体
    	 */
    	function buildWindowBody(){
    		//标题
        	var titleCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: '标题：'
        					},
        					{
        		    			name: 'title',
        						type: 'textbox'
        					}
        				]
        	}
        	
        	//代码框
        	var javascriptCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: 'javascript：'
        					},
        					{
        		    			name: 'javascript',
        						type: 'textbox',
        						multiline: true,
        						minWidth: editor.getParam("code_dialog_width", 400),
        						minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 300))
        					}
        				]
        	}
        	
        	return [{title: 'General',
    			type: 'form',
    			items: [titleCtrl, javascriptCtrl]}];
    	}
    	
    	editor.windowManager.open({
			title: "Data code",
			body: buildWindowBody(editor),
			onSubmit: function(e) {

				editor.execCommand("mceInsertContent", false, buildData(e.data));

			}
		});
    }
    
    
    /**
     * 创建数据
     * @param data
     * @returns
     */
    function buildData(data){
    	var d = '[javascript_a title=' + data.title;
    	d += ']';
    	d += data.javascript;
    	d += '[/javascript_a]';
    	return d;
    }
    
})(); 

