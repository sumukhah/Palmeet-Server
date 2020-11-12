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
<Directory /var/www/html/palmeet-server/public/> <br>
    Options Indexes FollowSymLinks MultiViews <br>
    AllowOverride all <br>
    Order allow,deny <br>
    allow from all <br>
</Directory> <br>
</ VirtualHost> <br>
</pre>
</li>

<li>All API endpoints can be found in <code>routes>>api.php</code> </li>
</ol>

### Premium Partners

- **[Jitsi](https://jitsi.com/)**
- **[Mattermost.](https://mattermost.com)**



## Contributors

- **[Hexxondiv](https://github.com/hexxondiv)**
- **[Sumukha](https://github.com/sumukhah)**


## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
