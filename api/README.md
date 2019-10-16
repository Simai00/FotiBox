# API
### Startup
    php -S localhost:8080 -t public public/index.php
(You have to be in the /api folder)
## Routes /v1
#### GET /image/_{id}_/{quality}
    Returns image resource   
(Quality = original, medium, preview)    
#### DELETE /image/_{id}_
#### GET /camera/capture/image
    {
      "imageId": 1,
      "createdAt": "2019-10-04 14:13:38"
    }
#### GET /camera/status
#### GET /images
    [
      {
        "id": 1,
        "createdAt": "2019-10-04 14:13:38"
      },
      {
        "id": 2,
        "createdAt": "2019-10-04 14:13:38"
      },
      {
        "id": 3,
        "createdAt": "2019-10-04 14:13:38"
      }
    ]

