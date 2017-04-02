package controllers

import "fmt"
import "strconv"
import "net/http"
import "encoding/json"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/database"
import "xyz/projectplay/onigokko/models"

type PlayerController struct{}

func NewPlayerController() *PlayerController {
	return &PlayerController{}
}

func (pc PlayerController) GetPlayer(w http.ResponseWriter, r *http.Request, p httprouter.Params) {
	tokenInfo, err := authenticateToken(w, r)
	if err == nil {
		dao := database.NewSQLDao()
		defer dao.Close()
		player, err := dao.GetPlayer(tokenInfo.UserId)
		if err != nil {
			w.WriteHeader(http.StatusNotFound)
			return
		}
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusOK)
		fmt.Fprintf(w,
			"{"+
				"\"id\": \""+player.Id+"\","+
				"\"name\": \""+player.Name+"\","+
				"\"latitude\": \""+strconv.FormatFloat(player.Latitude, 'f', -1, 64)+"\","+
				"\"longitude\": \""+strconv.FormatFloat(player.Longitude, 'f', -1, 64)+"\""+
				"}")
	}
}

func (pc PlayerController) CreatePlayer(w http.ResponseWriter, r *http.Request, _ httprouter.Params) {
	tokenInfo, err := authenticateToken(w, r)
	if err == nil {
		decoder := json.NewDecoder(r.Body)
		var p models.Player
		err = decoder.Decode(&p)
		if err != nil {
			w.WriteHeader(http.StatusBadRequest)
			return
		}
		defer r.Body.Close()
		dao := database.NewSQLDao()
		defer dao.Close()
		err = dao.InsertPlayer(tokenInfo.UserId, p)
		if err != nil {
			w.WriteHeader(http.StatusConflict)
			return
		}
		w.WriteHeader(http.StatusCreated)
	}
}
