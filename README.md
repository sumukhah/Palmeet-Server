<h2 align="center">PALMEET-SERVER</h2>
<h3>The Server-side application for Palmeet&nbsp;&nbsp;<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>&nbsp;</h3>
<h3>Built with Laravel Framework.</h3>
<h2>&nbsp;How to setup the Server-side</h2>
<ol>
    <li>
        <h2>Clone <a href="https://github.com/sumukhah/Palmeet-Server.git">this</a> Repository.</h2>
    </li>
    <li>Set up your apache sites available<h3>Sample config</h3>
        <pre>&lt;VirtualHost *:80&gt;
    ServerAdmin hexxondiv@gmail.com/ 
    ServerName palmeet.test 
DocumentRoot /var/www/html/palmeet-server/public 
&lt;Directory /var/www/html/palmeet-server/public/&gt; 
    Options Indexes FollowSymLinks MultiViews 
    AllowOverride all 
    Order allow,deny 
    allow from all 
&lt;/Directory&gt; 
&lt;/VirtualHost&gt;</pre>
    </li>
    <li>Open etc/hosts file
        <pre>sudo nano /etc/hosts</pre>
    </li>
    <li>
        <p>Add any test/live url/domain, E.g:</p>
        <pre>127.0.0.1<span style="white-space:pre;">    </span>palmeet.test</pre>
    </li>
    <li>Run composer update
        <pre>composer update</pre>
    </li>
    <li>Make a copy of .env.example named &quot;.env&quot;</li>
    <li>Change the database name, username and password for your mysql connection.</li>
    <li>Ensure you have created the database with the *database_name* you provided here</li>
    <li>
        <aside>Run <code>php artisan migrate</code></aside>
    </li>
    <li>Run <code>php artisan db:seed</code><br>You can check the seeds&gt;&gt;UsersTableSeeder.php file to see the seeded sample user</li>
    <li>Run <code>php artisan serve</code> to start the server-side</li>
    <li>All API endpoints can be found in <code>routes&gt;&gt;api.php</code></li>
</ol>
<h2>How to Register a New User</h2>
<p>Here is a sample registration call: <code>&nbsp;</code></p>
<pre><code>curl -X POST http://localhost:8000/api/register \ -H &quot;Accept: application/json&quot; \ -H &quot;Content-Type: application/json&quot; \ -d &apos;{&quot;name&quot;: &quot;John&quot;, &quot;email&quot;: &quot;jamesochuwa@gmail.com&quot;, &quot;password&quot;: &quot;secret123&quot;, &quot;password_confirmation&quot;: &quot;secret123&quot;}&apos; </code></pre>
<h4>Response</h4>
<pre><code>{ &quot;data&quot;: { &quot;api_token&quot;:&quot;0syHnl0Y9jOIfszq11EC2CBQwCfObmvscrZYo5o2ilZPnohvndH797nDNyAT&quot;, &quot;created_at&quot;: &quot;2020-11-23 21:17:15&quot;, &quot;email&quot;: &quot;jamesochuwa@gmail.com&quot;, &quot;id&quot;: 51, &quot;name&quot;: &quot;John&quot;, &quot;updated_at&quot;: &quot;2020-11-23 21:17:15&quot; } } </code></pre>
<p><br></p>
<h3>Here is a sample login call:</h3>
<pre><code> curl -X POST http://localhost:8000/api/login \ -H &quot;Accept: application/json&quot; \ -H &quot;Content-type: application/json&quot; \ -d &quot;{\&quot;email\&quot;: \&quot;admin@palmeet.com\&quot;, \&quot;password\&quot;: \&quot;adminPassword\&quot; }&quot; </code></pre>
<h4>Here is a sample Login Response:</h4>
<pre><code> { &quot;data&quot;: { &quot;id&quot;:1, &quot;name&quot;:&quot;Administrator&quot;, &quot;email&quot;:&quot;admin@palmeet.com&quot;, &quot;created_at&quot;:&quot;2020-11-23 21:17:15&quot;, &quot;updated_at&quot;:&quot;2020-11-23 21:17:15&quot;, &quot;api_token&quot;:&quot;Jll7q0BSijLOrzaOSm5Dr5hW9cJRZAJKOzvDlxjKCXepwAeZ7JR6YP5zQqnw&quot; } } </code></pre>
<h4>Here is a sample Logout call:</h4>
<pre><code>curl -X POST http://localhost:8000/api/logout -H &quot;Accept: application/json&quot; -H &quot;Content-type: application/json&quot; -d &quot;{\&quot;api_token\&quot;: \&quot;PKCyWS6omyPYdREz5PRilshTwJnCmpyt98AyHp77aXWUJP94UG2beiG1BGDv\&quot; }&quot; </code></pre>
<h3>Here is a sample Response:</h3>
<pre><code> {&quot;data&quot;:&quot;User logged out.&quot;} </code></pre>
<p><br></p>
<h2>Testing Our Endpoints</h2>
<p><a href="https://github.com/sumukhah/Palmeet-Server/blob/master/API_Endpoints_Responses.md">Click here</a> For Comprehensive list of our our endpoints and their responses.&nbsp;</p>
<h3>Premium Partners</h3>
<h3><a href="https://jitsi.org/" rel="noopener noreferrer" target="_blank"><span style='color: rgb(84, 172, 210); font-family: "Times New Roman"; font-size: 22px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;'><strong>Jitsi</strong></span></a></h3>
<p><a href="https://mattermost.com" rel="noopener noreferrer" target="_blank"><span style='color: rgb(41, 105, 176); font-family: "Times New Roman"; font-size: 19px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;'><strong>Mattermost</strong></span></a></p>
<h2>Contributors</h2>
<h4><a href="https://github.com/hexxondiv" rel="noopener noreferrer" target="_blank"><span style='color: rgb(235, 107, 86); font-family: "Times New Roman"; font-size: 20px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;'><strong>Hexxondiv</strong></span></a></h4>
<h4><strong><a href="https://github.com/sumukhah" target="_blank" rel="noopener noreferrer"></a></strong><a href="https://github.com/sumukhah" rel="noopener noreferrer" target="_blank"></a><a href="https://github.com/sumukhah" rel="noopener noreferrer" target="_blank"><span style='color: rgb(243, 121, 52); font-family: "Times New Roman"; font-size: 20px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;'><strong>Sumukha</strong></span></a></h4>
<h2>&nbsp;License&nbsp;</h2>
<p>The application is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" rel="noopener noreferrer" target="_blank">MIT license</a>.</p>
