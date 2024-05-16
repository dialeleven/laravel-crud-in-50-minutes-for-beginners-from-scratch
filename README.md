## Expanding Completed Laravel CRUD tutorial (marked as a 1.0 release). What's Next?

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


📋 **To Do**
- [ ] Admin site user admin module (✔️index, create, edit, delete)
- [ ] Authentication for CRUD app (login form, login form submission logic, user logged in check, forgot password, reset password - email reset password link)
- [ ] **Login check for entire CRUD app (check out [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze-and-blade) for authentication starter kit)
- [ ] "You are here" sidebar nav indicator
- [ ] Breadcrumb links?
- [ ] Calendar picker form input
- [ ] Dashboard index page
- [ ] Pagination - sorting (asc/desc)
- [ ] Style UI: Frameworks (e.g. ✔️Tailwind CSS, Bootstrap, **[Vue](https://v2.vuejs.org/v2/cookbook/form-validation#Using-Custom-Validation)**, **[Vueform](https://vueform.com/)**, **[react-hook-form](https://react-hook-form.com/)**)
- [ ] Hover over thumbnail to show full size image
- [ ] Validation (email address, URL slugs, [A-Za-z0-9], etc)
- [ ] API integration?


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
