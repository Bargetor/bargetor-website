(function() {
	/**
	 * 常量
	 */
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.sketch_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('sketch_button', {    
                title : '原型草图',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/sketch-icon.png',
                onclick : function() {
                	editor.execCommand("mceInsertContent", false, '[sketch]');
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
    tinymce.PluginManager.add('sketch_button', tinymce.plugins.sketch_button);
    
})(); 

