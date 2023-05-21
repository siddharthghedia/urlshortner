##Installation
Follow these steps to install and run the Laravel URL shortener application:

- Clone the repository: git clone https://github.com/siddharthghedia/urlshortner.git
- Install dependencies: composer install
- Copy the .env.example file to .env and configure your environment variables, including the database connection settings.
- Generate an application key: php artisan key:generate
- Run database migrations: php artisan migrate
- Compile CSS and JS assets: npm install, npm run dev (for development), npm run build (for production build)
- Start the development server: php artisan serve
Access the application in your browser at http://localhost:8000
Feel free to explore the application and generate short URLs!
