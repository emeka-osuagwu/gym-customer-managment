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
- clone repo
- cd into folder and run ```composer install```
- run ```docker exec  -it kontist_api_server bash``` to get into the dev ennviromennt
- cd into ```/web``` and run ```composer install``` to pull dependencies
- run ```php console kontist:migrate``` to run database migration

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
