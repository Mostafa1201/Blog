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
- Open command line and run : composer install
- Change database configurations according to your local database in the env file.
- run : php artisan key:generate
- run : php artisan migrate
- Go the localhost at the browser , no need for any plugins i have attached all links in the project.
- Internet is required because there are online links.
- You need to register to be able to add,delete or update posts and categories (you will be registered as an admin)

## Notes

- I changed the auth default from users to admins since there is no registeration for general users , as they will just view posts and categories.
- Only the admin can add , delete or update posts and categories.
- There is a one to many relationship between category and post so a category can have many posts but every post has only one category assigned to it.
- Only the 3 newly added categories appears in the navbar , you can browse all categories from the dropdown in the navbar.

## Conclusion

- I have done tests on it with code coverage more than 60% , you can find it in public/code-coverage directory
- i also deployed it on heroku with the url : http://my-blog1201.herokuapp.com

Thanks
