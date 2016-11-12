package network

import (
	"net/http"
	"fmt"
)

/**
Takes a Player ID as an owner, a Name, Tag distance (meters), and Hint distance (meters)
Optionally: immunity time (millis), oni minimum travel distance (meters)
 */
func addGame(w http.ResponseWriter, req *http.Request) {
	fmt.Print("ADD GAME\n")
}