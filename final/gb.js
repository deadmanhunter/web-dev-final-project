var GBAPI = "79b5703be280a5e4d1e4ae5b0f8c5b9a607b7d6c";

var fetchGameJSON = function(resources,gameID){ 

	var url = "http://www.giantbomb.com/api/", 

	urlResources = ""; 

	for(var i = resources.length-1; i>=0;--i){ 

		urlResources += resources[i]+"/";

	}; 
	
	url += urlResources + gameID ; 
	url += '/?api_key='+GBAPI +'&format=json';

	return $.getJSON( url );

};