package main

import (
	"net/http"
	"strconv"
	"time"

	"github.com/dgrijalva/jwt-go"
	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
)

// User struct to represent a user
type User struct {
	ID       int    `json:"id"`
	Username string `json:"username"`
	Password string `json:"password"`
}

var users = []User{
	{ID: 1, Username: "admin", Password: "admin"},
}

// JWT claims struct
type jwtCustomClaims struct {
	Username string `json:"username"`
	jwt.StandardClaims
}

// Secret key for signing JWT tokens
var jwtSecret = []byte("my_secret_key")

func main() {
	// Create a new Echo instance
	e := echo.New()

	// Middleware
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())

	// Public routes
	e.GET("/", func(c echo.Context) error {
		return c.String(http.StatusOK, "Hello, World!")
	})

	e.GET("/login", login)

	// Restricted group
	r := e.Group("/restricted")
	r.Use(middleware.JWTWithConfig(middleware.JWTConfig{
		SigningKey: jwtSecret,
	}))

	// Routes for user operations within restricted group
	r.GET("/users", listUsers)
	r.POST("/users", addUser)
	r.PUT("/users/:id", updateUser)
	r.DELETE("/users/:id", deleteUser)
	r.GET("/authenticate", authenticateUser)

	// Start the server
	e.Logger.Fatal(e.Start(":1323"))
}

// Handler to list users
func listUsers(c echo.Context) error {
	return c.JSON(http.StatusOK, users)
}

// Handler to add a new user
func addUser(c echo.Context) error {
	u := new(User)
	if err := c.Bind(u); err != nil {
		return err
	}
	u.ID = len(users) + 1
	users = append(users, *u)
	return c.JSON(http.StatusCreated, u)
}

// Handler to update an existing user
func updateUser(c echo.Context) error {
	id, _ := strconv.Atoi(c.Param("id"))
	u := new(User)
	if err := c.Bind(u); err != nil {
		return err
	}
	for i, user := range users {
		if user.ID == id {
			users[i] = *u
			users[i].ID = id
			return c.JSON(http.StatusOK, u)
		}
	}
	return c.JSON(http.StatusNotFound, "User not found")
}

// Handler to delete a user
func deleteUser(c echo.Context) error {
	id, _ := strconv.Atoi(c.Param("id"))
	for i, user := range users {
		if user.ID == id {
			users = append(users[:i], users[i+1:]...)
			return c.NoContent(http.StatusNoContent)
		}
	}
	return c.JSON(http.StatusNotFound, "User not found")
}

// Handler to authenticate a user
func authenticateUser(c echo.Context) error {
	username := c.QueryParam("username")
	password := c.QueryParam("password")
	for _, user := range users {
		if user.Username == username && user.Password == password {
			return c.JSON(http.StatusOK, "Authentication successful")
		}
	}
	return c.JSON(http.StatusUnauthorized, "Invalid credentials")
}

// Handler for login and token generation
func login(c echo.Context) error {
	username := c.QueryParam("username")
	password := c.QueryParam("password")

	// Check if the user exists
	for _, user := range users {
		if user.Username == username && user.Password == password {
			// Create JWT token
			claims := &jwtCustomClaims{
				username,
				jwt.StandardClaims{
					ExpiresAt: time.Now().Add(time.Hour * 72).Unix(),
				},
			}

			token := jwt.NewWithClaims(jwt.SigningMethodHS256, claims)
			t, err := token.SignedString(jwtSecret)
			if err != nil {
				return err
			}

			return c.JSON(http.StatusOK, map[string]string{
				"token": t,
			})
		}
	}

	return c.JSON(http.StatusUnauthorized, "Invalid credentials")
}
