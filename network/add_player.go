package network

import (
	"net/http"
	"fmt"
)

/**
Takes Name and Google ID
Creates a Player in the database using Google ID as identifier
*/
func addPlayer(w http.ResponseWriter, r *http.Request) {
	fmt.Print("ADDPLAYER\n")
}