$(function() {

	var apiurl = "https://api.instagram.com/v1/tags/venicebiennale/media/recent?access_token=248660894.aee21ef.0cb44e17e81547ef994d0de5ff989bbc&callback=?"
	var access_token = location.hash.split('=')[1];
	var html = ""

		$.ajax({
			type: "GET",
			dataType: "json",
			cache: false,
			url: apiurl,
			success: parseData
		});


		function parseData(json){
			console.log(json);

			$.each(json.data,function(i,data){
				html += '<img class= "search" src ="' + data.images.low_resolution.url + '">'
			});

			console.log(html);
			$("#search").append(html);

		}




 });
