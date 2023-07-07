import mysql from "mysql";

//database connection
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "Ashcode@123",
  database: "ecommerce",
  insecureAuth : true
});

con.connect(function (err) {
  if (err) throw err;
  // console.log("Connected!");
});

//done
export const read_file=(res, sql, callback)=> {
  con.query(sql, function (err, result) {
    callback(err, result);
  });
}
