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
- run ```php console ``` to see list of command available
- run ```php console virtuagym:migrate``` to create database tables
- run ```php console virtuagym:seed``` to seed database tables with test data. (this is optional)
- run ```php console virtuagym:drop-table``` to drop all database tables


#### Step 3 -> setup database migrates with the virtuagym console app:
- goto ```http://localhost:8080/ ``` on your browser to use the app


#### Testing:
  - run ```./vendor/bin/phpunit``` 
  
# Thanks
