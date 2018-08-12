WEBAM - Web Attendance Management System
========================================

*	Built with PHP and Laravel

### Prerequisites 

*   `PHP 7.*`: Install Binary file or with Xampp
*   [Composer Package Manager](https://getcomposer.org/)
*   Database: Preferably `MySQL` 
*   Git: clone the repository (https://github.com/okekeobasi/WEBAM.git)

##  Installatiion

*   `.env` - use the `.env.example` make a copy and name it `.env`
*   run `composer install` from command line to install all dependencies


##  Running locally

1.  `php artisan serve` from the root folder to run the project
2.  `open http://localhost:8000` in your favourite browser


##  Setting up the Migrations

1.  set up your database in your `.env`
2.  set up the mail options using the following configurations
```
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.netfirms.com
    MAIL_PORT=587
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=tls
```
3.  `php artisan migrate` to migrate.


-   *note: images are stored in* `public/storage/employees/`