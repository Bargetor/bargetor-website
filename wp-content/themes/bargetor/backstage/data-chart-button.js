(function() {
	/**
	 * 常量
	 */
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.data_chart_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('data_chart_button', {    
                title : '数据图表',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/data-chart-icon.png',
                onclick : function() {
                	//editor.execCommand("mceInsertContent", false, '[data_chart][/data_chart]');
                	showDataChartWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('data_chart_button', tinymce.plugins.data_chart_button);
    
    //由于数据图基于代码，并且效果的展现是基于短代码，所以就直接用一个代码框，编辑好后填入。
    
    function showDataChartWindow(editor){
    	editor.windowManager.open({
			title: "Data code",
			body: {
				type: 'textbox',
				name: 'code',
				multiline: true,
				minWidth: editor.getParam("code_dialog_width", 600),
				minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 500)),
				spellcheck: false,
				style: 'direction: ltr; text-align: left'
			},
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
    	//获取一个时间作为图表ID
    	var date = new Date();
    	var d = '[data_chart data_chart_id=data_chart_' + date.getTime();
    	d += ']';
    	d += data.code;
    	d += '[/data_chart]';
    	return d;
    }
    
})(); 

