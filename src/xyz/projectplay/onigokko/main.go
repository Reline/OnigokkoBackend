package main

import "fmt"
import "log"
import "net/http"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/controllers"

func main() {
	r := httprouter.New()

	pc := controllers.NewPlayerController()

	r.GET("/onigokko", hello)
	r.GET("/onigokko/player/:id", pc.GetPlayer)
	r.POST("/onigokko/player/create", pc.CreatePlayer)

	log.Fatal(http.ListenAndServeTLS(
		":8443", "/etc/letsencrypt/live/projectplay.xyz/cert.pem",
		"/etc/letsencrypt/live/projectplay.xyz/privkey.pem", r))
}

func hello(w http.ResponseWriter, r *http.Request, _ httprouter.Params) {
	fmt.Print("Hello from " + r.RemoteAddr + "\n")
	token := r.Header.Get("Token")
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	if token != "" {
		fmt.Fprint(w, "I got your token, it was "+token+"\n")
	} else {
		fmt.Fprint(w, "You didn't send me a token...\n")
	}
}
