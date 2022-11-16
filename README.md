# Product Dashboard [Laravel Nova]
This is the official repository [ULTIMATE Laravel Nova Tutorial](https://www.youtube.com/watch?v=vBfaiZQDQrQ&feature=youtu.be) <br>
•	Twitter: [@codewithdary](https://twitter.com/codewithdary) <br>
•	Instagram: [@codewithdary](https://www.instagram.com/codewithdary/) <br>
•	TikTok: [@codewithdary](https://tiktok.com/@codewithdary) <br>
•	Blog: [@codewithdary](https://blog.codewithdary.com) <br>
•	Patreon: [@codewithdary](https://www.patreon.com/user?u=30307830) <br>
 <br>

## Usage <br>
Setup the repository <br>
```
git clone git@github.com:codewithdary/product-dashboard.git
cd product-dashboard
```

Create a ```auth.json``` file in the root of your directory where you need to define your Laravel Nova email ans license key
```json
{
    "http-basic": {
        "nova.laravel.com": {
            "username": "",
            "password": ""
        }
    }
}
```

Then, we need to make sure that we run the following commands:
```
composer install
cp .env.example .env 
php artisan key:generate
php artisan cache:clear && php artisan config:clear 
php artisan serve 
```
