

## Blog


## Installation

Follow these steps to set up the project:

1. **Setup `.env` file**:
   Ensure the correct path for SQLite in the `.env` file. Example:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=D:/xampp/htdocs/blog/database/database.sqlite
2. Run the following command to install the necessary dependencies:
   ```composer
   composer Install
   
3. Install JWT Authentication: To install JWT authentication, run the following commands:
   ```JWT Authentication
   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
   php artisan jwt:secret
4. Run the following command to migrate the database and seed it with the necessary data:
   ```Database
   php artisan migrate:fresh --seed

5. The admin user credentials are as follows
   ```Admins
    email  =>  admin@example.com
    password => admin

6. The admin user credentials are as follows
   ```Authors
    email  =>  author1@example.com
    password => password

    email  =>  author2@example.com
    password => password

    email  =>  author3@example.com
    password => password
   
    email  =>  author4@example.com
    password => password
   
    email  =>  author5@example.com
    password => password

## Routes

## Authentication Routes

1. To register a new user, go to `/register` and send a `POST` request.
2. To login, go to `/login` and send a `POST` request.
3. To logout, go to `/logout` and send a `POST` request (authentication required).

## Post Routes

1. To get all posts, go to `/posts` and send a `GET` request.
2. To create a new post, go to `/posts` and send a `POST` request (authentication required, role: admin or author).
3. To get a specific post, go to `/posts/{post}` and send a `GET` request (replace `{post}` with the post ID).
4. To update a specific post, go to `/posts/{post}` and send a `PUT` request (authentication required, role: admin or author).
5. To delete a specific post, go to `/posts/{post}` and send a `DELETE` request (authentication required, role: admin or author).

## Comment Routes

1. To add a comment to a post, go to `/posts/{post}/comments` and send a `POST` request (authentication required).
