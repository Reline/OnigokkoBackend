package database

import "fmt"
import _ "github.com/go-sql-driver/mysql"
import "database/sql"
import "xyz/projectplay/onigokko/models"

type DatabaseAccessObject interface {
	IsValidToken(token string) bool
	InsertPlayer(p models.Player) error
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

func (dao SQLDao) IsValidToken(token string) bool {
	return true
}

func (dao SQLDao) InsertPlayer(p models.Player) error {
	_, err := dao.db.Exec("INSERT INTO Player (ID, Name) VALUES ('" + p.Id + "','" + p.Name + "')")
	return err
}

func (dao SQLDao) Close() {
	dao.db.Close()
}
