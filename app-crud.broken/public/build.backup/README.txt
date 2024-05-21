I) OVERVIEW

At some point using Laravel's pagination method links() in conjunction with Tailwind CSS, broke the browser output. Originally we'd have something like:

"Previous   Next"     "< Showing X to Y of Z results >"

While running 'npm run build' to build the Tailwind CSS/JS, the above changed a broke to display:

"Previous Next" (much less space between each word) and no more "Showing X..." on the right


II) THE FIX

We have to:

1) Publish the pagination views: Run the following Artisan command to publish the pagination views to your application:

php artisan vendor:publish --tag=laravel-pagination

2) Locate the pagination Blade file: After running the command above, you'll find the pagination Blade files in the `resources/views/vendor/pagination` directory of your Laravel application.

3) Customize the pagination Blade file: Open the appropriate pagination Blade file (e.g., `bootstrap-4.blade.php` or `tailwind.blade.php`, depending on your CSS framework) and locate the section responsible for rendering the pagination links.

// #4 is optional and at your own risk which will likely break the responsive CSS. It was tested without modifying the Blade HTML after by just having the pagination Blade templates in your file system
4) Remove the `hidden` part: You should find something like <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"> or similar. Remove the hidden part or modify it as needed to fit your layout requirements.

5) Save your changes: After making the necessary modifications, save the Blade file.

6) Test: Verify that the pagination links are now displayed as expected without the hidden part interfering with their visibility.

