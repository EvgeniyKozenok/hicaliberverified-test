# Install for local development
- git clone
- composer install && composer run-script post-autoload-dump && composer run-script post-root-package-install && composer run-script post-create-project-cmd
- create DB and setup DB connection in the .env
- php artisan migrate --seed && npm install && npm run dev && php artisan serve
