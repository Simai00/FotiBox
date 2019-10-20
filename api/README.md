# API
## Routes /v1
### GET /image/_{id}_/{quality}
    Returns image resource   
(Quality = original, medium, preview)    

### GET /image/_{id}_/triggerBW
    {
        "imageId": 1,
        "bwFilter":"1",
        "createdAt": "2019-10-04 14:13:38"
    }
### GET /camera/capture/image
    {
        "imageId": 1,
        "bwFilter":"0",
        "createdAt": "2019-10-04 14:13:38"
    }
### GET /camera/status
    {
        "name": "Sony Alpha 7ii"
        "status": "online"
    }
### GET /images
    [
        {
            "id": 1,
            "bwFilter":"1",
            "createdAt": "2019-10-04 14:13:38"
        },
        {
            "id": 2,
            "bwFilter":"0",
            "createdAt": "2019-10-04 14:13:38"
        },
        {
            "id": 3,
            "bwFilter":"1"
            "createdAt": "2019-10-04 14:13:38"
        }
    ]
## Installation on RaspberryPi
    sudo apt-get install apache2 -y
    sudo apt-get install php -y
    sudo apt-get install mariadb-server-10.0 php-mysql -y
    sudo service apache2 restart
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    sudo apt install php-curl php-gd php-imap php-json php-mcrypt php-mysql php-xmlrpc php-xml php-fpm php-zip -y
    sudo a2enmod proxy_fcgi setenvif
    sudo a2enconf php7.3-fpm
    sudo nano /etc/apache2/sites-available/000-default.conf
        Change DocumentRoot to /var/www/html/FotiBox/api/public
    sudo nano /etc/apache2/apache2.conf
        Change AllowOverride to All (<Directory /var/www/>)    
    sudo systemctl reload apache2
    
    sudo mysql_secure_installation
        enter
        n
        n
        enter
        enter
        enter
    sudo mysql -u root
        CREATE DATABASE fotiBox;
        USE fotiBox;
        CREATE TABLE `image` (
            `id`        int(11)      NOT NULL AUTO_INCREMENT,
            `path`      varchar(100) NOT NULL,
            `createdAt` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );
        CREATE USER 'fotiBox'@'localhost' IDENTIFIED BY 'password';
        GRANT SELECT, INSERT, UPDATE, DELETE ON fotiBox.* TO fotiBox@'localhost';    
        
    cd /var/www/html
    sudo git clone https://github.com/Simai00/FotiBox.git
    cd FotiBox/api
    sudo composer install
    sudo cp .env.example .env
    sudo cp db.env.example db.env
    sudo nano db.env
        Update user + password if necessary
    cd /var/www/html
    sudo chown -R www-data: .
    
    wget https://raw.githubusercontent.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh && chmod +x gphoto2-updater.sh && sudo ./gphoto2-updater.sh
    sudo gpasswd -a www-data plugdev
    
    Make a reboot!
