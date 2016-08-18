package main

import (
	"net/http"
	"log"
	"encoding/json"
)

func GetPlayer(w http.ResponseWriter, req *http.Request) {
	nate := Player{Name: "Nathan Reline"}
	w.Header().Set("Content-Type", "application/json; charset=UTF-8")
	w.WriteHeader(http.StatusOK)
	if err := json.NewEncoder(w).Encode(nate); err != nil {
		panic(err)
	}
}

func main() {
	http.HandleFunc("/Onigokko/player/get", GetPlayer)
	log.Fatal(http.ListenAndServeTLS(":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem", "/etc/letsencrypt/live/projectplay.xyz/privkey.pem", nil))
}

type Player struct {
	Name      string	`json:"name"`
	GoogleID  string	`json:"googleid"`
	Latitude  float64	`json:"latitude"`
	Longitude float64	`json:"longitude"`
}
