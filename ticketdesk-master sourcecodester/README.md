# Ticket Desk
Centralized ticketing system for a help desk, call center, dev team, or whatever you need. Check out a live demo here: http://devmonkeyz.com/ticketdev/ it's always running the latest code and anyone can register. 

## Install
The install process is fairly manual. We'll make automated install scripts in the future.

1. Set up a LAMP server (WAMP also tested, it's just easier on linux :D)
2. Create a MySQL database and user with insert, delete, update and select rights
3. Edit the /includes/connect.php with the new database name, user, and password
4. Run the install.sql script to create the tables
5. Place the code into your web root folder
6. (optional) For email notifications you'll also need an smtp server running on port 25

## Road map
Check the issues section there are a few items and enhancements that still need to be developed. The largest remaining task is implementing multiple languages.

