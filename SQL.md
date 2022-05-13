### MySQL database setup

# Step 1

Install MySQL. This can be done on servers running Debian derivatives by running `sudo apt install mysql-server`. You will need to research instructions for servers not running a Debian derivative. Do not use Windows as a server.

# Step 2

Create the database and user. You can name the database whatever you want. I will name mine `currency`. Open the MySQL console as root by running `sudo mysql` or your server's equivalent for running `mysql` as root. Creating the database is easy, just run `CREATE DATABASE db;` where `db` is the name of your database. Now we create the user that will access the database from PHP. Run the command `CREATE USER 'user'@'host' IDENTIFIED BY 'password';`. `user` is the name you want for your user, `host` is the hostname from which the user will connect, and `password` is the password to access this user. `host` will be `localhost` if you are running your web server on the same device as your MySQL server, and otherwise will be the IP address of your web server. I'll name my user the same as the database, `currency`. Now would be a good time to create a .env in the server root with the database name, user, host, and password for PHP to use. The format is formatted as `KEY=VALUE`. The web server will read the keys `DATABASE`, `USER`, `HOST`, and `PASSWORD`. You will need to give your new user permission to access your database, so in MySQL run `GRANT ALL PRIVILEGES ON db.* TO 'user'@'host';`. Make sure nobody else can access this user, as they would have full access to your database.

# Step 3

Create the table. We will only need one table because we only store user data. This step is easy because I have already done all the work for you. Make sure you're using the database by running `USE db;`. Run `CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, currency BIGINT UNSIGNED DEFAULT 0, apiKey CHAR(36), admin BOOLEAN DEFAULT 0);`. After registering on your web server, make yourself an admin by running `ALTER TABLE users SET admin = true WHERE id = 1`, where 1 is your ID.

Congratulations, you are complete!