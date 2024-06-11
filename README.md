With Devtamin's Laravel CRUD tutorial successfully completed going over the basics, we are going above and beyond the tutorial based on what I've built in native PHP in the past professionally (e.g. pagination, email functionality, image uploads and resizing, etc...).

The "basic" tutorial covers a fair amount including: routes, controllers, views, models, and dependency injection in the service container.

Beyond the basics, we cover things like PHPUnit testing in Laravel, Tailwind CSS, Bootstrap, Laravel Vite, middleware authentication, sending email (plain text/HTML, attachments), exporting MySQL data to CSV, handling file/image uploads, pagination and sorting, REST API consumption, and exploring various Laravel Libraries. You can see a list of completed (and planned) additions to the project below.

For [naming conventions](https://github.com/alexeymezenin/laravel-best-practices#follow-laravel-naming-conventions) and other Laravel best practices, Alexey Mezenin's GitHub repo for [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices) (scoll down to view the README.md) is an excellent resource.

# Expanding Completed Laravel CRUD tutorial (marked as a 1.0 release). What's Next?

## ✔️ Completed Additions
- [x] Laravel DB operations: add column to table
- [x] ~~Style UI: CSS~~
- [x] Image upload: Full-size image
- [x] Image upload: preserve user's image file name
- [x] Image upload: Generate thumbnail using [Intervention Image library](https://image.intervention.io/v3) (using v3.6.3)
- [x] Delete product: delete image/thumbnail
- [x] Create/edit product: link form submission error messages to form field
- [x] Edit product: image upload field (update -> view/controller) + delete old image/thumbnail
- [x] Product index: pagination and ~~basic~~ Tailwind CSS styling
- [x] Export product list to CSV
- [x] Styling with Tailwind CSS: Product index, Create product, Edit product
- [x] Common includes with Blade view partials (header/footer) - *no longer used in favor of @extends, @section+@yields, @push+@stack unless `include` is needed*
- [x] Templating using @extends, @section+@yields, @push+@stack, @parent (not used... yet)
- [x] Add meta tags (description, keywords) and use @section @yield
- [x] Dashboard UI - responsive, mobile hamburger menu
- [x] Edit/delete operations: send user back to same paginated page they were on after edit/delete operation instead of page 1 automatically
- [x] Login: controller, view
- [x] Organize admin site views into /views/admin/SUBFOLDER (update /routes/web.php accordingly)
- [x] Create migrations (admins, adminroles) and Models
- [x] Admin site user admin module (✔️index, ✔️create, ✔️edit, ✔️ delete)
- [x] Admin Users - Create/Edit - password requirements (min character limit, 1 number, 1 special char)
- [x] Admin Users - Create/Edit - Password requirement error message output: combine into single error message (currently multiple error messages can be output in list items)
- [x] Authentication for CRUD app (✔️login form, ✔️login form submission logic, ✔️user logged in check (web.php), ✔️logout
- [x] Login check for entire CRUD app (check out [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze-and-blade) for authentication starter kit?)
- [x] One public site view/controller/model (/products - public listing of products)
- [x] Pagination - sorting (asc/desc)
- [x] Admin site: [INNER JOIN](https://laravel.com/docs/11.x/queries#joins) query
- [x] Email functionality in XAMPP/Laravel with Gmail
  - [x] Email with attachement
  - [x] Email - HTML format
  - [x] Email multiple attachments
  - [x] Check if file exists when attaching file and log error if file does not exist
- [x] API integration: Weather
- [x] Calendar picker form input
- [x] PHPUnit testing
   - [x] Products: ✔️Product.index route
   - [x] Forgot/Reset Password: ✔️ Send password reset link
- [x] Products index - delete product (adjust page user is redirected to if record being deleted is the only product on that page - e.g deleting the only product on page 3  should redirect to page 2)
- [x] Move records per page pagination value to 'config/app.php'
- [x] Admin site: Forgot password/reset password
- [x] Admin login: remember me checkbox (update controller/view)
- [x] Install [Laravel Telescope - Debugging](https://laravel.com/docs/11.x/telescope)
- [x] Admin users index/edit/create (output user roles from 'admin_roles' table)
- [x] Add logged in user's name in sidebar (auth()->user()->name)
- [x] Restrict adminusers to admins and superadmins
- [x] Dashboard index page
- [x] Laravel Libraries
  - [x] [Laravel Backup](https://spatie.be/docs/laravel-backup/v8/introduction) - Run backups with ```php artisan backup:run```
- [x] SVG nav icon animations (scale up)
- [x] Truncate long usernames in left nav with ellipses
- [x] Configure PHPUnit to use separate database for running tests (keep db tables in sync running migrations as needed using `php artisan migrate --database=mysql_testing`)
- [x] Refactor email routes into EmailController for separation of concerns/readability of /routes/web.php

## 📋 Additional Features To Do
- [ ] **Deploy project in Docker**
- [ ] **Deploy project to Oracle Cloud or similar**
- [ ] **Redis**
- [ ] PHPUnit testing
  - [ ] Authenticate admin user
  - [ ] Products
  - [ ] Forgot/Reset Password: password.reset, password.update
- [ ] **Email CC/BCC - ensure CC/BCC list is not visible in email/header** (using [Mailtrap.io example](https://mailtrap.io/blog/laravel-send-email-gmail/#Send-email-to-multiple-recipients) )
- [ ] Email functionality with Mailtrap.io?
- [ ] **Products: search functionality (search for product name, description, price - slider(?), description)**
- [ ] "You are here" sidebar nav indicator
- [ ] Breadcrumb links?
- [ ] Style UI: Frameworks (e.g. ✔️Tailwind CSS, ✔️Bootstrap, **[Vue](https://v2.vuejs.org/v2/cookbook/form-validation#Using-Custom-Validation)**, **[Vueform](https://vueform.com/)**, **[react-hook-form](https://react-hook-form.com/)**)
- [ ] Hover over thumbnail to show full size image
- [ ] Check out Laravel Libraries
  - **[Laravel Socialite](https://laravel.com/docs/11.x/socialite)** (OAuth authentication from Google, FB, GitHub, etc)
  - [Algolia Meilisearch](https://laravel.com/docs/11.x/scout) (Search functionality: open source version - free)
  - [Laravel Maatwebsite Excel](https://laravel-excel.com/) (Import & Export)
  - [Laravel Dusk](https://laravel.com/docs/11.x/dusk) (browser automation and testing)
  - [Laravel Spatie Queues](https://spatie.be/docs/laravel-health/v1/available-checks/queue) (Background Jobs)
  - [Spatie Laravel Translation](https://spatie.be/docs/laravel-translatable/v6/introduction) (Localization)
  - [Laravel Passport (OAuth2 support)](https://laravel.com/docs/11.x/passport) or Sanctum (no OAuth2) - API authentication 
  - [Laravel Cashier (Stripe)](https://laravel.com/docs/11.x/billing) - subscription billing/payment services
  - [laravel-site-search](https://spatie.be/docs/laravel-site-search)
  - [laravel-pdf](https://spatie.be/docs/laravel-pdf)


## How to Install Intervention Image Library
Install Intervention Image with Composer by running the following command.
`$ composer require intervention/image`

### How To Use Intervention Image
Code Example from https://image.intervention.io/v3

```
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// create image manager with desired driver
$manager = new ImageManager(new Driver());

// read image from file system
$image = $manager->read('images/example.jpg');

// resize image proportionally to 300px width
$image->scale(width: 300);

// insert watermark
$image->place('images/watermark.png');

// save modified image in new format 
$image->toPng()->save('images/foo.png');
```

## Setting Up This Project Locally
This project currently runs on XAMPP 8.2.4 (PHP 8.2.4) and Laravel 11.8).

### Clone the repository
```git clone https://github.com/dialeleven/laravel-crud-in-50-minutes-for-beginners-from-scratch```

### Navigate To Project Directory
```cd app-crud```

### Install Dependencies (including Tailwind CSS)
```npm install```

### Install Required '/vendor' Dependencies (install composer if not already installed)
```composer update```

### Copy '.env.example' as '.env'
Adjust your MySQL details in your new .env file now or after the next two steps.

### Run 'php artisan key:generate'
```php artisan key:generate```
If trying to access the application via browser first, you may get a 'ERROR: No application encryption key has been specified. {"exception":"[object] (Illuminate\\Encryption\\MissingAppKeyException(code: 0): No application encryption key has been specified. at G:\\...\\\vendor\\laravel\\framework\\src\\Illuminate\\Encryption\\EncryptionServiceProvider.php:83)' message. The above command should help resolve the issue.

### Create MySQL Database 'app-crud'
Use mysql command line, phpMyAdmin, HeidiSQL, etc to create the database.

### Update .env with MySQL Details (Adjust Below Accordingly)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 # Ensure your port is correct! With multiple XAMPP installs (PHP 5.6 and PHP 8.2), I had to run XAMPP PHP 8.2 with MySQL on port 3308!)
DB_DATABASE=app-crud
DB_USERNAME=root
DB_PASSWORD=
```

### Create Link To /storage/public
TODO: add code example here

### Test Accessing The Home Page '/' and 'products/' (e.g. http://localhost/products or http://laravel.localhost/products)
If you get any 500 server errors, check 'storage/logs/laravel.log' or your Apache error_log. Once any error(s) are resolved, you should be up and running!

### Update Tailwind CSS/JS If Adding New TW Classes
Run ```npm run build``` within the 'app-crud' directory.

### If Using PHPUnit To Run Tests, Create MySQL DB for Tests Only
Some PHPUnit tests use ```use RefreshDatabase;``` which will remove existing DB table data, but configured to use a different PHPUnit test database to avoid this. This project uses the databases *app-crud* and *app-crud-phpunit-tests*.

See the following files for values to customize if needed:
- .env.example (DB_TEST_* fields)
- /config/database.php ('mysql_testing' entry)
- phpunit.xml (```<env name="DB_CONNECTION" value="mysql_testing"/>```)
