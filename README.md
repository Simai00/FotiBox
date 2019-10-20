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
Navigate to frontend path `FotiBox/api/`
```bash
cd api
```

Create DB [fotiBox.sql](https://github.com/Simai00/FotiBox/blob/master/fotiBox.sql)

Create the `.env` files from its corresponding example files:
* [.env](https://github.com/Simai00/FotiBox/blob/master/api/.env.example) (Change APP_SIMULATE_CAMERA to true)
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

#### Requirements
* [npm](https://nodejs.org/en/) installed

#### Startup
Navigate to frontend path `FotiBox/frontend/`
```bash
cd frontend
```

Create the `.env` files from its corresponding example files:
* [.env.local](https://github.com/Simai00/FotiBox/blob/master/frontend/.env.local.example) (Change api url if required)

```bash
cp .env.local.example .env.local
```

Install dependencies
```bash
npm install
```

Start dev server
```bash
npm run serve
```
