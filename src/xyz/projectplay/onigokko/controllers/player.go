package controllers

import "fmt"
import "net/http"
import "encoding/json"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/database"
import "xyz/projectplay/onigokko/models"

type PlayerController struct{}

var dao database.DatabaseAccessObject

func NewPlayerController() *PlayerController {
	dao = database.NewSQLDao()
	return &PlayerController{}
}

func (pc PlayerController) GetPlayer(w http.ResponseWriter, r *http.Request, p httprouter.Params) {
	token := r.Header.Get("Token")
	if dao.IsValidToken(token) {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusOK)
		id := p.ByName("id")
		fmt.Fprintf(w, "{\"player\": \""+id+"\"}")
	} else {
		w.WriteHeader(http.StatusUnauthorized)
	}
}

func (pc PlayerController) CreatePlayer(w http.ResponseWriter, r *http.Request, params httprouter.Params) {
	decoder := json.NewDecoder(r.Body)
	var p models.Player
	err := decoder.Decode(&p)
	if err != nil {
		w.WriteHeader(http.StatusBadRequest)
		fmt.Fprintf(w, "%s\n", err)
		return
	}
	err = dao.InsertPlayer(p)
	if err != nil {
		w.WriteHeader(http.StatusConflict)
		fmt.Fprintf(w, "This record already exists.\n")
		return
	}
}
