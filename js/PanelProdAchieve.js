function PanelProdAchieve(){

	var config = {
				id:"ID_prodachtable",
				view: "datatable",
				
				columns:[
					{id:"pcode", width: 60,header:"電編", sort:"int"},
					{id:"site", width: 80,header:"產地", sort:"string"},
					{id:"yr", width: 70, header:"年度", sort:"int"},
					{id:"sbkg", width: 100,header:"當年進貨Kg", sort:"int", css:{"text-align":"right"}},
					{id:"pqty", width: 100, header:"計畫生產Kg", sort:"int", css:{"text-align":"right"}},
					{id:"achrate", width: 80, header:"達成率%", sort:"int", css:{"text-align":"right"}}

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
				url:"php/getVegeSeedAchrate.php"
			};
	return config;
}

function updateAchTable(chosen_pcode){
	$$('ID_prodachtable').clearAll();
	$$('ID_prodachtable').load("php/getVegeSeedAchrate.php?pcode="+chosen_pcode);
}


