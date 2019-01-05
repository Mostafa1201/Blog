<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Blog

MyBlog a simple blog system which provides user interface to browse and explore blog posts. Also it contains admin dashboard to add, edit, delete, and update posts and categories.

## Setup

- Clone the project
- open command line and run : composer install
- Copy env.example file to .env file and change database configurations according to your local database.
- run : php artisan key:generate
- Go the localhost at the browser , no need for any plugins i have attached all links in the project.
- Internet is required because there are online links.
- You need to register to be able to add,delete or update posts and categories (you will be registered as an admin)

## Notes

- I assumed there is no registeration for general users in the system , as they will just view posts and categories.
- Only the admin can add , delete or update posts and categories.
- From the description of the task I assumed that there is a one to many relationship between category and post so a category can have many posts but every post has only one category assigned to it.
- Only the 3 newly added categories appears in the navbar , you can browse all categories from the dropdown in the navbar.

## Conclusion

I have done unit tests on it but still didnt do the code coverage , i will also deploy it on heroku.
Thanks
