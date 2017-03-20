package network

import (
	"net/http"
	"xyz/projectplay/onigokko/database"
	"xyz/projectplay/onigokko/model/player"
)

/**
Takes Name and Google ID,
Determines whether to create or update Player
*/
func oauth(w http.ResponseWriter, r *http.Request) {
	// todo: if Player does not exist within the database, create it using params
	//p := Player{id:r.Form.Get("id"), name:r.Form.Get("name")}

	id := r.FormValue("id")
	p := queryPlayer(id)

	if (p == player{}) {
		n := r.FormValue("name")
		insertPlayer(id, n)
	}
}