# PHP_Project
TE-IT

<br/>
<p><b>Project is based on E-commerce website used for renting products online!</b></p>
<br/>
<b>Pre-requisite-</b>
<ul>
  <li>XAMPP Software</li>
  <ul>
    <li>Apache</li>
    <li>MySQL</li>
  </ul>
  <li>Composer</li>
</ul>
<br/>
<b>Settings-</b>
<ul>
  <li><b>Put all the files in the Xampp/htdocs folder</b> (Can be accessed as url: localhost/Landing_Page/home.php)</li>
  <li><b>Changes in my.ini file</b> (Can be accessed through Xampp Control Panel MySQL-Config or Xampp/mysql/bin/my.ini)</li>
  <ul>
    <li>max_allowed_packet = 64M</li>
    <li>innodb_log_file_size = 256M</li>
    <li>innodb_lock_wait_timeout = 500</li>
  </ul>
  <li><b>Changes in php.ini file</b> (Can be accessed through Xampp Control Panel Apache-Config or Xampp/php/php.ini)</li>
  <ul>
    <li>max_execution_time=300</li>
    <li>display_errors=Off</li>
    <li>post_max_size=1280M</li>
    <li>upload_max_filesize=1280M</li>
    <li>sendmail_path = "\"...\Xampp\sendmail\sendmail.exe\" -t" (<b>... has to be replaced by whole path</b>)</li>
  </ul>
  <li><b>Changes in sendmail.ini file</b> (Can be accessed through Xampp/sendmail/sendmail.ini)</li>
  <ul>
    <li>smtp_server=smtp.gmail.com (<b>for Gmail</b>)</li>
    <li>smtp_port=587 (<b>for Gmail</b>)</li>
    <li>auth_username=... (<b>... has to be replaced by your email</b>)</li>
    <li>auth_password=... (<b>... has to be replaced by your password</b>)</li>
  </ul>
  <li>Run command '<b>composer install</b>' in cmd inside All_Includes folder</li>
  <li>Import <b>rentalservice.sql</b> in localhost/phpmyadmin</li>
</ul>
<br/>
<b>Features-</b>
<ul>
  <li>Landing Page</li>
  <li>Registration Page</li>
  <li>Profile Page</li>
  <li>Categories Page</li>
  <li>Product Page</li>
  <li>Wishlist Page</li>
  <li>Cart Page</li>
</ul>
<br/>
<b>Future Scope</b>
<ul>
  <li>Mail System (using PHPMailer/SendGrid instead of PHP mail function)</li>
  <li>SMS System (using Way2SMS/TextLocal API)</li>
  <li>Google Login System</li>
  <li>Payment System (using PayPal API)</li>
  <li>Realtime Notifications (using Pusher & toastr.js)</li>
  <li>Pretty URLs</li>
  <p>(removing .php in url by uncommenting mod_rewrite.so in Xampp/apache/conf/httpd.conf & creating '.htaccess' named file in our Project folder & writing rules using regular expressions in it)</p>
  <li>Security Measures</li>
  <li>Breadcrumbs</li>
  <li>Pagination</li>
  <li>Animations</li>
  <li>Admin Panel</li>
</ul>
<br/>
<b>References-</b>
<ul>
  <li>[Import MySQL database to Heroku with one command… import db.sql](https://medium.com/@michaeltendossemwanga/import-mysql-database-to-heroku-with-one-command-import-db-sql-a932d720c82b)</li>
  <li>[Deploying a PHP and MySQL Web App with Heroku](https://scotch.io/@phalconVee/deploying-a-php-and-mysql-web-app-with-heroku)</li>
</ul>
