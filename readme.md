# LearnCast

[![Build Status](https://travis-ci.org/andela-tolotin/Learncast.svg?branch=develop)] (https://travis-ci.org/andela-tolotin/Learncast) [![Coverage Status](https://coveralls.io/repos/github/andela-tolotin/Learncast/badge.svg?branch=develop)](https://coveralls.io/github/andela-tolotin/Learncast?branch=develop) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-tolotin/Learncast/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/andela-tolotin/Learncast/?branch=develop)

This website offers video tutorials accross various learning fields at no cost and its accessible for learning anywhere, anytime 24/7. 

(http://learncast.herokuapp.com/)


#Features 

#### Login System 

- Tradition :  User login via form
- Oauth : Users use social lazy login

#### Signup System 

- Tradition : Users signup via form
- Oauth : Users leverage on social signup without any hassle.


#### Video Category

##### Admin users can 

- create video categories 
- as well add video to cateories
- Edit video categories
- Restore deleted video categories

#### Video Content

##### An authenticated user can 

- Add videos to category
- Edit videos
- Delete videos
- Restore deleted videos

#### Favourite and Comment

##### An authenticated user can 

- Favourite and unfavourite a video
- Add comments to video
- Edit their comments
- Delete their comments

#### Search Video

- Both guest and authenticated users can search videos 

#### View learning resources

- Both guest and authenticated users can view available videos 

## Installation
You can install the application by forking this repo or cloning it to your desktop. After cloning the application
you have to set your environments variables, the required ones for the application are below:

Clone this repository by typing this on your command line 

` git clone https://github.com/andela-tolotin/Learncast.git `


```

- APP_ENV=local
- APP_DEBUG=true
- APP_KEY=xxxxxxxxxxxxxxxxxxxxx
- APP_URL=http://localhost

- DB_CONNECTION=pgsql
- DB_HOST=192.168.10.10
- DB_PORT=33060
- DB_DATABASE=learnanytime
- DB_USERNAME=xxxxx
- DB_PASSWORD=xxxxx

- GITHUB_CLIENT_ID=xxxxxxxxxxxxxx
- GITHUB_CLIENT_SECRET=xxxxxxxxxx
- GITHUB_CLIENT_REDIRECT=http://localhost

- FACEBOOK_CLIENT_ID=xxxxxxxxxxxx
- FACEBOOK_CLIENT_SECRET=xxxxxxxx
- FACEBOOK_CLIENT_REDIRECT=http://localhost

- TWITTER_CLIENT_ID=xxxxxxx
- TWITTER_CLIENT_SECRET=xxxxxxx
- TWITTER_CLIENT_REDIRECT=http://localhost

- CLOUDINARY_API_KEY=xxxxxx
- CLOUDINARY_API_SECRET=xxxxxxx
- CLOUDINARY_CLOUD_NAME=xxxxxxxxx

```

Run Migration:

```artisan
    php artisan db:migrate
```

and Seed:

```
    php artisan db:seed --class=UsersTableSeeder
```

##Requirements
- PHP
  - 5.5
  - 5.6
  - 7.0
- Composer
- Apache
- Database

#Testing 

` Run phpunit tests ` 


##Contributing
This application is open-source hence you are free to contribute to any part of the project