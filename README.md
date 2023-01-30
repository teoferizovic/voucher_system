
## About Project

Voucher System is imagined to work as small microservice and should work together with big E-Shop App.
This should be small independent application called Voucher App , where client can login, read and create voucher codes.
There are 2 voucher types : discount and free delivery. Client can not have more than 5 not used and validated vouchers.
Voucher App is made in php (Laravel Framework) , javascript (jQuery) and css (Bootstrap).

Like I said , this logic should be used with E-shop. For that purpose I made rest-apis that should be implemented in E-Shop.
Client can use one of voucher codes that he made in Voucher App, or he can create new Voucher with rest-api and then use them.

One of potential problem with rest-apis could be that there is no authentication. This can be solved using Api Gateway Authentication.
I assumed that E-Shop is really big project made in many different microservices.


## Setup Project

- Clone your project
- Go to the folder application using cd command on your cmd or terminal
- Run composer install on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan serve
- Go to http://localhost:8000/

## Rest-Apis

- Get all vouchers:
Method GET - http://127.0.0.1:8000/api/vouchers/

- Get Voucher By Id 
Method GET - http://127.0.0.1:8000/api/vouchers/1

- Create new voucher : 
Method POST - http://127.0.0.1:8000/api/vouchers/
Request Body :
{
    "user_id" : "1",
    "type_id" : "2"
}

- Update Voucher : 
Method PUT - http://127.0.0.1:8000/api/vouchers/803fe28fb2f27720c9eb052404f10800b98083bc

- Delete Voucher : 
Method DELETE - http://127.0.0.1:8000/api/vouchers/764c5a83457d48c8c6bf923fd933805658852410