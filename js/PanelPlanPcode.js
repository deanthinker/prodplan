function PanelPlanPcode(fxn){
var onSelectChangeFxn = fxn;
var config = {
				rows:[
					{
						view:"datatable",
						columns:[
							{ id:"pcode",	header:["PCODE", {content:"textFilter"}], sort:"int"},
							{ id:"pcname",	header:["Name",  {content:"textFilter"}], sort:"string"}
						],
						autowidth:true,
						navigation:true,
						select:"row",

						on:{
							onSelectChange: onSelectChangeFxn,
							
							onAfterLoad:function(){
								//document.getElementById('testC').innerHTML = this.count();	
							},
					        onBeforeLoad:function(){
					            this.showOverlay("資料讀取中...");
					        },
					        onAfterLoad:function(){
					            this.hideOverlay();
					        }							
						},
						url:"http://localhost/prodplan/php/pln_pcodelist.php"
					}
				]
			};

			config.filterByAll=function(){
				//get fitler values
				var pcname = this.getFilter("pcname").value.toString();
				var pcode = this.getFilter("pcode").value.toString();
				//unfilter for empty search text
				if (!pcname && !pcode) return this.filter();

				//filter using or logic
				this.filter(function(obj){
					if (equals(obj.pcode, pcode)) return true;
					if (equals(obj.pcname, pcname)) return true;
					return false;
				});
			};			
	return config;
}

function updateProdPlanTable(chosen_pcode){
	$$('ID_prodplantable').clearAll();
	$$('ID_prodplantable').load("php/getVegeSeedProdPlan.php?pcode="+chosen_pcode);
}


