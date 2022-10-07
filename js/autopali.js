//get vars from file
$.ajax({
    url: "/scripts/sutta_words.txt",
    dataType: "text",
    success: function(data) {
	
    var accentMap = {	
      "ā": "a",
      "ī": "i",
      "ū": "u",
      "ḍ": "d",
      "ṁ": "n",
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

//sort first letter results first
source:function(req, responseFn){
  var re = $.ui.autocomplete.escapeRegex(req.term);
  var pattern1 = new RegExp("^"+re, "i");
  var a = $.grep(YOURARRAY, function(item, index){return pattern1.test(item);}); //build array item begins with input string
  var b = $.grep(YOURARRAY, function(item, index){return ((item.toLowerCase()).indexOf(re.toLowerCase())>0);}); //build array items with input string somewhere
  responseFn( a.concat(b) );
  }
