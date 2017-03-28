package main

import "fmt"
import "log"
import "net/http"
import "github.com/julienschmidt/httprouter"
import "xyz/projectplay/onigokko/controllers"
import "google.golang.org/api/oauth2/v2"

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
		tokenInfo, err := getTokenInfo(token)
		if err != nil {
			fmt.Fprint(w, err)
		} else {
			fmt.Fprint(w, tokenInfo)
		}
	} else {
		fmt.Fprint(w, "You didn't send me a token...\n")
	}
}

func getTokenInfo(idToken string) (*oauth2.Tokeninfo, error) {
	oauth2Service, err := oauth2.New(&http.Client{})
	if err != nil {
		return nil, err
	}
	tokenInfoCall := oauth2Service.Tokeninfo()
	tokenInfoCall.IdToken(idToken)
	return tokenInfoCall.Do()
}
