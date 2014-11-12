function PanelProdFcst(){

var config = {
				id:"ID_prodfcsttable",
				view: "datatable",
				
				columns:[
					{id:"fcstid", width: 60,header:"編號", sort:"int"},
					{id:"agentid", width: 80,header:"需求端", sort:"int"},
					{id:"pcode", width: 70, header:"電編", sort:"string"},
					{id:"pcname", header:"品名", sort:"string"},
					{id:"yq", width: 80, header:"季", sort:"int"},
					{id:"planqty", width: 80, header:"數量", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}},
					{id:"class", width: 50,header:"類季", sort:"string"},
					{id:"state", width: 70, header:"狀態", sort:"string"},
					{id:"uprice", width: 80, header:"參考價", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}},
					{id:"totalamt", width: 80, header:"總額", sort:"int",css:{"text-align":"right"}},
					{id:"alloc", width: 80, header:"分配", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}},
					{id:"accushp", width: 80, header:"累計出", sort:"int", format:webix.i18n.numberFormat,css:{"text-align":"right"}}
				],
				
				//autoConfig:true,
			    on:{
			        onBeforeLoad:function(){
			            this.showOverlay("資料讀取中...");
			        },
			        onAfterLoad:function(){
			            this.hideOverlay();
			        }
			    },				
				//autoconfig:true, //using input data field as column names
				navigation:true,
				select:"row",				
				url:"php/getVegeSeedForecast.php"
			};

	return config;
}

function updateFcstTable(chosen_pcode){
	$$('ID_prodfcsttable').clearAll();
	$$('ID_prodfcsttable').load("php/getVegeSeedForecast.php?pcode="+chosen_pcode);
}
