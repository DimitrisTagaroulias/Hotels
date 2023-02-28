SETUP INSTRUCTIONS

In order to run this application:

1. you need to install xampp(Apache ,MySQL).
2. In xampp/htdocs folder create a "vhosts" folder and put the "hotels.localhost" folder of this project in there.
3. In xampp/apache/conf/extra open the "httpd-vhosts.conf" file and add these lines:
   <VirtualHost withoutthebackslash\*:80>
   ServerAdmin "your@email.example"
   DocumentRoot "C:/xampp/htdocs/vhosts/hotels.localhost/public"
   ServerName "hotels.localhost"
   ErrorLog "logs/hotels.localhost-error.log"
   CustomLog "logs/hotels.localhost-access.log" common
   </VirtualHost>
4. In C:/Windows/System32/drivers/etc open the "hosts" file and add this line at the bottom:
   127.0.0.1 hotels.localhost
5. Open XAMPP Control Panel and start the Apache and MySQL and open MySQL Admin
6. Create a new database named "hotel"
7. Click Import tab and import "hotel.sql" file of this project.
8. In "hotels.localhost/config/config.json" file:

   1. Set "username": "your MySQL user username"
   2. Set "password": "your MySQL password for the user above"

      !IMPORTANT: the user must have Global privileges (checked ALL privileges)

9. Open your browser and type "hotels.localhost" on the address bar.
