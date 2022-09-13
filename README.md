<p align="center">
<img src="https://i.postimg.cc/FRntK4VN/logo.png" width="50" alt="App Logo">
</p>
<div style="text-align: center; font-size: 20px; font-weight: bold">Bulldozer Url Shortener</div>
<hr>

## About Bulldozer Url Shortener

This is a demo app to create a shorten urls

## App Setup

1. clone this repository and cd
    > git clone https://github.com/FahmiChaar/bulldozer-url-shortener.git

    > cd bulldozer-url-shortener
2. Install dependencies
    > composer install

    > npm i
3. Create .env file and set the database information
   > cp .evn.example .env
4. Generate app key
   > php artisan key:generate
5. Migrate the database
   > php artisan migrate
6. Compile js assets by running the server
   > npm run dev
7. open the app in the browser, create an account and have fun. 