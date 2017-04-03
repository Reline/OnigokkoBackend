package controllers

import "fmt"
import "net/http"
import "log"
import "errors"
import "google.golang.org/api/oauth2/v2"

func authenticateToken(w http.ResponseWriter, r *http.Request) (*oauth2.Tokeninfo, error) {
	token := r.Header.Get("Token")
	oauth2Service, err := oauth2.New(&http.Client{})
	if err == nil {
		tokenInfo, err := oauth2Service.Tokeninfo().IdToken(token).Do()
		if err == nil {
			return tokenInfo, err
		}
	}
	err = errors.New("Invalid Token: [" + token + "]")
	w.WriteHeader(http.StatusUnauthorized)
	fmt.Fprint(w, err.Error())
	log.Println(err.Error())
	return nil, err
}