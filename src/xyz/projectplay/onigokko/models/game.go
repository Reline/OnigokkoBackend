package models

type Game struct {
	Id           int     `json:"id"`
	OwnerId      string  `json:"owner_id"`
	OniId        string  `json:"oni_id"`
	Name         string  `json:"name"`
	TagDistance  float64 `json:"tag_distance"`
	HintDistance float64 `json:"hint_distance"`
	ImmunityTime uint64  `json:"immunity_time"`
}
