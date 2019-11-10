export function database(request){
let mysql = require('mysql');
let con = mysql.createConnection({
host: "localhost",
user: "root",
password: "",
database: "bde"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    con.query(request, function (err, result, fields) {
        if (err) throw err;
        console.log(result);
    });
});
}