package main

import "net/http"

type game struct {
	id			int	`json:"id"`
	ownerId			string	`json:"owner_id"`
	oniId			string	`json:"oni_id"`
	name			string	`json:"name"`
	tagDistance		float64	`json:"tag_distance"`
	hintDistance		float64	`json:"hint_distance"`
	immunityTime		uint64	`json:"immunity_time"`
	oniMinTravelDistance	float64	`json:"oni_min_travel_distance"`
}

/**
Takes a Player ID as an owner, a Name, Tag distance (meters), and Hint distance (meters)
Optionally: immunity time (millis), oni minimum travel distance (meters)
 */
func addGame(w http.ResponseWriter, req *http.Request) {

}

func updateGame(w http.ResponseWriter, req *http.Request) {

}

func joinGame() {}

func leaveGame() {}

func getGame(w http.ResponseWriter, req *http.Request) {

}

func getPlayersGames(w http.ResponseWriter, req *http.Request) {

}

func getParticipants(w http.ResponseWriter, req *http.Request) {

}

func getJoinableGames(w http.ResponseWriter, req *http.Request) {

}

func deleteGame(w http.ResponseWriter, req *http.Request) {

}