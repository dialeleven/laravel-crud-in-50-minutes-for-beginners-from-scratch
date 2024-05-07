## Expanding Completed Laravel CRUD tutorial (marked as a 1.0 release). What's Next?

- [x] Laravel DB operations: add column to table
- [x] Style UI: CSS
- [x] Image upload: Full-size image
- [x] Image upload: preserve user's image file name
- [x] Image upload: Generate thumbnail using [Intervention Image library](https://image.intervention.io/v3) (using v3.6.3)
- [x] Delete product: delete image/thumbnail
- [ ] Edit product: image upload field (update -> view/controller)
- [ ] Product index: pagination
- [ ] Style UI: Frameworks? (e.g. Tailwind CSS, Vue)
- [ ] Login check for entire CRUD app
- [ ] User login page
- [ ] User forgot password page
- [ ] Reset password page
- [ ] Validation (email address, URL slugs, [A-Za-z0-9], etc)


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
