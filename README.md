## Copying This Repo For Yourself
### Clone the repository
git clone https://github.com/yourusername/your-repo.git

### Navigate to the project directory
cd your-repo

### Install dependencies (including Tailwind CSS?)
npm install

### Install required /vendor dependencies (install composer if not already installed)
composer update

### Copy .env.example as .env

### Run 'php artisan key:generate'
You may get a 'ERROR: No application encryption key has been specified. {"exception":"[object] (Illuminate\\Encryption\\MissingAppKeyException(code: 0): No application encryption key has been specified. at G:\\...\\\vendor\\laravel\\framework\\src\\Illuminate\\Encryption\\EncryptionServiceProvider.php:83)' if trying to access the application via browser first.

### Create MySQL Database 'app-crud'
Use mysql command line, phpMyAdmin, HeidiSQL, etc to create the database.

### Update .env With MySQL Details (Adjust Below Accordingly)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app-crud
DB_USERNAME=root
DB_PASSWORD=
```

# Expanding Completed Laravel CRUD tutorial (marked as a 1.0 release). What's Next?

✔️ **Completed Additions**
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
- [x] Login check for entire CRUD app (check out [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze-and-blade) for authentication starter kit)
- [x] One public site view/controller/model (/products - public listing of products)
- [x] Pagination - sorting (asc/desc)
- [x] Admin site: [INNER JOIN](https://laravel.com/docs/11.x/queries#joins) query
- [x] Email functionality in XAMPP/Laravel with Gmail
  - [x] Email with attachement
  - [x] Email - HTML format
  - [x] Email multiple attachments
- [x] API integration: Weather

📋 **To Do**
- [ ] **Email CC/BCC - ensure CC/BCC list is not visible in email/header**
- [ ] Email functionality with Mailtrap.io?
- [ ] **Admin site: Forgot password/reset password**
- [ ] Admin users index/edit/create (output user roles from 'adminroles' table???)
- [ ] **Products: search functionality (search for product name, description, price - slider(?), description)**
- [ ] **"You are here" sidebar nav indicator**
- [ ] Breadcrumb links?
- [ ] **Calendar picker form input**
- [ ] Dashboard index page
- [ ] Style UI: Frameworks (e.g. ✔️Tailwind CSS, **Bootstrap**, **[Vue](https://v2.vuejs.org/v2/cookbook/form-validation#Using-Custom-Validation)**, **[Vueform](https://vueform.com/)**, **[react-hook-form](https://react-hook-form.com/)**)
- [ ] Hover over thumbnail to show full size image


### How to Install Intervention Image Library
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
