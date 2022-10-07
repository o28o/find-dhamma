$.ajax({
    url: "/scripts/sutta_words.txt",
    dataType: "text",
    success: function(data) {
		    var accentMap = {	
      "ā": "a",
      "ī": "i",
      "ū": "u",
      "ḍ": "d",
      "ṁ": "m",
      "ṁ": "m",
      "ṅ": "n",
      "ṇ": "n",
      "ṭ": "t",
      "ñ": "n"
    };
	
        var availableTags = data.split('\n');
        $("#tags").autocomplete({
		  minLength: 3,
          source: function(request, response) {
                var results = $.ui.autocomplete.filter(availableTags, request.term);
                response(results); // .slice(0, 10) Display the first 10 results
            }
        });
    }
});
