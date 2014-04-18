
// function dbpost(){
//     $.ajax({
//         type: "POST",
//         url: "../final/search.php",
//         data: {functionname: 'dblog'},
//         success: function (quer) {
//             console.log($(quer).val()); 
//             //$("")

//         }
//     });

// }

//search api call
function gamesearch() {
	$.ajax({
        url: "http://api.giantbomb.com/search/",
        dataType: "jsonp",
        jsonp: 'json_callback',
        data: {
            api_key: '',
            query: $("#gsearch").val(),
            format: 'jsonp',
            limit: '10',
            page: '1',
            field_list: "image,deck,name,site_detail_url",
            resources: 'game'
        },
        success: function(res) {
        	if(res.error == "OK"){
          		//console.log(res);
                //document.getElementById("searchresults").innerHTML = "";
                //$(document.getElementById("searchresults")).append('<h1>' + res.number_of_total_results + ' Results</h1>');
        	



        		var txt = "";
        		txt +=	'<table border="1">';
        		$.each(res.results, function( idx) {
        			var gameDictionary = res.results[idx];


                	txt +=	'<tr>' +
                				"<td width='150' align='center' valign='top' style='padding-left:4px'>" +
                					'<a href="' + gameDictionary.site_detail_url + 
                					'""><img src="' + gameDictionary.image.medium_url + '" border="0" width="120" align="left" /></a>' +
                				'</td>' +
                				'<td width="680" valign="top" align="left">' +
                					'<h2>' + gameDictionary.name + '</h2></br>' +
                	 				'<h3>' + gameDictionary.deck + '</h3></br>' +
                	 			'</td>' +
                	 		'</tr>';
            	
				});
				txt += '</table>';
				//console.log(txt);

				$(document.getElementById("searchresults")).append(txt);
                //$("#searchresults").innerHTML = txt;
                // var searchstr =  { 
                //     'searchstring'  : $("#gsearch").val() //Store name fields value
                // };

                // alert(searchstr);
                // savesearch(searchstr);
            }

            else alert("Unable to search")
		}


    });

    var searchstr =  { 
        'searchstring'  : $("#gsearch").val() //Store name fields value
    };

    //alert(searchstr);
    savesearch(searchstr);
}
function savesearch(searchterm){
    $.ajax({
        type : 'POST',
        url: "../final/search2.php",
        dataType: "json",
        data : searchterm,
        success: function(res) {
            console.log("record saved.");
        }
    });
}



function newgames(date) {
	$.ajax({
            url: "http://api.giantbomb.com/releases/",
            dataType: "jsonp",
            jsonp: 'json_callback',
            data: {
                api_key: '',
                filter: date,
                format: 'jsonp',
                limit: '20',
                field_list: "name,site_detail_url,image"
            },
            success: function(res) {
            	if(res.error == "OK"){
            		//console.log(res);
                    //document.getElementById("searchresults").innerHTML = "";
                    //$(document.getElementById("searchresults")).append('<h1>' + res.number_of_total_results + ' Results</h1>');
            	



            		var txt = "";
            		txt +=	'<table border="1">';
            		$.each(res.results, function( idx) {
            			var gameDictionary = res.results[idx];
            			//console.log( gameDictionary.name );
                		//console.log(res.results);
                		//console.log(gameDictionary.name);


                    	txt +=	'<tr align="center">' +
                    				"<td width='150' align='center' valign='top' style='padding-left:4px'>" +
                    					'<a href="' + gameDictionary.site_detail_url + 
                    					'""><img src="' + ifnull(gameDictionary.image) + '" border="0" width="120" align="left" /></a>' +
                    				'</td>' +
                    				'<td width="680" valign="top" align="left">' +
                    					'<h2>' + gameDictionary.name + '</h2></br>' +//'<h3>' + gameDictionary.deck + '</h3></br>' +
                    	 			'</td>' +
                    	 		'</tr>';
                	
					});
				txt += '</table>';
				//console.log(txt);

				$(document.getElementById("searchresults")).append(txt);
                $("#searchresults").innerHTML = txt;
            }

            else alert("Unable to search")
		}


    });
}	




    // get individual dates for upcoming and recent games
	function getNextWeeksDate(nextday){

		var today = new Date();
		today.setDate(today.getDate() + nextday);	
		var searchString = 'release_date:' + today.getFullYear() + '-' + ( today.getMonth() + 1) + '-' + today.getDate();
		return searchString;

	}

//is image result null
function ifnull(jsn){
	if(jsn == null){
		return "giantbomb.png";
	}
	else return jsn.medium_url;

}
