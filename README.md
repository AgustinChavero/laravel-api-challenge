<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<p align="center">
  A simplified Twitter-like API built with Laravel.
</p>

## 📝 About the Project

This project is an API that replicates some of the internal functionalities of Twitter in a simplified manner. The API allows users to perform actions such as:

-   Post tweets with text.
-   Like tweets.
-   Save tweets.
-   Share tweets.
-   Follow other users.
-   Check account statistics such as follower count, following count, and number of tweets posted.

### 🚀 Features

-   **User Management**: Registration, login, profiles, and followers.
-   **Tweets**: Creation, editing, deletion, and viewing of tweets.
-   **Interactions**: Liking, saving, and sharing tweets.
-   **Statistics**: Followers, following, and tweet counts.
-   **User Following**: Follow and unfollow other users.

### 📚 API Documentation

The complete API documentation is available in the `/docs` folder, detailing the usage of each endpoint, accepted parameters, and response examples.

## 💻 Getting Started

To set up and run the project on your local machine, follow the steps below.

### Prerequisites

Ensure you have Composer, Docker and Docker Compose installed on your machine.

### Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/AgustinChavero/laravel-api-challenge.git
    cd laravel-api-challenge
    ```
2. **Create the Docker network**:
    ```
    docker network create post-network
    ```
3. **Start the containers**:
    ```
    docker-compose up -d
    ```
4. **Check the running containers**:
    ```
    docker ps
    ```
5. **Access the PHP container**:
    ```
    docker exec -it <container_id_php> bash
    ```
6. **Update the .env file**:
    ```
    sed -i 's/^DB_HOST=.*/DB_HOST=dbposts/' .env
    ```
7. **Clear the config cache**:
    ```
    php artisan config:cache
    ```
8. **Run database migrations**:
    ```
    php artisan migrate
    ```

## Suggestions and Support

I am open to suggestions for improvements. If you encounter any issues or are unable to get the project up and running, please feel free to reach out to me at [agustindanielchavero@gmail.com](mailto:agustindanielchavero@gmail.com).
