package main

import (
	"net/http"
	"fmt"
	//"log"
	"encoding/json"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
)

var db *sql.DB

func oauth(w http.ResponseWriter, req *http.Request) {
	// todo: if player does not exist within the database, create it using params
	nate := Player{Name: "Nathan Reline"}
	w.Header().Set("Content-Type", "application/json; charset=UTF-8")
	w.WriteHeader(http.StatusOK)
	if err := json.NewEncoder(w).Encode(nate); err != nil {
		panic(err) // todo: don't panic
	}
}

func OpenDB() {
	database, err := sql.Open("mysql", "root:mysql@/onigokko")
	db = database
	if err != nil {
		panic(err.Error()) // todo: Just for example purpose. You should use proper error handling instead of panic
	}

	err = db.Ping()
	if err != nil {
		panic(err.Error()) // todo: proper error handling instead of panic in your app
	}
}

func QueryPlayer(id string)  {

	// Prepare statement for reading data
	stmtOut, err := db.Prepare("SELECT * FROM Player WHERE GoogleID = ?")
	if err != nil {
		panic(err.Error()) // todo: proper error handling instead of panic in your app
	}
	defer stmtOut.Close()

	row := stmtOut.QueryRow("116912744736380502344")
	player := Player{}
	err = row.Scan(&player.ID, &player.GoogleID, &player.Name, &player.Latitude, &player.Longitude)
	if err != nil {
		fmt.Printf("SQL Err: %s", err)
	}
	fmt.Print(player)
}

func main() {
	//http.HandleFunc("/Onigokko/player/oauth", oauth)
	//log.Fatal(http.ListenAndServeTLS(":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem", "/etc/letsencrypt/live/projectplay.xyz/privkey.pem", nil))

	OpenDB()
	QueryPlayer("116912744736380502344")

	defer db.Close()
}

type Player struct {
	ID		int	`json:"id"`
	GoogleID  	string	`json:"googleid"`
	Name      	string	`json:"name"`
	Latitude  	float64	`json:"latitude"`
	Longitude 	float64	`json:"longitude"`
}

type Game struct {
	ID		int	`json:"id"`
	Name		string	`json:"name"`
	TagDistance	float64	`json:"tag_distance"`
	HintDistance	float64	`json:"hint_distance"`
	ImmunityTime	uint64	`json:"immunity_time"`
	OwnerID		string	`json:"owner_id"`
	OniID		string	`json:"oni_id"`
}