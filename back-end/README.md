# Commands

From the root folder.

```bash
cd back-end
php artisan serve
php artisan migrate:fresh --seed
```

# Pre-conditions

From the root folder.

Open this link -> http://127.0.0.1:8000/
Go to Postman or Insomnia to test the API

# Expected Output

## ------------------**Public Routes**------------------

### For User

| Route                 | Method | Description                                      | Status |
| :-------------------- | :----- | :----------------------------------------------- | :----- |
| `/api/v1/users`       | `POST` | Register new User in the Database                | ok     |
| `/api/v1/users/login` | `POST` | Login user and generate Token for Authentication | ok     |

### User Register

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

### User Login

To login a new User, put this in the request body using JSON.
`/api/v1/users/login`

```bash
{
	"email" : "johnpaul@gmail.com",
	"password" : "xxxxxxx"
}
```

## ------------------**Private Routes**------------------

### For User

| Route                     | Method | Description                                             | Status |
| :------------------------ | :----- | :------------------------------------------------------ | :----- |
| `/api/v1/users`           | `GET`  | Get all registered user in the Database excluding Admin | ok     |
| `/api/v1/users/{user_id}` | `GET`  | Get specific user based on id from the database         | ok     |
| `/api/v1/users/{user_id}` | `PUT`  | Update specific user based on id from the database      | ok     |
| `/api/v1/users/logout`    | `POST` | Logout User and destroy the Authentication Token        | ok     |

### User Update

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

### For Lesson

| Route                         | Method   | Description                                          | Status |
| :---------------------------- | :------- | :--------------------------------------------------- | :----- |
| `/api/v1/lessons`             | `POST`   | Create new lesson                                    | ok     |
| `/api/v1/lessons`             | `GET`    | Get all lessons in the Database                      | ok     |
| `/api/v1/lessons/{lesson_id}` | `GET`    | Get specific lesson based on id from the database    | ok     |
| `/api/v1/lessons/{lesson_id}` | `PUT`    | Update specific lesson based on id from the database | ok     |
| `/api/v1/lessons/{lesson_id}` | `DELETE` | Delete specific lesson based on id from the database | ok     |

### Create New Lesson

To create new lesson, put this in the request body using JSON.
`/api/v1/lessons`

```bash
{
	"title" : "Lesson Title",
	"description" : "This is the lesson description blablablabla."
}
```

### Update Lesson

To update a lesson, put this in the request body using JSON.
`/api/v1/lessons/{lesson_id}`

```bash
{
	"title" : "Update This Lesson Title",
	"description" : "This is the updated lesson description blebleblebleble."
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
