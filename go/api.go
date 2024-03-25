package main

import (
    "net/http"
    "github.com/google/uuid"
    "github.com/gin-gonic/gin"
    "net/mail"
)

type user struct {
    ID        string  `json:"id"`
    Name      string  `json:"name" binding:"required"`
    Surname   string  `json:"surname" binding:"required"`
    Email     string  `json:"email" binding:"required"`
    Password  string  `json:"password" binding:"required"`
}

var users = []user{
    {ID: "1", Name: "Jan", Surname: "Kowalski", Email: "jan.kowalski@gmail.com", Password: "REe24P;9'Nx(]uP-jUmTmU,'4m*dh)Yi]Sk2%PqY_"},
    {ID: "2", Name: "Adam", Surname: "Malysz", Email: "adam.malysz@gmail.com", Password: "qwerty123"},
    {ID: "3", Name: "Uzytkownik", Surname: "Testowy", Email: "test_email@gmail.com", Password: "test123"},
}

func main() {
    router := gin.Default()
    router.GET("/users", getUsers)
    router.POST("/register", registerUser)

    router.Run("localhost:8080")
}

func getUsers(c *gin.Context) {
    c.IndentedJSON(http.StatusOK, users)
}

func registerUser(c *gin.Context) {
    var newUser user

    maxUserId := users[0].ID

    for _, currentUser := range users {
        if currentUser.ID > maxUserId {
            maxUserId = currentUser.ID
        }
    }

    if err := c.BindJSON(&newUser); err != nil {
        return
    }

    id := uuid.New()
    newUser.ID = id.String()

    _, err := mail.ParseAddress(newUser.Email)
    if err != nil {
        c.JSON(http.StatusBadRequest, "Invalid email")
        return
    }

    users = append(users, newUser)
    c.IndentedJSON(http.StatusCreated, newUser)
}

// curl http://localhost:8080/register \
//     --include \
//     --header "Content-Type: application/json" \
//     --request "POST" \
//     --data '{"name": "Nowy","surname": "Uzytkownik","email": "test@wp.pl", "password": "123"}'
