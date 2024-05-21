<?php
// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// create image manager with desired driver
$manager = new ImageManager(new Driver());

// read image from file system
$image = $manager->read('twice_group.jpg');

// resize image proportionally to 300px width
$image->scale(width: 300);

// insert watermark
#$image->place('watermark.png');

// save modified image in new format 
$image->toPng()->save('foo.png');

// read image from binary data
#$image = $manager->read(file_get_contents('twice_group.jpg'));