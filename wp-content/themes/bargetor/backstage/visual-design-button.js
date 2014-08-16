(function() {
	/**
	 * 常量
	 */
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.visual_design_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('visual_design_button', {    
                title : '视觉设计',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/visual-design-icon.png',
                onclick : function() {
                	editor.execCommand("mceInsertContent", false, '[visual_design]');
                	//showRoleModelWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('visual_design_button', tinymce.plugins.visual_design_button);
})(); 

