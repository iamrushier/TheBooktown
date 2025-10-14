# The Booktown - A PHP Bookstore Project

This project is a fully functional e-commerce website for a bookstore, built with PHP. It provides a complete user experience, from browsing and searching for books to placing orders. It also includes a comprehensive admin panel for site management.

This version has been refactored to run entirely within a Dockerized environment, using MySQL for the database and Apache for the web server.

## Features

- **User Facing:**
  - Browse and search for books.
  - View product details.
  - User registration and login.
  - Add products to a shopping cart.
  - Complete checkout process to place an order.
  - View order history.
  - Submit requests to sell books.

- **Admin Panel:**
  - View dashboard with site statistics.
  - Manage products (add, update, delete).
  - Manage placed orders.
  - Manage user accounts.
  - Review and approve/deny user messages and sell requests.

## How to Run with Docker

This project is configured to run seamlessly with Docker and Docker Compose, eliminating the need for a local XAMPP or PHP/MySQL installation.

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Steps

1.  **Clone the Repository**

    ```bash
    git clone <your-repository-url>
    cd thebooktown_php
    ```

2.  **Set Up Environment Variables**

    Create a `.env` file by copying the example file:

    ```bash
    cp .env.example .env
    ```

    Now, open the `.env` file and fill in the necessary values. For a local setup, you can use the following:

    ```
    MYSQL_ROOT_PASSWORD=rootpassword
    MYSQL_DATABASE=shop_db
    MYSQL_USER=user
    MYSQL_PASSWORD=password
    SENDGRID_API_KEY=<your_sendgrid_api_key>
    DB_HOST=db
    ```

3.  **Build and Run the Containers**

    Run the following command from the project root. This will build the PHP/Apache image, install all the necessary Composer dependencies (creating the `vendor` directory inside the image), and start all services in the background.

    ```bash
    docker-compose up --build -d
    ```

    The database will be automatically initialized with schema and sample data from the `init.sql` file the first time you run this command.

    **Note:** Because the `vendor` directory is created by Docker, it is included in the `.gitignore` file. You can and should delete the `vendor` directory from your local machine if it exists.

4.  **Access the Application**

    - **Website:** You can now access the bookstore at [http://localhost:8080](http://localhost:8080)
    - **Admin Panel:** The admin panel is available at [http://localhost:8080/admin_login.php](http://localhost:8080/admin_login.php)

5.  **Test Credentials**

    A set of test credentials for both a regular user and an admin are available in the `test_credentials.txt` file.

### Stopping the Application

To stop the containers, run:

```bash
docker-compose down
```

To stop the containers and remove the database volume (useful for a clean restart), run:

```bash
docker-compose down -v
```
