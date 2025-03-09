# Guide to Setting Up and Using the URL Shortener Service

1. **Clone the Repository**:  
   Use Git to clone the repository to your local machine. Navigate to the project directory after cloning.  
   Command:  
   `git clone https://github.com/yourusername/ShortLinksApp.git`  
   `cd ShortLinksApp`

2. **Install Dependencies**:  
   Ensure you have PHP and Composer installed. If you're using Docker, you can build the containers and install dependencies with:  
   Command:  
   `docker-compose up --build`  
   Then, go into the PHP container:  
   `docker-compose exec php sh`  
   Navigate to the application directory:  
   `cd /var/www/html`  
   Install dependencies:  
   `composer install`

3. **Configure Environment**:  
   Copy the `.env.example` file to `.env`. Open the `.env` file and set up your database connection parameters, including the database name, username, and password.  
   Command:  
   `cp .env.example .env`  
   (Edit the `.env` file as needed)

4. **Generate Application Key**:  
   Generate the application key for Laravel.  
   Command:  
   `php artisan key:generate`

5. **Run Migrations**:  
   Create the necessary tables in the database. If you're using Docker, go into the MySQL container:  
   Command:  
   `docker-compose exec mysql sh`  
   Then access MySQL:  
   `mysql -uroot -proot`  
   Create the database:  
   `CREATE DATABASE laravel;`  
   Exit MySQL and run migrations:  
   `php artisan migrate`

6. **Start the Server**:  
   If you're not using Docker, you can start the built-in Laravel development server:  
   Command:  
   `php artisan serve`  
   Navigate to the URL provided by the server (usually `http://localhost:8080`).

7. **Access the Application**:  
   Open your web browser and go to the URL provided by the server. You will see the main interface of the URL shortener service.

8. **Create a Short Link**:  
   Use the provided form on the main page to enter the original URL and any optional title. Submit the form to create a short link.

9. **View Short Links**:  
   Navigate to the page that lists all created short links. You can see the original URLs along with their corresponding short links.

10. **Edit or Delete Links**:  
    Use the edit and delete options available next to each short link to modify or remove links as needed.

11. **Run Tests**:
    Run command in container:  
   `php artisan test`
