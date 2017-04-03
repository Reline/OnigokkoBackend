package controllers

import "fmt"
import "strconv"
import "net/http"
import "encoding/json"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/database"
import "xyz/projectplay/onigokko/models"

type PlayerController struct{}

var dao database.AccessObject

func NewPlayerController(databaseAccessObject database.AccessObject) *PlayerController {
	dao = databaseAccessObject
	return &PlayerController{}
}

func (pc PlayerController) GetPlayer(w http.ResponseWriter, r *http.Request, _ httprouter.Params) {
	tokenInfo, err := authenticateToken(w, r)
	if err == nil {
		p, err := dao.GetPlayer(tokenInfo.UserId)
		if err != nil {
			w.WriteHeader(http.StatusNotFound)
			fmt.Fprint(w, err.Error())
			return
		}
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusOK)
		fmt.Fprintf(w, "{"+
			"\"id\": "+p.Id+","+
			"\"name\": \""+p.Name+"\","+
			"\"latitude\": "+strconv.FormatFloat(p.Latitude, 'f', -1, 64)+","+
			"\"longitude\": "+strconv.FormatFloat(p.Longitude, 'f', -1, 64)+
			"}")
	}
}

func (pc PlayerController) CreatePlayer(w http.ResponseWriter, r *http.Request, _ httprouter.Params) {
	w.Header().Set("Content-Type", "text/plain")
	tokenInfo, err := authenticateToken(w, r)
	if err == nil {
		decoder := json.NewDecoder(r.Body)
		var p models.Player
		err = decoder.Decode(&p)
		if err != nil {
			w.WriteHeader(http.StatusBadRequest)
			fmt.Fprint(w, err.Error())
			return
		}
		err = dao.InsertPlayer(tokenInfo.UserId, p.Name)
		if err != nil {
			w.WriteHeader(http.StatusConflict)
			fmt.Fprint(w, err.Error())
			return
		}
		w.WriteHeader(http.StatusCreated)
	}
}
