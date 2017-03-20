package network

import (
	"net/http"
	"fmt"
	"xyz/projectplay/onigokko/model/player"
)

/**
Takes either Name, Lat & Lng, or both, with a Google ID in all cases
Updates Player
*/
func updatePlayer(w http.ResponseWriter, r *http.Request) {
	fmt.Print("UPDATEPLAYER\n")
}