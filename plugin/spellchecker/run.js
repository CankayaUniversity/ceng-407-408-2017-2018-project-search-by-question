
// Init the text spellchecker
var spellchecker = new $.SpellChecker('.input', {
  lang: 'en',
  parser: 'text',
  webservice: {
    path: 'src/webservices/php/SpellChecker.php',
    driver: 'google'
  },
  suggestBox: {
    position: 'above'
  },
  incorrectWords: {
    container: '#incorrect-word-list'
  }
});
//

// Bind spellchecker handler functions
spellchecker.on('check.success', function() {
  alert('There are no incorrectly spelt words.');
});
 
$("#keyboardText").keyup(function(e){
  var ch = String.fromCharCode(e.which);

  if(ch == " "){
    spellchecker.check();
  }
})
