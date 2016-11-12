package game

type Game struct {
	id			int	`json:"id"`
	ownerId			string	`json:"owner_id"`
	oniId			string	`json:"oni_id"`
	name			string	`json:"name"`
	tagDistance		float64	`json:"tag_distance"`
	hintDistance		float64	`json:"hint_distance"`
	immunityTime		uint64	`json:"immunity_time"`
	oniMinTravelDistance	float64	`json:"oni_min_travel_distance"`
}