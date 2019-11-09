//Connection to the database
//import {database} from db_connection.js;

//La variable express nous permettra d'utiliser les fonctionnalités du module Express.  
let express = require('express'); 

// Nous définissons ici les paramètres du serveur.
let hostname = 'localhost'; 
let port = 3000; 

// Nous créons un objet de type Express. 
let app = express(); 


//Database execution of a request
//let sql = database("SELECT * FROM user");

let mysql = require('mysql');
let con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "bde"
});

//Afin de faciliter le routage (les URL que nous souhaitons prendre en charge dans notre API), nous créons un objet Router.
//C'est à partir de cet objet router, que nous allons implémenter les méthodes. 
var router = express.Router();


let bodyParser = require ("body-parser");
app.use(bodyParser.urlencoded({extended:false}));
app.use(bodyParser.json());

router.route('/')
.all(function(req,res){ 
      res.json({message : "Bienvenue sur notre Frugal API ", methode : req.method});
});


// con.connect(function(err) {
// 	if (err) throw err;
//     	console.log("Connected!");
//     	con.query("SELECT * FROM user LIMIT 10", function (err, result, fields) {
// 	if (err) throw err;
// 		json_result = JSON.stringify(result);
// 		console.log(json_result);
//     })
// });

router.route('/users')
app.get('/users', (req, res) => {
	con.connect(function(err) {
		  if (err) throw err;
		  console.log("Connected to the database!");
		  con.query("SELECT * FROM user", function (err, result) {
			if (err) throw err;
			res.json(result);
		  });
		});
});

//POST
app.post('/users', (req, res) => {
	con.connect(function(err) {
		  if (err) throw err;
		  console.log("Connected to the database!");
		  con.query("", function (err, result) {
			if (err) throw err;
			res.json(result);
		  });
		});
});

//PUT
// .put(function(req,res){ 
//       res.json({message : "Mise à jour des informations d'une piscine dans la liste", methode : req.method});
// })
// //DELETE
// .delete(function(req,res){ 
// res.json({message : "Suppression d'une piscine dans la liste", methode : req.method});  
// }); 


router.route('/users/:user_id')
app.get('/users/:user_id', (req, res) => {
	con.connect(function(err) {
		  if (err) throw err;
		  console.log("Connected!");
		  let request =  "SELECT * FROM user WHERE id ="+ req.params.user_id;
		  con.query(request, function (err, result) {
			if (err) throw err;
			res.json(result);
		  });
	});
});
// .put(function(req,res){ 
// 	  res.json({message : "Vous souhaitez modifier les informations de la piscine n°" + req.params.piscine_id});
// })
// .delete(function(req,res){ 
// 	  res.json({message : "Vous souhaitez supprimer la piscine n°" + req.params.piscine_id});
// });


// Nous demandons à l'application d'utiliser notre routeur
app.use(router);  

// // Démarrer le serveur 
app.listen(port, hostname, function(){
	console.log("Mon serveur fonctionne sur http://"+ hostname +":"+port); 
});
