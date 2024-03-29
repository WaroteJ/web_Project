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



//List all the user 
app.get('/users', (req, res) => {
	con.query("SELECT  user.nom, user.prenom, user.droit, centre.nom as centre  FROM user INNER JOIN centre ON user.id_Centre = centre.id", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

// List all the commands
app.get('/commandes', (req, res) => {
	con.query("SELECT  user.nom, user.prenom, commande.id, commande.date ,article.nom_article,article_commande.qte FROM ((commande INNER JOIN user ON commande.id_User = user.id) INNER JOIN article_commande ON commande.id = article_commande.id_Commande)  INNER JOIN article on article_commande.id = article.id WHERE commande.etat=1 ORDER BY commande.id", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List all the articles
app.get('/articles', (req, res) => {
	con.query("SELECT nom_article as nom, description, prix,url categorie.nom as categorie FROM article INNER JOIN categorie ON article.id_Categorie = categorie.id", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article ordered of one centre
app.get('/articles/up/:centre', (req, res) => {
	 	con.query("SELECT url, nom_article, prix, id FROM article WHERE deleted = 0  AND id_centre =" + req.params.centre +" ORDER BY prix", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the top 3 the most sold articles of an center
app.get('/articles/carousel/:centre', (req, res) => {
	let request =  "SELECT article.url FROM `article_commande` INNER JOIN article on article_commande.id = article.id WHERE id_centre="+req.params.centre+" GROUP BY article_commande.id ORDER BY SUM(`qte`) DESC LIMIT 3";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article ordered 
app.get('/articles/down/:centre', (req, res) => {
	let request =  "SELECT url, nom_article, prix, id FROM article WHERE deleted = 0  AND id_centre=" +req.params.centre+" ORDER BY prix DESC";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article grouped by type of one centre
app.get('/articles/type/:centre', (req, res) => {
	let request =  "SELECT categorie.nom  FROM categorie INNER JOIN article ON categorie.id = article.id_Categorie WHERE deleted = 0 AND id_centre=" +req.params.centre+" GROUP BY id_Categorie";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});


//List the user of one centre
app.get('/users/:user_centre', (req, res) => {
	request =  "SELECT  user.nom, user.prenom, user.droit  FROM user WHERE id_Centre ="+ req.params.user_centre+"";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//Count user number of one centre 
app.get('/users/total/:user_centre', (req, res) => {
	con.query("SELECT COUNT(nom) as total FROM user WHERE id_Centre ="+req.params.user_centre+"", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List an specific article
app.get('/articles/:choix', (req, res)=> {
	request =  "SELECT url, nom_article, prix, id FROM article WHERE  id= "+ req.params.choix +"";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article with the corresponding id and the corresponding center with specifics letters
app.get('/articles/:choix/:user_centre', (req, res)=> {
	request =  "SELECT url, nom_article, prix, id FROM article WHERE  id_centre =" + req.params.user_centre + " AND UPPER(nom_article) LIKE UPPER('%"+ req.params.choix +"%') AND deleted = 0";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article grouped by type of one centre
app.get('/articles/type/:categorie/:centre', (req, res) => {
	let request = "SELECT categorie.nom, article.id as id, article.nom_article as nom_article, article.url as url, article.prix as prix FROM categorie INNER JOIN article ON categorie.id = article.id_Categorie WHERE deleted = 0 AND categorie.nom ='"+ req.params.categorie+"'	 AND id_centre=" +req.params.centre+" ORDER BY categorie.nom";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List for pagination
app.get('/users/:user_centre/:debut/:pas', (req, res)=>{
	let request = "SELECT user.nom, user.prenom, user.droit  FROM user WHERE id_Centre ="+ req.params.user_centre+" LIMIT "+ req.params.debut + " , " + req.params.pas+"";
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

// Start the server
app.listen(port, hostname, function(){
	console.log("Mon serveur fonctionne sur http://"+ hostname +":"+port); 
});