//get vars from file src="/js/autopali.js"
$.ajax({
    url: "/assets/texts/sutta_words.txt",
    dataType: "text",
    success: function(data) {
	
    var accentMap = {	
      "ā": "a",
      "ī": "i",
      "ū": "u",
      "ḍ": "d",
      "ḷ": "l",
      "ṁ": "n",
      "ṁ": "m",
      "ṅ": "n",
      "ṇ": "n",
      "ṭ": "t",
      "ñ": "n",
	  "ss": "s",
	  "cc": "c"	  
    };
 
        		
    var normalize = function( term ) {
      var ret = "";
      for ( var i = 0; i < term.length; i++ ) {
        ret += accentMap[ term.charAt(i) ] || term.charAt(i);
      }
      return ret;
    };
 
  	var allWords = data.split('\n');
   
   function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
    
    $( "#paliauto" ).autocomplete({
	minLength: 3,
//	multiple: true,
//  multipleSeparator: " ",
      source: function( request, response ) {
		var re = $.ui.autocomplete.escapeRegex(request.term);
		var matchbeginonly = new RegExp("^"+re, "i");
		var matchall = new RegExp( re, "i");
		
var listBeginOnly = $.grep( allWords , function( value ) {value = value.label || value.value || value; 
var results = matchbeginonly.test( value ) || matchbeginonly.test( normalize( value ) );
	return results
	   });
var listAll = $.grep( allWords , function( value ) {value = value.label || value.value || value; 
var results = matchall.test( value ) || matchall.test( normalize( value ) );
	return results ;       
	   });   
	   
listAll = listAll.filter( function( el ) {
  return !listBeginOnly.includes( el );
} );
	 listPrior = (listBeginOnly.concat(listAll));
//var b = $.grep(allWords, function(item, index){return ((item.toLowerCase()).indexOf(re.toLowerCase())>0);});
 // delegate back to autocomplete, but extract the last term
response( $.ui.autocomplete.filter(
            listPrior, extractLast( request.term ) ) ); // end source
 }, 
 focus: function() {
          // prevent value inserted on focus
          return false;
        },
 select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( " " );
          return false;
          // end select
        }
// end autocomplete 
    });
// end success parsing file
    }
// end ajax    
});