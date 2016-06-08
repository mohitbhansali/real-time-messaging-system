Real Time Messaging System
===============================

This is a real time messaging system using Yii2, NodeJS, Socket.io and Redis.

User has to login and search user with whom he wants to chat and can begin chatting.

**Steps to install the application**

1. Clone or download the zip in the server root directory.
2. Install composer
3. Run ``composer global require "fxp/composer-asset-plugin:1.1.4"``
4. Run ``composer update``
5. Run command "init" (windows) or "php init" (for linux) to initialize the application with a specific environment. Select "development" environment.
6. Create database named as "bananabandy" adjust the components['db'] configuration in <root>/common/config/main.php. 
7. Migrate Database ``yii migrate`` in command prompt.
8. Install NodeJS
9. Install & run Redis
10. Go to nodejs folder and open command prompt here and run ``node server.js``
11. Go to browser URL and type <root>/backend/web
12. Use following credentials to login: admin@bananabandy.com/admin123
13. Create users.
14. Go to frontend 
15. Open two browsers & type <root>/ in both the browsers.
16. Login using credentials created in the admin panel
17. Search user and start chatting.
 

*Note* : Please let me know if you need any help in setting up the system.
