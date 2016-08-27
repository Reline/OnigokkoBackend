package main

import (
	"net/http"
	"log"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
)

var db *sql.DB

func main() {
	var err error
	db, err = sql.Open("mysql", "root:mysql@/onigokko")
	if err != nil {
		panic(err.Error()) // todo: add proper handling
	}

	err = db.Ping()
	if err != nil {
		panic(err.Error()) // todo: add proper handling
	}

	defer db.Close()

	http.HandleFunc("/Onigokko/player/oauth", oauth) // determine if AddPlayer or UpdatePlayer should be called
	http.HandleFunc("/Onigokko/player/add", addPlayer)
	http.HandleFunc("/Onigokko/player/update", updatePlayer)
	http.HandleFunc("/Onigokko/player/get", getPlayer)
	http.HandleFunc("/Onigokko/game/add", addGame)

	log.Fatal(http.ListenAndServeTLS(
		":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem",
		"/etc/letsencrypt/live/projectplay.xyz/privkey.pem", nil))
}

func tag() {}