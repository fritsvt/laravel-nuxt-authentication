# Local and social authentication with Laravel and Nuxt 

Welcome, this repo contains the end result of the series [Authentication in Laravel and Nuxt](https://www.youtube.com/playlist?list=PLeZmuYT0mSPNmQie2QyoY-3hxQxDZwi22) and [social Authentication in Laravel and Nuxt](https://www.youtube.com/playlist?list=PLeZmuYT0mSPPeyIMa6oURCgpCMEd_sD_n)

Please see the authentication branch if you're looking for the source code that belongs to Authentication in Laravel and Nuxt

## Setup
Start off by cloning the repo. Make sure to switch  branches if you want to have a different starting point.
```
git clone https://github.com/fritsvt/laravel-nuxt-authentication.git
```
make sure you are in the project folder then run
```
composer install
```
create a .env file and copy the contents from .env.example and modify it with your info.
```
cp .env.example .env
```
Migrate the database.
```
php artisan migrate
```
Now navigate to the client directory where the nuxt project is located.
```
cd client
```
Now we're going to install the node modules.
```
npm i
```
Fill in the contents of nuxt.config.js so they match with your setup. 
After that's done you can start the nuxt development server.
```
npm run dev
```
