# API
### Startup
    php -S localhost:8080 -t public public/index.php
(You have to be in the /api folder)
## Routes /v1
#### GET /image/_{id}_
    Returns image resource 
#### GET /image/test
    Returns a test image (works already)    
#### DELETE /image/_{id}_
#### GET /camera/capture/image
    {
      "imageId": 1,
      "url": "http://localhost:8080/v1/image/1"
    }
#### GET /camera/status
#### GET /images
    [
      {
        "imageId": 1,
        "url": "http://localhost:8080/v1/image/1",
        "createdAt": "2019-10-04 14:13:38"
      },
      {
        "imageId": 2,
        "url": "http://localhost:8080/v1/image/2",
        "createdAt": "2019-10-04 14:13:38"
      },
      {
        "imageId": 3,
        "url": "http://localhost:8080/v1/image/3",
        "createdAt": "2019-10-04 14:13:38"
      }
    ]

