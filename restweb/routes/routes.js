//contain all my user related routes
const express = require('express')
const router = express.Router();

// Database connection
let mysql = require('mysql');
let con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "bde"
});

//List all the user when get request on /users
router.get('/users', (req, res) => {
	con.query("SELECT * FROM user", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the user with the corresponding id when get request on /users/user_:id
router.get('/users/:user_id', (req, res) => {
	let request =  "SELECT nom, prenom,droit FROM user WHERE id ="+ req.params.user_id;
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List all the articles when get request on /articles
router.get('/articles', (req, res) => {
	con.query("SELECT * FROM article", function (err, result) {
		res.send(JSON.stringify(result));
	});
});

//List the article with the corresponding id when get request on /articles/article_:id
router.get('/articles/:article_id', (req, res) => {
	let request =  "SELECT * FROM article WHERE id ="+ req.params.article_id;
	con.query(request, function (err, result) {
		res.send(JSON.stringify(result));
	});
});
module.exports = router
