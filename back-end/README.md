`[Commands]`
From the root folder

- cd back-end
- php artisan serve
- php artisan migrate:fresh --seed

`[Pre-conditions]`
Open this link -> http://127.0.0.1:8000/
Go to Postman or Insomnia to test the API

`[Expected Output]`

## **Public Routes**

### For User

| Route                 | Method | Description                                      |
| :-------------------- | :----- | :----------------------------------------------- |
| `/api/v1/users`       | `POST` | Register new User in the Database                |
| `/api/v1/users/login` | `POST` | Login user and generate Token for Authentication |

## **Private Routes**

### For User

| Route                     | Method | Description                                             |
| :------------------------ | :----- | :------------------------------------------------------ |
| `/api/v1/users`           | `GET`  | Get all registered user in the Database excluding Admin |
| `/api/v1/users/{user_id}` | `GET`  | Get specific user based on id from the database         |
| `/api/v1/users/{user_id}` | `PUT`  | Update specific user based on id from the database      |
| `/api/v1/users/logout`    | `POST` | Logout User and destroy the Authentication Token        |

### For Lesson

| Route                         | Method   | Description                                          |
| :---------------------------- | :------- | :--------------------------------------------------- |
| `/api/v1/lessons`             | `POST`   | Create new lesson                                    |
| `/api/v1/lessons`             | `GET`    | Get all lessons in the Database                      |
| `/api/v1/lessons/{lesson_id}` | `GET`    | Get specific lesson based on id from the database    |
| `/api/v1/lessons/{lesson_id}` | `PUT`    | Update specific lesson based on id from the database |
| `/api/v1/lessons/{lesson_id}` | `DELETE` | Delete specific lesson based on id from the database |

### For Admin

| Route                     | Method   | Description                                             |
| :------------------------ | :------- | :------------------------------------------------------ |
| `/api/v1/admin`           | `GET`    | Get all registered user in the Database excluding Admin |
| `/api/v1/admin/{user_id}` | `GET`    | Get specific user based on id from the database         |
| `/api/v1/admin/{user_id}` | `PUT`    | Update specific user based on id from the database      |
| `/api/v1/admin/{user_id}` | `DELETE` | Delete specific user based on id from the database      |

`[Notes]`

- Ensure to add this in the header `Accept application/json` in all methods to avoid the 405 methods not allowed error.
