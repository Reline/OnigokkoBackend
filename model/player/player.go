package player

type player struct {
	id        string  `json:"id"`
	name      string  `json:"name"`
	latitude  float64 `json:"latitude"`
	longitude float64 `json:"longitude"`
}