(function() {
	/**
	 * 常量
	 */
	
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.role_model_list_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('role_model_list_button', {    
                title : '人物角色集',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/role-model-list-icon.png',
                onclick : function() { 
                	editor.execCommand("mceInsertContent", false, '[role_model_list]<br/>[/role_model_list]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('role_model_list_button', tinymce.plugins.role_model_list_button);

})(); 

