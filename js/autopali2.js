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
 
        		
    var normalize = function( term ) {
      var ret = "";
      for ( var i = 0; i < term.length; i++ ) {
        ret += accentMap[ term.charAt(i) ] || term.charAt(i);
      }
      return ret;
    };
 
  	var allWords = data.split('\n');

    $( "#paliauto" ).autocomplete({
	minLength: 3,
      source: function( request, response ) {
		var re = $.ui.autocomplete.escapeRegex(request.term);
		var matcher = new RegExp( "^"+re, "i");
		var matcher2 = new RegExp( "!"+re, "i"); 

var a = $.grep( allWords , function( value ) {value = value.label || value.value || value; 
var firstresults = matcher.test( value ) || matcher.test( normalize( value ) );
return  firstresults ;       
	   });
var b = $.grep( allWords , function( value ) {value = value.label || value.value || value; 
var firstresults = matcher2.test( value ) || matcher2.test( normalize( value ) );
return  firstresults ;       
	   });
response( matcher.concat(matcher2) );
 }
    });
    }
});

