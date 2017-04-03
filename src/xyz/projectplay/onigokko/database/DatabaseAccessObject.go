package database

import "fmt"
import _ "github.com/go-sql-driver/mysql"
import "database/sql"
import "xyz/projectplay/onigokko/models"

type AccessObject interface {
	GetPlayer(id string) (models.Player, error)
	InsertPlayer(id string, name string) error
	Close()
}

type SQLDao struct {
	db *sql.DB
}

func NewSQLDao() *SQLDao {
	var err error
	dao := &SQLDao{}

	dao.db, err = sql.Open("mysql", "root:mysql@/onigokko")
	if err != nil {
		fmt.Errorf("Error opening database: " + err.Error())
	}

	err = dao.db.Ping()
	if err != nil {
		fmt.Errorf("Error pinging database: " + err.Error())
	}

	return dao
}

func (dao SQLDao) GetPlayer(id string) (p models.Player, err error) {
	stmt, err := dao.db.Prepare("SELECT Player WHERE ID = ?")
	if err != nil {
		return p, err
	}
	defer stmt.Close()
	row := stmt.QueryRow(id)
	var lat sql.NullFloat64
	var lng sql.NullFloat64
	err = row.Scan(&p.Id, &p.Name, &lat, &lng)
	if err != nil {
		return p, err
	}
	if lat.Valid && lng.Valid {
		p.Latitude = lat.Float64
		p.Longitude = lng.Float64
	}
	return p, nil
}

func (dao SQLDao) InsertPlayer(id string, name string) error {
	_, err := dao.db.Exec("INSERT INTO Player (ID, Name) VALUES " +
		"('" + id + "','" + name + "')")
	return err
}

func (dao SQLDao) Close() {
	dao.db.Close()
}
