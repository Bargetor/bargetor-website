(function() {
	/**
	 * 常量
	 */

	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.video_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('video_button', {    
                title : '演说视频',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/video-icon.png',
                onclick : function() { 
                	showVideoWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('video_button', tinymce.plugins.video_button);
    
    function showVideoWindow(editor){
    	
    	function buildData(data){
    		return '[bargetor_video url="' + data.videoUrl + '"][/bargetor_video]';
    		
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
        						type: 'label', text: '视频地址：'
        					},
        					{
        		    			name: 'videoUrl',
        						type: 'textbox'
        					}
        				]
        	}
        	
        	
        	return [{title: 'General',
				type: 'form',
				items: [videoCtrl]}];
    	}
    	
    	editor.windowManager.open({
			title: "演说视频",
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
