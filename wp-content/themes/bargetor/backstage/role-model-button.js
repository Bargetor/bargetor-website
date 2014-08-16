(function() {
	/**
	 * 常量
	 */
	var Role_Model_Name = 'role_model';
	var Role_Model_Age_Name = 'age';
	var Role_Model_Sex_Name = 'sex';
	var Role_Model_Job_Name = 'job';
	var Role_Model_Demand_Name = 'demand';
	
	
	//注意这里有个 role_model_button
    tinymce.create('tinymce.plugins.role_model_button', {
        init : function(editor, url) {
        	//注意这一行有一个 role_model_button
        	editor.addButton('role_model_button', {    
                title : '人物角色',
              //注意图片的路径 url是当前js的路径  
                image : url+'/images/role-model-icon.png',
                onclick : function() { 
                	showRoleModelWindow(editor);
                	//editor.selection.setContent('[role_model_button]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;
        },   
    });
    //注意这里有两个 role_model_button
    tinymce.PluginManager.add('role_model_button', tinymce.plugins.role_model_button);
    
    
    /**
     * 显示人物角色模型窗口
     * @param editor
     * @returns
     */
    function showRoleModelWindow(editor) {
    	//数据
    	var data = {};
    	/**
    	 * 创建数据
    	 */
    	function buildData(data){
    		var tagStr = '[' +  Role_Model_Name;
    		
    		//职业，年龄，性别为属性
    		tagStr += ' ' + Role_Model_Job_Name + '="' + data[Role_Model_Job_Name] + '" ';
    		tagStr += ' ' + Role_Model_Age_Name + '="' + data[Role_Model_Age_Name] + '" ';
    		tagStr += ' ' + Role_Model_Sex_Name + '="' + data[Role_Model_Sex_Name] + '" ';
    		
    		tagStr += ']';
    		
    		
    		//需求为子短代码
    		
    		//设置需求
    		if(data[Role_Model_Demand_Name] && data[Role_Model_Demand_Name] != ''){
    			var demands = data[Role_Model_Demand_Name].split('\n');
    			for(var i = 0, len = demands.length; i < len; i++){
        			var demand = '[' +  Role_Model_Demand_Name + ']';
        			demand += demands[i];
        			demand += '[/' +  Role_Model_Demand_Name + ']';
        			//tagStr += '<br/>';
        			tagStr += demand;
        		}
    		}
    		
    		tagStr += '[/' +  Role_Model_Name +']';
    		return tagStr;
    	}
    	
    	/**
    	 * 创建窗体
    	 */
    	function buildWindowBody(data){
    		//工作
        	var jobCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: '工作：'
        					},
        					{
        		    			name: Role_Model_Job_Name,
        						type: 'textbox',
        						value: data[Role_Model_Job_Name]
        					}
        				]
        	}
        	
        	//年龄
        	var ageCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: '年龄：'
        					},
        					{
        		    			name: Role_Model_Age_Name,
        						type: 'textbox',
        						value: data[Role_Model_Age_Name]
        					}
        				]
        	}
        	
        	
        	//性别
        	var sexListCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: '性别：'
        					},
        					{
        		    			name: Role_Model_Sex_Name,
        						type: 'listbox',
        						value: data[Role_Model_Sex_Name],
        						values:[{
        							text: '男', value: '男'
        						},{
        							text: '女', value: '女'
        						}]
        					}
        				]
        	}
        	
        	//需求框
        	var demandCtrl = {
        			type: 'container',
        			layout: 'flex',
        			direction: 'row',
        			align: 'left',
        			spacing: 5,
        			items: [
        					{
        						type: 'label', text: '需求（换行分隔）：'
        					},
        					{
        		    			name: Role_Model_Demand_Name,
        						type: 'textbox',
        						value: data[Role_Model_Demand_Name],
        						multiline: true,
        						minWidth: editor.getParam("code_dialog_width", 400),
        						minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 300))
        					}
        				]
        	}
        	
        	return [{title: 'General',
				type: 'form',
				items: [jobCtrl, ageCtrl, sexListCtrl, demandCtrl]}];
    	}
    	
    	/**
    	 * 提交
    	 */
    	function onSubmit(e){
    		// We get a lovely "Wrong document" error in IE 11 if we
    		// don't move the focus to the editor before creating an undo
    		// transation since it tries to make a bookmark for the current
    		// selection
    		//editor.focus();
    		
    		editor.execCommand("mceInsertContent", false, buildData(e.data));

//    		editor.selection.setCursorLocation();
//    		editor.nodeChanged();
    	}
    	
    	/************************* 执行 **********************************/

    	//打开窗口
    	editor.windowManager.open({
    		title: "人物角色模型",
    		data: data,
    		bodytype: 'tabpanel',
    		body: buildWindowBody(data),
    		onSubmit: onSubmit
    	});
    }

})(); 

