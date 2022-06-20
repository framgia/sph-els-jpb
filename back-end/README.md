![image](https://i.imgur.com/SNd4v1h.png)

# Commands

From the root folder.

```bash
cd back-end
php artisan serve
php artisan migrate:fresh --seed
```

# Pre-conditions
  
- Open this link -> http://127.0.0.1:8000/
- Go to Postman or Insomnia to test the API

# Expected Output

## ------------------**Public Routes**------------------

### For User

| Route                 | Method | Description                                      | Status |
| :-------------------- | :----- | :----------------------------------------------- | :----- |
| `/api/v1/users`       | `POST` | Register new User in the Database                | ok     |
| `/api/v1/users/login` | `POST` | Login user and generate Token for Authentication | ok     |

### **_User Register Request Body_**

To register a new User, put this in the request body using JSON.
`/api/v1/users`

```bash
{
	"first_name" : "John Paul",
	"last_name" : "Banera",
	"email" : "johnpaul@gmail.com",
	"password" : "xxxxxxx",
	"password_confirmation" : "xxxxxxx"
}
```

### **_User Register Response Body_**

After successful registration, you will receive a body response in JSON format that should have a message of success.
If the registration is unsuccessful you will receive an error response.
`Response`

```bash
{
	"message": "Account Created Successfully"
}
```

### **_User Login Request Body_**

To login a new User, put this in the request body using JSON.
`/api/v1/users/login`

```bash
{
	"email" : "johnpaul@gmail.com",
	"password" : "xxxxxxx"
}
```

`Response`

```bash
{
	"message": "Success Login",
	"0": "1|a23STzKXDWIxNXk9suJE2Dugo9xwlJU49flDfeX9"
}
```

## ------------------**Private Routes**------------------

### **_For User_**

| Route                     | Method | Description                                             | Status |
| :------------------------ | :----- | :------------------------------------------------------ | :----- |
| `/api/v1/users`           | `GET`  | Get all registered user in the Database excluding Admin | ok     |
| `/api/v1/users/{user_id}` | `GET`  | Get specific user based on id from the database         | ok     |
| `/api/v1/users/{user_id}` | `PUT`  | Update specific user based on id from the database      | ok     |
| `/api/v1/users/logout`    | `POST` | Logout User and destroy the Authentication Token        | ok     |

### **_User Update_**

To update specific User Information, put this in the request body using JSON.
`/api/v1/users/{user_id}`

```bash
{
	"avatar_url" : "Optional",
	"cover_url" : "Optional",
	"first_name" : "Optional",
	"last_name" : "Optional",
	"email" : "Optional",
	"current_password" : "Input current password if wants to change something",
	"new_password" : "Optional"
}
```

`Response`

```bash
{
	"message": "Account Updated Successfully"
}
```

### For Lesson

| Route                         | Method   | Description                                          | Status |
| :---------------------------- | :------- | :--------------------------------------------------- | :----- |
| `/api/v1/lessons`             | `POST`   | Create new lesson                                    | ok     |
| `/api/v1/lessons`             | `GET`    | Get all lessons in the Database                      | ok     |
| `/api/v1/lessons/{lessonId}` | `GET`    | Get specific lesson based on id from the database    | ok     |
| `/api/v1/lessons/{lessonId}` | `PUT`    | Update specific lesson based on id from the database | ok     |
| `/api/v1/lessons/{lessonId}` | `DELETE` | Delete specific lesson based on id from the database | ok     |

### **_Create New Lesson_**

To create new lesson, put this in the request body using JSON.
`/api/v1/lessons`

```bash
{
	"title" : "Lesson Title",
	"description" : "This is the lesson description blablablabla."
}
```

`Response`

```bash
{
	"message": "Lesson Created Successfully"
}
```

### **_Update Lesson_**

To update a lesson, put this in the request body using JSON.
`/api/v1/lessons/{lessonId}`

```bash
{
	"title" : "Update This Lesson Title",
	"description" : "This is the updated lesson description blebleblebleble."
}
```

`Response`

```bash
{
	"message": "Lesson Updated Successfully"
}
```

### For Admin

| Route                     | Method   | Description                                             | Status         |
| :------------------------ | :------- | :------------------------------------------------------ | :------------- |
| `/api/v1/admin`           | `GET`    | Get all registered user in the Database excluding Admin | ok             |
| `/api/v1/admin/{user_id}` | `GET`    | Get specific user based on id from the database         | ok             |
| `/api/v1/admin/{user_id}` | `PUT`    | Update specific user based on id from the database      | **Deprecated** |
| `/api/v1/admin/{user_id}` | `DELETE` | Delete specific user based on id from the database      | ok             |

# Notes

- Ensure to add this in the header `Accept application/json` in all methods to avoid the 405 methods not allowed error.

## Appendix

Any additional information goes here
