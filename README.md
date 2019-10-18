# FotiBox

## Startup for Dev (without Camera)
Clone the repository

```bash
git clone https://github.com/Simai00/FotiBox.git
cd FotiBox
```

### Backend
#### Requirements
* [Composer](https://getcomposer.org/) installed

#### Startup
    
Create DB [fotiBox.sql](https://github.com/Simai00/FotiBox/blob/master/fotiBox.sql)

Create the `.env` files from its corresponding example files:
* [db.env](https://github.com/Simai00/FotiBox/blob/master/api/db.env.example) (Change user and password if required)

Install dependencies
```bash
composer install
```

Start Server
```bash
php -S localhost:8080 -t public public/index.php
```

### Frontend    

Create the `.env` files from its corresponding example files:
* [.env.local](https://github.com/Simai00/FotiBox/blob/master/frontend/.env.local.example) (Change api url if required)
