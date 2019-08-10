# Local (Email/password) and social authentication with Laravel and Nuxt

Welcome, this repo contains the end result of the series [Authentication in Laravel and Nuxt](https://www.youtube.com/playlist?list=PLeZmuYT0mSPNmQie2QyoY-3hxQxDZwi22) and [social Authentication in Laravel and Nuxt](https://www.youtube.com/playlist?list=PLeZmuYT0mSPPeyIMa6oURCgpCMEd_sD_n)

Please see the authentication branch if you're looking for the source code that belongs to Authentication in Laravel and Nuxt

## Setup

Start off by cloning the repo. Make sure to switch branches if you want to have a different starting point.

```
git clone https://github.com/fritsvt/laravel-nuxt-authentication.git
```

Make sure you are in the main project folder:

```
cd laravel-nuxt-authentication
```

## server-side / API setup (Laravel)

Run:

```
composer install
```

create a .env file by copying the contents from .env.example.

```
cp .env.example .env
```

Update the DB settings in your .env file
Then, Migrate the database.

```
php artisan migrate --seed
```

Generate the keys:

```
php artisan key:generate
php artisan jwt:secret
```

Make sure the settings (client ids, secret keys, redirect URLs) for the social auth providers you want to use are set up correctly:

```
# Set these up at https://github.com/settings/applications/new
GITHUB_CLIENT_ID=xxxxxxxxxxxxxxxxxxxxx
GITHUB_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
GITHUB_REDIRECT_URL=http://localhost:8000/api/auth/login/github/callback

# Set these up at https://console.developers.google.com/
GOOGLE_CLIENT_ID=xxxxxxxxxxxxxxxxxxxxx
GOOGLE_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
GOOGLE_REDIRECT_URL=http://localhost:8000/api/auth/login/google/callback

# Set these up at https://developers.facebook.com/
FACEBOOK_CLIENT_ID=xxxxxxxxxxxxxxxxxxxxx
FACEBOOK_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
FACEBOOK_REDIRECT_URL=http://localhost:8000/api/auth/login/facebook/callback

# Set these up at https://www.linkedin.com/developers/apps/
LINKEDIN_CLIENT_ID=xxxxxxxxxxxxxxxxxxxxx
LINKEDIN_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
LINKEDIN_REDIRECT_URL=http://localhost:8000/api/auth/login/linkedin/callback

# Set these up at https://apps.twitter.com/
TWITTER_CLIENT_ID=xxxxxxxxxxxxxxxxxxxxx
TWITTER_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TWITTER_REDIRECT_URL=http://localhost:8000/api/auth/login/twitter/callback

```

Note that you can do the same for other social auth services like Linkedin, Twitter, Gitlab, etc. Just make sure that the config settings exist in config/services.php and the keys are set in your .env file.
Example:

```
    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_REDIRECT_URL'),
    ],

```

Change this setting, if needed. 
If set, we will save the email that comes back from social login, regardless of whether or not it has been verified by the provider (Google is the only one that does this right now). If not set, we will store a dummy email to the DB like: 'linkedin-id123456@linkedin.local'
```
RETRIEVE_UNVERIFIED_SOCIAL_EMAIL=0
```

IMPORTANT: Make sure that your .env file is updated with the right settings for APP_URL (for your back-end APIs) and CLIENT_BASE_URL (for your front-end / Nuxt). These values need to match what you will set in the client-side setup section.

```
APP_URL=http://localhost:8000
CLIENT_BASE_URL= http://localhost:3000
```

Finally, start the Laravel API server:

```
php artisan serve
or
php artisan serve --port=8000
```

## client-side / front-end setup (Nuxt.js):

Now navigate to the client directory where the nuxt project is located.

```
cd client
```

Now we're going to install the node modules.

```
npm install
```

Update nuxt.config.js to match the server:port where your Laravel API server is running:
This needs to be done in 2 places:

1. baseUrl in the env{} section (either make sure process.env.BASE_URL is set, or change the default)

```
   env: {
    baseUrl: process.env.BASE_URL || 'https://jwt-auth.test.com/api/'
   },
```

Example: baseUrl: process.env.BASE_URL || 'http://localhost:8000/api/'
(dont forget the trailing slash)

2. baseURL in the axios: {} section

```
  /*
  ** Axios module configuration
  */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
    baseURL: 'http://jwt-auth.test/api'
  },
```

Example: baseURL: "http://localhost:8000/api" (no trailing slash here)

Finally, start the nuxt development server.

```
npm run dev
```

Now, navigate to the front-end URL displayed on the Nuxt terminal (default is http://localhost:3000) and click 'Register'. Click on the logo for the social auth service you have configured, and see the social authentication in action!
