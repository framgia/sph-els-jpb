![Logo](https://i.imgur.com/4O1TJBI.png)

# API Reference

### Commands

From the root folder

- cd back-end
- php artisan serve
- php artisan migrate:refresh --seed

### Pre-conditions

Open this link -> http://127.0.0.1:8000/api/v1/users

Go to Postman or Insomnia to test the API

# Expected Output

### **Public Routes**

| Route                 | Method | Description                                      |
| :-------------------- | :----- | :----------------------------------------------- |
| `/api/v1/users`       | `POST` | Register new User in the Database                |
| `/api/v1/users/login` | `POST` | Login user and generate Token for Authentication |

### **Private Routes**

| Route                     | Method   | Description                                             |
| :------------------------ | :------- | :------------------------------------------------------ |
| `/api/v1/users`           | `GET`    | Get all registered user in the Database excluding Admin |
| `/api/v1/users/{user_id}` | `GET`    | Get specific user based on id from the database         |
| `/api/v1/users/{user_id}` | `PUT`    | Update specific user based on id from the database      |
| `/api/v1/users/{user_id}` | `DELETE` | Delete specific user based on id from the database      |
| `/api/v1/users/logout`    | `POST`   | Logout User and destroy the Authentication Token        |

# Notes

- Make sure to add this in header `Accept application/json` in all of the methods to avoid 405 method not allowed error.
