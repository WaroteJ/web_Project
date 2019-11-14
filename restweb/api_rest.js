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

let request;
 
// Extract the entire body portion of an incoming requset stream and exposes it on req.body
let bodyParser = require ("body-parser");

app.use(bodyParser.urlencoded({extended:false}));
app.use(bodyParser.json());

//List all the user when get request on /users
app.get('/users', (req, res) => {
	con.query("SELECT  user.nom, user.prenom, user.droit, centre.nom as centre  FROM user INNER JOIN centre ON user.id_Centre = centre.id", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the user with the corresponding id when get request on /users/user_:id
app.get('/users/:user_centre', (req, res) => {
	request =  "SELECT  user.nom, user.prenom, user.droit, centre.nom as centre  FROM user INNER JOIN centre ON user.id_Centre = centre.id WHERE centre.nom="+'"'+ req.params.user_centre+'"';
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List all the articles when get request on /articles
app.get('/articles', (req, res) => {
	con.query("SELECT nom_article as nom, description, prix,url categorie.nom as categorie FROM article INNER JOIN categorie ON article.id_Categorie = categorie.id", function (err, result) {
		res.send(JSON.stringify(result));
	});
});



// app.get('/articles/:choix', (req, res)=> {
// 	let type = typeof req.params.choix;
// 	if(type === "number"){
// 		//List the article with the corresponding id when get request on /articles/choix:id
// 		request =  "SELECT url, nom_article, prix, id FROM article WHERE id ="+ req.params.choix;
// 		console.log(req.params.choix);
// 	} else if(req.params.choix == "up" && type == "string"){
// 			//List the article ordered when get request on /articles/up
// 			request = "SELECT url, nom_article, prix, id FROM article ORDER BY prix";
// 			console.log(req.params.choix);

// 		}else if (req.params.choix == "down" && type == "string"){
// 			//List the article ordered when get request on /articles/down
// 			request =  "SELECT url, nom_article, prix, id FROM article ORDER BY prix DESC";
// 			console.log(req.params.choix);

// 		}else if (req.params.choix == "type" && type == "string"){
// 			//List the article grouped by type when get request on /articles/down
// 			request =  "SELECT url, nom_article, prix, id FROM article ORDER BY id_Categorie";
// 			console.log(req.params.choix);

// 		}
// 	con.query(request, function (err, result) {
// 		res.send(JSON.stringify(result));
// 	});
// });


//List the article ordered when get request on /articles/up
app.get('/articles/up', (req, res) => {
	 	con.query("SELECT url, nom_article, prix, id FROM article WHERE deleted = 0 ORDER BY prix", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article ordered when get request on /articles/down
app.get('/articles/down', (req, res) => {
	let request =  "SELECT url, nom_article, prix, id FROM article WHERE deleted = 0 ORDER BY prix DESC";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article grouped by type when get request on /articles/down
app.get('/articles/type', (req, res) => {
	let request =  "SELECT url, nom_article, prix, id FROM article WHERE deleted = 0 ORDER BY id_Categorie";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article with the corresponding id when get request on /articles/article_:id
app.get('/articles/:choix', (req, res)=> {
	request =  "SELECT url, nom_article, prix, id FROM article WHERE deleted = 0 WHERE id ="+ req.params.choix;
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

// Start the server
app.listen(port, hostname, function(){
	console.log("Mon serveur fonctionne sur http://"+ hostname +":"+port); 
});