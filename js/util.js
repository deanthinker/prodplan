const FI = 0;
const FO = 1;
const AI = 2;
const AO = 3;
const NET = 4;

const STD = 0; //standard
const NSTD = 1; //non-standard
const RES = 0; //reserved
const AVA = 1; //available


function getSeason(month){
	switch (month){
		case 1:	case 2:	case 3:
			return 1;
		case 4:	case 5:	case 6:
			return 2;
		case 7:	case 8:	case 9:
			return 3;
		case 10: case 11: case 12:
			return 4;
	}
}

function period2seasonIndex(period){
	var periodArr = getPeriodArray();
	for (var i=0; i < periodArr.length; i++){
		if (period == periodArr[i])
			return i;
	}
	return -1; //error; not possible
}

function getCurrentPeriod(){
	var dt = new Date();
	var year = dt.getFullYear();
	var month = dt.getMonth() + 1;
	var season = getSeason(month);
	return year.toString() + season.toString();	
}

function getPeriodArray(){
	var dt = new Date();
	var year = dt.getFullYear();
	var month = dt.getMonth() + 1;
	var season = getSeason(month);

	var periodArr = new Array();
	var totalSeason = 8;
	var seasonCount = season;
	var headerString = "";
	for (i = 0; i < totalSeason; i++){
		headerString = year.toString()+seasonCount.toString();
		periodArr[i] = headerString;
		seasonCount+=1;
		if (seasonCount==5){
			seasonCount = 1;
			year+=1;
		}

	}
	return periodArr;
}

function getSeasonArr(totalSeason){
	var dt = new Date();
	var year = dt.getFullYear();
	var month = dt.getMonth() + 1;
	var season = getSeason(month);

	var headerArr = new Array();
	//var totalSeason = 8;
	var seasonCount = season;
	var headerString = "";
	for (i = 0; i < totalSeason; i++){
		headerString = year.toString() +seasonCount.toString();
		headerArr[i] = headerString;
		seasonCount+=1;
		if (seasonCount==5){
			seasonCount = 1;
			year+=1;
		}

	}
	return headerArr;
}