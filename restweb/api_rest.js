// To allow us to use the express functionnalities  
let express = require('express'); 

let cors = require('cors');
// Defining the server's parameters
let hostname = 'localhost'; 
let port = 3000; 

//Creating express object to. 
let app = express(); 

// Database connection
let mysql = require('mysql');
let con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "bde"
});

app.use(cors());

// Extract the entire body portion of an incoming requset stream and exposes it on req.body
let bodyParser = require ("body-parser");
app.use(bodyParser.urlencoded({extended:false}));
app.use(bodyParser.json());

//List all the user when get request on /users
app.get('/users', (req, res) => {
	con.query("SELECT * FROM user", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the user with the corresponding id when get request on /users/user_:id
app.get('/users/:user_id', (req, res) => {
	let request =  "SELECT nom, prenom,droit FROM user WHERE id ="+ req.params.user_id;
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List all the articles when get request on /articles
app.get('/articles', (req, res) => {
	con.query("SELECT * FROM article", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article with the corresponding id when get request on /articles/article_:id
app.get('/users/:article_id', (req, res) => {
	let request =  "SELECT * FROM article WHERE id ="+ req.params.article_id;
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});


// Start the server
app.listen(port, hostname, function(){
	console.log("Mon serveur fonctionne sur http://"+ hostname +":"+port); 
});