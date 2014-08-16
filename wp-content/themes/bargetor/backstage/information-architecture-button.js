(function() {
	/**
	 * 常量
	 */
	
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.information_architecture_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('information_architecture_button', {    
                title : '信息架构',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/information-architecture-icon.png',
                onclick : function() { 
                	showInformationArchitectureWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('information_architecture_button', tinymce.plugins.information_architecture_button);

    function showInformationArchitectureWindow(editor){
    	
    	function buildData(data){
    		return '[information_architecture]' + data.data + '[/information_architecture]';
    		
    	}
    	
    	editor.windowManager.open({
			title: "信息架构",
			body: {
				type: 'textbox',
				name: 'data',
				multiline: true,
				minWidth: editor.getParam("code_dialog_width", 600),
				minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 500)),
				spellcheck: false,
				style: 'direction: ltr; text-align: left'
			},
			onSubmit: function(e) {
				// We get a lovely "Wrong document" error in IE 11 if we
				// don't move the focus to the editor before creating an undo
				// transation since it tries to make a bookmark for the current selection
				editor.execCommand("mceInsertContent", false, buildData(e.data));
			}
		});
    	
    }
})(); 

