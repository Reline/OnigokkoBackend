package database

import (
	_ "github.com/go-sql-driver/mysql"
	"database/sql"
	"fmt"
	"xyz/projectplay/onigokko/model/player"
)

var db *sql.DB

func openDatabase() {
	var err error
	db, err = sql.Open("mysql", "root:mysql@/onigokko")
	if  err != nil {
		fmt.Errorf("Error opening database: " + err.Error())
	}

	err = db.Ping()
	if err != nil {
		fmt.Errorf("Error pinging database: " + err.Error())
	}

	defer db.Close()
}

func queryPlayer(id string) (p player) {

	// Prepare statement for reading data
	stmtOut, err := db.Prepare("SELECT * FROM Player WHERE ID = ?")
	if err != nil {
		panic(err.Error()) // todo: proper error handling instead of panic in your app
	}
	defer stmtOut.Close()
	row := stmtOut.QueryRow(id)
	var lat sql.NullFloat64
	var lng sql.NullFloat64
	err = row.Scan(&p.id, &p.name, &lat, &lng)
	if err != nil {
		fmt.Printf("Query Player SQL Err: %s\n", err)
	}
	if lat.Valid && lng.Valid {
		//p.latitude = lat.Float64
		//p.longitude = lng.Float64
	}
	return
}

func insertPlayer(id string, n string) {
	// todo: use proper syntax
	_, err := db.Exec(
		"INSERT INTO Player (ID, Name) VALUES ('" + id + "','" + n + "')",
	)
	if err != nil {
		fmt.Printf("Insert Player SQL Err: %s\n", err)
	}
}