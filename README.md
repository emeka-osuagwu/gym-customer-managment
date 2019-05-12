## VIrtuagym Customer Plan Management


### Summary
The goal of the project is to create a dashboard for managing users and user plans

### Features
- Responsive Dashboard
- Request Validation
- Json REST API response
- TDD
- Email Notification
- Command Line developer tool


#### Step 1 -> clone and startup the app:
- run ```git clone git@github.com:emeka-osuagwu/gym-customer-managment.git``` to clone
- cd into folder and run ```composer install```
- create your ```.env```, you can see example of this in the ```.env.example file```
- run ``` php -S localhost:8080 ``` to start the app

#### Step 2 -> setup your env file:

```
- DATABASE_DRIVER=YOUR_DB_DRIVE
- DATABASE_PORT=YOUR_DB_PORT
- DATABASE_HOST=YOUR_DB_HOST
- DATABASE=YOUR_DB_NAME
- DATABASE_USERNAME=YOUR_DB_USERNAME
- DATABASE_PASSWORD=YOUR_DB_PASSWORD
```
```
- APP_NAME=virtuagym
```

```
- SENDGRID_API_KEY=ENTER_YOUR_SEND_GRID_API_KEY
```

#### Step 3 -> setup database migrates with the virtuagym console app:
- run ```php console ``` to see list of command avalable
- run ```php console virtuagym:migrate``` to create database tables
- run ```php console virtuagym:seed``` to seed database tables with test data. (this is optional)
- run ```php console virtuagym:drop-table``` to drop all database tables




#### Run Test:
  - while in the docker dev ennviromennt run ```./vendor/bin/phpunit``` 

#### Get Started:
- Open [postman](https://www.getpostman.com/apps). or any api client to test the api functionality
- Import [postman api collection](https://www.getpostman.com/collections/b5f7da2dc2d9f65f3cde). or any api client to test the api functionality
- Visit http://localhost to see the contents of the web container and develop your application.

#### Console App:
- while in the docker dev ennviromennt run ```php console``` to get the list of commands
- run ```php console kontist:migrate``` to run database migration
- run ```php console kontist:drop-table``` to drop  Drop database table
- run ```php console kontist:seed``` to seed database table

API documentation => https://documenter.getpostman.com/view/1035891/RztppnBu
