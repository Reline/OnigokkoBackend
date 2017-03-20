package network

import (
	"encoding/json"
	"net/http"
	"xyz/projectplay/onigokko/model/player"
)

func getPlayer(w http.ResponseWriter, r *http.Request) {
	nate := player{name: "Nathan Reline"}
	w.Header().Set("Content-Type", "application/json; charset=UTF-8")
	w.WriteHeader(http.StatusOK)
	if err := json.NewEncoder(w).Encode(nate); err != nil {
		panic(err)
	}
}