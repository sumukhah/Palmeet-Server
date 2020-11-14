<h2 align="center">PALMEET-SERVER</h2>
<h3>The Server-side application for Palmeet</h3>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Built with Laravel Framework

Laravel is a web application framework with expressive, 
elegant syntax. 

## How to setup the Server-side
<ol>
<li> Clone <a href="https://github.com/sumukhah/Palmeet-Server.git">this</a> Repository.</li>
<li> Set up your apache sites available
<h6>Sample config</h6>
<pre>
< VirtualHost *:80>
    ServerAdmin hexxondiv@gmail.com/ <br>
    ServerName palmeet.test <br>
DocumentRoot /var/www/html/palmeet-server/public <br>
< Directory /var/www/html/palmeet-server/public/> <br>
    Options Indexes FollowSymLinks MultiViews <br>
    AllowOverride all <br>
    Order allow,deny <br>
    allow from all <br>
</ Directory> <br>
</ VirtualHost> <br>
</pre>
</li>
<li>Run composer update</li>
<li> Make a copy of .env.example named ".env"
<li> Change the database name, username and password for your mysql connection.</li>
<li> Ensure you have created the database with the *database_name* you provided here</li>
<li> Run <code>php artisan migrate</code></li>
<li> Run <code>php artisan db:seed</code>
<br>You can check the seeds>>UsersTableSeeder.php file to see the seeded sample user
</li>
<li> Run <code>php artisan serve</code> to start the server-side
<li>All API endpoints can be found in <code>routes>>api.php</code> </li>
</ol>

<h2>How to Register a New User</h2>
<p>
Here is a sample registration call:

<code>

curl -X POST http://localhost:8000/api/register \
 -H "Accept: application/json" \
 -H "Content-Type: application/json" \
 -d '{"name": "John", "email": "jamesochuwa@gmail.com", "password": "secret123", "password_confirmation": "secret123"}'
{
    "data": {
        "api_token":"0syHnl0Y9jOIfszq11EC2CBQwCfObmvscrZYo5o2ilZPnohvndH797nDNyAT",
        "created_at": "2020-11-23 21:17:15",
        "email": "jamesochuwa@gmail.com",
        "id": 51,
        "name": "John",
        "updated_at": "2020-11-23 21:17:15"
    }
}

</code>
</p>
<p>
<h5>Here is a sample login call:</h5>

<code>

curl -X POST http://localhost:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-type: application/json" \
  -d "{\"email\": \"admin@palmeet.com\", \"password\": \"adminPassword\" }"

</code>


<h6>Here is a sample Response:</h6>

<code>

{
    "data": {
        "id":1,
        "name":"Administrator",
        "email":"admin@palmeet.com",
        "created_at":"2020-11-23 21:17:15",
        "updated_at":"2020-11-23 21:17:15",
        "api_token":"Jll7q0BSijLOrzaOSm5Dr5hW9cJRZAJKOzvDlxjKCXepwAeZ7JR6YP5zQqnw"
    }
}
</code>


</p>

<p>
<h5>Here is a sample Logout call:</h5>

<code>

curl -X POST http://localhost:8000/api/logout   -H "Accept: applicogout"   -H "Content-type: application/json"   -d "{\"api_token\": \"PKCyWS6omyPYdREz5PRilshTwJnCmpyt98AyHp77aXWUJP94UG2beiG1BGDv\" }"


</code>


<h6>Here is a sample Response:</h6>

<code>
{"data":"User logged out."}
</code>

</p>

<h2>Testing Our Endpoints</h2>
<a href="https://github.com/sumukhah/Palmeet-Server/blob/master/API_Endpoints_Responses.md">Click here</a> For Comprehensive list of our our endpoints and their responses.



### Premium Partners

- **[Jitsi](https://jitsi.com/)**
- **[Mattermost.](https://mattermost.com)**



## Contributors

- **[Hexxondiv](https://github.com/hexxondiv)**
- **[Sumukha](https://github.com/sumukhah)**


## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
