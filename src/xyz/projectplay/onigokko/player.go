package main

import (
	"net/http"
	"fmt"
	"encoding/json"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
)

type player struct {
	id	  string	`json:"id"`
	name      string	`json:"name"`
	latitude  float64	`json:"latitude"`
	longitude float64	`json:"longitude"`
}

/**
Takes Name and Google ID,
Determines whether to create or update player
*/
func oauth(w http.ResponseWriter, r *http.Request) {
	// todo: if player does not exist within the database, create it using params
	//p := player{id:r.Form.Get("id"), name:r.Form.Get("name")}

	id := r.FormValue("id")
	p := queryPlayer(id)

	if (p == player{}) {
		n := r.FormValue("name")
		fmt.Print(n)
		insertPlayer(id, n)
	}
}

/**
Takes Name and Google ID
Creates a player in the database using Google ID as identifier
 */
func addPlayer(w http.ResponseWriter, r *http.Request) {

}

/**
Takes either Name, Lat & Lng, or both, with a Google ID in all cases
Updates player
 */
func updatePlayer(w http.ResponseWriter, r *http.Request) {

}

func getPlayer(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json; charset=UTF-8")
	w.WriteHeader(http.StatusOK)
	p := queryPlayer(r.FormValue("id"))
	if err := json.NewEncoder(w).Encode(p); err != nil {
		panic(err) // todo: don't panic
	}
}

func queryPlayer(id string) (p player){

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
		p.latitude = lat.Float64
		p.longitude = lng.Float64
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