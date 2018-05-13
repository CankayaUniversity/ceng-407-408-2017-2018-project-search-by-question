var express = require('express');

var app = express();

app.disable('x-powered-by');

var mDict;

// Spellchecker
var sc = require('simple-spellchecker');
sc.getDictionary("en-US", "./node_modules/simple-spellchecker/dict",function(err, dictionary) {
    if(!err) {
        mDict = dictionary;
    }else{
    	console.log("dictionary Error: " + err);
    }
}); 

console.log(mDict);

var handlebars = require('express-handlebars').create({defaultLayout:'main'})

app.engine('handlebars', handlebars.engine);
app.set('view engine', 'handlebars');

app.set('port', process.env.PORT || 8884);

app.use(express.static(__dirname + '/public'));

app.get('/', function(req, res){
	res.render('home');
});

app.get('/datasets', function(req, res){
	res.render('datasets',{layout: 'dtsets'});
});
app.get('/dataset', function(req, res){
	res.render('dataset',{layout: 'dtset'});
});

app.get('/result', function(req, res){

	res.render('result', {layout: 'res'});
});


app.get('/suggestions', function(req, res){

	var word = req.query.word;

	var suggestions = mDict.getSuggestions(word);

	res.send(suggestions);
});

app.get('/about', function(req, res){
	res.render('about');
});

app.use(function(req, res){
	res.type('text.html');
	res.status(404);
	res.render('404');
});

app.listen(app.get('port'), function(){
	console.log('Node server started at port 8884.\nServer: http://localhost:8884/');
});