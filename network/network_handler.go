package network

import (
	"xyz/projectplay/onigokko/model/game"
	"xyz/projectplay/onigokko/model/player"
	"net/http"
	"log"
)

func openNetwork() {
	http.HandleFunc("/Onigokko/player/oauth", oauth) // determine if AddPlayer or UpdatePlayer should be called
	http.HandleFunc("/Onigokko/player/add", addPlayer)
	http.HandleFunc("/Onigokko/player/update", updatePlayer)
	http.HandleFunc("/Onigokko/player/get", getPlayer)
	http.HandleFunc("/Onigokko/game/add", addGame)

	log.Fatal(http.ListenAndServeTLS(
		":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem",
		"/etc/letsencrypt/live/projectplay.xyz/privkey.pem", nil))
}