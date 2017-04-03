package main

import "log"
import "net/http"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/controllers"
import "xyz/projectplay/onigokko/database"

func main() {
	r := httprouter.New()

	dao := database.NewSQLDao()
	pc := controllers.NewPlayerController(dao)

	r.GET("/onigokko/player", pc.GetPlayer)
	r.POST("/onigokko/player", pc.CreatePlayer)

	log.Fatal(http.ListenAndServeTLS(
		":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem",
		"/etc/letsencrypt/live/projectplay.xyz/privkey.pem", r))
}
