package controllers

import "fmt"
import "net/http"
import "google.golang.org/api/oauth2/v2"

func authenticateToken(w http.ResponseWriter, r *http.Request) (*oauth2.Tokeninfo, error) {
	token := r.Header.Get("Token")
	if token != "" {
		oauth2Service, err := oauth2.New(&http.Client{})
		tokenInfoCall := oauth2Service.Tokeninfo()
		tokenInfoCall.IdToken(token)
		if err == nil {
			return tokenInfoCall.Do()
		}
	}
	err := error("Invalid Token")
	w.WriteHeader(http.StatusUnauthorized)
	fmt.Fprint(w, err)
	return nil, err
}