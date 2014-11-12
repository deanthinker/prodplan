function PanelProdPlan(){

var config = {
				id:"ID_prodplantable",
				view: "datatable",
				editable:true,
				editaction:"dblclick",
				columns:[
					{id:"plannum", header:"計畫編號", sort:"string"},
					{id:"prodnum", header:"生產編", sort:"string"},
					{id:"seednum", header:"原種", sort:"string"},
					{id:"pcode", width: 70, header:"電編", sort:"string"},
					{id:"pcname", header:"品名", sort:"string"},
					{id:"yq", width: 80,header:"生效季", sort:"int"},
					{id:"estdyq", width: 80,header:"交期季", sort:"int"},
					{id:"site", width: 70, header:"產地", sort:"string"},
					{id:"qty", width: 80,header:"數量KG", sort:"int",css:{"text-align":"right"}},
					{id:"landsize", width: 80, header:"面積", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}},
					{id:"curr", width: 50,header:"幣別", sort:"string"},
					{id:"ref_cost", width: 80, header:"參考價", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}},
					{id:"report1mon", width: 80,header:"月報", sort:"int", editor:"text",css:{"text-align":"center"}},
					{id:"report1qty", width: 80,header:"報數量", sort:"int", editor:"text",css:{"text-align":"right"}},
					{id:"report1ym", width: 80,header:"交期月", sort:"int", editor:"text",css:{"text-align":"center"}},
					{id:"note", width: 480,header:"備註", editor:"popup"}
				],
				
				//autoConfig:true,
			    on:{
			        onBeforeLoad:function(){
			            this.showOverlay("資料讀取中...");
			        },
			        onAfterLoad:function(){
			            this.hideOverlay();
			        },
			        onAfterEditStop:function(state, editor, ignoreUpdate){
					    if(state.value != state.old){
					    	var item = this.getItem(this.getSelectedId().row);		
					        //webix.message("Cell value was changed to " + state.value);
							webix.message("item " + "=" + item["plannum"]);
							var param = {plannum:item["plannum"],
										report1mon:item["report1mon"],
										report1qty:item["report1qty"],
										report1ym:item["report1ym"],
										note:item["note"]
										};
							webix.ajax().sync().get("php/updateVegeSeedProdPlanReport.php", param, function(response){
								webix.message(response);
							});							
					    } 
			        }
			    },				
				//autoconfig:true, //using input data field as column names
				navigation:true,
				select:"row",				
				url:"php/getVegeSeedProdPlan.php"
			};
	return config;
}